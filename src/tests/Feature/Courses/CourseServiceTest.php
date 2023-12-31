<?php

test('that getCourses returns a list of courses', function () {

    /** @var \App\Services\CourseService $courseService */
    $courseService = app()->make(\App\Services\CourseService::class);

    expect($courseService->getCourses())
        ->toBeInstanceOf(
            class: \Spatie\LaravelData\DataCollection::class
        );
});

test('that we can get a course by slug', function () {

    /** @var \App\Services\CourseService $courseService */
    $courseService = app()->make(\App\Services\CourseService::class);

    $slug = 'create-deploy-laravel-application';
    $course = $courseService->getCourse(
        slug: $slug
    );

    expect(value: $course)
        ->toBeInstanceOf(
            class: \App\DataTransferObjects\CourseDTO::class
        )
        ->and(value: $course->title)
        ->toBe(
            expected: 'Create and Deploy a Laravel Application from Scratch'
        );

});
