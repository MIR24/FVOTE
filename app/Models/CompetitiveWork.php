<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetitiveWork extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
