<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competition extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function nominations()
    {
        return $this->belongsToMany('App\Nomination');
    }

    public function competitiveWorks()
    {
        return $this->hasManyThrough('App\CompetitiveWork', 'App\Nomination');
    }
}
