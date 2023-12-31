<?php

declare(strict_types=1);

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class IndexController extends Controller
{
    public function __construct(
        private CourseService $courseService
    ) {
    }

    public function __invoke(Request $request): View
    {
        return view('courses.index', [
            'courses' => $this->courseService->getCourses(),
        ]);

    }
}
