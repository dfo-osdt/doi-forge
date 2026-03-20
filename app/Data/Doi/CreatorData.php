<?php

namespace App\Data\Doi;

use App\Enums\DataCite\NameType;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class CreatorData extends Data
{
    /**
     * @param  AffiliationData[]|null  $affiliation
     * @param  NameIdentifierData[]|null  $nameIdentifiers
     */
    public function __construct(
        #[Required, Max(255)]
        public string $name,
        public ?NameType $nameType = null,
        #[Max(255)]
        public ?string $givenName = null,
        #[Max(255)]
        public ?string $familyName = null,
        #[DataCollectionOf(AffiliationData::class)]
        public ?array $affiliation = null,
        #[DataCollectionOf(NameIdentifierData::class)]
        public ?array $nameIdentifiers = null,
    ) {}
}
