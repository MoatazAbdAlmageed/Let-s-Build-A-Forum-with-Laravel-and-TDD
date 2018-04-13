<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model {

	protected $guarded = [];

	/**
	 * Get the user that wrote the Reply.
	 */
	public function owner() {
		return $this->belongsTo( 'App\User', 'user_id' );
	}


	/**
	 * Get the Thread
	 */
	public function thread() {
		return $this->belongsTo( 'App\Thread' );
	}

}
