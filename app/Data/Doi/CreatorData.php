<?php

namespace App\Data\Doi;

use App\Enums\DataCite\NameType;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CreatorData extends Data
{
    /**
     * @param  AffiliationData[]  $affiliation
     * @param  NameIdentifierData[]  $nameIdentifiers
     */
    public function __construct(
        #[Required, Max(255)]
        public string $name,
        public NameType|Optional $nameType = new Optional,
        #[Max(255)]
        public string|Optional $givenName = new Optional,
        #[Max(255)]
        public string|Optional $familyName = new Optional,
        #[DataCollectionOf(AffiliationData::class)]
        public array $affiliation = [],
        #[DataCollectionOf(NameIdentifierData::class)]
        public array $nameIdentifiers = [],
    ) {}
}
