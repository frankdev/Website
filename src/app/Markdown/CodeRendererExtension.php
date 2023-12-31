<?php

namespace App\Markdown;

use Illuminate\Support\Facades\Blade;
use JetBrains\PhpStorm\NoReturn;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentRenderedEvent;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;

class CodeRendererExtension implements ExtensionInterface, NodeRendererInterface
{

    public static bool $allowBladeForNextDocument = false;

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addRenderer(FencedCode::class, $this, 100);
        $environment->addEventListener(DocumentRenderedEvent::class, [$this, 'onDocumentRenderedEvent']);
    }

    /**
     * @param Node $node
     * @param ChildNodeRendererInterface $childRenderer
     * @return string|void|null
     */
    #[NoReturn] public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        /** @var $node IndentedCode|FencedCode  */
        $info = $node->getInfoWords();

        if(!static::$allowBladeForNextDocument) {
            return;
        }

        if (in_array('+parse', $info)) {
           return Blade::render($node->getLiteral());
        }

        return null;
    }

    public function onDocumentRenderedEvent()
    {
        static::$allowBladeForNextDocument = false;
    }


}
