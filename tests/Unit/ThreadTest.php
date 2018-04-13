<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadTest extends TestCase {


	use DatabaseMigrations;
	protected $thread;

	/**
	 * @@test
	 */

	public function thread_has_replies() {

		$this->assertInstanceOf( 'Illuminate\Database\Eloquent\Collection', $this->thread->replies );
	}

	/**
	 * @@test
	 */

	public function thread_has_creator() {


		$this->assertInstanceOf( 'App\User', $this->thread->owner );


	}

	/**
	 * @@test
	 */

	public function user_can_add_reply() {
		$this->thread->addReply( [
			'body'    => 'Footer',
			'user_id' => 1,
		] );
		$this->assertCount( 1, $this->thread->replies );
	}

	/**
	 * @@test
	 */

	public function thread_belongs_to_channel() {

		$thread = create( 'App\Thread' );
		$this->assertInstanceOf( 'App\Channel', $thread->channel );

	}

	/**
	 * @@test
	 */

	public function thread_path_should_contains_sulg_and_id() {
		$thread = create( 'App\Thread' );
		$this->assertEquals( "/threads/{$thread->channel->slug}/{$thread->id}", $thread->path() );

	}

	protected function setUp() {
		parent::setUp();
		$this->thread = create( 'App\Thread' );
	}

}
