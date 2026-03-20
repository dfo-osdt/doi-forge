<?php

namespace App\Services;

use App\Data\Doi\DoiData;
use VincentAuger\DataCiteSdk\Data\DOIData as SdkDOIData;
use VincentAuger\DataCiteSdk\DataCite;
use VincentAuger\DataCiteSdk\Enums\ApiVersion;
use VincentAuger\DataCiteSdk\Enums\DOIEvent;

final class DataCiteService
{
    private DataCite $client;

    private string $prefix;

    public function for(string $repositoryId, string $password, string $prefix): static
    {
        $this->prefix = $prefix;
        $this->client = new DataCite(
            baseUrl: config('datacite.base_url'),
            apiVersion: ApiVersion::MEMBER,
            username: $repositoryId,
            password: $password,
            mailto: config('datacite.mailto'),
        );

        return $this;
    }

    public function createDraft(DoiData $data): DoiData
    {
        /** @var SdkDOIData $doi */
        $doi = $this->client->createDOI($data->toCreateInput($this->prefix))->dto();

        return DoiData::fromSdk($doi);
    }

    public function getDoi(string $doi): DoiData
    {
        /** @var SdkDOIData $doiData */
        $doiData = $this->client->getDOI($doi)->dto();

        return DoiData::fromSdk($doiData);
    }

    public function updateDoi(string $doi, DoiData $data): DoiData
    {
        /** @var SdkDOIData $doiData */
        $doiData = $this->client->updateDOI($doi, $data->toUpdateInput())->dto();

        return DoiData::fromSdk($doiData);
    }

    public function publishDoi(string $doi, DoiData $data): DoiData
    {
        /** @var SdkDOIData $doiData */
        $doiData = $this->client->updateDOI($doi, $data->toUpdateInput(DOIEvent::PUBLISH))->dto();

        return DoiData::fromSdk($doiData);
    }

    public function registerDoi(string $doi, DoiData $data): DoiData
    {
        /** @var SdkDOIData $doiData */
        $doiData = $this->client->updateDOI($doi, $data->toUpdateInput(DOIEvent::REGISTER))->dto();

        return DoiData::fromSdk($doiData);
    }

    public function hideDoi(string $doi, DoiData $data): DoiData
    {
        /** @var SdkDOIData $doiData */
        $doiData = $this->client->updateDOI($doi, $data->toUpdateInput(DOIEvent::HIDE))->dto();

        return DoiData::fromSdk($doiData);
    }

    public function deleteDoi(string $doi): void
    {
        $this->client->deleteDOI($doi);
    }

    public function getClient(): DataCite
    {
        return $this->client;
    }
}
