<?php

namespace Tests;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase {
	use CreatesApplication;

	protected function setUp() {
		parent::setUp();
		$this->oldExceptionHandler = $this->app->make( ExceptionHandler::class );
		$this->disableExceptionHandling();
	}

	protected function disableExceptionHandling() {


		app()->instance( ExceptionHandler::class, new class extends Handler {


			public function __construct() {
			}

			public function report( \ Exception $e ) {
				// no-op
			}

			public function render( $request, \ Exception $e ) {
				throw $e;
			}
		} );
	}

	protected function withExceptionHandling() {
		$this->app->instance( ExceptionHandler::class, $this->oldExceptionHandler );

		return $this;
	}

	protected function logIn( $user = null ) {
		$user = $user ?: create( 'App\User' );
		$this->be( $user );

		return $this;

	}

}





