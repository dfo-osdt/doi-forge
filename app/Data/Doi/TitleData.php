<?php

namespace App\Data\Doi;

use App\Enums\DataCite\TitleType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class TitleData extends Data
{
    public function __construct(
        #[Required, Max(255)]
        public string $title,
        #[Max(10)]
        public ?string $lang = null,
        public ?TitleType $titleType = null,
    ) {}
}
