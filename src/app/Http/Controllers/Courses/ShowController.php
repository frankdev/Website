<?php

declare(strict_types=1);

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class ShowController extends Controller
{

    public function __construct(
        private readonly CourseService $courseService
    ) {}

    public function __invoke(Request $request, string $slug): View
    {
        return view('courses.show', [
            'course' => $this->courseService->getCourse(
                slug: $slug
            )
        ]);

    }
}
