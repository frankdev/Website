<?php

namespace App\Services;

use App\DataTransferObjects\CourseDTO;
use App\DataTransferObjects\LessonDTO;
use App\DataTransferObjects\SectionDTO;

final class LessonService
{

    /**
     * @param CourseService $courseService
     */
    public function __construct(
        private readonly CourseService $courseService
    ) {}

    /**
     * @param string $courseSlug
     * @param string $lessonSlug
     * @return array{CourseDTO, LessonDTO}
     */
    public function getLesson(string $courseSlug, string $lessonSlug): array
    {

        $course = $this->courseService->getCourse($courseSlug);
        foreach ($course->sections->items() as $section) {
            if($lesson = $section->lessons->where('slug', $lessonSlug)->first()) {
                return [$course, $lesson];
            }
        }

        return [$course, null];

    }

}
