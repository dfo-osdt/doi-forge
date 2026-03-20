<?php

namespace App\Data\Doi;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;

class ContainerData extends Data
{
    public function __construct(
        #[Max(255)]
        public ?string $type = null,
        #[Max(255)]
        public ?string $title = null,
        #[Max(50)]
        public ?string $firstPage = null,
    ) {}
}
