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
	
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" prefix="og: http://ogp.me/ns#">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="/templates/<?php echo $this->template; ?>/icon/favicon.ico"/>
	
	<jdoc:include type="head"/>
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
					      <a href="<?= (!$locationThailand) ? '//my.honorfx.com/en/login' : '//portal.honorfx.com/login'?>" class="header_control__link popup-modal">Login</a>
					      <a href="<?= (!$locationThailand) ? '//my.honorfx.com/en/signup' : '//portal.honorfx.com/register'?>" class="btn btn_header popup-modal">Register</a>
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
						<a href="#" class="footer_social__link">
							<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
										d="M21.333 11.3335V11.3348H21.3334V14.0014H20C19.54 14.0014 19.3333 14.5406 19.3333 15.0014V16.6681H19.3334H21.3333V19.3348H19.3333V24.6681L16.6663 24.6668L16.6666 19.3348H14.6666V16.6681H16.6666L16.6667 14.0014C16.6667 12.5287 17.8606 11.3348 19.3334 11.3348L21.333 11.3335Z"
										fill="white"/>
								<rect x="0.5" y="0.5" width="35" height="35" rx="17.5" stroke="#EE743B"/>
							</svg>
						</a>
						<a href="#" class="footer_social__link">
							<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0)">
									<path
											d="M23.3333 18.0003C23.3333 19.072 23.3333 19.7947 23.3084 20.1935C23.2585 21.1654 22.9844 21.9131 22.4361 22.4365C21.8878 22.9598 21.1651 23.2589 20.1931 23.3087C19.7944 23.3337 19.0467 23.3337 18 23.3337C16.9283 23.3337 16.2056 23.3337 15.8068 23.3087C14.8349 23.2589 14.0872 22.9847 13.5638 22.4365C13.0405 21.9131 12.7414 21.1654 12.6915 20.1935C12.6666 19.7947 12.6666 19.0471 12.6666 18.0003C12.6666 16.9536 12.6666 16.2059 12.6915 15.8072C12.7414 14.8352 13.0155 14.0876 13.5638 13.5642C14.0872 13.0408 14.8349 12.7418 15.8068 12.6919C16.2056 12.667 16.9532 12.667 18 12.667C19.0716 12.667 19.7944 12.667 20.1931 12.6919C21.1651 12.7418 21.9127 13.0159 22.4361 13.5642C22.9595 14.1125 23.2585 14.8352 23.3084 15.8072C23.3084 16.2059 23.3333 16.9287 23.3333 18.0003ZM18.5233 13.614C18.1993 13.614 18.0249 13.614 18 13.614C17.975 13.614 17.8006 13.614 17.4766 13.614C17.1526 13.614 16.9034 13.614 16.7539 13.614C16.5794 13.614 16.3551 13.614 16.081 13.639C15.8068 13.639 15.5576 13.6639 15.3582 13.7137C15.1588 13.7386 14.9844 13.7885 14.8598 13.8383C14.6355 13.938 14.4361 14.0626 14.2367 14.2371C14.0623 14.4115 13.9377 14.6109 13.838 14.8601C13.7881 14.9847 13.7383 15.1592 13.7134 15.3586C13.6884 15.558 13.6635 15.7823 13.6386 16.0813C13.6386 16.3555 13.6137 16.5798 13.6137 16.7542C13.6137 16.9287 13.6137 17.1779 13.6137 17.477C13.6137 17.8009 13.6137 17.9754 13.6137 18.0003C13.6137 18.0252 13.6137 18.1997 13.6137 18.5237C13.6137 18.8477 13.6137 19.0969 13.6137 19.2464C13.6137 19.4209 13.6137 19.6452 13.6386 19.9193C13.6386 20.1935 13.6635 20.4427 13.7134 20.6421C13.7632 20.8414 13.7881 21.0159 13.838 21.1405C13.9377 21.3648 14.0623 21.5642 14.2367 21.7636C14.4112 21.938 14.6106 22.0626 14.8598 22.1623C14.9844 22.2122 15.1588 22.262 15.3582 22.2869C15.5576 22.3119 15.7819 22.3368 16.081 22.3617C16.38 22.3866 16.5794 22.3866 16.7539 22.3866C16.9283 22.3866 17.1775 22.3866 17.4766 22.3866C17.8006 22.3866 17.975 22.3866 18 22.3866C18.0249 22.3866 18.1993 22.3866 18.5233 22.3866C18.8473 22.3866 19.0965 22.3866 19.2461 22.3866C19.4205 22.3866 19.6448 22.3866 19.919 22.3617C20.1931 22.3617 20.4423 22.3368 20.6417 22.2869C20.8411 22.262 21.0155 22.2122 21.1401 22.1623C21.3644 22.0626 21.5638 21.938 21.7632 21.7636C21.9377 21.5891 22.0623 21.3897 22.162 21.1405C22.2118 21.0159 22.2616 20.8414 22.2866 20.6421C22.3115 20.4427 22.3364 20.2184 22.3613 19.9193C22.3613 19.6452 22.3863 19.4209 22.3863 19.2464C22.3863 19.072 22.3863 18.8228 22.3863 18.5237C22.3863 18.1997 22.3863 18.0252 22.3863 18.0003C22.3863 17.9754 22.3863 17.8009 22.3863 17.477C22.3863 17.153 22.3863 16.9038 22.3863 16.7542C22.3863 16.5798 22.3863 16.3555 22.3613 16.0813C22.3613 15.8072 22.3364 15.558 22.2866 15.3586C22.2616 15.1592 22.2118 14.9847 22.162 14.8601C22.0623 14.6358 21.9377 14.4365 21.7632 14.2371C21.5887 14.0626 21.3894 13.938 21.1401 13.8383C21.0155 13.7885 20.8411 13.7386 20.6417 13.7137C20.4423 13.6888 20.218 13.6639 19.919 13.639C19.6448 13.639 19.4205 13.614 19.2461 13.614C19.0965 13.614 18.8473 13.614 18.5233 13.614ZM19.919 16.0564C20.4423 16.5798 20.7165 17.2277 20.7165 18.0003C20.7165 18.7729 20.4423 19.396 19.919 19.9443C19.3956 20.4676 18.7476 20.7418 17.975 20.7418C17.2025 20.7418 16.5794 20.4676 16.0311 19.9443C15.5077 19.4209 15.2336 18.7729 15.2336 18.0003C15.2336 17.2277 15.5077 16.6047 16.0311 16.0564C16.5545 15.533 17.2025 15.2589 17.975 15.2589C18.7476 15.2589 19.3956 15.5081 19.919 16.0564ZM19.2461 19.2464C19.595 18.8975 19.7694 18.4738 19.7694 18.0003C19.7694 17.5268 19.595 17.0782 19.2461 16.7293C18.8972 16.3804 18.4735 16.2059 17.975 16.2059C17.4766 16.2059 17.0529 16.3804 16.704 16.7293C16.3551 17.0782 16.1806 17.5019 16.1806 18.0003C16.1806 18.4988 16.3551 18.9224 16.704 19.2464C17.0529 19.5953 17.4766 19.7698 17.975 19.7698C18.4735 19.7698 18.8972 19.5953 19.2461 19.2464ZM21.2897 14.6857C21.4143 14.8103 21.4891 14.9598 21.4891 15.1343C21.4891 15.3087 21.4143 15.4583 21.2897 15.5829C21.1651 15.7075 21.0155 15.7823 20.8411 15.7823C20.6666 15.7823 20.5171 15.7075 20.3925 15.5829C20.2679 15.4583 20.1931 15.3087 20.1931 15.1343C20.1931 14.9598 20.2679 14.8103 20.3925 14.6857C20.5171 14.5611 20.6666 14.4863 20.8411 14.4863C21.0155 14.4863 21.1651 14.5611 21.2897 14.6857Z"
											fill="white"/>
								</g>
								<rect x="0.5" y="0.5" width="35" height="35" rx="17.5" stroke="#EE743B"/>
								<defs>
									<clipPath id="clip0">
										<rect width="16" height="16" fill="white" transform="translate(10 10)"/>
									</clipPath>
								</defs>
							</svg>
						
						</a>
						<a href="#" class="footer_social__link">
							<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
										d="M23.3333 22.4445H20.963V18.4445C20.963 17.8172 20.259 17.2924 19.6317 17.2924C19.0044 17.2924 18.5926 17.8172 18.5926 18.4445V22.4445H16.2222V15.3334H18.5926V16.5186C18.9851 15.8837 19.989 15.474 20.6815 15.474C22.1461 15.474 23.3333 16.6837 23.3333 18.1482V22.4445ZM15.037 22.4445H12.6667V15.3334H15.037V22.4445ZM13.8518 11.7778C14.5064 11.7778 15.037 12.3085 15.037 12.963C15.037 13.6176 14.5064 14.1482 13.8518 14.1482C13.1973 14.1482 12.6667 13.6176 12.6667 12.963C12.6667 12.3085 13.1973 11.7778 13.8518 11.7778Z"
										fill="white"/>
								<rect x="0.5" y="0.5" width="35" height="35" rx="17.5" stroke="#EE743B"/>
							</svg>
						</a>
						<a href="#" class="footer_social__link">
							<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
										d="M24.9728 14.0081C24.4598 14.2357 23.9083 14.3895 23.3296 14.4586C23.9202 14.1045 24.374 13.5438 24.5876 12.8757C24.0347 13.2036 23.4224 13.4417 22.7707 13.57C22.2488 13.0139 21.5053 12.6665 20.6824 12.6665C19.1023 12.6665 17.8212 13.9475 17.8212 15.5275C17.8212 15.7518 17.8465 15.9701 17.8953 16.1796C15.5174 16.0602 13.4092 14.9212 11.9981 13.1902C11.7518 13.6127 11.6107 14.1042 11.6107 14.6286C11.6107 15.6212 12.1158 16.4969 12.8835 17.01C12.4146 16.9951 11.9733 16.8664 11.5876 16.6521C11.5874 16.6641 11.5874 16.676 11.5874 16.6881C11.5874 18.0744 12.5736 19.2307 13.8824 19.4936C13.6424 19.559 13.3896 19.594 13.1287 19.594C12.9443 19.594 12.7651 19.576 12.5903 19.5426C12.9544 20.6792 14.0111 21.5065 15.2631 21.5295C14.2839 22.297 13.0502 22.7544 11.7097 22.7544C11.4788 22.7544 11.251 22.7408 11.0272 22.7143C12.2934 23.5261 13.7973 23.9998 15.413 23.9998C20.6756 23.9998 23.5535 19.6402 23.5535 15.8593C23.5535 15.7353 23.5507 15.6119 23.5452 15.4891C24.1042 15.0857 24.5893 14.5819 24.9728 14.0081Z"
										fill="white"/>
								<rect x="0.5" y="0.5" width="35" height="35" rx="17.5" stroke="#EE743B"/>
							</svg>
						</a>
						<a href="#" class="footer_social__link">
							<svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0)">
									<path
											d="M26.191 14.8776C26.0181 14.1435 25.5115 13.5647 24.869 13.3671C23.6952 13 19 13 19 13C19 13 14.3048 13 13.131 13.3529C12.5008 13.5506 11.9819 14.1435 11.8089 14.8776C11.5 16.2188 11.5 19 11.5 19C11.5 19 11.5 21.7953 11.8089 23.1224C11.9819 23.8565 12.4885 24.4353 13.131 24.6329C14.3171 25 19 25 19 25C19 25 23.6952 25 24.869 24.6471C25.5115 24.4494 26.0181 23.8706 26.191 23.1365C26.4999 21.7953 26.4999 19.0141 26.4999 19.0141C26.4999 19.0141 26.5123 16.2188 26.191 14.8776Z"
											fill="white"/>
									<path d="M21.4094 19.0001L17.505 16.4307V21.5695L21.4094 19.0001Z" fill="#9A9BAA"/>
								</g>
								<rect x="0.5" y="0.5" width="37" height="37" rx="18.5" stroke="#EE743B"/>
								<defs>
									<clipPath id="clip0">
										<rect width="15" height="12" fill="white" transform="translate(11.5 13)"/>
									</clipPath>
								</defs>
							</svg>
						</a>
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