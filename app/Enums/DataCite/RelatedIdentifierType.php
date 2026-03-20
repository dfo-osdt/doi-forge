<?php

namespace App\Enums\DataCite;

enum RelatedIdentifierType: string
{
    case Ark = 'ARK';
    case Arxiv = 'arXiv';
    case Bibcode = 'bibcode';
    case Cstr = 'CSTR';
    case Doi = 'DOI';
    case Ean13 = 'EAN13';
    case Eissn = 'EISSN';
    case Handle = 'Handle';
    case Igsn = 'IGSN';
    case Isbn = 'ISBN';
    case Issn = 'ISSN';
    case Istc = 'ISTC';
    case Lissn = 'LISSN';
    case Lsid = 'LSID';
    case Pmid = 'PMID';
    case Purl = 'PURL';
    case Raid = 'RAiD';
    case Rrid = 'RRID';
    case Swhid = 'SWHID';
    case Upc = 'UPC';
    case Url = 'URL';
    case Urn = 'URN';
    case W3id = 'w3id';
}
