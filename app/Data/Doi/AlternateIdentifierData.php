<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class AlternateIdentifierData extends Data
{
    public function __construct(
        #[Required]
        public string $alternateIdentifier,
        #[Required, Max(255)]
        public string $alternateIdentifierType,
    ) {}
}
