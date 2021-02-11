<?php
	/**
	 * Start
	 * Geo location for Thailand
	 */
	
	if(!$document->countryLocationName){
		
		$document->locationThailand = false;
		$getIrl =  'http://api.sypexgeo.net/json/'.$_SERVER['REMOTE_ADDR'];
		$geo =  json_decode(file_get_contents($getIrl));
		$document->countryLocationName = $geo->country->name_en;
		                                                        
		switch ($document->countryLocationName){
			case 'Thailand' ;
				$document->locationThailand = true;
				break ;
			default:
				$document->locationThailand = false;
		}
		   
	}
	/** End  */