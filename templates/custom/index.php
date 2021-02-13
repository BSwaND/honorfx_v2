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
	$pageclass = '';
	if (is_object($menu))
		$pageclass = $menu->params->get('pageclass_sfx');
	
	// Подключение своих стилей:
	JHtml::_('stylesheet', 'styles.min.css', array('version' => '', 'relative' => true));
	JHtml::_('stylesheet', 'custom.css', array('version' => '', 'relative' => true));
	
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
	
	include_once(JPATH_BASE . '/templates/custom/html/geo_location.php');
	include_once(JPATH_BASE . '/templates/custom/html/ib-cooke.php');
	
	
	
?>


<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" prefix="og: http://ogp.me/ns#">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="/templates/<?php echo $this->template; ?>/icon/favicon.ico"/>
	
	<jdoc:include type="head"/>
	<meta name="theme-color" content="#EE743B">
</head>
<body class="<?php echo $pageclass ? htmlspecialchars($pageclass) : 'default'; ?>">
<header class="header">
	<div class="header_top-line">
		<div class="container">
			<div class="row">
				<div class="col-sm-5">
					<div class="bb d-flex">
						<span class="header_control__btn-hamburger">
					<div class="hamburger hamburger--slider">
						<div class="hamburger-box">
							<div class="hamburger-inner"></div>
						</div>
					</div>
				</span>
						<a href="/" class="header_logo"><img src="images/logo.svg" alt="logo"></a>
					</div>
				</div>
				<div class="col-sm-7">
					<div class="header_control">
				      <span class="header_control__link-block">
					      <a href="<?= (!$document->locationThailand) ? '//my.honorfx.com/en/login' : '//portal.honorfx.com/login'?>" class="header_control__link popup-modal">Login</a>
					      <a href="<?= (!$document->locationThailand) ? '//my.honorfx.com/en/signup' : '//portal.honorfx.com/register'?>" class="btn btn_header popup-modal">Register</a>
				      </span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav>
						<jdoc:include type="modules" name="nav_header" style="none"/>
				</nav>
			</div>
		</div>
	</div>
</header>

<main class="main">
		<jdoc:include type="component"/>
</main>

<footer class="footer">
	<div class="container">
		<div class="mb-4">
			<a href="/" class="footer__logo"><img src="images/logo-color.svg" alt="logo"></a>
		</div>
		
		<div class="footer_body">
			<div class="row">
				<div class="col-md-6 col-lg-3">
					<div class="footer_address">
						<div class="footer_address_item">
							<img src="images/icon/marcer.svg" class="footer_address__marker">
							<span class="footer_address__text">10th Floor, Sterling Tower, 14 <br>
								Poudriere Street, Port Louis, <br>Mauritius
							</span>
						</div>
						<div class="footer_address_item">
							<img src="images/icon/phone.svg" class="footer_address__marker">
							<a href="+442032396011" class="footer_address__text">+442032396011</a>
						</div>
						<div class="footer_address_item">
							<img src="images/icon/mail.svg" class="footer_address__marker">
							<span class="footer_address__text">support@honorfx.com</span>
						</div>
					
					</div>
					<div class="footer_social">
						<jdoc:include type="modules" name="footer_social" style="none"/>  
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="footer__descriptor">HonorFX is a brand name of Honor Capital Markets Limited. We are regulated by
						Financial Services Commission of the Republic of Mauritius with an Investment Dealer license.
					</div>
					<div class="mt-4 accent-color ">License number GB200225826.</div>
				</div>
				<div class="mt-5 mt-md-0 col-md-12 col-lg-6">
					<div class="footer__info">
						<p><b>Risk Warning: </b>Trading Forex and Leveraged Financial Instruments involves
							significant risk and can result in the loss of your invested capital. You should not invest more than you
							can afford to lose and should ensure that you fully understand the risks involved. Trading leveraged
							products may not be suitable for all investors.Past performance is no guarantee of future results.It is
							the
							responsibility of the Client to ascertain whether he/she is permitted to use the services of the Honorfx
							brand based on the legal requirements in his/her country of residence. Please read Honorfx’s full Risk
							Disclosure. </p><br>
						<p>Regional restrictions: Honorfx brand does not provide services to residents of the USA, Japan,
							British Columbia, Mauritius, Quebec and FATF black listed countries. Find out more in the Regulations
							section of our FAQs. </p>
					</div>
				</div>
			
			</div>
		</div>
	</div>
	<div class="footer_sub">
		<div class="container">
			<div class="row">
				<div class="offset-0 offset-lg-2 col-lg-8">
					<jdoc:include type="modules" name="footer" style="none"/>
				</div>
			</div>
		</div>
	</div>
</footer>


<div class="btn-up">
	<svg width="26" height="14" viewBox="0 0 26 14" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path
				d="M11.8748 0.309078L0.308338 11.8755C-0.102779 12.2866 -0.102779 12.9512 0.308338 13.3623C0.719456 13.7734 1.38402 13.7734 1.79513 13.3623L12.6182 2.53929L23.4412 13.3623C23.8523 13.7734 24.5169 13.7734 24.928 13.3623C25.133 13.1573 25.2361 12.8881 25.2361 12.6189C25.2361 12.3497 25.133 12.0805 24.928 11.8755L13.3615 0.309028C12.9505 -0.10204 12.2859 -0.102039 11.8748 0.309078Z"
				fill="#EE743B"/>
	</svg>
</div>

<script src="/templates/<?php echo $this->template; ?>/js/scripts.min.js"></script>
<script src="/templates/<?php echo $this->template; ?>/js/custom.js"></script>
</body>
</html>