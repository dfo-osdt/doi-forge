<?php

declare(strict_types=1);

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class GeoLocationPointData extends Data
{
    public function __construct(
        #[Required, Min(-180), Max(180)]
        public float $pointLongitude,
        #[Required, Min(-90), Max(90)]
        public float $pointLatitude,
    ) {}
}
