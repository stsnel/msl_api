<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TnaMockup extends Model
{
    protected $table = "tna_mockup";
    
    protected $fillable = [
        'organizationName',
        'facilityName',
        'facilityUrl',
        'facilityCountry',
        'facilityCity',
        'equipmentType',
        'equipmentGroup',
        'equipmentName',
        'equipmentUrl',
        'equipmentManufacturer',
        'tnaStartDate',
        'tnaEndDate'
    ];
    
    public function toArray()
    {
        return [
            'organizationName' => $this->organizationName,
            'facilityName' => $this->facilityName,
            'facilityUrl' => $this->facilityUrl,
            'facilityCountry' => $this->facilityCountry,
            'facilityCity' => $this->facilityCity,
            'equipmentType' => $this->equipmentType,
            'equipmentGroup' => $this->equipmentGroup,
            'equipmentName' => $this->equipmentName,
            'equipmentUrl' => $this->equipmentUrl,
            'equipmentManufacturer' => $this->equipmentManufacturer,
            'tnaStartDate' => $this->tnaStartDate,
            'tnaEndDate' => $this->tnaEndDate
        ];
    }
    
}
