<?php

namespace App\Data\Doi;

use App\Enums\DataCite\RelatedIdentifierType;
use App\Enums\DataCite\RelationType;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;

class RelatedIdentifierData extends Data
{
    public function __construct(
        #[Required]
        public string $relatedIdentifier,
        #[Required]
        public RelatedIdentifierType $relatedIdentifierType,
        #[Required]
        public RelationType $relationType,
        public ?string $relatedMetadataScheme = null,
        #[Url]
        public ?string $schemeUri = null,
        public ?string $schemeType = null,
        public ?string $resourceTypeGeneral = null,
    ) {}
}
