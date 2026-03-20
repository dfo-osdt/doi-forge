<?php

use App\Data\Doi\CreatorData;
use App\Data\Doi\DescriptionData;
use App\Data\Doi\DoiData;
use App\Data\Doi\PublisherData;
use App\Data\Doi\ResourceTypeData;
use App\Data\Doi\TitleData;
use App\Enums\DataCite\DescriptionType;
use App\Enums\DataCite\ResourceTypeGeneral;
use App\Services\DataCiteService;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use VincentAuger\DataCiteSdk\Requests\DOIs\CreateDOI;
use VincentAuger\DataCiteSdk\Requests\DOIs\DeleteDOI;
use VincentAuger\DataCiteSdk\Requests\DOIs\GetDOI;
use VincentAuger\DataCiteSdk\Requests\DOIs\UpdateDOI;

function doiFixture(): array
{
    return json_decode(file_get_contents(__DIR__.'/../../Fixtures/DataCite/doi_response.json'), true);
}

function makeService(): DataCiteService
{
    return (new DataCiteService)->for('test-repo-id', 'test-password');
}

function minimalInput(): DoiData
{
    return new DoiData(
        creators: [new CreatorData(name: 'Smith, John')],
        titles: [new TitleData(title: 'Test Dataset')],
        publicationYear: 2024,
        publisher: new PublisherData(name: 'Zenodo'),
        types: new ResourceTypeData(resourceTypeGeneral: ResourceTypeGeneral::Dataset),
        url: 'https://example.com/dataset',
        prefix: '10.5281',
    );
}

it('createDraft sends correct payload and returns DoiData', function () {
    $mockClient = new MockClient([
        CreateDOI::class => MockResponse::make(doiFixture(), 201),
    ]);

    $service = makeService();
    $service->getClient()->withMockClient($mockClient);

    $result = $service->createDraft(minimalInput());

    expect($result)->toBeInstanceOf(DoiData::class)
        ->and($result->prefix)->toBe('10.5281')
        ->and($result->creators[0]->name)->toBe('Smith, John')
        ->and($result->titles[0]->title)->toBe('Test Dataset')
        ->and($result->publicationYear)->toBe(2024)
        ->and($result->url)->toBe('https://example.com/dataset')
        ->and($result->types->resourceTypeGeneral)->toBe(ResourceTypeGeneral::Dataset)
        ->and($result->language)->toBe('en')
        ->and($result->version)->toBe('1.0');

    $mockClient->assertSent(CreateDOI::class);
});

it('getDoi returns DoiData with inbound descriptions', function () {
    $mockClient = new MockClient([
        GetDOI::class => MockResponse::make(doiFixture(), 200),
    ]);

    $service = makeService();
    $service->getClient()->withMockClient($mockClient);

    $result = $service->getDoi('10.5281/zenodo.123456');

    expect($result)->toBeInstanceOf(DoiData::class)
        ->and($result->descriptions)->toHaveCount(1)
        ->and($result->descriptions[0])->toBeInstanceOf(DescriptionData::class)
        ->and($result->descriptions[0]->description)->toBe('A test dataset description.')
        ->and($result->descriptions[0]->descriptionType)->toBe(DescriptionType::Abstract);

    $mockClient->assertSent(GetDOI::class);
});

it('updateDoi sends PUT request and returns updated DoiData', function () {
    $mockClient = new MockClient([
        UpdateDOI::class => MockResponse::make(doiFixture(), 200),
    ]);

    $service = makeService();
    $service->getClient()->withMockClient($mockClient);

    $result = $service->updateDoi('10.5281/zenodo.123456', minimalInput());

    expect($result)->toBeInstanceOf(DoiData::class);

    $mockClient->assertSent(UpdateDOI::class);
});

it('deleteDoi sends DELETE request', function () {
    $mockClient = new MockClient([
        DeleteDOI::class => MockResponse::make([], 204),
    ]);

    $service = makeService();
    $service->getClient()->withMockClient($mockClient);

    $service->deleteDoi('10.5281/zenodo.123456');

    $mockClient->assertSent(DeleteDOI::class);
});

it('maps publisher as PublisherData object from response', function () {
    $mockClient = new MockClient([
        GetDOI::class => MockResponse::make(doiFixture(), 200),
    ]);

    $service = makeService();
    $service->getClient()->withMockClient($mockClient);

    $result = $service->getDoi('10.5281/zenodo.123456');

    expect($result->publisher)->toBeInstanceOf(PublisherData::class)
        ->and($result->publisher->name)->toBe('Zenodo');
});

it('datacite config resolves correctly', function () {
    expect(config('datacite.base_url'))->not->toBeEmpty()
        ->and(config('datacite'))->toHaveKey('base_url')
        ->and(config('datacite'))->toHaveKey('mailto');
});
