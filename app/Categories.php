<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable=[
        'slug','title'
    ];

    public function posts()
    {
        return $this->hasMany('App\Post','category_id','id');
    }
}
