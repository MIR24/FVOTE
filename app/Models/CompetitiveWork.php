<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jcc\LaravelVote\CanBeVoted;

class CompetitiveWork extends Model
{
    use SoftDeletes;
    use CanBeVoted;

    protected $vote = User::class;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'filial', 'url', 'correspondent', 'operator'
    ];

    public function nominations()
    {
        return $this->belongsToMany('App\Nomination');
    }

    public function competitions()
    {
        return $this->hasManyThrough('App\Competition', 'App\Nomination');
    }

    public function getLinkAttribute()
    {
        return "<a href='{$this->url}' target='_blank'>{$this->url}</a>";
    }
}
