<?php

namespace App\Data\Doi;

use App\Enums\DataCite\RelatedIdentifierType;
use App\Enums\DataCite\RelationType;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class RelatedIdentifierData extends Data
{
    public function __construct(
        #[Required]
        public string $relatedIdentifier,
        #[Required]
        public RelatedIdentifierType $relatedIdentifierType,
        #[Required]
        public RelationType $relationType,
        public string|Optional $relatedMetadataScheme = new Optional,
        #[Url]
        public string|Optional $schemeUri = new Optional,
        public string|Optional $schemeType = new Optional,
        public string|Optional $resourceTypeGeneral = new Optional,
    ) {}
}
