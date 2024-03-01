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
        'external_identifier',
        'fast_domain_id',
        'fast_domain_name'                        
    ];
    
    
}
