<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;

class RightsListData extends Data
{
    public function __construct(
        #[Max(255)]
        public ?string $rights = null,
        #[Url]
        public ?string $rightsUri = null,
        #[Url]
        public ?string $schemeUri = null,
        #[Max(255)]
        public ?string $rightsIdentifier = null,
        #[Max(255)]
        public ?string $rightsIdentifierScheme = null,
        #[Max(10)]
        public ?string $lang = null,
    ) {}
}
