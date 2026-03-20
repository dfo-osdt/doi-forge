<?php

namespace App\Data\Doi;

use App\Enums\DataCite\RelationType;
use App\Enums\DataCite\ResourceTypeGeneral;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class RelatedItemData extends Data
{
    /**
     * @param  TitleData[]  $titles
     * @param  CreatorData[]  $creators
     * @param  ContributorData[]  $contributors
     */
    public function __construct(
        #[DataCollectionOf(TitleData::class), Required, Min(1)]
        public array $titles,
        #[Required]
        public RelationType $relationType,
        #[Required]
        public ResourceTypeGeneral $relatedItemType,
        public RelatedItemIdentifierData|Optional $relatedItemIdentifier = new Optional,
        #[DataCollectionOf(CreatorData::class)]
        public array $creators = [],
        #[DataCollectionOf(ContributorData::class)]
        public array $contributors = [],
        #[Max(50)]
        public string|Optional $publicationYear = new Optional,
        #[Max(255)]
        public string|Optional $volume = new Optional,
        #[Max(50)]
        public string|Optional $issue = new Optional,
        #[Max(50)]
        public string|Optional $number = new Optional,
        #[Max(50)]
        public string|Optional $numberType = new Optional,
        #[Max(50)]
        public string|Optional $firstPage = new Optional,
        #[Max(50)]
        public string|Optional $lastPage = new Optional,
        #[Max(255)]
        public string|Optional $publisher = new Optional,
        #[Max(255)]
        public string|Optional $edition = new Optional,
    ) {}
}
