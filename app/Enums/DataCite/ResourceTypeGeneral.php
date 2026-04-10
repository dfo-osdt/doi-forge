<?php

declare(strict_types=1);

namespace App\Enums\DataCite;

enum ResourceTypeGeneral: string
{
    case Audiovisual = 'Audiovisual';
    case Award = 'Award';
    case Book = 'Book';
    case BookChapter = 'BookChapter';
    case Collection = 'Collection';
    case ComputationalNotebook = 'ComputationalNotebook';
    case ConferencePaper = 'ConferencePaper';
    case ConferenceProceeding = 'ConferenceProceeding';
    case DataPaper = 'DataPaper';
    case Dataset = 'Dataset';
    case Dissertation = 'Dissertation';
    case Event = 'Event';
    case Image = 'Image';
    case InteractiveResource = 'InteractiveResource';
    case Instrument = 'Instrument';
    case Journal = 'Journal';
    case JournalArticle = 'JournalArticle';
    case Model = 'Model';
    case OutputManagementPlan = 'OutputManagementPlan';
    case PeerReview = 'PeerReview';
    case PhysicalObject = 'PhysicalObject';
    case Poster = 'Poster';
    case Preprint = 'Preprint';
    case Presentation = 'Presentation';
    case Project = 'Project';
    case Report = 'Report';
    case Service = 'Service';
    case Software = 'Software';
    case Sound = 'Sound';
    case Standard = 'Standard';
    case StudyRegistration = 'StudyRegistration';
    case Text = 'Text';
    case Workflow = 'Workflow';
    case Other = 'Other';
}
