<?php

declare(strict_types=1);

namespace App\Enums\DataCite;

enum DescriptionType: string
{
    case Abstract = 'Abstract';
    case Methods = 'Methods';
    case SeriesInformation = 'SeriesInformation';
    case TableOfContents = 'TableOfContents';
    case TechnicalInfo = 'TechnicalInfo';
    case Other = 'Other';
}
