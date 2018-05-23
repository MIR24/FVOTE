<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Nomination extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at', 'from_time', 'to_time'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status', 'from_time', 'to_time'
    ];

    public function competitions()
    {
        return $this->belongsToMany('App\Competition');
    }

    public function competitiveWorks()
    {
        return $this->belongsToMany('App\CompetitiveWork');
    }

     /**
     * Set from_time attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setFromTimeAttribute($value)
    {
        if ($value) {
            $this->attributes['from_time'] =  Carbon::createFromFormat('Y-m-d\Th:m', $value);
        }
    }

     /**
     * Set to_time attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setToTimeAttribute($value)
    {
        if ($value) {
            $this->attributes['to_time'] =  Carbon::createFromFormat('Y-m-d\Th:m', $value);
        }
    }
}
