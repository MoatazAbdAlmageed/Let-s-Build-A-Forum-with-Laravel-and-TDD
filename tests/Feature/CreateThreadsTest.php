<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase {

	use DatabaseMigrations;

	/**
	 * @@test
	 */

	public function auth_users_can_create_thread() {

		$this->logIn();
		$thread = make( 'App\Thread' );

		$response = $this->post( '/threads', $thread->toArray() );

		$location = $response->headers->get( 'Location' );
		$this->get( $location )
		     ->assertSee( $thread->title )
		     ->assertSee( $thread->body );
	}

	/**
	 * @@test
	 */


	public function guests_can_not_create_thread() {
		/**
		 * signed user
		 * create form
		 * published in thread list
		 */


		$this->withExceptionHandling();

		$this->post( 'threads' )
		     ->assertRedirect( '/login' );

		$this->get( 'threads/create' )
		     ->assertRedirect( '/login' );

	}


	/**
	 * @@test
	 */

	public function thread_should_has_title() {

		$this->publishThread( [ 'title' => null ] )
		     ->assertSessionHasErrors( 'title' );

	}

	public function publishThread( $options = [] ) {
		$this->withExceptionHandling();
		$this->logIn();
		$thread = make( 'App\Thread', $options );

		return $this->post( 'threads', $thread->toArray() );
	}

	/**
	 * @@test
	 */

	public function thread_should_has_body() {

		$this->publishThread( [ 'body' => null ] )
		     ->assertSessionHasErrors( 'body' );

	}

	/**
	 * @@test
	 */

	public function thread_should_has_channel() {

		$this->publishThread( [ 'channel_id' => null ] )
		     ->assertSessionHasErrors( 'channel_id' );


		$this->publishThread( [ 'channel_id' => - 1 ] )
		     ->assertSessionHasErrors( 'channel_id' );


	}


}
