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
        'external_identifier'
    ];
    
    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }
    
}
