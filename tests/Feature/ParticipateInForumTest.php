<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForum extends TestCase {

	use DatabaseMigrations;


	/**
	 * @@test
	 */

	public function auth_user_may_participate_in_forum() {

		$this->logIn();
		$thread = create( 'App\Thread' );
		$reply  = make( 'App\Reply' );
		$this->post( $thread->path() . '/replies', $reply->toArray() );
		$this->get( $thread->path() )
		     ->assertSee( $reply->body );
	}

	/**
	 * @@test
	 */

	public function guest_can_not_participate() {
		$this->withExceptionHandling();
		$this->post( 'threads' )
		     ->assertRedirect( 'login' );
	}

	/**
	 * @@test
	 */

	public function reply_should_has_body() {

		$this->publishReply( [ 'body' => null ] )
		     ->assertSessionHasErrors( 'body' );


	}

	public function publishReply( $options = [] ) {
		$this->withExceptionHandling();
		$this->logIn();

		$thread = create( 'App\Thread' );
		$reply  = make( 'App\Reply', $options );

		return $this->post( $thread->path() . '/replies', $reply->toArray() );

	}

}
