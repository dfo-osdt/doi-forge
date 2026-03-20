<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;

class SubjectData extends Data
{
    public function __construct(
        #[Required, Max(255)]
        public string $subject,
        public ?string $subjectScheme = null,
        #[Url]
        public ?string $schemeUri = null,
        #[Url]
        public ?string $valueUri = null,
        public ?string $classificationCode = null,
        #[Max(10)]
        public ?string $lang = null,
    ) {}
}
