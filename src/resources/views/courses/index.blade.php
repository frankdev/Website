<x-public-layout>


    <section class="py-16">
        <div class="container mx-auto grid gap-8 md:gap-16 md:grid-cols-2">
            <header>
                <div class="text-indigo-400 text-md mb-2">
                    Courses
                </div>
                <h1 class="text-5xl font-bold">
                    Practical Laravel Courses
                </h1>
                <p class="mt-8 md:text-lg text-gray-100">
                    Courses that focus on building real apps like you were working on a real Dev team.
                </p>
            </header>
            <div class="border dark:border-gray-600 rounded-md">

            </div>
        </div>

    </section>


    <div class="flex">
        <div class="bg-gradient-to-r from-transparent to-indigo-700 to-25% my-4  w-6/12" style="height: 1px">

        </div>

        <div class="bg-gradient-to-l from-transparent to-indigo-700 to-25% my-4  w-6/12" style="height: 1px">

        </div>

    </div>


    <main class="py-16 dark:text-gray-200">
        <div class="container mx-auto mb-4">
            <h2 class="dark:text-indigo-400">Latest Courses</h2>
        </div>

        <ul class="container mx-auto grid md:grid-cols-3">
            @foreach($courses->items as $course)
                <li class="dark:bg-gray-800 px-8 md:px-10 py-6 md:py-8 rounded-xl">
                    <h2 class="text-lg dark:text-gray-200 font-black">
                        {{ $course->title }}
                    </h2>
                    <p class="dark:text-gray-400 mt-4">
                        {{ $course->description }}
                    </p>
                    <div class="mt-4">
                        <a href="{{ url()->route('courses.show', ['slug' => $course->slug]) }}"
                            class="inline-flex items-center justify-center h-10 bg-indigo-500 rounded text-sm px-5 transition-all font-semibold w-full">
                            Start learning
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </main>

</x-public-layout>
