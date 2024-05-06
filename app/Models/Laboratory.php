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
}
