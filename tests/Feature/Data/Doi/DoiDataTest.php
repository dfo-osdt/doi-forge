<?php

use App\Data\Doi\CreatorData;
use App\Data\Doi\DoiData;
use App\Data\Doi\PublisherData;
use App\Data\Doi\ResourceTypeData;
use App\Data\Doi\TitleData;
use App\Enums\DataCite\NameType;
use App\Enums\DataCite\ResourceTypeGeneral;
use App\Enums\DataCite\TitleType;
use Spatie\LaravelData\Optional;

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

it('creates DoiData from array with required fields', function (): void {
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

it('casts enum values when creating from array', function (): void {
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

it('serializes to array preserving enum values as strings', function (): void {
    $data = minimalDoiData();
    $array = $data->toArray();

    expect($array['creators'][0]['name'])->toBe('Smith, John')
        ->and($array['titles'][0]['title'])->toBe('Test Dataset')
        ->and($array['publicationYear'])->toBe(2024)
        ->and($array['url'])->toBe('https://example.com/dataset')
        ->and($array['types']['resourceTypeGeneral'])->toBe('Dataset');
});

it('optional fields default correctly when not provided', function (): void {
    $data = minimalDoiData();

    // String/object optional fields use Optional sentinel
    expect($data->prefix)->toBeInstanceOf(Optional::class)
        ->and($data->language)->toBeInstanceOf(Optional::class)
        ->and($data->version)->toBeInstanceOf(Optional::class)
        ->and($data->contentUrl)->toBeInstanceOf(Optional::class)
        ->and($data->schemaVersion)->toBeInstanceOf(Optional::class)
        ->and($data->container)->toBeInstanceOf(Optional::class);

    // Array optional fields default to empty arrays
    expect($data->identifiers)->toBe([])
        ->and($data->alternateIdentifiers)->toBe([])
        ->and($data->subjects)->toBe([])
        ->and($data->contributors)->toBe([])
        ->and($data->dates)->toBe([])
        ->and($data->relatedIdentifiers)->toBe([])
        ->and($data->relatedItems)->toBe([])
        ->and($data->sizes)->toBe([])
        ->and($data->formats)->toBe([])
        ->and($data->rightsList)->toBe([])
        ->and($data->descriptions)->toBe([])
        ->and($data->geoLocations)->toBe([])
        ->and($data->fundingReferences)->toBe([]);
});

it('accepts publisher as string', function (): void {
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

it('round-trips through array serialization', function (): void {
    $original = minimalDoiData();
    $reconstructed = DoiData::from($original->toArray());

    expect($reconstructed->creators[0]->name)->toBe($original->creators[0]->name)
        ->and($reconstructed->titles[0]->title)->toBe($original->titles[0]->title)
        ->and($reconstructed->publicationYear)->toBe($original->publicationYear)
        ->and($reconstructed->url)->toBe($original->url)
        ->and($reconstructed->types->resourceTypeGeneral)->toBe($original->types->resourceTypeGeneral);
});
