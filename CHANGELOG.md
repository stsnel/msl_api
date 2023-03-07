# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added 
- Geochemistry vocab now uses two top levels
- Update microscopy vocab
- URI generation for vocabularies and specific terms
- Specific vocabulary versions
- Several export formats for vocabularies: xlsx, json, ttl and and xml (linked data)
- Keyword mapping no longer removes matched keywords from tag_string field
- Change sorting of specific nodes in filter tree export used by frontend
- Include 4TU importer/harvesting
- Replace FTP based download harvester for GFZ with web crawling method
- Add seperate keyword section in data structure to indicate original and interpreted keywords
- Split JSON tree export for use in frontend into interpreted and original types
- Enlarge databasefields to store larger response objects

## [1.2.0] - 2022-11-11

- API documentation in API.md
- Add changelog in CHANGELOG.md
- Update GFZ and yoda importers to work with new data-publication schema
- Update API responses to work with new data-publication schema
- Csic data importing
- Implement 4 new vocabularies: geological age, geological setting, paleomagnetism and geochemistry
- Add geological setting to researchaspects part of each API endpoint
- Add functions to view and export unmatched keyword terms
- Add functions to view and export matching of keywords in abstract and title
- Add keyword mapping based on free text to keyword helpers used by importers
- Update all importers to use new keyword mapping features
- Update all vocabularies
- RDF/Turtle file used by EPOS ICS-C integration implemented within repo

## [1.1.0] - 2022-05-24

- First release