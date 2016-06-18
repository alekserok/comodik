<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable = [
        'type_id',
        'title',
        'description',
        'body',
        'image'
    ];

    public function type()
    {
        return $this->belongsTo('App\Type');
    }
}
