<?php
/**
 * @var \App\DataTransferObjects\CourseDTO $course
 */

?>
<x-public-layout>
    <section class="py-10">
        <div class="container mx-auto">
            <header class="px-8 py-12 dark:bg-gray-800 rounded-xl">
                <div class="flex items-center flex-wrap text-indigo-400 mb-8 gap-2">
                    @foreach($course->tags->items() as $tag)
                        <span
                            class="uppercase inline-flex whitespace-nowrap py-1.5 px-3 rounded-xl dark:bg-gray-700 dark:text-gray-400 font-semibold text-xs">
                            {{ $tag->title }}
                        </span>
                    @endforeach
                </div>
                <h1 class="text-5xl font-bold">
                    {{ $course->title  }}
                </h1>
                <p class="mt-8 md:text-lg text-gray-100">
                    {{ $course->description }}
                </p>
            </header>
        </div>
    </section>

    <main class="dark:text-gray-200">
        <div class="container mx-auto mb-4 md:grid md:grid-cols-2 px-2 md:px-8 gap-24">
            <div>
                <h2 class="text-lg font-semibold mb-4">
                    About this Course
                </h2>
                <article class="prose prose-ray dark:prose-invert">
                    {!! $course->body !!}
                </article>
            </div>
            <div>
                <h2 class="text-lg font-semibold mb-4">
                    Course Lessons
                </h2>
                <ul class="flex flex-col gap-4">
                    <?php $i = 1; ?>
                    @foreach($course->sections->items() as $sectionKey => $section)
                        <li>
                            <span class="text-sm dark:text-gray-400 mb-2 inline-flex">
                               {{ $section->title }}
                            </span>
                            <ul class="flex flex-col gap-1">
                            @foreach($section->lessons->items() as $lessonKey => $lesson)
                                <a href="{{ url()->route('courses.watch', ['course' => $course->slug, 'lesson' => $lesson->slug])  }}">
                                <li class="py-3 border dark:border-gray-600 px-4 rounded dark:bg-gray-700 hover:dark:bg-gray-800 transition-all cursor-pointer text-sm font-semibold">
                                    <span class="text-white">
                                        {{ sprintf("%02d", $i )  }}. {{ $lesson->title }}
                                    </span>
                                </li>
                                </a>
                                <?php $i++ ?>
                            @endforeach
                            </ul>
                        </li>
                    @endforeach

                </ul>
            </div>

        </div>
    </main>

</x-public-layout>
