<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Services\CourseService;
use App\Services\LessonService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class WatchController extends Controller
{

    public function __construct(
        private readonly LessonService $lessonService
    ) {}

    public function __invoke(Request $request, string $course, string $lesson): View
    {

        list($course, $lesson) = $this->lessonService->getLesson($course, $lesson);


        if(!$course || !$lesson) {
            throw new NotFoundHttpException();
        }

        return view('courses.watch', [
            'course' => $course,
            'lesson' => $lesson
        ]);
    }

}
