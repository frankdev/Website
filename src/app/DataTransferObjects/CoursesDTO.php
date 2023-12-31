<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CoursesDTO extends Data
{

    public function __construct(
        #[DataCollectionOf(CourseDTO::class)]
        public DataCollection $items
    ) {}

}
