<?php

namespace App;

use \Gzero\EloquentTree\Model\Tree;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Tree
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
