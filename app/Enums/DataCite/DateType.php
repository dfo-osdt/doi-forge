<?php

namespace App\Enums\DataCite;

enum DateType: string
{
    case Accepted = 'Accepted';
    case Available = 'Available';
    case Copyrighted = 'Copyrighted';
    case Collected = 'Collected';
    case Coverage = 'Coverage';
    case Created = 'Created';
    case Issued = 'Issued';
    case Submitted = 'Submitted';
    case Updated = 'Updated';
    case Valid = 'Valid';
    case Withdrawn = 'Withdrawn';
    case Other = 'Other';
}
