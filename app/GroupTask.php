<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupTask extends Model
{
    protected $table = 'group_tasks';
    protected $fillable = ['id','user_id','project_id', 'group_name', 'group_description', 'position', 'created_at', 'updated_at'];

    public function user(){
    return $this->belongsTo('App\User');
    }

    public function project(){
    return $this->belongsTo('App\Project');
    }

    public function company(){
    return $this->belongsTo('App\Company');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
