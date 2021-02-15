<?php

namespace App\libraries;
use Illuminate\Http\Request;

class converter
{
	function objectToArray($d) {

		if (is_object($d)) {
			$d = get_object_vars($d);
		}
       //echo "<pre> coba cob"; print_r($d); echo "</pre>"; die();
		if (is_array($d)) {
           // echo "<pre> coba cob"; print_r($d); echo "</pre>";
			return array_map(null, $d);
		}else {
			return $d;
		}
	}


	function arrayToObject($d) {
		if (is_array($d)) {
			return (object) array_map(null, $d);
		}else{
			return $d;
		}
	}

}
