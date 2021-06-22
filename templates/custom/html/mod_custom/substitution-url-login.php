<?php
  
  if (empty($document)) {
    $document = JFactory::getDocument();
  }
  
  if (!$document->locationThailand) {
    $linkLc = '//my.honorfx.com/' . JText::_("TPL_CUSTOM_MOD_CUSTOM_LANGUAGE_TAG") . '/login';
    if($_COOKIE['currentLocalKey'] && $document->language === 'en-gb'){
      $linkLc  = '//my.honorfx.com/'. JText::_("TPL_CUSTOM_MOD_CUSTOM_LANGUAGE_TAG"). '/'. $_COOKIE['currentLocalKey'] .'/login' ;
    }
  } else {
    $linkLc = '//portal.honorfx.com/login';
  }
  
  echo $linkLc;