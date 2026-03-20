<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;

class GeoLocationData extends Data
{
    /**
     * @param  GeoLocationPolygonData[]|null  $geoLocationPolygon
     */
    public function __construct(
        #[Max(255)]
        public ?string $geoLocationPlace = null,
        public ?GeoLocationPointData $geoLocationPoint = null,
        public ?GeoLocationBoxData $geoLocationBox = null,
        #[DataCollectionOf(GeoLocationPolygonData::class)]
        public ?array $geoLocationPolygon = null,
    ) {}
}
