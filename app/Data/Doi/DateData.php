<?php

namespace App\Data\Doi;

use App\Enums\DataCite\DateType;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class DateData extends Data
{
    public function __construct(
        #[Required]
        public string|int $date,
        #[Required]
        public DateType $dateType,
        public ?string $dateInformation = null,
    ) {}
}
