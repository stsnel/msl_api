<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    public $fillable = [
        'parent_id',
        'value',
        'uri',
        'vocubulary_id'
    ];
 
    public function parent()
    {
        return $this->belongsTo(Keyword::class, 'parent_id');
    }
    
    public function vocabulary()
    {
        return $this->belongsTo(Vocabulary::class, 'vocabulary_id');
    }
    
    public function getAncestors()
    {
        $parents = collect([]);
        $parent = $this->parent;
        
        while($parent) {
            $parents->push($parent);
            $parent = $parent->parent;
        }
        
        return $parents;
    }
    
    public function getAncestorsValues()
    {
        $ancestors = $this->getAncestors();
        $values = [];
        
        foreach ($ancestors as $ancestor) {
            $values[] = $ancestor->value;
        }
        
        return $values;
    }
}
