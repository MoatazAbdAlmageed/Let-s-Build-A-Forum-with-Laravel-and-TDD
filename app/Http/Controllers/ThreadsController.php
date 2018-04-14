<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class ThreadsController extends Controller {

	public function __construct() {
//		$this->middleware( 'auth' )->only( [ 'create', 'store' ] );
		$this->middleware( 'auth' )->except( [ 'index', 'show' ] );
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Channel $channel
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( Channel $channel ) {


		if ( $channel->exists ) {

			$threads = $channel->threads()->latest()->get();

			return view( 'threads.index', compact( 'threads' ) );


		} else {


			$threads = Thread::orderBy( 'created_at', 'desc' )->with( 'channel' )->get();
		}

		return view( 'threads.index', compact( 'threads' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

//		$channels = Channel::all();
		$channels = Channel::all( 'id', 'name' );

		return view( 'threads.create', compact( 'channels' ) );
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
			'title'      => 'required|unique:threads',
			'body'       => 'required',
			'channel_id' => 'required|exists:channels,id',
		] );

		if ( $validator->fails() ) {
			return Redirect::back()->withInput()->withErrors( $validator );
		}

		$thread = Thread::create( [
			'user_id'    => auth()->id(),
			'channel_id' => request( 'channel_id' ),
			'title'      => request( 'title' ),
			'body'       => request( 'body' ),

		] );


		return redirect( $thread->path() );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Thread $thread
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $channelId, Thread $thread ) {
		return view( 'threads.show', compact( 'thread' ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Thread $thread
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Thread $thread ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Thread $thread
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Thread $thread ) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Thread $thread
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Thread $thread ) {
		//
	}
}
