<?php

use Illuminate\Support\Facades\URL;
use function Pest\Laravel\get;

test('course list page is displayed', function () {

    $response = get('/courses');

    $response->assertOk();
    $response->assertSee('Practical Laravel Courses');
});

test('course list page has the create and deploy course', function () {

    /** @var \App\Services\CourseService  $service */
    $service = app()->make(\App\Services\CourseService::class);

    $courses = $service->getCourses();

    $response = get('/courses');
    $response->assertOk()
        ->assertViewHas('courses');

    foreach ($courses as $course) {
        $response->assertSee('<a href="' . url()->route(name: 'courses.show', parameters: [
            'slug' => $course->slug
            ] ) .'">');
        $response->assertSee($course->title);
    }

});
