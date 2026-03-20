<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;

class PublisherData extends Data
{
    public function __construct(
        #[Required, Max(255)]
        public string $name,
        #[Url]
        public ?string $schemeUri = null,
        public ?string $publisherIdentifier = null,
        public ?string $publisherIdentifierScheme = null,
    ) {}
}
