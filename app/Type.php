<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'id', 'name', 'parent_id'
    ];

    public $timestamps = false;

    function scopeTypeList($query)
    {
        return $query->lists('name', 'id');
    }

    function scopeTypeEditList($query, $id)
    {
        return $query->where('id', '!=', $id)->lists('name', 'id');
    }

    public function setParentIdAttribute($value)
    {
        if($value == 0) {
            $this->attributes['parent_id'] = null;
        } else {
            $this->attributes['parent_id'] = $value;
        }
    }
    
    public function pages()
    {
        return $this->hasMany('App\Page');
    }
}
