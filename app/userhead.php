<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userhead extends Model
{
	protected $table = 'userheads';
	protected $fillable = [
        'id', 'user_id', 'oldImg','newImg'
    ];
    public function user() {
	    return $this->belongsTo('App\User');
	}
}
