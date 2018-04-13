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


	protected function setUp() {
		parent::setUp();
		$this->thread = create( 'App\Thread' );
	}
}
