<?php
namespace App\Mappers;

use App\Models\SourceDataset;
use App\Datasets\RockPhysicsDataset;
use App\Datasets\AnalogueModelingDataset;
use App\Datasets\PaleoMagneticDataset;
use App\Models\MappingLog;

class GfzMapper
{
    
    private function createDatasetNameFromDoi($doiString) 
    {        
        return md5($doiString);
    }
    
    private function getDatasetType($xml, $sourceDataset) {
        $result = $xml->xpath("//*/gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:descriptiveKeywords/gmd:MD_Keywords/gmd:keyword/gco:CharacterString[(./node()='analogue models of geologic processes') or (./node()='rock and melt physical properties') or (./node()='paleomagnetic and magnetic data' )]/node()");
        
        $resultCount = count($result);
        if($resultCount == 0) {
            $sourceDataset->status = 'error';
            $sourceDataset->save();
            $this->log('ERROR', 'No keyword found to match dataset type', $sourceDataset);
            throw new \Exception('No keyword found to match dataset type');
        } elseif ($resultCount == 1) {
            $typeKeyword = (string)$result[0];
            switch ($typeKeyword) {
                case 'analogue models of geologic processes':
                    return 'analogue';
                    break;
                                   
                case 'rock and melt physical properties':
                    return 'rockphysics';
                    break;
                    
                case 'paleomagnetic and magnetic data':
                    return 'paleomagnetic';
                    break;
            }
        } elseif ($resultCount > 1) {
            $sourceDataset->status = 'error';
            $sourceDataset->save();
            $this->log('ERROR', 'Multiple keywords indicating dataset found', $sourceDataset);
            throw new \Exception('Multiple dataset types matched');
        }
                       
    }
    
    private function log($severity, $text, $sourceDataset)
    {
        $levels = ['ERROR', 'WARNING'];
        if(in_array($severity, $levels)) {
            MappingLog::create([
                'type' => $severity,
                'message' => $text,
                'source_dataset_id' => $sourceDataset->id,
                'import_id' => $sourceDataset->source_dataset_identifier->import->id
            ]);
        } else {
            throw new \Exception('invalid log type');
        }
    }
    
    public function map(SourceDataset $sourceDataset)
    {
        //load xml file
        $xmlDocument = simplexml_load_string($sourceDataset->source_dataset);
        
        //declare xpath namespaces
        $xmlDocument->registerXPathNamespace('oai', 'http://www.openarchives.org/OAI/2.0/');
        $xmlDocument->registerXPathNamespace('gmd', 'http://www.isotc211.org/2005/gmd');
        $xmlDocument->registerXPathNamespace('gco', 'http://www.isotc211.org/2005/gco');
        
        //getDatasetType
        $datasetType = $this->getDatasetType($xmlDocument, $sourceDataset);
        
        $dataset = null;
        switch ($datasetType) {
            case 'analogue':
                $dataset = new AnalogueModelingDataset();
                break;
                
            case 'rock and melt physical properties':
                $dataset = new RockPhysicsDataset();
                break;
                
            case 'paleomagnetic and magnetic data':
                $dataset = new PaleoMagneticDataset();
                break;
        }
                        
        //extract msl_pids
        $result = $xmlDocument->xpath('/oai:OAI-PMH/oai:GetRecord/oai:record/oai:metadata/gmd:MD_Metadata/gmd:fileIdentifier/gco:CharacterString/node()');
        if(isset($result[0])) {
            $dataset->msl_pids[] = [
                'msl_pid' => (string)$result[0],
                'msl_identifier_type' => 'doi'
            ];
        }               
        
        //extract title
        $result = $xmlDocument->xpath('/oai:OAI-PMH/oai:GetRecord/oai:record/oai:metadata/gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:title/gco:CharacterString/node()');
        if(isset($result[0])) {
            $dataset->title = (string)$result[0];
        }
        
        //extract name
        $result = $xmlDocument->xpath('/oai:OAI-PMH/oai:GetRecord/oai:record/oai:metadata[1]/gmd:MD_Metadata/gmd:fileIdentifier/gco:CharacterString/node()');
        if(isset($result[0])) {
            $dataset->name = $this->createDatasetNameFromDoi((string)$result[0]);
        }
        
        //extract source
        $result = $xmlDocument->xpath('/oai:OAI-PMH/oai:GetRecord/oai:record/oai:metadata[1]/gmd:MD_Metadata[1]/gmd:distributionInfo[1]/gmd:MD_Distribution[1]/gmd:transferOptions[1]/gmd:MD_DigitalTransferOptions[1]/gmd:onLine[1]/gmd:CI_OnlineResource[1]/gmd:linkage[1]/gmd:URL[1]/node()[1]');
        if(isset($result[0])) {
            $dataset->msl_source = (string)$result[0];
        }        
        
        //set required fields for now
        $dataset->notes = 'temp notes';
        $dataset->owner_org = 'yoda-repository';
        
                
        return $dataset;
    }
}

