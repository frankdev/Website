<?php
/**
 * @var \App\DataTransferObjects\CourseDTO $course
 */
/** @var \App\DataTransferObjects\LessonDTO $lesson */

?>
<x-public-layout>

    <main class="flex flex-col overflow-hidden -mx-4">
        <div class="dark:bg-gradient-to-r dark:from-gray-900 dark:to-gray-800 w-full py-4 px-4 md:px-8 flex items-center justify-between dark:bg-gray-800 border-b dark:border-gray-700">
            <a href="{{ url()->route('courses.show', ['slug' => $course->slug])  }}"
               class="flex inline-flex space-x-4">
                <span><svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M7.28 7.72a.75.75 0 0 1 0 1.06l-2.47 2.47H21a.75.75 0 0 1 0 1.5H4.81l2.47 2.47a.75.75 0 1 1-1.06 1.06l-3.75-3.75a.75.75 0 0 1 0-1.06l3.75-3.75a.75.75 0 0 1 1.06 0" clip-rule="evenodd"/></svg></span>
                <span>{{ $course->title }}</span>

            </a>
            <div>
                Completion
            </div>
        </div>


        <div class="w-full flex flex-col lg:flex-row  dark:bg-gray-800">
            <div class="flex-1 py-4 px-4 md:px-8 dark:bg-gray-900 dark:bg-gradient-to-r dark:from-gray-900 dark:to-gray-800">
                <article class="prose prose-ray dark:prose-invert xl:prose-lg max-w-7xl">
                    {!! $lesson->body !!}
                </article>
            </div>
            <div class="w-full lg:w-96 py-4 px-4 md:px-8">
                <x-lesson.list :course="$course" :current="$lesson" />
            </div>
        </div>

    </main>





</x-public-layout>
