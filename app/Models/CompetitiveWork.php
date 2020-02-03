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
        $url = $this->url;
        if (substr($url, 0, 5) != "http:" && substr($url, 0, 6) != "https:") {
            $url = "http://" . $url;
        }
        return "<a href='{$url}' target='_blank'>Перейти по ссылке</a>";
    }

}
