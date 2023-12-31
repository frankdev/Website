<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Illuminate\Support\Str;
use Spatie\LaravelData\Data;

final class TagDTO extends Data
{
    public function __construct(
        public string $title,
        public string $slug,
        public ?string $description,
    ) {
    }

    public static function fromTitle(string $title, ?string $description = null): TagDTO
    {

        return new self(
            title: $title,
            slug: Str::slug($title),
            description: $description
        );

    }
}
