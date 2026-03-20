<?php

namespace App\Data\Doi;

use App\Enums\DataCite\TitleType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class TitleData extends Data
{
    public function __construct(
        #[Required, Max(255)]
        public string $title,
        #[Max(10)]
        public string|Optional $lang = new Optional,
        public TitleType|Optional $titleType = new Optional,
    ) {}
}
