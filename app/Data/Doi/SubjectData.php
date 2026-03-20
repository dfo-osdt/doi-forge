<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class SubjectData extends Data
{
    public function __construct(
        #[Required, Max(255)]
        public string $subject,
        public string|Optional $subjectScheme = new Optional,
        #[Url]
        public string|Optional $schemeUri = new Optional,
        #[Url]
        public string|Optional $valueUri = new Optional,
        public string|Optional $classificationCode = new Optional,
        #[Max(10)]
        public string|Optional $lang = new Optional,
    ) {}
}
