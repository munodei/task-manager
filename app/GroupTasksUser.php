<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupTasksUser extends Model
{
    protected $table = 'group_task_user';
    protected $fillable = ['id', 'group_id', 'user_id', 'role', 'created_at', 'updated_at'];
}
