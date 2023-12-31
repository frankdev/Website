<?php

namespace App\Services;

use App\DataTransferObjects\CourseDTO;
use App\DataTransferObjects\CoursesDTO;
use App\DataTransferObjects\LessonDTO;
use App\DataTransferObjects\SectionDTO;
use App\Markdown\CodeRendererExtension;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\LaravelData\DataCollection;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class CourseService
{
    /**
     * Returns the list of courses that are published under
     * the content /courses folder
     *
     * @return CoursesDTO
     */
    public function getCourses(): CoursesDTO
    {
        $courses = CourseDTO::collection([]);
        $directories = glob(base_path('content/courses/*'));

        CodeRendererExtension::$allowBladeForNextDocument = true;

        foreach ($directories as $courseDirectory) {
            $courseIndex = $courseDirectory.'/index.md';
            if (File::exists($courseIndex)) {

                $course = YamlFrontMatter::parse(
                    content: file_get_contents($courseIndex)
                );

                $courses[] = CourseDTO::from(array_merge(
                    $course->matter(), [
                        'body' => Markdown::convert($course->body()),
                        'directory' => $courseDirectory,
                        'sections' => $this->getSections($courseDirectory),
                    ]
                ));

            }
        }

        return CoursesDTO::from([
            'items' => $courses
        ]);
    }

    /**
     * @return DataCollection<(int|string), SectionDTO>
     */
    public function getSections(string $directory): DataCollection
    {
        $sections = SectionDTO::collection([]);
        $sectionsDirectories = glob($directory.'/*', GLOB_ONLYDIR);

        foreach ($sectionsDirectories as $sectionDirectory) {
            $sectionFolder = explode('-', last(explode(DIRECTORY_SEPARATOR, $sectionDirectory)));
            unset($sectionFolder[0]);
            $sections[] = $this->addSectionLessons(
                section: SectionDTO::from([
                    'title' => Str::title(implode(' ', $sectionFolder)),
                ]),
                directory: $sectionDirectory
            );
        }

        return $sections;

    }

    public function addSectionLessons(SectionDTO $section, string $directory): SectionDTO
    {

        $files = glob($directory.'/*.{md}', GLOB_BRACE);
        $section->lessons = LessonDTO::collection([]);

        foreach ($files as $file) {
            $lesson = YamlFrontMatter::parse(
                content: file_get_contents($file)
            );

            $section->lessons[] = LessonDTO::from(array_merge(
                $lesson->matter(), [
                    'body' => Markdown::convert($lesson->body())->getContent(),
                ]
            ));
        }

        return $section;

    }

    public function getCourse(string $slug): CourseDTO
    {

        $courses = $this->getCourses();

        return $courses->items->where('slug', $slug)->first();

    }
}
