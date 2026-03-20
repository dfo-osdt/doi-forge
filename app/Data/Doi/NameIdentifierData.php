<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class NameIdentifierData extends Data
{
    public function __construct(
        public string|Optional $nameIdentifier = new Optional,
        public string|Optional $nameIdentifierScheme = new Optional,
        #[Url]
        public string|Optional $schemeUri = new Optional,
    ) {}
}
