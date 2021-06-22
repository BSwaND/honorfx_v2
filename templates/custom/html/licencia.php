<?php
  use Joomla\CMS\Router\Route;
  
  defined('_JEXEC') or die;
  $session = JFactory::getSession();
  $app = JFactory::getApplication();
  $params = $app->getTemplate(true)->params;
  $menu = $app->getMenu()->getActive();
  $document = JFactory::getDocument();
  
  
  
  $document->languageLicensia = '';
  $document->homePage = ($document->language != 'en-gb') ? mb_substr($document->language, 0, 2) : null;
  if ($_COOKIE['currentLocalKey'] && $document->language === 'en-gb') {
    $document->homePage = '/' . $_COOKIE['currentLocalKey'] . $document->homePage;
    $document->languageLicensia = '__' . mb_strtoupper($_COOKIE['currentLocalKey']);

    //  redirect
    if (mb_substr($_SERVER['REQUEST_URI'], 1, 2) !== "mu"
      && mb_substr($_SERVER['REQUEST_URI'], 1, 2) !== "my") {
      $app->redirect('/' . $_COOKIE['currentLocalKey'] . Route::_($menu->link));
    }
  }
  
  $document->linkLicense = '/';
  switch (mb_substr(Route::_($menu->link), 0, 3)) {
    case '/mu' :
    case '/my' :
      $document->linkLicense = mb_substr(Route::_($menu->link), 3);
      if(!$_COOKIE['currentLocalKey']){
        setcookie('currentLocalKey', mb_substr(Route::_($menu->link), 1, 2),time()+3600000,'/');
      }
      break;
    default:
      $document->linkLicense = Route::_($menu->link);
  }