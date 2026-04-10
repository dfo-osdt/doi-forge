<?php

declare(strict_types=1);

namespace App\Enums\DataCite;

enum RelationType: string
{
    case IsCitedBy = 'IsCitedBy';
    case Cites = 'Cites';
    case IsSupplementTo = 'IsSupplementTo';
    case IsSupplementedBy = 'IsSupplementedBy';
    case IsContinuedBy = 'IsContinuedBy';
    case Continues = 'Continues';
    case IsDescribedBy = 'IsDescribedBy';
    case Describes = 'Describes';
    case HasMetadata = 'HasMetadata';
    case IsMetadataFor = 'IsMetadataFor';
    case HasVersion = 'HasVersion';
    case IsVersionOf = 'IsVersionOf';
    case IsNewVersionOf = 'IsNewVersionOf';
    case IsPreviousVersionOf = 'IsPreviousVersionOf';
    case IsPartOf = 'IsPartOf';
    case HasPart = 'HasPart';
    case IsPublishedIn = 'IsPublishedIn';
    case IsReferencedBy = 'IsReferencedBy';
    case References = 'References';
    case IsDocumentedBy = 'IsDocumentedBy';
    case Documents = 'Documents';
    case IsCompiledBy = 'IsCompiledBy';
    case Compiles = 'Compiles';
    case IsVariantFormOf = 'IsVariantFormOf';
    case IsOriginalFormOf = 'IsOriginalFormOf';
    case IsIdenticalTo = 'IsIdenticalTo';
    case IsReviewedBy = 'IsReviewedBy';
    case Reviews = 'Reviews';
    case IsDerivedFrom = 'IsDerivedFrom';
    case IsSourceOf = 'IsSourceOf';
    case IsRequiredBy = 'IsRequiredBy';
    case Requires = 'Requires';
    case IsObsoletedBy = 'IsObsoletedBy';
    case Obsoletes = 'Obsoletes';
    case IsCollectedBy = 'IsCollectedBy';
    case Collects = 'Collects';
    case IsTranslationOf = 'IsTranslationOf';
    case HasTranslation = 'HasTranslation';
    case Other = 'Other';
}
