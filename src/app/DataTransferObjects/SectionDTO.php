<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class SectionDTO extends Data
{

    public function __construct(
        public string $title,
        #[DataCollectionOf(LessonDTO::class)]
        public ?DataCollection $lessons
    ) {}

}
