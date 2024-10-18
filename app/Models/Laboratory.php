<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    protected $fillable = [
        'fast_id',
        'msl_identifier',
        'lab_portal_name',
        'lab_editor_name',
        'msl_identifier_inputstring',
        'original_domain',
        'name',
        'description',
        'description_html',
        'website',
        'address_street_1',
        'address_street_2',
        'address_postalcode',
        'address_city',
        'address_country_code',
        'latitude',
        'longitude',
        'altitude',
        'external_identifier',
        'fast_domain_id',
        'fast_domain_name',
        'laboratory_organization_id',
        'laboratory_contact_person_id',
        'laboratory_manager_id'
    ];
    
    public function laboratoryOrganization()
    {
        return $this->belongsTo(LaboratoryOrganization::class, 'laboratory_ogranization_id');
    }
    
    public function laboratoryContactPerson()
    {
        return $this->belongsTo(LaboratoryContactPerson::class, 'laboratory_contact_person_id');
    }
    
    public function laboratoryManager()
    {
        return $this->belongsTo(LaboratoryManager::class, 'laboratory_manager_id');
    }
    
    public function laboratoryEquipment()
    {
        return $this->hasMany(LaboratoryEquipment::class, 'laboratory_id');
    }
    
    public function laboratoryKeywords()
    {
        return $this->hasMany(LaboratoryKeyword::class, 'laboratory_id');
    }

    public function toCkanArray()
    {
        return [
            'title' => $this->name,
            'type' => 'lab',
            'name' => $this->msl_identifier,
            'owner_org' => 'epos-multi-scale-laboratories-thematic-core-service',
            'msl_id' => $this->id,
            'msl_description' => $this->description,
            'msl_description_html' => $this->description_html,
            'msl_website' => $this->website,
            'msl_address_street_1' => $this->address_street_1,
            'msl_address_street_2' => $this->address_street_2,
            'msl_address_postalcode' => $this->address_postalcode,
            'msl_address_city' => $this->address_city,
            'msl_msl_address_country_code' => $this->address_country_code,
            'msl_domain_name' => $this->fast_domain_name,
            'msl_location' => $this->getPointGeoJson(),
            'msl_has_spatial_data' => $this->hasSpatialData(),
            'extras' => [
                ["key" => "spatial", "value" => $this->getPointGeoJson()]
            ]
        ];
    }

    private function getPointGeoJson()
    {
        if((strlen($this->latitude) > 0) && (strlen($this->longitude) > 0)) {
            return json_encode([
                'type' => 'Point',
                'coordinates' => [(float)$this->longitude, (float)$this->latitude]
            ]);
        }

        return '';
    }

    private function hasSpatialData()
    {
        if((strlen($this->latitude) > 0) && (strlen($this->longitude) > 0)) {
            return true;
        }

        return false;
    }
}
