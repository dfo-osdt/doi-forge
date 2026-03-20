<?php

namespace App\Data\Doi;

use App\Enums\DataCite\RelationType;
use App\Enums\DataCite\ResourceTypeGeneral;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class RelatedItemData extends Data
{
    /**
     * @param  TitleData[]  $titles
     * @param  CreatorData[]|null  $creators
     * @param  ContributorData[]|null  $contributors
     */
    public function __construct(
        #[DataCollectionOf(TitleData::class), Required, Min(1)]
        public array $titles,
        #[Required]
        public RelationType $relationType,
        #[Required]
        public ResourceTypeGeneral $relatedItemType,
        public ?RelatedItemIdentifierData $relatedItemIdentifier = null,
        #[DataCollectionOf(CreatorData::class)]
        public ?array $creators = null,
        #[DataCollectionOf(ContributorData::class)]
        public ?array $contributors = null,
        #[Max(50)]
        public ?string $publicationYear = null,
        #[Max(255)]
        public ?string $volume = null,
        #[Max(50)]
        public ?string $issue = null,
        #[Max(50)]
        public ?string $number = null,
        #[Max(50)]
        public ?string $numberType = null,
        #[Max(50)]
        public ?string $firstPage = null,
        #[Max(50)]
        public ?string $lastPage = null,
        #[Max(255)]
        public ?string $publisher = null,
        #[Max(255)]
        public ?string $edition = null,
    ) {}
}
