<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    public $fillable = [
        'parent_id',
        'value',
        'uri',
        'vocubulary_id',
        'level',
        'hyperlink'
    ];
 
    public function parent()
    {
        return $this->belongsTo(Keyword::class, 'parent_id');
    }
    
    public function vocabulary()
    {
        return $this->belongsTo(Vocabulary::class, 'vocabulary_id');
    }
    
    public function getChildren()
    {
        return Keyword::where('parent_id', $this->id)->get();                
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
    
    public function getFullPath($delimiter = '>')
    {
        $keywords = $this->getFullHierarchy();
        $parts = [];
        
        foreach ($keywords as $keyword) {
           $parts[] = $keyword->value;
        }
        
        return implode($delimiter, $parts);
    }
    
    public function getFullHierarchy()
    {
        $ancestors = $this->getAncestors();
        $ancestors->prepend($this);        
        $ancestors = $ancestors->reverse();
        
        return $ancestors;
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
