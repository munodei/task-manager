<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
'id', 'parent_id', 'task_id', 'project_id', 'group_id', 'body', 'url', 'user_id', 'commentable_id', 'commentable_type', 'created_at', 'updated_at'  ];

    public function commentable()
    {
        return $this->morphTo();
    }


        /**
     * Return the user associated with this comment.
     *
     * @return array
     */
     public function user()
     {
         return $this->hasOne('\App\User', 'id', 'user_id');
     }
}
