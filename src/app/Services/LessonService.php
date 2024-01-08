<?php

namespace App\Services;

use App\DataTransferObjects\CourseDTO;
use App\DataTransferObjects\LessonDTO;

final class LessonService
{
    public function __construct(
        private readonly CourseService $courseService
    ) {
    }

    /**
     * @return array{CourseDTO|null, LessonDTO|null}
     */
    public function getLesson(string $courseSlug, string $lessonSlug): array
    {

        $course = $this->courseService->getCourse($courseSlug);
        foreach ($course->sections->items() as $section) {
            if ($lesson = $section->lessons->where('slug', $lessonSlug)->first()) {
                return [$course, $lesson];
            }
        }

        return [$course, null];

    }
}
