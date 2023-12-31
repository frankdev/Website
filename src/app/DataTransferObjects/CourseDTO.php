<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CourseDTO extends Data
{
    public function __construct(
        public string $title,
        public string $slug,
        public string $directory,
        public ?string $description,
        public ?string $body,
        #[DataCollectionOf(TagDTO::class)]
        public DataCollection $tags,
        #[DataCollectionOf(SectionDTO::class)]
        public DataCollection $sections,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public Carbon $created_at
    ) {
    }
}
