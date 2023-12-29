<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShowController extends Controller
{

    public function __invoke(string $slug)
    {


        if (!File::exists(base_path('content/articles/' . $slug . '.md'))) {
            throw new NotFoundHttpException();
        }

        $contents = file_get_contents(base_path('content/articles/' . $slug . '.md'));
        $object = YamlFrontMatter::parse($contents);
        dd($contents, $object);
    }
}
