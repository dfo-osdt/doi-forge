<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use VincentAuger\DataCiteSdk\Data\Affiliations\PublisherData as SdkPublisherData;
use VincentAuger\DataCiteSdk\Data\CreateDOIInput;
use VincentAuger\DataCiteSdk\Data\DOIData as SdkDOIData;
use VincentAuger\DataCiteSdk\Data\GeoLocation\GeoLocation;
use VincentAuger\DataCiteSdk\Data\Identifiers\AlternateIdentifier;
use VincentAuger\DataCiteSdk\Data\Identifiers\RelatedIdentifier;
use VincentAuger\DataCiteSdk\Data\Identifiers\RelatedItem;
use VincentAuger\DataCiteSdk\Data\Metadata\Contributor;
use VincentAuger\DataCiteSdk\Data\Metadata\Creator;
use VincentAuger\DataCiteSdk\Data\Metadata\Date;
use VincentAuger\DataCiteSdk\Data\Metadata\Description;
use VincentAuger\DataCiteSdk\Data\Metadata\FundingReference;
use VincentAuger\DataCiteSdk\Data\Metadata\ResourceType;
use VincentAuger\DataCiteSdk\Data\Metadata\RightsList;
use VincentAuger\DataCiteSdk\Data\Metadata\Subject;
use VincentAuger\DataCiteSdk\Data\Metadata\Title;
use VincentAuger\DataCiteSdk\Data\UpdateDOIInput;
use VincentAuger\DataCiteSdk\Enums\DOIEvent;

class DoiData extends Data
{
    /**
     * @param  CreatorData[]  $creators
     * @param  TitleData[]  $titles
     * @param  AlternateIdentifierData[]  $alternateIdentifiers
     * @param  SubjectData[]  $subjects
     * @param  ContributorData[]  $contributors
     * @param  DateData[]  $dates
     * @param  RelatedIdentifierData[]  $relatedIdentifiers
     * @param  RelatedItemData[]  $relatedItems
     * @param  string[]  $sizes
     * @param  string[]  $formats
     * @param  RightsListData[]  $rightsList
     * @param  DescriptionData[]  $descriptions
     * @param  GeoLocationData[]  $geoLocations
     * @param  FundingReferenceData[]  $fundingReferences
     */
    public function __construct(
        #[Required, DataCollectionOf(CreatorData::class), Min(1)]
        public array $creators,
        #[Required, DataCollectionOf(TitleData::class), Min(1)]
        public array $titles,
        #[Required, IntegerType, Min(1000), Max(9999)]
        public int $publicationYear,
        #[Required]
        public PublisherData|string $publisher,
        #[Required]
        public ResourceTypeData $types,
        #[Required, Url, Max(2048)]
        public string $url,
        #[Max(255)]
        public string|Optional $prefix = new Optional,
        #[DataCollectionOf(AlternateIdentifierData::class)]
        public array $alternateIdentifiers = [],
        #[DataCollectionOf(SubjectData::class)]
        public array $subjects = [],
        #[DataCollectionOf(ContributorData::class)]
        public array $contributors = [],
        #[DataCollectionOf(DateData::class)]
        public array $dates = [],
        #[Max(10)]
        public string|Optional $language = new Optional,
        #[DataCollectionOf(RelatedIdentifierData::class)]
        public array $relatedIdentifiers = [],
        #[DataCollectionOf(RelatedItemData::class)]
        public array $relatedItems = [],
        public array $sizes = [],
        public array $formats = [],
        #[Max(255)]
        public string|Optional $version = new Optional,
        #[DataCollectionOf(RightsListData::class)]
        public array $rightsList = [],
        #[DataCollectionOf(DescriptionData::class)]
        public array $descriptions = [],
        #[DataCollectionOf(GeoLocationData::class)]
        public array $geoLocations = [],
        #[DataCollectionOf(FundingReferenceData::class)]
        public array $fundingReferences = [],
        #[Url, Max(2048)]
        public string|Optional $contentUrl = new Optional,
    ) {}

    public static function fromSdk(SdkDOIData $doi): static
    {
        return static::from($doi->toArray()['data']['attributes']);
    }

    public function toCreateInput(string $prefix, ?DOIEvent $event = null): CreateDOIInput
    {
        $attrs = $this->toArray();

        return new CreateDOIInput(
            prefix: $prefix,
            event: $event,
            creators: array_values(array_filter(array_map(Creator::fromArray(...), $attrs['creators']))),
            titles: array_map(Title::fromArray(...), $attrs['titles']),
            publicationYear: (int) $attrs['publicationYear'],
            publisher: is_array($attrs['publisher']) ? SdkPublisherData::fromArray($attrs['publisher']) : (string) $attrs['publisher'],
            types: ResourceType::fromArray($attrs['types']),
            url: (string) $attrs['url'],
            alternateIdentifiers: array_map(AlternateIdentifier::fromArray(...), $attrs['alternateIdentifiers']),
            subjects: array_map(Subject::fromArray(...), $attrs['subjects']),
            contributors: array_values(array_filter(array_map(Contributor::fromArray(...), $attrs['contributors']))),
            dates: array_map(Date::fromArray(...), $attrs['dates']),
            language: $attrs['language'] ?? null,
            relatedIdentifiers: array_map(RelatedIdentifier::fromArray(...), $attrs['relatedIdentifiers']),
            relatedItems: array_map(RelatedItem::fromArray(...), $attrs['relatedItems']),
            sizes: $attrs['sizes'],
            formats: $attrs['formats'],
            version: $attrs['version'] ?? null,
            rightsList: array_map(RightsList::fromArray(...), $attrs['rightsList']),
            descriptions: array_values(array_filter(array_map(Description::fromArray(...), $attrs['descriptions']))),
            geoLocations: array_map(GeoLocation::fromArray(...), $attrs['geoLocations']),
            fundingReferences: array_map(FundingReference::fromArray(...), $attrs['fundingReferences']),
            contentUrl: $attrs['contentUrl'] ?? null,
        );
    }

    public function toUpdateInput(?DOIEvent $event = null): UpdateDOIInput
    {
        $attrs = $this->toArray();

        return new UpdateDOIInput(
            prefix: $attrs['prefix'] ?? null,
            event: $event,
            creators: array_values(array_filter(array_map(Creator::fromArray(...), $attrs['creators']))),
            titles: array_map(Title::fromArray(...), $attrs['titles']),
            publicationYear: (int) $attrs['publicationYear'],
            publisher: is_array($attrs['publisher']) ? SdkPublisherData::fromArray($attrs['publisher']) : (string) $attrs['publisher'],
            types: ResourceType::fromArray($attrs['types']),
            url: $attrs['url'],
            alternateIdentifiers: array_map(AlternateIdentifier::fromArray(...), $attrs['alternateIdentifiers']),
            subjects: array_map(Subject::fromArray(...), $attrs['subjects']),
            contributors: array_values(array_filter(array_map(Contributor::fromArray(...), $attrs['contributors']))),
            dates: array_map(Date::fromArray(...), $attrs['dates']),
            language: $attrs['language'] ?? null,
            relatedIdentifiers: array_map(RelatedIdentifier::fromArray(...), $attrs['relatedIdentifiers']),
            relatedItems: array_map(RelatedItem::fromArray(...), $attrs['relatedItems']),
            sizes: $attrs['sizes'],
            formats: $attrs['formats'],
            version: $attrs['version'] ?? null,
            rightsList: array_map(RightsList::fromArray(...), $attrs['rightsList']),
            descriptions: array_values(array_filter(array_map(Description::fromArray(...), $attrs['descriptions']))),
            geoLocations: array_map(GeoLocation::fromArray(...), $attrs['geoLocations']),
            fundingReferences: array_map(FundingReference::fromArray(...), $attrs['fundingReferences']),
            contentUrl: $attrs['contentUrl'] ?? null,
        );
    }
}
