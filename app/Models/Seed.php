<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Seed extends Model
{
    protected $fillable = [
        'seeder_id'        
    ];    
    
    public function seeder() 
    {
        return $this->belongsTo(Seeder::class);
    }
    
    public function creates()
    {
        return $this->hasMany(OrganizationCreate::class);
    }
       
}
