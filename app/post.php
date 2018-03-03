<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
	protected $table = 'posts';
	protected $fillable = [
        'id','name', 'user_id', 'title','view'
    ];
}
