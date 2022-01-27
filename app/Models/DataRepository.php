<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataRepository extends Model
{
    
    protected $fillable = [
        'name'
    ];
    
    public function importer() {
        return $this->belongsToMany(Importer::class);
    }
}
