<?php

namespace App\Data\Doi;

use App\Enums\DataCite\ResourceTypeGeneral;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class ResourceTypeData extends Data
{
    public function __construct(
        #[Required]
        public ResourceTypeGeneral $resourceTypeGeneral,
        #[Max(255)]
        public ?string $resourceType = null,
    ) {}
}
