<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;

class NameIdentifierData extends Data
{
    public function __construct(
        public ?string $nameIdentifier = null,
        public ?string $nameIdentifierScheme = null,
        #[Url]
        public ?string $schemeUri = null,
    ) {}
}
