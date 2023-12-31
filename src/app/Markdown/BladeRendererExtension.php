<?php

namespace App\Markdown;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Event\DocumentRenderedEvent;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\HtmlBlock;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Output\RenderedContent;
use League\CommonMark\Renderer\HtmlRenderer;

class BladeRendererExtension implements ExtensionInterface
{
    public array $rendered = [];

    public Environment|EnvironmentBuilderInterface $environment;

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addEventListener(
            DocumentParsedEvent::class, [$this, 'onDocumentParsed'], -10
        );

        $environment->addEventListener(
            DocumentRenderedEvent::class, [$this, 'onDocumentRendered'], 100
        );

        $this->environment = $environment;
    }

    public function onDocumentParsed(DocumentParsedEvent $event): void
    {

        foreach ($event->getDocument()->iterator() as $node) {
            if (! $this->isCodeNode($node)) {
                continue;
            }

            /** @var FencedCode|IndentedCode|Code $node */
            $id = Str::uuid()->toString();
            $replacement = new HtmlBlock(HtmlBlock::TYPE_6_BLOCK_ELEMENT);
            $replacement->setLiteral("[[replace:$id]]");

            $node->replaceWith($replacement);

            $this->rendered[$id] = (new HtmlRenderer($this->environment))->renderNodes([
                $node,
            ]);

        }

    }

    public function onDocumentRendered(DocumentRenderedEvent $event): void
    {

        //dd($event->getOutput()->getContent());

        $content = Blade::render(
            $event->getOutput()->getContent()
        );

        $search = [];
        $replace = [];

        foreach ($this->rendered as $id => $rendered) {

            $search[] = "<p>[[replace:$id]]</p>";
            $replace[] = $rendered;
            $search[] = "[[replace:$id]]";
            $replace[] = $rendered;

        }

        $content = Str::replace($search, $replace, $content);

        $event->replaceOutput(
            new RenderedContent(
                $event->getOutput()->getDocument(), $content
            )
        );

    }

    protected function isCodeNode($node): bool
    {
        return $node instanceof FencedCode
            || $node instanceof IndentedCode
            || $node instanceof Code;
    }
}
