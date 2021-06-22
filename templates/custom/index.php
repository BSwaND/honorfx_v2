<?php
	
	use Joomla\CMS\Router\Route;
	
	defined('_JEXEC') or die;
	$session = JFactory::getSession();
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
	
	include_once(JPATH_BASE . '/templates/custom/html/geo_location.php');
	include_once(JPATH_BASE . '/templates/custom/html/ib-cooke.php');
	include_once(JPATH_BASE . '/templates/custom/html/licencia.php');
	
	if($document->locationIndia && $menu->get('id') != 123){  // redirect for India
		header('Location: /not-available-region');
	}
	

	
	
//	echo '<pre style=" display: none;    ">';
//	//print_r($document);   echo '<br>';
//	//print_r(JUri::current());
//
////	$URL = 'https://honorfx.com';
////	$headers = get_headers($URL);
////	print_r( $code = $headers );
//
//	//print_r(getallheaders(JUri::current()));
//	echo '</pre>';
	

	
	// Подключение своих стилей:
	JHtml::_('stylesheet', 'swiper-bundle.min.css', array('version' => '', 'relative' => true));
	JHtml::_('stylesheet', 'styles.min.css', array('version' => '', 'relative' => true));
	JHtml::_('stylesheet', 'custom.css', array('version' => '', 'relative' => true));
	if($document->scc){
		JHtml::_('stylesheet', $document->scc, array('version' => 'v=1.3', 'relative' => true));
	}
	
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
		$image = JURI::base().'img/layout/og-logo.png';
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

	<?php  if( $this->language == 'ar-aa' || $this->language == 'ur-pk'){  ?>
    	<link rel="stylesheet" href="/templates/custom/css/styles.RTL.css" />
	<?php  } ?>
	<link rel="stylesheet" href="/templates/custom/css/careers.css">
	<meta name="theme-color" content="#EE743B">
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<?/*<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139622869-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		
		gtag('config', 'UA-139622869-1');
	</script>*/?>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NRJ983H');</script>

	<!-- Yandex.Metrika counter -->
	<!-- <script type="text/javascript" >
		(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
			m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
		(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
		
		ym(73195747, "init", {
			clickmap:true,
			trackLinks:true,
			accurateTrackBounce:true,
			webvisor:true
		});
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/73195747" style="position:absolute; left:-9999px;" alt="" /></div></noscript> -->
	<!-- /Yandex.Metrika counter -->

</head>
<body class="<?php echo $pageclass ? htmlspecialchars($pageclass) : 'default'; ?>">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NRJ983H";
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<header class="header">
	<div class="header_top-line">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="d-flex flex-wrap">
						<div class="header_control__btn-hamburger">
							<div class="hamburger hamburger--slider">
								<div class="hamburger-box">
									<div class="hamburger-inner"></div>
								</div>
							</div>
					</div>
						<a href="<?= $document->homePage ?>" class="header_logo"><img src="img/layout/honorfx_logo.svg" alt="logo"></a>
						<?php if($document->language === 'en-gb' && $_SERVER['REMOTE_ADDR'] === '195.138.64.213'){ ?>
						<div class="header_logo_wrapp _d-none">
							<div class="current-site"></div>
							<ul class="show-sites">
								<li data-site="" class="show-sites__item">
									<a href="<?= 	$document->linkLicense ?>">Honor Capital Markets Limited (SV)</a>
								</li>
								<li data-site="mu" class="show-sites__item">
									<a href="/mu<?= 	$document->linkLicense ?>">Honor Capital Markets Limited (MU)</a>
								</li>
								<li data-site="my" class="show-sites__item d-none">
									<a href="/my<?= 	$document->linkLicense ?>">Honor Capital Markets Limited (MY)</a>
								</li>
							</ul>
						</div>
							
						<?php }	?>
						
					</div>
				</div>
				<div class="col-sm-6">
					<div class="header_control">
						<div class="switch_lange">
							<jdoc:include type="modules" name="switch_lange" style="none"/>
						</div>
						
						<?php if(!$document->locationIndia){ ?>
				      <span class="header_control__link-block">
					      <?= (!$document->locationThailand) ? '' : '<a href="//portal.honorfx.com/login" class="header_control__link popup-modal" style="margin-bottom: 10px;">Client Login</a>'?>
					      
					      <?php /* <a href="<?= (!$document->locationThailand) ? '//my.honorfx.com/'. JText::_("TPL_CUSTOM_MOD_CUSTOM_LANGUAGE_TAG") . '/login' : '//portal.honorfx.com/ib/login'?>" class="header_control__link popup-modal"> */ ?>
					      <a href="<?php include (JPATH_BASE . '/templates/custom/html/mod_custom/substitution-url-login.php') ?>" class="header_control__link popup-modal">
						      <?= (!$document->locationThailand) ? JText::_("TPL_CUSTOM_MOD_CUSTOM_HEADER_TOP_SIGN_BTN") :  JText::_("TPL_CUSTOM_MOD_CUSTOM_HEADER_TOP_SIGN_BTN")?>
					      </a>
					      <a href="<?php include (JPATH_BASE . '/templates/custom/html/mod_custom/substitution-url-register.php') ?>" class="btn btn_header popup-modal">
						      <?= JText::_("TPL_CUSTOM_MOD_CUSTOM_HEADER_TOP_AUTH_BTN") ?>
					      </a>
				      </span>
						<?php } ?>
						
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
		<div class="footer_body">
			<div class="row">
				<div class="col-md-12 col-lg-6">
					<div class="footer_address">
						<div class="mb-3 footer__logo">
							<a href="<?= $document->homePage ?>"><img src="images/logo-color.svg" alt="logo"></a>
						</div>
						<h4 class="our-platform__title">
							Download MT5
						</h4>
						<div class="our-platform_link_block platform-new-design block-dotted-line">
							<a href="//play.google.com/store/apps/details?id=net.metaquotes.metatrader5&hl=en" class="our-platform__link">
								<svg viewBox="0 0 30 36" xmlns="http://www.w3.org/2000/svg">
									<path d="M27.8049 11.6872C26.5997 11.6872 25.6098 12.6911 25.6098 13.9133V23.1888C25.6098 24.411 26.5997 25.415 27.8049 25.415C29.01 25.415 30 24.411 30 23.1888V13.9133C30 12.6802 29.01 11.6872 27.8049 11.6872ZM2.19512 11.6872C0.989957 11.6872 0 12.6911 0 13.9133V23.1888C0 24.411 0.989957 25.415 2.19512 25.415C3.40029 25.415 4.39024 24.411 4.39024 23.1888V13.9133C4.39024 12.6802 3.40029 11.6872 2.19512 11.6872ZM24.792 12.0691V26.4626C24.792 27.7939 23.7374 28.8633 22.4247 28.8633H20.8537V33.7739C20.8537 34.9961 19.8637 36 18.6585 36C17.4534 36 16.4634 34.9961 16.4634 33.7739V28.8633H13.5366V33.7739C13.5366 34.9961 12.5466 36 11.3415 36C10.1363 36 9.14634 34.9961 9.14634 33.7739V28.8633H7.57532C6.26255 28.8633 5.20803 27.7939 5.20803 26.4626V12.0691H24.792ZM19.7991 3.30646L21.3486 0.469233C21.4347 0.31646 21.3809 0.120036 21.2303 0.0436496C21.1872 0.0218248 21.1334 0 21.0796 0C20.972 0 20.8644 0.054562 20.8106 0.163686L19.2396 3.02273C17.9591 2.44438 16.5172 2.11701 15 2.11701C13.4828 2.11701 12.0409 2.44438 10.7604 3.02273L9.20014 0.163686C9.11406 0.0109124 8.93113 -0.0436496 8.78049 0.0436496C8.62984 0.130949 8.57604 0.31646 8.66212 0.469233L10.2116 3.30646C7.23099 4.87784 5.22956 7.85693 5.2188 11.2834H24.8027C24.792 7.85693 22.7798 4.87784 19.7991 3.30646ZM10.4806 7.64959C10.0287 7.64959 9.66284 7.27857 9.66284 6.82025C9.66284 6.36193 10.0287 5.99091 10.4806 5.99091C10.9326 5.99091 11.2984 6.36193 11.2984 6.82025C11.2984 7.27857 10.9326 7.64959 10.4806 7.64959ZM19.5194 7.64959C19.0674 7.64959 18.7016 7.27857 18.7016 6.82025C18.7016 6.36193 19.0674 5.99091 19.5194 5.99091C19.9713 5.99091 20.3372 6.36193 20.3372 6.82025C20.3372 7.27857 19.9713 7.64959 19.5194 7.64959Z" fill="#999999"/>
								</svg>
							</a>
							<a href="//apps.apple.com/ru/app/metatrader-5/id413251709" class="our-platform__link">
								<svg viewBox="0 0 29 36" xmlns="http://www.w3.org/2000/svg">
									<path d="M14.7258 10.3436C13.3196 10.3436 11.1429 8.72683 8.85052 8.78527C5.82617 8.82423 3.05225 10.5579 1.49191 13.3045C-1.64802 18.8172 0.682851 26.9597 3.74573 31.44C5.24827 33.6217 7.0205 36.0761 9.37063 35.9982C11.6244 35.9008 12.472 34.5177 15.2074 34.5177C17.9236 34.5177 18.6941 35.9982 21.0828 35.9398C23.5099 35.9008 25.051 33.7191 26.5343 31.5179C28.2487 28.9856 28.9615 26.5311 29 26.3948C28.9422 26.3753 24.2805 24.5637 24.2227 19.1094C24.1842 14.5512 27.902 12.3695 28.0754 12.2721C25.9564 9.1359 22.7009 8.78527 21.5643 8.70736C18.5978 8.4736 16.1128 10.3436 14.7258 10.3436ZM19.7343 5.74646C20.9864 4.22706 21.8148 2.10379 21.5836 0C19.7921 0.0779182 17.6346 1.20773 16.344 2.72713C15.1882 4.07122 14.1865 6.23345 14.4562 8.29828C16.4403 8.45412 18.4822 7.26587 19.7343 5.74646Z" fill="#999999"/>
								</svg>
							</a>
							<a href="//download.mql5.com/cdn/web/honor.fx.ltd/mt5/honorfx5setup.exe" class="our-platform__link">
								<svg viewBox="0 0 31 33" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 21.9141V22.8809C0 24.4793 1.22784 25.7812 2.73529 25.7812H28.2647C29.7722 25.7812 31 24.4793 31 22.8809V21.9141H0Z" fill="#999999"/>
									<path d="M21.5787 29.1328H20.5271L19.9983 27.7148H11.0083L10.4795 29.1328H9.42182C7.90829 29.1328 6.68652 30.4283 6.68652 32.0332C6.68652 32.5682 7.09378 33 7.59829 33H23.4022C23.9067 33 24.314 32.5682 24.314 32.0332C24.314 30.4283 23.0922 29.1328 21.5787 29.1328Z" fill="#999999"/>
									<path d="M28.2647 0H2.73529C1.22784 0 0 1.30195 0 2.90039V19.9805H31V2.90039C31 1.30195 29.7722 0 28.2647 0Z" fill="#999999"/>
								</svg>
							</a>
							<a href="//download.mql5.com/cdn/web/honor.fx.ltd/mt5/honorfx5setup.exe" class="our-platform__link">
                              <svg xmlns="http://www.w3.org/2000/svg" width="29.701" height="29.701" viewBox="0 0 29.701 29.701">
                                <defs>
                                    <style>
                                        .a {
                                            fill: #ee743b;
                                        }
                                    </style>
                                </defs>
                                <path class="a" d="M0,260.619,12.173,262.3v-11.62H0Z" transform="translate(0 -235.005)" />
                                <path class="a" d="M0,50.307H12.173V38.544L0,40.222Z" transform="translate(0 -36.134)" />
                                <path class="a" d="M216.129,262.473l16.189,2.231V250.674H216.129Z" transform="translate(-202.617 -235.003)" />
                                <path class="a" d="M216.132,2.231V14.172h16.189V0Z" transform="translate(-202.62)" />
                              </svg>
							</a>
						</div>
						<div class="footer__nav-links block-dotted-line">
							<div class="footer__module-container">
								<p class="footer__list__title">Company:</p>
								<jdoc:include type="modules" name="footer_menu_company" style="none"/>
							</div>
							<div class="footer__module-container">
								<p class="footer__list__title">Trading:</p>
								<jdoc:include type="modules" name="footer_menu_trading" style="none"/>
							</div>
							<div class="footer__module-container">
								<p class="footer__list__title">Promotions:</p>
								<jdoc:include type="modules" name="footer_menu_promotions" style="none"/>
							</div>
						</div>
					</div>
					<div class="footer__contacs-info">
						<?php if(!$document->locationIndia){ ?>
							<div class="footer__contacts-container">
								<h4 class="footer__contacs-title">
									Contacts
								</h4>
								<div itemscope itemtype="https://schema.org/Organization">
									<div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
										<div class="footer__address-wrapp">
											<div class="footer_address_item ml-0 pb-0 mr-0">
												<img src="images/icon/phone.svg" class="footer_address__marker" alt="icon: phone">
												<span itemprop="telephone"><a href="tel:97142211811" class="footer_address__text">+97142211811</a></span>
											</div>
											<div class="footer_address_item">
												<img src="images/icon/mail.svg" class="footer_address__marker" alt="icon: message">
												<span itemprop="email"><a href="mailto:support@honorfx.com" class="footer_address__text">support@honorfx.com</a><span>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
						<div class="footer__socials-container">
							<h4 class="footer__socials-title">
								Follow us
							</h4>
							<div class="footer_socials">
								<a href="//www.facebook.com/HonorFX/" class="footer_socials-links">
									<svg xmlns="http://www.w3.org/2000/svg" width="11.976" height="23.954" viewBox="0 0 11.976 23.954">
										<path class="a" d="M11.975,0V0h0v4.79H9.58c-.826,0-1.2.969-1.2,1.8V9.583h3.593v4.79H8.383v9.581l-4.791,0V14.373H0V9.583H3.593V4.793A4.79,4.79,0,0,1,8.383,0Z" />
									</svg>
								</a>
								<a href="//twitter.com/honor_fx" class="footer_socials-links">
									<svg xmlns="http://www.w3.org/2000/svg" width="23.084" height="18.76" viewBox="0 0 23.084 18.76">
										<g transform="translate(0 0)">
											<path class="a" d="M23.084,2.221a9.467,9.467,0,0,1-2.72.746A4.751,4.751,0,0,0,22.446.346,9.48,9.48,0,0,1,19.439,1.5a4.74,4.74,0,0,0-8.07,4.32A13.445,13.445,0,0,1,1.607.867,4.741,4.741,0,0,0,3.073,7.19,4.718,4.718,0,0,1,.928,6.6c0,.02,0,.04,0,.06a4.739,4.739,0,0,0,3.8,4.644,4.745,4.745,0,0,1-2.139.081,4.741,4.741,0,0,0,4.424,3.289A9.5,9.5,0,0,1,1.13,16.7,9.617,9.617,0,0,1,0,16.632,13.4,13.4,0,0,0,7.26,18.76,13.383,13.383,0,0,0,20.734,5.285q0-.308-.014-.613A9.621,9.621,0,0,0,23.084,2.221Z" />
										</g>
									</svg>
								</a>
								<a href="//www.linkedin.com/company/honorfx" class="footer_socials-links">
									<svg xmlns="http://www.w3.org/2000/svg" width="21.093" height="21.093" viewBox="0 0 21.093 21.093">
										<path class="a" d="M21.093,21.093H16.405v-7.91A2.636,2.636,0,0,0,13.773,10.9a2.119,2.119,0,0,0-2.055,2.278v7.91H7.031V7.031h4.687V9.375a5.381,5.381,0,0,1,4.131-2.066A5.282,5.282,0,0,1,21.093,12.6Zm-16.405,0H0V7.031H4.687ZM2.344,0A2.344,2.344,0,1,1,0,2.344,2.344,2.344,0,0,1,2.344,0Z" />
									</svg>
								</a>
								<a href="//www.instagram.com/honorfx/" class="footer_socials-links">
									<svg xmlns="http://www.w3.org/2000/svg" width="20.787" height="20.791" viewBox="0 0 20.787 20.791">
										<path class="a"
											d="M21.183,6.113A7.6,7.6,0,0,0,20.7,3.59,5.326,5.326,0,0,0,17.657.548,7.617,7.617,0,0,0,15.135.065C14.022.012,13.669,0,10.846,0S7.67.012,6.561.061A7.6,7.6,0,0,0,4.039.544a5.073,5.073,0,0,0-1.844,1.2A5.119,5.119,0,0,0,1,3.586,7.617,7.617,0,0,0,.514,6.108C.461,7.221.449,7.575.449,10.4s.012,3.176.061,4.285A7.6,7.6,0,0,0,.993,17.2a5.325,5.325,0,0,0,3.042,3.042,7.618,7.618,0,0,0,2.522.483c1.109.049,1.462.061,4.285.061s3.176-.012,4.285-.061a7.6,7.6,0,0,0,2.522-.483A5.318,5.318,0,0,0,20.691,17.2a7.622,7.622,0,0,0,.483-2.522c.049-1.109.061-1.462.061-4.285s0-3.176-.053-4.285ZM19.31,14.6a5.7,5.7,0,0,1-.357,1.929A3.449,3.449,0,0,1,16.979,18.5a5.719,5.719,0,0,1-1.929.357c-1.1.049-1.425.061-4.2.061s-3.107-.012-4.2-.061A5.7,5.7,0,0,1,4.721,18.5a3.2,3.2,0,0,1-1.194-.776,3.232,3.232,0,0,1-.776-1.194,5.72,5.72,0,0,1-.357-1.929c-.049-1.1-.061-1.426-.061-4.2s.012-3.107.061-4.2a5.7,5.7,0,0,1,.357-1.929,3.16,3.16,0,0,1,.78-1.194,3.227,3.227,0,0,1,1.194-.776A5.723,5.723,0,0,1,6.655,1.95c1.1-.049,1.426-.061,4.2-.061s3.107.012,4.2.061a5.7,5.7,0,0,1,1.929.357,3.2,3.2,0,0,1,1.194.776,3.232,3.232,0,0,1,.776,1.194,5.722,5.722,0,0,1,.357,1.929c.049,1.1.061,1.425.061,4.2s-.012,3.1-.061,4.2Zm0,0"
											transform="translate(-0.449 0)" />
										<path class="a"
											d="M130.29,124.5a5.341,5.341,0,1,0,5.341,5.341A5.342,5.342,0,0,0,130.29,124.5Zm0,8.805a3.464,3.464,0,1,1,3.464-3.464A3.465,3.465,0,0,1,130.29,133.305Zm0,0"
											transform="translate(-119.892 -119.443)" />
										<path class="a" d="M364.944,89.849A1.247,1.247,0,1,1,363.7,88.6,1.247,1.247,0,0,1,364.944,89.849Zm0,0"
											transform="translate(-347.747 -85.003)" />
									</svg>
								</a>
								<a href="//www.youtube.com/c/honorfx" class="footer_socials-links">
									<svg xmlns="http://www.w3.org/2000/svg" width="25.231" height="17.872" viewBox="0 0 25.231 17.872">
										<path class="a" d="M24.673,6.054l.032.206a3.2,3.2,0,0,0-2.174-2.22l-.022-.005C20.541,3.5,12.626,3.5,12.626,3.5s-7.9-.011-9.882.534a3.2,3.2,0,0,0-2.19,2.2L.549,6.26A35.17,35.17,0,0,0,.581,18.82l-.033-.208a3.2,3.2,0,0,0,2.174,2.22l.022.005c1.965.535,9.882.535,9.882.535s7.894,0,9.882-.535a3.2,3.2,0,0,0,2.191-2.2l.005-.022a32.869,32.869,0,0,0,.526-5.938c0-.077,0-.155,0-.232s0-.157,0-.242a33.911,33.911,0,0,0-.558-6.146ZM10.1,17.373V7.511l7.863,4.93Z" transform="translate(0 -3.5)" />
									</svg>
								</a>
							</div>
						</div>
					</div>
					<!-- <div class="footer_social">
						<jdoc:include type="modules" name="footer_social" style="none"/>  
					</div> -->
				</div>
				<div class="col-md-12 col-lg-6">
					<div class="footer_address_item block-dotted-line">
						<p class="footer__description">
							<b><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_FOOTER_TITLE_LEGAL_DESCRIPTION_TEXT') ?></b> <?= JText::_('TPL_CUSTOM_MOD_CUSTOM_FOOTER_LEGAL_DESCRIPTION_TEXT'.$document->languageLicensia ) ?>
						</p>
						<p class="footer__description">
							<?= JText::_('TPL_CUSTOM_MOD_CUSTOM_FOOTER_LEGAL_DESCRIPTION_TEXT_MU') ?>
						</p>
						<p class="footer__description">
							<?= JText::_('TPL_CUSTOM_MOD_CUSTOM_FOOTER_LEGAL_DESCRIPTION_TEXT_MY'.$document->languageLicensia ) ?>
						</p>
						<p class="footer__description mb-0">
							<?= JText::_('TPL_CUSTOM_MOD_CUSTOM_FOOTER_LEGAL_DESCRIPTION_TEXT_SV'.$document->languageLicensia ) ?>
							</br> 
							HONOR MARKETING LTD (Company number 13352317) is an authorized Payment agent (PA).
						</p>
					</div>
					<div class="footer__info">
						<p class="mb-0">
							<b><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_FOOTER_TITLE_RISK_DESCRIPTION_TEXT') ?></b> <?= JText::_('TPL_CUSTOM_MOD_CUSTOM_FOOTER_RISK_DESCRIPTION_TEXT') ?><br>
						</p>
						<p>
							<b><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_FOOTER_TITLE_REGION_DESCRIPTION_TEXT') ?></b> <?= JText::_('TPL_CUSTOM_MOD_CUSTOM_FOOTER_REGION_DESCRIPTION_TEXT') ?>
						</p>
					</div>
					<div class="footer__privacy">
						<div class="footer_address_item block-dotted-line">
							<a href="index.php?option=com_content&view=article&id=11" class="footer_address__text">Privacy Policy</a>
							<a href="index.php?option=com_content&view=article&id=33" class="footer_address__text">Terms of Use</a>
							<a href="index.php?option=com_content&view=article&id=38" class="footer_address__text">Risk Warning</a>
							<a href="index.php?option=com_content&view=article&id=39" class="footer_address__text">Cookies Policy</a>
						</div> 
					</div>
				</div>
			
			</div>
		</div>
	</div>
	<jdoc:include type="modules" name="footer" style="none"/>
	<div class="footer_sub">
		<div class="container">
			<div class="row">
				<div class="offset-0 offset-lg-2 col-lg-8">  
					<p class="footer__copyright">
						<?= JText::_('TPL_CUSTOM_MOD_CUSTOM_FOOTER_SUB_COPYRIGHT') ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</footer>
<jdoc:include type="modules" name="pop_up" style="none"/>

<div class="btn-up">
	<svg width="26" height="14" viewBox="0 0 26 14" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path
				d="M11.8748 0.309078L0.308338 11.8755C-0.102779 12.2866 -0.102779 12.9512 0.308338 13.3623C0.719456 13.7734 1.38402 13.7734 1.79513 13.3623L12.6182 2.53929L23.4412 13.3623C23.8523 13.7734 24.5169 13.7734 24.928 13.3623C25.133 13.1573 25.2361 12.8881 25.2361 12.6189C25.2361 12.3497 25.133 12.0805 24.928 11.8755L13.3615 0.309028C12.9505 -0.10204 12.2859 -0.102039 11.8748 0.309078Z"
				fill="#EE743B"/>
	</svg>
</div>


<!-- Start of LiveChat (www.livechatinc.com) code -->
<?php if(!$document->locationIndia){ ?>
<script>
	window.__lc = window.__lc || {};
	window.__lc.license = 12424659;
	;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
</script>
<noscript><a href="https://www.livechatinc.com/chat-with/12424659/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
<?php } ?>
<!-- End of LiveChat code -->
  
<!-- Start linkedine -->  	
  <script type="text/javascript"> _linkedin_partner_id = "3293433"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); </script><script type="text/javascript"> (function(){var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(); </script> <noscript> <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=3293433&fmt=gif" /> </noscript>
  <!-- End linkedine -->

<script src="/smetrics/metrics.js"></script>
<script defer src="/templates/<?php echo $this->template; ?>/js/swiper-bundle.min.js"></script>
<script async src="/templates/<?php echo $this->template; ?>/uForm/js/script.js"></script>
<script async src="/templates/<?php echo $this->template; ?>/js/scripts.min.js"></script>
<script src="/templates/<?php echo $this->template; ?>/js/custom.js"></script>
<?= ($document->js) ? '<script src="/templates/'. $this->template .'/js/'. $document->js .'"></script>': null?>  
</body>
</html>