<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ContainerData extends Data
{
    public function __construct(
        #[Max(255)]
        public string|Optional $type = new Optional,
        #[Max(255)]
        public string|Optional $title = new Optional,
        #[Max(50)]
        public string|Optional $firstPage = new Optional,
    ) {}
}
