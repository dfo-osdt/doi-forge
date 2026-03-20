<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class GeoLocationPolygonData extends Data
{
    /**
     * @param  GeoLocationPointData[]  $polygonPoints
     */
    public function __construct(
        #[DataCollectionOf(GeoLocationPointData::class), Required, Min(4)]
        public array $polygonPoints,
        public GeoLocationPointData|Optional $inPolygonPoint = new Optional,
    ) {}
}
