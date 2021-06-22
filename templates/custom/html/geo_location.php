<?php
	/**
	 * Start
	 * Geo location for Thailand
	 */
  $session = JFactory::getSession();
  $document->locationThailand = false;
  $document->locationIndia = false;

	if(!$document->countryLocationName && !$session->get('geoLocation')){
		$getIrl =  'http://api.sypexgeo.net/json/'.$_SERVER['REMOTE_ADDR'];
		//$getIrl =  'https://ipwhois.app/json/'.$_SERVER['REMOTE_ADDR'];
		$geo =  json_decode(file_get_contents($getIrl));
		
	  $document->countryLocationName = $geo->country->name_en;  //sypexgeo
		//$document->countryLocationName = $geo->country;   //ipwhois
    
    $session->set('geoLocation', $document->countryLocationName);
	}
  
  switch ($session->get('geoLocation')){
    case 'Thailand':
    case 'thailand':
      $document->locationThailand = true;
      break ;
    case 'India':
    case 'india':
      $document->locationIndia = true;
      $document->locationIndia = false; // -- открыл для тайланда времмено (удалить  эту строку для включения).
      break ;
  }
	/** End  */
