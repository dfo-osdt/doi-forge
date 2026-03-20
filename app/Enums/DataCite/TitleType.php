<?php

namespace App\Enums\DataCite;

enum TitleType: string
{
    case AlternativeTitle = 'AlternativeTitle';
    case Subtitle = 'Subtitle';
    case TranslatedTitle = 'TranslatedTitle';
    case Other = 'Other';
}
