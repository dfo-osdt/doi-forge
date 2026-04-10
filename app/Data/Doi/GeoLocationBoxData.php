<?php

declare(strict_types=1);

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class GeoLocationBoxData extends Data
{
    public function __construct(
        #[Required, Min(-90), Max(90)]
        public float $southBoundLatitude,
        #[Required, Min(-90), Max(90)]
        public float $northBoundLatitude,
        #[Required, Min(-180), Max(180)]
        public float $westBoundLongitude,
        #[Required, Min(-180), Max(180)]
        public float $eastBoundLongitude,
    ) {}
}
