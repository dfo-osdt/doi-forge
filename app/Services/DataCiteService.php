<?php

namespace App\Services;

use App\Data\Doi\DoiData;
use VincentAuger\DataCiteSdk\Data\DOIData as SdkDOIData;
use VincentAuger\DataCiteSdk\DataCite;
use VincentAuger\DataCiteSdk\Enums\ApiVersion;

final class DataCiteService
{
    private DataCite $client;

    public function for(string $repositoryId, string $password): static
    {
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
        $doi = $this->client->createDOI($data->toCreateInput())->dto();

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

    public function deleteDoi(string $doi): void
    {
        $this->client->deleteDOI($doi);
    }

    public function getClient(): DataCite
    {
        return $this->client;
    }
}
