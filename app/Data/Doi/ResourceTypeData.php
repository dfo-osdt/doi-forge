<?php

namespace App\Data\Doi;

use App\Enums\DataCite\ResourceTypeGeneral;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ResourceTypeData extends Data
{
    public function __construct(
        #[Required]
        public ResourceTypeGeneral $resourceTypeGeneral,
        #[Max(255)]
        public string|Optional $resourceType = new Optional,
    ) {}
}
