<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model {

//	protected $fillable = [ 'body', 'user_id', 'thread_id' ];
	protected $guarded = [];

	public function path() {
		return "/threads/{$this->channel->slug}/{$this->id}";
	}

	public function owner() {
		return $this->belongsTo( User::class, 'user_id' );
	}


	public function channel() {
		return $this->belongsTo( Channel::class );
	}

	public function addReply( $reply ) {
		$this->replies()->create( $reply );

	}

	/**
	 * Get all of the replies for the Thread.
	 */
	public function replies() {
		/**
		 * Laravel orderBy on a relationship - Stack Overflow
		 * https://stackoverflow.com/questions/18143061/laravel-orderby-on-a-relationship
		 */

		return $this->hasMany( 'App\Reply' )->orderBy( 'id', 'desc' );
	}

}
