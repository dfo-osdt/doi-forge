<?php

declare(strict_types=1);

namespace App\Enums\DataCite;

enum TitleType: string
{
    case AlternativeTitle = 'AlternativeTitle';
    case Subtitle = 'Subtitle';
    case TranslatedTitle = 'TranslatedTitle';
    case Other = 'Other';
}
