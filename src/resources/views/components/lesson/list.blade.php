@props(['course', 'current'])

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
                        <li
                            class="py-3 border dark:border-gray-700 px-4 rounded hover:dark:bg-gray-800 transition-all cursor-pointer text-sm font-semibold @if($current->slug === $lesson->slug) dark:bg-gray-700 pointer-events-none @else dark:bg-gray-800 @endif">
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

