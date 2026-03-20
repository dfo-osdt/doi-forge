<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class GeoLocationData extends Data
{
    /**
     * @param  GeoLocationPolygonData[]  $geoLocationPolygon
     */
    public function __construct(
        #[Max(255)]
        public string|Optional $geoLocationPlace = new Optional,
        public GeoLocationPointData|Optional $geoLocationPoint = new Optional,
        public GeoLocationBoxData|Optional $geoLocationBox = new Optional,
        #[DataCollectionOf(GeoLocationPolygonData::class)]
        public array|Optional $geoLocationPolygon = new Optional,
    ) {}
}
