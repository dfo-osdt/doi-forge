<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class RightsListData extends Data
{
    public function __construct(
        #[Max(255)]
        public string|Optional $rights = new Optional,
        #[Url]
        public string|Optional $rightsUri = new Optional,
        #[Url]
        public string|Optional $schemeUri = new Optional,
        #[Max(255)]
        public string|Optional $rightsIdentifier = new Optional,
        #[Max(255)]
        public string|Optional $rightsIdentifierScheme = new Optional,
        #[Max(10)]
        public string|Optional $lang = new Optional,
    ) {}
}
