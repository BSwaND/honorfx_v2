<?php
	
	defined('_JEXEC') or die;
	
	$app = JFactory::getApplication();
	$user = JFactory::getUser();
	$this->setHtml5(true);
	$params = $app->getTemplate(true)->params;
	$menu = $app->getMenu()->getActive();
	$document = JFactory::getDocument();
	$document->setGenerator('');
	$template_url = JUri::root() . 'template/' . $this->template;
	if (is_object($menu))
		$pageclass = $menu->params->get('pageclass_sfx');
	
	include_once(JPATH_BASE . '/templates/custom/html/geo_location.php');
	include_once(JPATH_BASE . '/templates/custom/html/ib-cooke.php');
	
	// Подключение своих стилей:
	JHtml::_('stylesheet', $document->scc, array('version' => 'v=1.4', 'relative' => true));
	
	//Протокол Open Graph
	$pageTitle = $document->getTitle();
	$metaDescription = $document->getMetaData('description');
	$type = 'website';
	$view = $app->input->get('view', '');
	$id = $app->input->get('id', '');
	$image = JURI::base() . 'templates/custom/icon/logo.png';
	$title = !empty($pageTitle) ? $pageTitle : "default title";
	$desc = !empty($metaDescription) ? $metaDescription : "default description";
	
	if (!empty($view) && $view === 'article' && !empty($id)) {
		$article = JControllerLegacy::getInstance('Content')->getModel('Article')->getItem($id);
		$type = 'article';
		$images = json_decode($article->images);
		$image = !empty($images->image_intro) ? JURI::base() . $images->image_intro : JURI::base() . $images->image_fulltext;
	}
	$document->addCustomTag('
    <meta property="og:type" content="' . $type . '" />
    <meta property="og:title" content="' . $title . '" />
    <meta property="og:description" content="' . $desc . '" />
    <meta property="og:image" content="' . $image . '" />
    <meta property="og:url" content="' . JURI:: current() . '" />
');
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" prefix="og: http://ogp.me/ns#">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="/templates/<?php echo $this->template; ?>/icon/favicon-v1.jpg"/>
	<jdoc:include type="head"/>
</head>
<body>

	<jdoc:include type="component"/>
	
	<jdoc:include type="modules" name="footer" style="none"/>
<script src="/templates/<?= $this->template; ?>/js/<?= $document->js ?>"></script>
</body>
</html>