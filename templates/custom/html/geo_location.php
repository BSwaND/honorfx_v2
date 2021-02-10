<?php
	/**
	 * Start
	 * Geo location for Thailand
	 */
	$locationThailand = false;
	$getIrl =  'http://api.sypexgeo.net/json/'.$_SERVER['REMOTE_ADDR'];
	$geo =  json_decode(file_get_contents($getIrl));
	$countryLocationName = $geo->country->name_en;
	
	switch ($countryLocationName){
		case 'Thailand' ;
			$locationThailand = true;
			break ;
		default:
			$locationThailand = false;
	}
	/** End  */