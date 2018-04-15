<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadsTest extends TestCase {
	protected $thread;
	use DatabaseMigrations;

	/**
	 * Test threads
	 *
	 * @@test
	 */
	public function user_can_browse_threads() {
		$this->get( '/threads' )
		     ->assertSee( $this->thread->title );
//		>assertSee( 'Threads' );
	}

	/**
	 * @@test
	 */

	public function user_can_browse__single_thread() {

		$this->get( $this->thread->path() )
		     ->assertSee( $this->thread->title );
	}

	/**
	 * @@test
	 */


	public function user_can_read_replies() {
		$reply = create( 'App\Reply', [ 'thread_id' => $this->thread->id ] );


		$this->get( $this->thread->path() )
		     ->assertSee( $reply->body );
	}

	/**
	 * @@test
	 */

	public function user_can_filter_threads_according_to_tag() {
		$channel = create( 'App\Channel' );

		$threadInChannel    = create( 'App\Thread', [ 'channel_id' => $channel->id ] );
		$threadNotInChannel = create( 'App\Thread' );


		$this->get( "threads/{$channel->slug}" )
		     ->assertSee( $threadInChannel->title )
		     ->assertDontSee( $threadNotInChannel->title );
	}

	/**
	 * @@test
	 */

	public function user_can_filter_threads_by_user() {

		$this->logIn( create( 'App\User', [ 'name' => 'moataz' ] ) );

		$threadByMoataz    = create( 'App\Thread', [ 'user_id' => auth()->id() ] );
		$threadNotByMoataz = create( 'App\Thread' );


		$this->get( 'threads?by=moataz' )
		     ->assertSee( $threadByMoataz->title )
		     ->assertDontSee( $threadNotByMoataz->title );
	}


	protected function setUp() {
		parent::setUp();
		$this->thread = create( 'App\Thread' );
	}
}
