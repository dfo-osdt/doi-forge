<?php

use App\Enums\DataCite\ContributorType;
use App\Enums\DataCite\DateType;
use App\Enums\DataCite\DescriptionType;
use App\Enums\DataCite\NameType;
use App\Enums\DataCite\RelatedIdentifierType;
use App\Enums\DataCite\RelationType;
use App\Enums\DataCite\ResourceTypeGeneral;
use App\Enums\DataCite\TitleType;
use VincentAuger\DataCiteSdk\Enums\ContributorType as SdkContributorType;
use VincentAuger\DataCiteSdk\Enums\DateType as SdkDateType;
use VincentAuger\DataCiteSdk\Enums\DescriptionType as SdkDescriptionType;
use VincentAuger\DataCiteSdk\Enums\NameType as SdkNameType;
use VincentAuger\DataCiteSdk\Enums\RelatedIdentifierType as SdkRelatedIdentifierType;
use VincentAuger\DataCiteSdk\Enums\RelationType as SdkRelationType;
use VincentAuger\DataCiteSdk\Enums\ResourceTypeGeneral as SdkResourceTypeGeneral;
use VincentAuger\DataCiteSdk\Enums\TitleType as SdkTitleType;

it('ResourceTypeGeneral has same string values as SDK enum', function (): void {
    $ourCases = array_column(ResourceTypeGeneral::cases(), 'value');
    $sdkCases = array_column(SdkResourceTypeGeneral::cases(), 'value');

    sort($ourCases);
    sort($sdkCases);

    expect($ourCases)->toBe($sdkCases);
});

it('ContributorType has same string values as SDK enum', function (): void {
    $ourCases = array_column(ContributorType::cases(), 'value');
    $sdkCases = array_column(SdkContributorType::cases(), 'value');

    sort($ourCases);
    sort($sdkCases);

    expect($ourCases)->toBe($sdkCases);
});

it('RelationType has same string values as SDK enum', function (): void {
    $ourCases = array_column(RelationType::cases(), 'value');
    $sdkCases = array_column(SdkRelationType::cases(), 'value');

    sort($ourCases);
    sort($sdkCases);

    expect($ourCases)->toBe($sdkCases);
});

it('DateType has same string values as SDK enum', function (): void {
    $ourCases = array_column(DateType::cases(), 'value');
    $sdkCases = array_column(SdkDateType::cases(), 'value');

    sort($ourCases);
    sort($sdkCases);

    expect($ourCases)->toBe($sdkCases);
});

it('DescriptionType has same string values as SDK enum', function (): void {
    $ourCases = array_column(DescriptionType::cases(), 'value');
    $sdkCases = array_column(SdkDescriptionType::cases(), 'value');

    sort($ourCases);
    sort($sdkCases);

    expect($ourCases)->toBe($sdkCases);
});

it('TitleType has same string values as SDK enum', function (): void {
    $ourCases = array_column(TitleType::cases(), 'value');
    $sdkCases = array_column(SdkTitleType::cases(), 'value');

    sort($ourCases);
    sort($sdkCases);

    expect($ourCases)->toBe($sdkCases);
});

it('NameType has same string values as SDK enum', function (): void {
    $ourCases = array_column(NameType::cases(), 'value');
    $sdkCases = array_column(SdkNameType::cases(), 'value');

    sort($ourCases);
    sort($sdkCases);

    expect($ourCases)->toBe($sdkCases);
});

it('RelatedIdentifierType has same string values as SDK enum', function (): void {
    $ourCases = array_column(RelatedIdentifierType::cases(), 'value');
    $sdkCases = array_column(SdkRelatedIdentifierType::cases(), 'value');

    sort($ourCases);
    sort($sdkCases);

    expect($ourCases)->toBe($sdkCases);
});

it('app enums can be converted to SDK enums via value', function (): void {
    expect(SdkResourceTypeGeneral::from(ResourceTypeGeneral::Dataset->value))->toBe(SdkResourceTypeGeneral::DATASET);
    expect(SdkTitleType::from(TitleType::Subtitle->value))->toBe(SdkTitleType::SUBTITLE);
    expect(SdkNameType::from(NameType::Personal->value))->toBe(SdkNameType::PERSONAL);
    expect(SdkDescriptionType::from(DescriptionType::Abstract->value))->toBe(SdkDescriptionType::ABSTRACT);
    expect(SdkDateType::from(DateType::Created->value))->toBe(SdkDateType::CREATED);
    expect(SdkContributorType::from(ContributorType::Editor->value))->toBe(SdkContributorType::EDITOR);
    expect(SdkRelationType::from(RelationType::Cites->value))->toBe(SdkRelationType::CITES);
});
