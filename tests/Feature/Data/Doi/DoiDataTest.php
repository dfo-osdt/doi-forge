<?php

use App\Data\Doi\CreatorData;
use App\Data\Doi\DoiData;
use App\Data\Doi\PublisherData;
use App\Data\Doi\ResourceTypeData;
use App\Data\Doi\TitleData;
use App\Enums\DataCite\NameType;
use App\Enums\DataCite\ResourceTypeGeneral;
use App\Enums\DataCite\TitleType;

function minimalDoiData(): DoiData
{
    return new DoiData(
        creators: [new CreatorData(name: 'Smith, John')],
        titles: [new TitleData(title: 'Test Dataset')],
        publicationYear: 2024,
        publisher: new PublisherData(name: 'Test Publisher'),
        types: new ResourceTypeData(resourceTypeGeneral: ResourceTypeGeneral::Dataset),
        url: 'https://example.com/dataset',
    );
}

it('creates DoiData from array with required fields', function () {
    $data = DoiData::from([
        'creators' => [['name' => 'Smith, John']],
        'titles' => [['title' => 'Test Dataset']],
        'publicationYear' => 2024,
        'publisher' => ['name' => 'Test Publisher'],
        'types' => ['resourceTypeGeneral' => 'Dataset'],
        'url' => 'https://example.com/dataset',
    ]);

    expect($data->creators[0]->name)->toBe('Smith, John')
        ->and($data->titles[0]->title)->toBe('Test Dataset')
        ->and($data->publicationYear)->toBe(2024)
        ->and($data->url)->toBe('https://example.com/dataset')
        ->and($data->types->resourceTypeGeneral)->toBe(ResourceTypeGeneral::Dataset);
});

it('casts enum values when creating from array', function () {
    $data = DoiData::from([
        'creators' => [['name' => 'Smith, John', 'nameType' => 'Personal']],
        'titles' => [['title' => 'Test', 'titleType' => 'Subtitle']],
        'publicationYear' => 2024,
        'publisher' => ['name' => 'Test Publisher'],
        'types' => ['resourceTypeGeneral' => 'Dataset'],
        'url' => 'https://example.com',
    ]);

    expect($data->creators[0]->nameType)->toBe(NameType::Personal)
        ->and($data->titles[0]->titleType)->toBe(TitleType::Subtitle);
});

it('serializes to array preserving enum values as strings', function () {
    $data = minimalDoiData();
    $array = $data->toArray();

    expect($array['creators'][0]['name'])->toBe('Smith, John')
        ->and($array['titles'][0]['title'])->toBe('Test Dataset')
        ->and($array['publicationYear'])->toBe(2024)
        ->and($array['url'])->toBe('https://example.com/dataset')
        ->and($array['types']['resourceTypeGeneral'])->toBe('Dataset');
});

it('optional fields default to null', function () {
    $data = minimalDoiData();

    expect($data->prefix)->toBeNull()
        ->and($data->identifiers)->toBeNull()
        ->and($data->alternateIdentifiers)->toBeNull()
        ->and($data->subjects)->toBeNull()
        ->and($data->contributors)->toBeNull()
        ->and($data->dates)->toBeNull()
        ->and($data->language)->toBeNull()
        ->and($data->relatedIdentifiers)->toBeNull()
        ->and($data->relatedItems)->toBeNull()
        ->and($data->sizes)->toBeNull()
        ->and($data->formats)->toBeNull()
        ->and($data->version)->toBeNull()
        ->and($data->rightsList)->toBeNull()
        ->and($data->descriptions)->toBeNull()
        ->and($data->geoLocations)->toBeNull()
        ->and($data->fundingReferences)->toBeNull()
        ->and($data->contentUrl)->toBeNull()
        ->and($data->schemaVersion)->toBeNull();
});

it('accepts publisher as string', function () {
    $data = DoiData::from([
        'creators' => [['name' => 'Smith, John']],
        'titles' => [['title' => 'Test Dataset']],
        'publicationYear' => 2024,
        'publisher' => 'Simple Publisher Name',
        'types' => ['resourceTypeGeneral' => 'Dataset'],
        'url' => 'https://example.com/dataset',
    ]);

    expect($data->publisher)->toBe('Simple Publisher Name');
});

it('round-trips through array serialization', function () {
    $original = minimalDoiData();
    $reconstructed = DoiData::from($original->toArray());

    expect($reconstructed->creators[0]->name)->toBe($original->creators[0]->name)
        ->and($reconstructed->titles[0]->title)->toBe($original->titles[0]->title)
        ->and($reconstructed->publicationYear)->toBe($original->publicationYear)
        ->and($reconstructed->url)->toBe($original->url)
        ->and($reconstructed->types->resourceTypeGeneral)->toBe($original->types->resourceTypeGeneral);
});
