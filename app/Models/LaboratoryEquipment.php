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
            'type' => 'equipment',
            'name' => md5($this->fast_id . '-' . $this->laboratory_id),
            'owner_org' => 'epos-multi-scale-laboratories-thematic-core-service',
            'msl_description' => $this->description,
            'msl_description_html' => $this->description_html,
            'msl_category_name' => $this->category_name,
            'msl_type_name' => $this->type_name,
            'msl_domain_name' => $this->domain_name,
            'msl_group_name' => $this->group_name,
            'msl_brand' => $this->brand,
            'msl_website' => $this->website,
            'msl_location' => $this->getGeoJsonFeature(),
            'msl_has_spatial_data' => $this->hasSpatialData(),
            'extras' => [
                ["key" => "spatial", "value" => $this->getPointGeoJson()]
            ]
        ];
    }


    private function getPointGeoJson()
    {
        if($this->hasSpatialData()) {
            if((strlen($this->latitude) > 0) && (strlen($this->longitude) > 0)) {
                return json_encode([
                    'type' => 'Point',
                    'coordinates' => [(float)$this->longitude, (float)$this->latitude]
                ]);
            } else {
                return $this->laboratory->getPointGeoJson();
            }            
        }

        return '';
    }

    public function getGeoJsonFeature()
    {
        if($this->hasSpatialData()) {
            if((strlen($this->latitude) > 0) && (strlen($this->longitude) > 0)) {
                return json_encode([
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [(float)$this->longitude, (float)$this->latitude]
                    ],
                    'properties' => [
                        'title' => $this->name,
                        'name' => md5($this->fast_id . '-' . $this->laboratory_id),
                        'msl_id' => $this->id
                    ]
                ]);
            } else {
                return json_encode([
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [(float)$this->laboratory->longitude, (float)$this->laboratory->latitude]
                    ],
                    'properties' => [
                        'title' => $this->name,
                        'name' => md5($this->fast_id . '-' . $this->laboratory_id),
                        'msl_id' => $this->id
                    ]
                ]);
            }
        }

        return '';
    }

    public function hasSpatialData()
    {
        if((strlen($this->latitude) > 0) && (strlen($this->longitude) > 0)) {
            return true;
        } else if($this->laboratory->hasSpatialData()) {
            return true;
        }

        return false;
    }


    
}
