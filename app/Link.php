<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{

    protected $fillable = [
        'name', 'url',
    ];
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
