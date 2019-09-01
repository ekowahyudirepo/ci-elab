<?php 

if( ! function_exists('tgl_f') ) {

	function tgl_f( $date ) {

		return date('M, d-Y H:i', strtotime($date));

	}

}


if( ! function_exists('_jk') ) {

	function _jk( $gender ) {

		return ( $gender == 'L' )? 'Male' : 'Female';

	}

}



 ?>