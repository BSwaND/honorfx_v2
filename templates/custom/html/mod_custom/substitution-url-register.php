<?php

  if(empty($document)){
   $document = JFactory::getDocument();
  }
  
  
  if(!$document->locationThailand) {
    $linkLc =  '//my.honorfx.com/'. JText::_("TPL_CUSTOM_MOD_CUSTOM_LANGUAGE_TAG") .'/signup' ;
    if($_COOKIE['currentLocalKey'] && $document->language === 'en-gb'){
      $linkLc  = '//my.honorfx.com/'. JText::_("TPL_CUSTOM_MOD_CUSTOM_LANGUAGE_TAG"). '/'. $_COOKIE['currentLocalKey'] .'/signup' ;
    }
  } else {
    $linkLc =  '//portal.honorfx.com/register' ;
  }

  echo $linkLc;