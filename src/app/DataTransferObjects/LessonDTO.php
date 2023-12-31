<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class LessonDTO extends Data
{

    public function __construct(
        public string $title,
        public string $slug,
        public ?string $description,
        public ?string $body,
        #[WithCast(DateTimeInterfaceCast::class, format: "Y-m-d H:i:s")]
        public Carbon $created_at
    ) {}

}
