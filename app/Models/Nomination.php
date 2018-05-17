<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nomination extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function competitions()
    {
        return $this->belongsToMany('App\Competition');
    }

    public function competitiveWorks()
    {
        return $this->belongsToMany('App\CompetitiveWork');
    }
}
