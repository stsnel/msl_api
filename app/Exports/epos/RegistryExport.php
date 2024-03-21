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
    public $laboratories;
    
    public function __construct($laboraries) {
        $this->laboratories = $laboraries;
    }
    
    public function export($type = 'turtle')
    {        
        $graph = new Graph();
        
        // Set namespaces
        RdfNamespace::set('epos', 'https://www.epos-eu.org/epos-dcat-ap#');
        RdfNamespace::set('dct', 'http://purl.org/dc/terms/');
        RdfNamespace::set('locn', 'http://www.w3.org/ns/locn#');
        RdfNamespace::set('gsp', 'http://www.opengis.net/ont/geosparql#');
        
        // Get organizations        
        $organizations = LaboratoryOrganization::where('fast_id', 13)->get();
        //$organization = LaboratoryOrganization::where('fast_id', 13)->first();
        
        //dd($organization->laboratories);
        
        foreach ($organizations as $organization) {
            // Add organization to graph
            $organizationGraph = $graph->resource($organization->external_identifier, 'schema:Organization');
            $schemaIdentifier = $graph->newBnode('schema:PropertyValue');
            $schemaIdentifier->set('schema:propertyID', "ROR");
            $schemaIdentifier->set('schema:value', $organization->external_identifier);
            $organizationGraph->set('schema:identifier', $schemaIdentifier);
            $organizationGraph->set('schema:legalName', $organization->name);
            
            /* 
             * missing information:
             * - address (country code is required as discussed in meeting @Rome
             * - schema:logo "http://organization/logo.jpg"^^xsd:anyURI;
             * - schema:url "http://www.organization.eu/"^^xsd:anyURI; 
             */ 
            
            // set schema:owns after facilities have been added
            
            // Get laboratories belonging to organization
            foreach ($organization->laboratories as $laboratory) {
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
                $facilityGraph->set('dct:type', ['type' => 'uri', 'value' => '<epos:laboratory>']);                
                $facilityGraph->set('dct:theme', ['type' => 'uri', 'value' => $this->getEPOSlabType($laboratory)]);
                $facilityGraph->set('dcat:contactPoint', ['type' => 'uri', 'value' => $contactPointGraph->getUri()]);
                if((strlen($laboratory->latitude) > 0) && (strlen($laboratory->longitude) > 0)) {
                    $facilityLocation = $graph->newBNode('dct:location');
                    $facilityLocation->add("locn:geometry", Literal::create($this->generateGeonometryString($laboratory), null, 'gsp:wktLiteral'));
                    $facilityGraph->set('dct:spatial', $facilityLocation);
                }
                
                // to-do check generation of keywords
                
                /*
                 * optional
                 */
                
                if(strlen($laboratory->website) > 0) {
                    $facilityGraph->add(
                        'foaf:page', Literal::create($laboratory->website, null, 'xsd:anyURI')
                    );
                }
                                               
            }
            
        }
        
        
        
        
        
        /*
        // Organization sample
        $organizationGraph = $graph->resource('test-identifier-organization', 'schema:Organization');
        $schemaIdentifier = $graph->newBnode('schema:PropertyValue');
        $schemaIdentifier->set('schema:propertyID', "ROR");
        $schemaIdentifier->set('schema:value', "0000000000");
        $organizationGraph->set('schema:identifier', $schemaIdentifier);
        $organizationGraph->set('schema:legalName', 'name of organization');
        // add schema:owns
        
        
        // Contact point
        $contactPointGraph = $graph->resource('test-identifier-contactpoint', 'schema:ContactPoint');
        $contactPointGraph->set('schema:email', 'test@test.nl');
        $contactPointGraph->set('schema:availableLanguage', 'en');
        $contactPointGraph->set('schema:contactType', 'Contact');
        
        // Facility sample
        $facilityGraph = $graph->resource('test-identifier-facility', 'epos:Facility');
        $facilityGraph->set('dct:identifier', $organizationGraph->getUri());
        $facilityGraph->set('dct:title', 'title of laboratory');
        $facilityGraph->set('dct:description', 'description of laboratory');
        $facilityGraph->set('dct:type', ['type' => 'uri', 'value' => '<epos:laboratory>']);
        $facilityGraph->set('dcat:theme', ['type' => 'uri', 'value' => '<category:AnalyticalMicroscopy_conc>']);
        $facilityGraph->set('dcat:contactPoint', ['type' => 'uri', 'value' => $contactPointGraph->getUri()]);
        // Add location to facility
        $facilityLocation = $graph->newBNode('dct:location');
        $facilityLocation->set("locn:geometry", "POINT(5.1767 52.1017 3)\"^^gsp:wktLiteral");
        $facilityGraph->set('dct:spatial', $facilityLocation);
        $facilityGraph->set('foaf:page', 'test.nl');
        */
        
        
        
        
        /*
         * dct:spatial [ a dct:Location ;
		      locn:geometry  "POINT(5.1767 52.1017 3)"^^gsp:wktLiteral;
            ];
         */
        
        
        
        // concepts
        
        
        $laboratoryConcept = $graph->resource('epos:Laboratory', 'skos:Concept');
        $laboratoryConcept->set('skos:definition', 'Laboratory');
        $laboratoryConcept->set('skos:inScheme', ['type' => 'uri', 'value' => '<epos:Facility_Type>']);
        $laboratoryConcept->set('skos:prefLabel', 'Laboratory');
        
        

        
        // concepts
        /*
        $laboratoryConcept = $graph->resource('epos:Laboratory', 'skos:Concept');
        $laboratoryConcept->set('skos:definition', 'Laboratory');
        $laboratoryConcept->set('skos:prefLabel', 'Laboratory');
        */

        //dd($laboratoryConcept->label());
        
        
        
        //dd($graph->serialise($type))

        
        return $graph->serialise($type);        
    }
    
    private function generateContactPersonURI(LaboratoryContactPerson $contactPerson) {
        // Return orcid if available otherwise generate custom uri
        if(strlen($contactPerson->orcid) > 5) {
            return 'http://orcid.org/' . $contactPerson->orcid . '/contactperson';
        } else {
            return 'https://epos-msl/contactperson/' . $contactPerson->fast_id;
        }        
    }
    
    private function generateFacilityURI(Laboratory $laboratory) {
        return 'https://epos-msl/facility/' . $laboratory->fast_id;
    }
    
    private function generateGeonometryString(Laboratory $laboratory) {        
        return "POINT(" . str_replace(',', '.', $laboratory->longitude) . " " . str_replace(',', '.', $laboratory->latitude) . " 0)";
    }
    
    private function getEPOSlabType(Laboratory $laboratory) {
        $fastLaboratoryDomain = $laboratory->fast_domain_name;
        
        switch ($fastLaboratoryDomain) {
            case 'Analogue modelling':
                return '<category:AnalogueModelling>';
            
            case 'Analytical':
                return '';
                
            case 'Microscopy':
                return '<category:AnalyticalMicroscopy>';
                
            case 'Paleomagnetism':
                return '<category:Paleomagnetism>';
                
            case 'Rock physics':
                return '<category:RockPhysics>';
                
            default:
                return '';
        }
    }
}

