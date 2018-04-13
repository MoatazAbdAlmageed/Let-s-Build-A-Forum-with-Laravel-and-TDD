<?php

/**
 * Created by PhpStorm.
 * User: moataz
 * Date: 4/4/18
 * Time: 11:44 PM
 */
function create( $class, $attributes = [] ) {
	return factory( $class )->create( $attributes );
}


function make( $class, $attributes = [] ) {
	return factory( $class )->make( $attributes );
}

