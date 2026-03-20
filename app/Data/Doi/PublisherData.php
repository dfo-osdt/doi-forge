<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class PublisherData extends Data
{
    public function __construct(
        #[Required, Max(255)]
        public string $name,
        #[Url]
        public string|Optional $schemeUri = new Optional,
        public string|Optional $publisherIdentifier = new Optional,
        public string|Optional $publisherIdentifierScheme = new Optional,
    ) {}
}
