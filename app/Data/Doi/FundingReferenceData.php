<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;

class FundingReferenceData extends Data
{
    public function __construct(
        #[Required, Max(255)]
        public string $funderName,
        public ?string $funderIdentifier = null,
        public ?string $funderIdentifierType = null,
        public ?string $awardNumber = null,
        #[Url]
        public ?string $awardUri = null,
        #[Max(255)]
        public ?string $awardTitle = null,
    ) {}
}
