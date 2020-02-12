<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskNote extends Model
{
    protected $table = 'task_notes';
    protected fillable = ['id', 'task_id', 'note', 'created_at', 'updated_at'];
}
