<?php

it('course details page is displayed', function () {

    $response = $this->get('courses/create-deploy-laravel-application');

    $response->assertOk();

});
