<?php
	/**
	 * @package     Joomla.Site
	 * @subpackage  Templates.protostar
	 *
	 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
	 * @license     GNU General Public License version 2 or later; see LICENSE.txt
	 */
	
	defined( '_JEXEC' ) or die( 'Restricted access' );
  
  $app = JFactory::getApplication();
  $menu = $app->getMenu()->getActive();
  $document = JFactory::getDocument();

  
//  $document->homePage =  ($document->language != 'en-gb') ? mb_substr($document->language,0,2) : null;
//  if ($_COOKIE['currentLocalKey']){
//    $document->homePage = '/'.$_COOKIE['currentLocalKey'] . $document->homePage;
//  }
  
  
  
  $opts = array(
    'http'=>array(
      'method'=>"GET",
      'header'=>"Accept-language: en\r\n" .
        "Cookie: currentLocalKey=".$_COOKIE['currentLocalKey']
    )
  );
  
  $context = stream_context_create($opts);
  
  if (($this->error->getCode()) == '404') {
		header("HTTP/1.1 404 Not Found");
		echo file_get_contents(JURI::root() . '/page-404', true, $context);
		exit;
	}
