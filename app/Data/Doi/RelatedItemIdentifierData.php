<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class RelatedItemIdentifierData extends Data
{
    public function __construct(
        #[Max(255)]
        public string|Optional $relatedItemIdentifier = new Optional,
        #[Max(255)]
        public string|Optional $relatedItemIdentifierType = new Optional,
    ) {}
}
