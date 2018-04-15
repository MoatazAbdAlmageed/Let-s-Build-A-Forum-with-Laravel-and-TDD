<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class ChannelController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		return view( 'channels.index' );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view( 'channels.create' );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$validator = Validator::make( $request->all(), [
			'name' => 'required|unique:channels',
		] );


		if ( $validator->fails() ) {
			return Redirect::back()->withInput()->withErrors( $validator );
		}
		$channel = Channel::create( [
			'name' => ucfirst( request( 'name' ) ),
			'slug' => lcfirst( preg_replace( '/\s+/', '-', request( 'name' ) ) ),

		] );


		return redirect( $channel->path() );

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {

		$threads = Thread::where( 'channel_id', $id )->with( 'channel' )->get();
		$channel = Channel::where( 'id', $id )->first();


		return view( 'threads.index', compact( 'threads', 'channel' ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}
}
