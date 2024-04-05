<?php
namespace App\Exports\epos;

use App\Models\Keyword;
use App\Models\Vocabulary;
use EasyRdf\Graph;
use App\Models\LaboratoryOrganization;
use EasyRdf\Resource;
use EasyRdf;
use EasyRdf\RdfNamespace;
use App\Models\LaboratoryContactPerson;
use App\Models\Laboratory;
use EasyRdf\Literal;

class RegistryExport
{
    public $organizations;
    
    public function __construct($organizations) {
        $this->organizations = $organizations;
    }
    
    public function export($type = 'turtle')
    {        
        $graph = new Graph();
        
        // Set namespaces
        RdfNamespace::delete('dc');
        RdfNamespace::delete('dcterms');
        RdfNamespace::set('dct', 'http://purl.org/dc/terms/');
        RdfNamespace::set('epos', 'https://www.epos-eu.org/epos-dcat-ap#');       
        RdfNamespace::set('locn', 'http://www.w3.org/ns/locn#');
        RdfNamespace::set('gsp', 'http://www.opengis.net/ont/geosparql#');
        
        foreach ($this->organizations as $organization) {
            // Add organization to graph
            $organizationGraph = $graph->resource($organization->external_identifier, 'schema:Organization');
            $schemaIdentifier = $graph->newBnode('schema:PropertyValue');
            $schemaIdentifier->set('schema:propertyID', "ROR");
            $schemaIdentifier->set('schema:value', $organization->external_identifier);
            $organizationGraph->set('schema:identifier', $schemaIdentifier);
            $organizationGraph->set('schema:legalName', $organization->name);
            // add address information
            $organizationAddress = $graph->newBnode('schema:PostalAddress');
            $organizationAddress->set('schema:addressCountry', $organization->ror_country_code);
            $organizationGraph->set('schema:address', $organizationAddress);
            
            $organizationGraph->set('schema:url', Literal::create($organization->ror_website , null, 'xsd:anyURI'));                                    
            
            // Get laboratories belonging to organization
            foreach ($organization->laboratories as $laboratory) {
                /*
                 * Skip if no location data is present
                 */
                
                if((strlen($laboratory->latitude) == 0) || (strlen($laboratory->longitude) == 0)) {
                    continue;
                }
                
                
                // Add contactpoint of laboratory to graph
                $contactPerson = $laboratory->laboratoryContactPerson;
                
                $contactPointGraph = $graph->resource($this->generateContactPersonURI($contactPerson), 'schema:ContactPoint');
                $contactPointGraph->set('schema:email', $contactPerson->email);
                $contactPointGraph->set('schema:availableLanguage', 'en');
                $contactPointGraph->set('schema:contactType', 'Contact');
                
                // Add Laboratory to graph
                $facilityGraph = $graph->resource($this->generateFacilityURI($laboratory), 'epos:Facility');
                $facilityGraph->set('dct:identifier', $facilityGraph->getUri());
                $facilityGraph->set('dct:title', $laboratory->name);
                $facilityGraph->set('dct:description', $laboratory->description);
                $facilityGraph->set('dct:type', ['type' => 'uri', 'value' => '<epos:Laboratory>']);                
                $facilityGraph->set('dcat:theme', ['type' => 'uri', 'value' => $this->getEPOSlabType($laboratory)]);
                $facilityGraph->set('dcat:contactPoint', ['type' => 'uri', 'value' => $contactPointGraph->getUri()]);
                if((strlen($laboratory->latitude) > 0) && (strlen($laboratory->longitude) > 0)) {
                    $facilityLocation = $graph->newBNode('dct:Location');
                    $facilityLocation->add("locn:geometry", Literal::create($this->generateGeonometryString($laboratory), null, 'gsp:wktLiteral'));
                    $facilityGraph->set('dct:spatial', $facilityLocation);
                }
                
                // Add keywords
                $facilityGraph->set('dcat:keyword', $laboratory->fast_domain_name);
                $facilityKeywords = $laboratory->laboratoryKeywords->pluck('value')->toArray();
                $facilityKeywords = array_unique($facilityKeywords);
                
                foreach ($facilityKeywords as $facilityKeyword) {                    
                    $facilityGraph->add('dcat:keyword', $facilityKeyword);
                }

                // optional
                if(strlen($laboratory->website) > 0) {
                    $facilityGraph->add(
                        'foaf:page', Literal::create($laboratory->website, null, 'xsd:anyURI')
                    );
                }
                
                // Add facility to organization owns
                if ($organizationGraph->hasProperty('schema:owns')) {
                    $organizationGraph->add('schema:owns', $facilityGraph);
                } else {
                    $organizationGraph->set('schema:owns', $facilityGraph);
                }
                                               
            }
            
        }
        
                
        
        // concepts
        $laboratoryConcept = $graph->resource('epos:Laboratory', 'skos:Concept');
        $laboratoryConcept->set('skos:definition', 'Laboratory');
        $laboratoryConcept->set('skos:inScheme', ['type' => 'uri', 'value' => '<epos:Facility_Type>']);
        $laboratoryConcept->set('skos:prefLabel', 'Laboratory');
                
        return $graph->serialise($type);        
    }
    
    private function generateContactPersonURI(LaboratoryContactPerson $contactPerson) {
        // Return orcid if available otherwise generate custom uri
        if(strlen($contactPerson->orcid) > 5) {
            return 'http://orcid.org/' . $contactPerson->orcid . '/contactperson';
        } else {
            return 'https:/epos-msl/contactperson/' . $contactPerson->fast_id;
        }        
    }
    
    private function generateFacilityURI(Laboratory $laboratory) {
        return 'https:/epos-msl/facility/' . $laboratory->fast_id;
    }
    
    private function generateGeonometryString(Laboratory $laboratory) {        
        return "POINT(" . str_replace(',', '.', $laboratory->longitude) . " " . str_replace(',', '.', $laboratory->latitude) . ")";
    }
    
    private function getEPOSlabType(Laboratory $laboratory) {
        $fastLaboratoryDomain = $laboratory->fast_domain_name;
        
        switch ($fastLaboratoryDomain) {
            case 'Analogue modelling of geological processes':
                return '<category:AnalogueModelling_conc>';
            
            case 'Geochemistry':
                return '<category:Geochemistry_conc>';
                
            case 'Microscopy and tomography':
                return '<category:MicroscopyAndTomography_conc>';
                
            case 'Paleomagnetism':
                return '<category:Paleomagnetism_conc>';
                
            case 'Rock and melt physics':
                return '<category:RockPhysics_conc>';
                
            default:
                return '';
        }
    }
}

