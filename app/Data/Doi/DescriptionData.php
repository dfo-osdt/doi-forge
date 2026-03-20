<?php

namespace App\Data\Doi;

use App\Enums\DataCite\DescriptionType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class DescriptionData extends Data
{
    public function __construct(
        #[Required]
        public string $description,
        #[Required]
        public DescriptionType $descriptionType,
        #[Max(10)]
        public ?string $lang = null,
    ) {}
}
