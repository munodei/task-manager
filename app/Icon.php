<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $table="icons";
    protected $fillable =['id', 'icon', 'created_at', 'updated_at'];
}
