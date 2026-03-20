<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;
use VincentAuger\DataCiteSdk\Data\Affiliations\PublisherData as SdkPublisherData;
use VincentAuger\DataCiteSdk\Data\CreateDOIInput;
use VincentAuger\DataCiteSdk\Data\DOIData as SdkDOIData;
use VincentAuger\DataCiteSdk\Data\GeoLocation\GeoLocation;
use VincentAuger\DataCiteSdk\Data\Identifiers\AlternateIdentifier;
use VincentAuger\DataCiteSdk\Data\Identifiers\Identifier;
use VincentAuger\DataCiteSdk\Data\Identifiers\RelatedIdentifier;
use VincentAuger\DataCiteSdk\Data\Identifiers\RelatedItem;
use VincentAuger\DataCiteSdk\Data\Metadata\ContainerData as SdkContainerData;
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

class DoiData extends Data
{
    /**
     * @param  CreatorData[]  $creators
     * @param  TitleData[]  $titles
     * @param  IdentifierData[]|null  $identifiers
     * @param  AlternateIdentifierData[]|null  $alternateIdentifiers
     * @param  SubjectData[]|null  $subjects
     * @param  ContributorData[]|null  $contributors
     * @param  DateData[]|null  $dates
     * @param  RelatedIdentifierData[]|null  $relatedIdentifiers
     * @param  RelatedItemData[]|null  $relatedItems
     * @param  string[]|null  $sizes
     * @param  string[]|null  $formats
     * @param  RightsListData[]|null  $rightsList
     * @param  DescriptionData[]|null  $descriptions
     * @param  GeoLocationData[]|null  $geoLocations
     * @param  FundingReferenceData[]|null  $fundingReferences
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
        public ?string $prefix = null,
        #[DataCollectionOf(IdentifierData::class)]
        public ?array $identifiers = null,
        #[DataCollectionOf(AlternateIdentifierData::class)]
        public ?array $alternateIdentifiers = null,
        public ?ContainerData $container = null,
        #[DataCollectionOf(SubjectData::class)]
        public ?array $subjects = null,
        #[DataCollectionOf(ContributorData::class)]
        public ?array $contributors = null,
        #[DataCollectionOf(DateData::class)]
        public ?array $dates = null,
        #[Max(10)]
        public ?string $language = null,
        #[DataCollectionOf(RelatedIdentifierData::class)]
        public ?array $relatedIdentifiers = null,
        #[DataCollectionOf(RelatedItemData::class)]
        public ?array $relatedItems = null,
        public ?array $sizes = null,
        public ?array $formats = null,
        #[Max(255)]
        public ?string $version = null,
        #[DataCollectionOf(RightsListData::class)]
        public ?array $rightsList = null,
        #[DataCollectionOf(DescriptionData::class)]
        public ?array $descriptions = null,
        #[DataCollectionOf(GeoLocationData::class)]
        public ?array $geoLocations = null,
        #[DataCollectionOf(FundingReferenceData::class)]
        public ?array $fundingReferences = null,
        #[Url, Max(2048)]
        public ?string $contentUrl = null,
        #[Max(255)]
        public ?string $schemaVersion = null,
    ) {}

    public static function fromSdk(SdkDOIData $doi): static
    {
        return static::from($doi->toArray()['data']['attributes']);
    }

    public function toCreateInput(): CreateDOIInput
    {
        $attrs = $this->toArray();

        return new CreateDOIInput(
            prefix: (string) ($attrs['prefix'] ?? ''),
            creators: self::buildCreators($attrs['creators']),
            titles: array_map(Title::fromArray(...), $attrs['titles']),
            publicationYear: (int) $attrs['publicationYear'],
            publisher: is_array($attrs['publisher']) ? SdkPublisherData::fromArray($attrs['publisher']) : (string) $attrs['publisher'],
            types: ResourceType::fromArray($attrs['types']),
            url: (string) $attrs['url'],
            identifiers: $attrs['identifiers'] !== null ? array_map(Identifier::fromArray(...), $attrs['identifiers']) : null,
            alternateIdentifiers: $attrs['alternateIdentifiers'] !== null ? array_map(AlternateIdentifier::fromArray(...), $attrs['alternateIdentifiers']) : null,
            container: $attrs['container'] !== null ? SdkContainerData::fromArray($attrs['container']) : null,
            subjects: $attrs['subjects'] !== null ? array_map(Subject::fromArray(...), $attrs['subjects']) : null,
            contributors: $attrs['contributors'] !== null ? self::buildContributors($attrs['contributors']) : null,
            dates: $attrs['dates'] !== null ? array_map(Date::fromArray(...), $attrs['dates']) : null,
            language: $attrs['language'],
            relatedIdentifiers: $attrs['relatedIdentifiers'] !== null ? array_map(RelatedIdentifier::fromArray(...), $attrs['relatedIdentifiers']) : null,
            relatedItems: $attrs['relatedItems'] !== null ? array_map(RelatedItem::fromArray(...), $attrs['relatedItems']) : null,
            sizes: $attrs['sizes'],
            formats: $attrs['formats'],
            version: $attrs['version'],
            rightsList: $attrs['rightsList'] !== null ? array_map(RightsList::fromArray(...), $attrs['rightsList']) : null,
            descriptions: $attrs['descriptions'] !== null ? array_values(array_filter(array_map(Description::fromArray(...), $attrs['descriptions']))) : null,
            geoLocations: $attrs['geoLocations'] !== null ? array_map(GeoLocation::fromArray(...), $attrs['geoLocations']) : null,
            fundingReferences: $attrs['fundingReferences'] !== null ? array_map(FundingReference::fromArray(...), $attrs['fundingReferences']) : null,
            contentUrl: $attrs['contentUrl'],
            schemaVersion: $attrs['schemaVersion'],
        );
    }

    public function toUpdateInput(): UpdateDOIInput
    {
        $attrs = $this->toArray();

        return new UpdateDOIInput(
            prefix: $attrs['prefix'],
            creators: self::buildCreators($attrs['creators']),
            titles: array_map(Title::fromArray(...), $attrs['titles']),
            publicationYear: $attrs['publicationYear'] !== null ? (int) $attrs['publicationYear'] : null,
            publisher: is_array($attrs['publisher']) ? SdkPublisherData::fromArray($attrs['publisher']) : (string) $attrs['publisher'],
            types: $attrs['types'] !== null ? ResourceType::fromArray($attrs['types']) : null,
            url: $attrs['url'],
            identifiers: $attrs['identifiers'] !== null ? array_map(Identifier::fromArray(...), $attrs['identifiers']) : null,
            alternateIdentifiers: $attrs['alternateIdentifiers'] !== null ? array_map(AlternateIdentifier::fromArray(...), $attrs['alternateIdentifiers']) : null,
            container: $attrs['container'] !== null ? SdkContainerData::fromArray($attrs['container']) : null,
            subjects: $attrs['subjects'] !== null ? array_map(Subject::fromArray(...), $attrs['subjects']) : null,
            contributors: $attrs['contributors'] !== null ? self::buildContributors($attrs['contributors']) : null,
            dates: $attrs['dates'] !== null ? array_map(Date::fromArray(...), $attrs['dates']) : null,
            language: $attrs['language'],
            relatedIdentifiers: $attrs['relatedIdentifiers'] !== null ? array_map(RelatedIdentifier::fromArray(...), $attrs['relatedIdentifiers']) : null,
            relatedItems: $attrs['relatedItems'] !== null ? array_map(RelatedItem::fromArray(...), $attrs['relatedItems']) : null,
            sizes: $attrs['sizes'],
            formats: $attrs['formats'],
            version: $attrs['version'],
            rightsList: $attrs['rightsList'] !== null ? array_map(RightsList::fromArray(...), $attrs['rightsList']) : null,
            descriptions: $attrs['descriptions'] !== null ? array_values(array_filter(array_map(Description::fromArray(...), $attrs['descriptions']))) : null,
            geoLocations: $attrs['geoLocations'] !== null ? array_map(GeoLocation::fromArray(...), $attrs['geoLocations']) : null,
            fundingReferences: $attrs['fundingReferences'] !== null ? array_map(FundingReference::fromArray(...), $attrs['fundingReferences']) : null,
            contentUrl: $attrs['contentUrl'],
            schemaVersion: $attrs['schemaVersion'],
        );
    }

    /** @param array<array<string, mixed>> $creators */
    private static function buildCreators(array $creators): array
    {
        return array_values(array_filter(array_map(
            fn (array $c) => Creator::fromArray([...$c, 'affiliation' => $c['affiliation'] ?? [], 'nameIdentifiers' => $c['nameIdentifiers'] ?? []]),
            $creators
        )));
    }

    /** @param array<array<string, mixed>> $contributors */
    private static function buildContributors(array $contributors): array
    {
        return array_values(array_filter(array_map(
            fn (array $c) => Contributor::fromArray([...$c, 'affiliation' => $c['affiliation'] ?? [], 'nameIdentifiers' => $c['nameIdentifiers'] ?? []]),
            $contributors
        )));
    }
}
