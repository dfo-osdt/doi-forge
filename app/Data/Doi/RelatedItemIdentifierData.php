<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;

class RelatedItemIdentifierData extends Data
{
    public function __construct(
        #[Max(255)]
        public ?string $relatedItemIdentifier = null,
        #[Max(255)]
        public ?string $relatedItemIdentifierType = null,
    ) {}
}
