declare namespace App {
namespace Data {
namespace Doi {
export type AffiliationData = {
name: string,
schemeUri: string | null,
affiliationIdentifier: string | null,
affiliationIdentifierScheme: string | null,
};
export type AlternateIdentifierData = {
alternateIdentifier: string,
alternateIdentifierType: string,
};
export type ContainerData = {
type: string | null,
title: string | null,
firstPage: string | null,
};
export type ContributorData = {
name: string,
contributorType: App.Enums.DataCite.ContributorType,
nameType: App.Enums.DataCite.NameType | null,
givenName: string | null,
familyName: string | null,
affiliation: App.Data.Doi.AffiliationData[] | null,
nameIdentifiers: App.Data.Doi.NameIdentifierData[] | null,
};
export type CreatorData = {
name: string,
nameType: App.Enums.DataCite.NameType | null,
givenName: string | null,
familyName: string | null,
affiliation: App.Data.Doi.AffiliationData[] | null,
nameIdentifiers: App.Data.Doi.NameIdentifierData[] | null,
};
export type DateData = {
date: string | number,
dateType: App.Enums.DataCite.DateType,
dateInformation: string | null,
};
export type DescriptionData = {
description: string,
descriptionType: App.Enums.DataCite.DescriptionType,
lang: string | null,
};
export type DoiFormData = {
creators: App.Data.Doi.CreatorData[],
titles: App.Data.Doi.TitleData[],
publicationYear: number,
publisher: App.Data.Doi.PublisherData | string,
types: App.Data.Doi.ResourceTypeData,
url: string,
prefix: string | null,
identifiers: App.Data.Doi.IdentifierData[] | null,
alternateIdentifiers: App.Data.Doi.AlternateIdentifierData[] | null,
container: App.Data.Doi.ContainerData | null,
subjects: App.Data.Doi.SubjectData[] | null,
contributors: App.Data.Doi.ContributorData[] | null,
dates: App.Data.Doi.DateData[] | null,
language: string | null,
relatedIdentifiers: App.Data.Doi.RelatedIdentifierData[] | null,
relatedItems: App.Data.Doi.RelatedItemData[] | null,
sizes: string[] | null,
formats: string[] | null,
version: string | null,
rightsList: App.Data.Doi.RightsListData[] | null,
descriptions: App.Data.Doi.DescriptionData[] | null,
geoLocations: App.Data.Doi.GeoLocationData[] | null,
fundingReferences: App.Data.Doi.FundingReferenceData[] | null,
contentUrl: string | null,
schemaVersion: string | null,
};
export type FundingReferenceData = {
funderName: string,
funderIdentifier: string | null,
funderIdentifierType: string | null,
awardNumber: string | null,
awardUri: string | null,
awardTitle: string | null,
};
export type GeoLocationBoxData = {
southBoundLatitude: number,
northBoundLatitude: number,
westBoundLongitude: number,
eastBoundLongitude: number,
};
export type GeoLocationData = {
geoLocationPlace: string | null,
geoLocationPoint: App.Data.Doi.GeoLocationPointData | null,
geoLocationBox: App.Data.Doi.GeoLocationBoxData | null,
geoLocationPolygon: App.Data.Doi.GeoLocationPolygonData[] | null,
};
export type GeoLocationPointData = {
pointLongitude: number,
pointLatitude: number,
};
export type GeoLocationPolygonData = {
polygonPoints: App.Data.Doi.GeoLocationPointData[],
inPolygonPoint: App.Data.Doi.GeoLocationPointData | null,
};
export type IdentifierData = {
identifier: string,
identifierType: string,
};
export type NameIdentifierData = {
nameIdentifier: string | null,
nameIdentifierScheme: string | null,
schemeUri: string | null,
};
export type PublisherData = {
name: string,
schemeUri: string | null,
publisherIdentifier: string | null,
publisherIdentifierScheme: string | null,
};
export type RelatedIdentifierData = {
relatedIdentifier: string,
relatedIdentifierType: App.Enums.DataCite.RelatedIdentifierType,
relationType: App.Enums.DataCite.RelationType,
relatedMetadataScheme: string | null,
schemeUri: string | null,
schemeType: string | null,
resourceTypeGeneral: string | null,
};
export type RelatedItemData = {
titles: App.Data.Doi.TitleData[],
relationType: App.Enums.DataCite.RelationType,
relatedItemType: App.Enums.DataCite.ResourceTypeGeneral,
relatedItemIdentifier: App.Data.Doi.RelatedItemIdentifierData | null,
creators: App.Data.Doi.CreatorData[] | null,
contributors: App.Data.Doi.ContributorData[] | null,
publicationYear: string | null,
volume: string | null,
issue: string | null,
number: string | null,
numberType: string | null,
firstPage: string | null,
lastPage: string | null,
publisher: string | null,
edition: string | null,
};
export type RelatedItemIdentifierData = {
relatedItemIdentifier: string | null,
relatedItemIdentifierType: string | null,
};
export type ResourceTypeData = {
resourceTypeGeneral: App.Enums.DataCite.ResourceTypeGeneral,
resourceType: string | null,
};
export type RightsListData = {
rights: string | null,
rightsUri: string | null,
schemeUri: string | null,
rightsIdentifier: string | null,
rightsIdentifierScheme: string | null,
lang: string | null,
};
export type SubjectData = {
subject: string,
subjectScheme: string | null,
schemeUri: string | null,
valueUri: string | null,
classificationCode: string | null,
lang: string | null,
};
export type TitleData = {
title: string,
lang: string | null,
titleType: App.Enums.DataCite.TitleType | null,
};
}
}
namespace Enums {
export type SupportedLocale = "en" | "fr";
namespace DataCite {
export type ContributorType = "ContactPerson" | "DataCollector" | "DataCurator" | "DataManager" | "Distributor" | "Editor" | "HostingInstitution" | "Producer" | "ProjectLeader" | "ProjectManager" | "ProjectMember" | "RegistrationAgency" | "RegistrationAuthority" | "RelatedPerson" | "Researcher" | "ResearchGroup" | "RightsHolder" | "Sponsor" | "Supervisor" | "Translator" | "WorkPackageLeader" | "Other";
export type DateType = "Accepted" | "Available" | "Copyrighted" | "Collected" | "Coverage" | "Created" | "Issued" | "Submitted" | "Updated" | "Valid" | "Withdrawn" | "Other";
export type DescriptionType = "Abstract" | "Methods" | "SeriesInformation" | "TableOfContents" | "TechnicalInfo" | "Other";
export type NameType = "Personal" | "Organizational";
export type RelatedIdentifierType = "ARK" | "arXiv" | "bibcode" | "CSTR" | "DOI" | "EAN13" | "EISSN" | "Handle" | "IGSN" | "ISBN" | "ISSN" | "ISTC" | "LISSN" | "LSID" | "PMID" | "PURL" | "RAiD" | "RRID" | "SWHID" | "UPC" | "URL" | "URN" | "w3id";
export type RelationType = "IsCitedBy" | "Cites" | "IsSupplementTo" | "IsSupplementedBy" | "IsContinuedBy" | "Continues" | "IsDescribedBy" | "Describes" | "HasMetadata" | "IsMetadataFor" | "HasVersion" | "IsVersionOf" | "IsNewVersionOf" | "IsPreviousVersionOf" | "IsPartOf" | "HasPart" | "IsPublishedIn" | "IsReferencedBy" | "References" | "IsDocumentedBy" | "Documents" | "IsCompiledBy" | "Compiles" | "IsVariantFormOf" | "IsOriginalFormOf" | "IsIdenticalTo" | "IsReviewedBy" | "Reviews" | "IsDerivedFrom" | "IsSourceOf" | "IsRequiredBy" | "Requires" | "IsObsoletedBy" | "Obsoletes" | "IsCollectedBy" | "Collects" | "IsTranslationOf" | "HasTranslation" | "Other";
export type ResourceTypeGeneral = "Audiovisual" | "Award" | "Book" | "BookChapter" | "Collection" | "ComputationalNotebook" | "ConferencePaper" | "ConferenceProceeding" | "DataPaper" | "Dataset" | "Dissertation" | "Event" | "Image" | "InteractiveResource" | "Instrument" | "Journal" | "JournalArticle" | "Model" | "OutputManagementPlan" | "PeerReview" | "PhysicalObject" | "Poster" | "Preprint" | "Presentation" | "Project" | "Report" | "Service" | "Software" | "Sound" | "Standard" | "StudyRegistration" | "Text" | "Workflow" | "Other";
export type TitleType = "AlternativeTitle" | "Subtitle" | "TranslatedTitle" | "Other";
}
}
}
declare namespace Illuminate {
export type CursorPaginator<TKey, TValue> = {
data: TKey extends string ? Record<TKey, TValue> : TValue[],
links: {
url: string | null,
label: string,
active: boolean,
}[],
meta: {
path: string,
per_page: number,
next_cursor: string | null,
next_page_url: string | null,
prev_cursor: string | null,
prev_page_url: string | null,
},
};
export type CursorPaginatorInterface<TKey, TValue> = Illuminate.CursorPaginator<TKey, TValue>;
export type LengthAwarePaginator<TKey, TValue> = {
data: TKey extends string ? Record<TKey, TValue> : TValue[],
links: {
url: string | null,
label: string,
active: boolean,
}[],
meta: {
total: number,
current_page: number,
first_page_url: string,
from: number | null,
last_page: number,
last_page_url: string,
next_page_url: string | null,
path: string,
per_page: number,
prev_page_url: string | null,
to: number | null,
},
};
export type LengthAwarePaginatorInterface<TKey, TValue> = Illuminate.LengthAwarePaginator<TKey, TValue>;
}
declare namespace Spatie {
namespace LaravelData {
export type CursorPaginatedDataCollection<TKey, TValue> = Illuminate.CursorPaginator<TKey, TValue>;
export type PaginatedDataCollection<TKey, TValue> = Illuminate.LengthAwarePaginator<TKey, TValue>;
}
}
