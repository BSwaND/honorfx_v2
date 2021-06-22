<?php
	defined('_JEXEC') or die;
	
	JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
  $document = JFactory::getDocument();       
	
	// Create shortcuts to some parameters.
	$params  = $this->item->params;
	$canEdit = $params->get('access-edit');
	$user    = JFactory::getUser();
	$info    = $params->get('info_block_position', 0);

	$imageIntro 			= json_decode($this->item->images)->image_intro;
	$imageIntroAtt 		= (json_decode($this->item->images)->image_intro_alt) ? json_decode($this->item->images)->image_intro_alt : $this->item->title ;

	$imageFull 			= json_decode($this->item->images)->image_fulltext;
	$imageFullAtt 		= (json_decode($this->item->images)->image_fulltext_alt) ? json_decode($this->item->images)->image_fulltext_alt : $this->item->title ;

	// Check if associations are implemented. If they are, define the parameter.
	$assocParam = (JLanguageAssociations::isEnabled() && $params->get('show_associations'));
	JHtml::_('behavior.caption');
	
	//вывод модуля внутри шаблона
	jimport( 'joomla.application.module.helper' );
	$attribs['style'] = 'none';
  
  $document->scc = $this->item->jcfields[1]->rawvalue;
  $document->js = $this->item->jcfields[2]->rawvalue;