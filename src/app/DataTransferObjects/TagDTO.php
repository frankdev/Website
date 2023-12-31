<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;
use Illuminate\Support\Str;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class TagDTO extends Data
{

    public function __construct(
        public string $title,
        public string $slug,
        public ?string $description,
    ) {}

    public static function fromTitle(string $title, string $description = null): TagDTO
    {

        return new static(
            title: $title,
            slug: Str::slug($title),
            description: $description
        );

    }

}
