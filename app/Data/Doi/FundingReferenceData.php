<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class FundingReferenceData extends Data
{
    public function __construct(
        #[Required, Max(255)]
        public string $funderName,
        public string|Optional $funderIdentifier = new Optional,
        public string|Optional $funderIdentifierType = new Optional,
        public string|Optional $awardNumber = new Optional,
        #[Url]
        public string|Optional $awardUri = new Optional,
        #[Max(255)]
        public string|Optional $awardTitle = new Optional,
    ) {}
}
