<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Laboratory;
use App\fast\Fast;
use App\Models\LaboratoryUpdateFast;
use App\Models\LaboratoryOrganization;
use App\Models\LaboratoryContactPerson;
use App\Models\LaboratoryManager;
use App\Models\LaboratoryEquipment;


class ProcessLaboratoryUpdateFast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $laboratoryUpdateFast;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(LaboratoryUpdateFast $laboratoryUpdateFast)
    {
        $this->laboratoryUpdateFast = $laboratoryUpdateFast;
    }
    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {        
        $lab = $this->laboratoryUpdateFast->laboratory;
        
        $fast = new Fast();        
        $result = $fast->facilityRequest($lab->fast_id);
        
        if($result->response_code == 200) {
            $data = $result->response_body['data'];
                        
            $lab->name = $data['name'];
            $lab->description = $data['description'];
            if(isset($data['description_html'])) {
                $lab->description_html = $data['description_html'];
            }
            
            $lab->website = $data['website'];
            $lab->address_street_1 = $data['address_street_1'];
            $lab->address_street_2 = $data['address_street_2'];
            $lab->address_postalcode = $data['address_postcode'];
            $lab->address_city = $data['address_city'];
            $lab->address_country_code = $data['address_country_code'];
            $lab->latitude = $data['gps_latitude'];
            $lab->longitude = $data['gps_longitude'];
            $lab->external_identifier = $data['external_identifier'];
            $lab->fast_domain_id = $data['domain']['id'];
            $lab->fast_domain_name = $data['domain']['name'];
            
            //include affiliation
            if(isset($data['affiliation'])) {
                $fastAffiliationId = $data['affiliation']['id'];
                $organization = LaboratoryOrganization::where('fast_id', $fastAffiliationId)->first();
                
                if(!$organization) {
                    $organization = new LaboratoryOrganization();
                    $organization->fast_id = $data['affiliation']['id'];
                }
                                                    
                $organization->name = $data['affiliation']['name'];
                
                $organization->external_identifier = '';
                if(isset($data['affiliation']['external_identifier'])) {
                    $organization->external_identifier = $data['affiliation']['external_identifier'];
                }
                
                $organization->save();
                
                $lab->laboratory_organization_id = $organization->id;
            }
            
            //include contact person
            if(isset($data['contact_person'])) {
                $fastContactPersonId = $data['contact_person']['id'];
                $contactPerson = LaboratoryContactPerson::where('fast_id', $fastContactPersonId)->first();
                
                if(!$contactPerson) {
                    $contactPerson = new LaboratoryContactPerson();
                    $contactPerson->fast_id = $data['contact_person']['id'];
                }
                
                $contactPerson->email = $data['contact_person']['email'];
                $contactPerson->first_name = $data['contact_person']['first_name'];
                $contactPerson->last_name = $data['contact_person']['last_name'];
                $contactPerson->orcid = $data['contact_person']['orcid'];
                $contactPerson->address_street_1 = $data['contact_person']['address_street_1'];
                $contactPerson->address_street_2 = $data['contact_person']['address_street_2'];
                $contactPerson->address_postalcode = $data['contact_person']['address_postcode'];
                $contactPerson->address_city = $data['contact_person']['address_city'];
                $contactPerson->address_country_code = $data['contact_person']['address_country']['code'];
                $contactPerson->address_country_name = $data['contact_person']['address_country']['name'];
                $contactPerson->affiliation_fast_id = $data['contact_person']['affiliation_id'];
                $contactPerson->nationality_code = $data['contact_person']['nationality']['code'];
                $contactPerson->nationality_name = $data['contact_person']['nationality']['name'];
                
                $contactPerson->save();
                $lab->laboratory_contact_person_id = $contactPerson->id;                
            }
            
            //include manager
            if(isset($data['manager'])) {
                $fastManagerId = $data['manager']['id'];
                $manager = LaboratoryManager::where('fast_id', $fastManagerId)->first();
                
                if(!$manager) {
                    $manager = new LaboratoryManager();
                    $manager->fast_id = $data['manager']['id'];
                }
                
                $manager->email = $data['manager']['email'];
                $manager->first_name = $data['manager']['first_name'];
                $manager->last_name = $data['manager']['last_name'];
                $manager->orcid = $data['manager']['orcid'];
                $manager->address_street_1 = $data['manager']['address_street_1'];
                $manager->address_street_2 = $data['manager']['address_street_2'];
                $manager->address_postalcode = $data['manager']['address_postcode'];
                $manager->address_city = $data['manager']['address_city'];
                $manager->address_country_code = $data['manager']['address_country']['code'];
                $manager->address_country_name = $data['manager']['address_country']['name'];
                $manager->affiliation_fast_id = $data['manager']['affiliation_id'];
                $manager->nationality_code = $data['manager']['nationality']['code'];
                $manager->nationality_name = $data['manager']['nationality']['name'];
                
                $manager->save();
                $lab->laboratory_manager_id = $manager->id;
            }
            
            //include equipment
            if(isset($data['equipment'])) {
                foreach ($data['equipment'] as $fastEquipment) {
                    $equipment = new LaboratoryEquipment();
                    
                    $equipment->fast_id = $fastEquipment['id'];
                    $equipment->laboratory_id = $organization->id;
                    $equipment->description = $fastEquipment['description'];
                    
                    $equipment->description_html = '';
                    if(isset($fastEquipment['description_html'])) {
                        $equipment->description_html = $fastEquipment['description_html'];
                    }
                    
                    $equipment->category_name = $fastEquipment['category']['name'];
                    $equipment->type_name = $fastEquipment['type']['name'];
                    $equipment->domain_name = $fastEquipment['type']['domain']['name'];
                    $equipment->group_name = $fastEquipment['group']['name'];
                    $equipment->brand = $fastEquipment['brand'];
                    $equipment->website = $fastEquipment['website'];
                    $equipment->latitude = $fastEquipment['gps_latitude'];
                    $equipment->longitude = $fastEquipment['gps_longitude'];
                    $equipment->altitude = $fastEquipment['gps_altitude'];
                    
                    $equipment->external_identifier = '';
                    if(isset($fastEquipment['external_identifier'])) {
                        $equipment->external_identifier = $fastEquipment['external_identifier'];
                    }
                    
                    $equipment->save();
                }
            }
                        
            $lab->save();
            
            $this->laboratoryUpdateFast->response_code = $result->response_code;
            $this->laboratoryUpdateFast->source_laboratory_data = $data;
            $this->laboratoryUpdateFast->save();
        } else {
            $this->laboratoryUpdateFast->response_code = $result->response_code;
            $this->laboratoryUpdateFast->save();
        }
        

    }    
}
