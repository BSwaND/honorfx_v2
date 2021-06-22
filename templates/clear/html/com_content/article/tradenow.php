<?php

	/**

	 * @package     Joomla.Site

	 * @subpackage  com_content

	 *

	 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.

	 * @license     GNU General Public License version 2 or later; see LICENSE.txt

	 */

	defined('_JEXEC') or die;

	

	$session = JFactory::getSession();

	$answer = $session->get('answer', false);

	$session->set('answer', false);

	$document = JFactory::getDocument();

	

	if(!empty($_POST['email']))

	{

		$email = $_POST['email'];

		$phone = $_POST['phone'];

		$referrer_url = $_POST['referrer_url'];

		$manager_id = $_POST['manager_id'];

		

		$afp = htmlspecialchars($_COOKIE['afp']);

		$sub_id = htmlspecialchars($_COOKIE['sub_id']);

		$utm_content = htmlspecialchars($_COOKIE['utm_content']);

		

		$curl = curl_init();

		

		curl_setopt_array($curl, [

				CURLOPT_URL => "http://api.honorfx.com/keyMetatrader/rest/create-demo-account",

				CURLOPT_RETURNTRANSFER => true,

				CURLOPT_ENCODING => "",

				CURLOPT_MAXREDIRS => 10,

				CURLOPT_TIMEOUT => 30,

				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

				CURLOPT_CUSTOMREQUEST => "POST",

				CURLOPT_POSTFIELDS => '&email=' . $email . '&phone=' . $phone . '&referrer_url=' . $referrer_url . '&manager_id='. $manager_id . '&afp=' . $afp . '&sub_id=' . $sub_id . '&utm_content=' . $utm_content ,

				CURLOPT_HTTPHEADER => [

						"cache-control: no-cache",

						"content-type: application/x-www-form-urlencoded"

				],

		]);

		$response = curl_exec($curl);

		$err = curl_error($curl);

		curl_close($curl);

		

		

		if ($err){

			echo "cURL Error #:" . $err;

		}

		if($response == '"done"'){

			$session->set('answer', true);

		}	else 	{

			echo 'Error!';

		}

		

		$js = <<<js

		document.addEventListener("DOMContentLoaded", function() {

			document.querySelector(".modal").classList.add("modal__open") ;

		})

js;

		$document->addScriptDeclaration($js);

	}



?>



<?php include_once(JPATH_BASE .'/templates/clear/html/com_content/article/_header.php');  ?>

	<div class="<?php echo $this->pageclass_sfx; ?>" >

		<?= $this->item->event->afterDisplayTitle ?>

		<?= $this->item->event->beforeDisplayContent ?>

		

		<div class="lending-form_body">

			<a href="/" class="header_logo"><img src="/templates/clear/images/lending-form/logo-withe.svg" alt="logo"></a>

			

			<div class="lending-form_inner">

				<div class="lending-form_titles">

					<div class="lending-form_title-form">One Platform</div>

					<div class="lending-form_title-form accent">275+ Instruments</div>

					<img src="/templates/clear/images/lending-form/bg-3.png" alt="One Platform">

				</div>

				<div class="lending-form_main">

					<div class="d-flex">

						<div class="lending-form_main__link"><a href="/" target="_blank"><img src="/templates/clear/images/lending-form/logo.svg" alt="HonorFX" ></a></div>

						<div class="lending-form_main__link"><a class="d-flex" href="//investing.com"><img src="/templates/clear/images/lending-form/logo-invest-new.png" alt="Investing.com"></a></div>

					</div>

					<form class="form" id="investing_com" method="post">

						<div class="d-none">

							<input name="referrer_url" type="text" value="<?= htmlspecialchars($_COOKIE['referrer']) ?>">

							<input name="ib_id" type="text" value="<?= htmlspecialchars($_COOKIE['1825b7fc00c894def505222b814a4f7c']) ?>">

							<input name="manager_id" type="text" value="<?= htmlspecialchars($_COOKIE['0efa14672a91fa0768d9f7e3d4330593']) ?>">

							

							<input name="afp" type="text" value="<?= htmlspecialchars($_COOKIE['afp']) ?>">

							<input name="sub_id" type="text" value="<?= htmlspecialchars($_COOKIE['sub_id']) ?>">

							<input name="utm_content" type="text" value="<?= htmlspecialchars($_COOKIE['utm_content']) ?>">

						</div>

						

						<div class="input_email__outer"><input type="text" placeholder="Email"  name="email" class="input input_email" required></div>

						<div class="input_phone__outer"><input type="text" placeholder="Phone"  name="phone" class="input input_phone" required></div>

						<div class=""><input type="submit" value="Start Trading!" class="input input_submit"></div>

						<p class="text-center privacy-policy">By creating an account, I accept <a href="index.php?Itemid=119">Privacy Policy.</a> </p>

					</form>

				

				</div>

			</div>

		</div>

		

		<div class="modal">

			<div class="modal_body">

				<div class="btn-close"><img src="/templates/clear/images/close.svg" alt="close"></div>

				<div class=""><img src="/templates/clear/images/modal-logo.svg" alt="Thanks for registering"></div>

				<div class="modal_title">

					<div class="accent">Thanks for registering</div>

					<div class="">on HonorFX trading platform.</div>

				</div>

				<p class="grey">Your relationship manager will contact you soon.</p>

			</div>

		</div>

		

		<?= $this->item->event->afterDisplayContent ?>

	</div>



<?php

	$document->addScript('/smetrics/metrics.js');

	

	$js = <<<js

		document.addEventListener("DOMContentLoaded", function() {

			let locationSearch = location.search.split('?', -1);

			let key =  locationSearch[1].split('&');

			

			key.forEach((e) =>{

				let k  = e.split('=');

				switch(k[0]) {

				  case 'afp':

				  	document.cookie = 'afp = '+ k[1];

				  	document.querySelector('input[name=afp]').value = k[1];

				    break

				  case 'sub_id':

				  	document.cookie = 'sub_id = '+ k[1];

				  	document.querySelector('input[name=sub_id]').value = k[1];

				    break

				  case 'utm_content':

				  	document.cookie = 'utm_content = '+ k[1] ;

				  	document.querySelector('input[name=utm_content]').value = k[1];

				    break

				}

			})

		})

js;

	

	$document->addScriptDeclaration($js);

	