<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaboratoryEquipment extends Model
{
    protected $table = 'laboratory_equipment';
    
    protected $fillable = [
        'fast_id',
        'laboratory_id',
        'description',
        'description_html',
        'category_name',
        'type_name',
        'domain_name',
        'group_name',
        'brand',
        'website',
        'latitude',
        'longitude',
        'altitude',
        'external_identifier',
        'name'
    ];
    
    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function toCkanArray()
    {
        return [
            'title' => $this->name,
            'type' => 'lab',
            'name' => md5($this->fast_id . '-' . $this->laboratory_id),
            'owner_org' => 'epos-multi-scale-laboratories-thematic-core-service',


            
            'msl_location' => $this->getGeoJsonFeature(),
            'msl_has_spatial_data' => $this->hasSpatialData(),
            'extras' => [
                ["key" => "spatial", "value" => $this->getPointGeoJson()]
            ]
        ];
    }    
    
}
