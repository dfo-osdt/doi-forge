<?php

declare(strict_types=1);

namespace App\Enums\DataCite;

enum ContributorType: string
{
    case ContactPerson = 'ContactPerson';
    case DataCollector = 'DataCollector';
    case DataCurator = 'DataCurator';
    case DataManager = 'DataManager';
    case Distributor = 'Distributor';
    case Editor = 'Editor';
    case HostingInstitution = 'HostingInstitution';
    case Producer = 'Producer';
    case ProjectLeader = 'ProjectLeader';
    case ProjectManager = 'ProjectManager';
    case ProjectMember = 'ProjectMember';
    case RegistrationAgency = 'RegistrationAgency';
    case RegistrationAuthority = 'RegistrationAuthority';
    case RelatedPerson = 'RelatedPerson';
    case Researcher = 'Researcher';
    case ResearchGroup = 'ResearchGroup';
    case RightsHolder = 'RightsHolder';
    case Sponsor = 'Sponsor';
    case Supervisor = 'Supervisor';
    case Translator = 'Translator';
    case WorkPackageLeader = 'WorkPackageLeader';
    case Other = 'Other';
}
