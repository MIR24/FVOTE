<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetitiveWork extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function nominations()
    {
        return $this->belongsToMany('App\Nomination');
    }

    public function competitions()
    {
        return $this->hasManyThrough('App\Competition', 'App\Nomination');
    }
}
