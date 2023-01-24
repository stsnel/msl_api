<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    public $fillable = [
        'name',
        'uri'
    ];
             
    public function keywords() {
        return $this->hasMany(Keyword::class);
    }
    
    public function maxLevel() {
        return Keyword::where('vocabulary_id', $this->id)->max('level');
    }
}
