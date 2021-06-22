<?php
	/**
	 * @package     Joomla.Site
	 * @subpackage  mod_custom
	 *
	 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
	 * @license     GNU General Public License version 2 or later; see LICENSE.txt
	 */
	
	defined('_JEXEC') or die;
	
	$session = JFactory::getSession();
	$answer = $session->get('answer', false);
	$document = JFactory::getDocument();
	
	if (!empty($_POST['email'])) {
		$curl = curl_init();
		curl_setopt_array($curl, [
				CURLOPT_URL => "https://us-central1-madrid-investing.cloudfunctions.net/PostbackCloudFunciton/?token=YWR2ZXJpc2VyX2FmZmlsYXRpb25fdXJs&advertiser=Honor%20Capital%20Markets%20Limited&model=CPL&event_type=Lead&affiliate_id=12&subID=12",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_POSTFIELDS => '',
				CURLOPT_HTTPHEADER => [
						"cache-control: no-cache",
						"content-type: application/x-www-form-urlencoded"
				],
		]);
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		
		
		if ($err) {
			echo "cURL Error #:" . $err;
		}
		
		$js = <<<js
		document.addEventListener("DOMContentLoaded", function() {
			document.querySelector(".modal").classList.add("modal__open")
		})
js;
		$document->addScriptDeclaration($js);
	}
	
	$document->addScript('/smetrics/metrics.js');
?>

<form class="form" id="investing_com" method="post">
	<div class="d-none">
		<input name="referrer_url" type="text" value="<?= htmlspecialchars($_COOKIE['referrer']) ?>">
		<input name="ib_id" type="text" value="<?= htmlspecialchars($_COOKIE['1825b7fc00c894def505222b814a4f7c']) ?>">
		<input name="manager_id" type="text" value="<?= htmlspecialchars($_COOKIE['0efa14672a91fa0768d9f7e3d4330593']) ?>">
		
		<input name="afp" type="text" value="<?= htmlspecialchars($_COOKIE['afp']) ?>">
		<input name="sub_id" type="text" value="<?= htmlspecialchars($_COOKIE['sub_id']) ?>">
		<input name="utm_content" type="text" value="<?= htmlspecialchars($_COOKIE['utm_content']) ?>">
	</div>
	
	<div class=""><input type="text" placeholder="First Name" name="first_name" class="input" required=""></div>
	<div class=""><input type="text" placeholder="Last Name" name="last_name" class="input" required=""></div>
	<div class=""><input type="text" placeholder="Email" name="email" class="input" required=""></div>
	<div class=""><input type="text" placeholder="Phone" name="phone" class="input" required=""></div>
	<div class=""><input type="submit" value="Create Account" class="input input_submit"></div>
	<p class="text-center privacy-policy">By creating an account, I accept <a href="index.php?Itemid=119">Privacy
			Policy.</a></p>
</form>

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

<script>
	jQuery('#investing_com').submit(function () {
		jQuery('.input_submit').attr('style', 'display:none');
	});
	
	function addValForInvesting(){
		let locationSearch = location.search.split('?', -1);
		let key = locationSearch[1].split('&');
		
		if(!key) return;
		
		key.forEach((e) => {
			let k = e.split('=');
			switch (k[0]) {
				case 'afp':
					document.cookie = 'afp = ' + k[1];
					document.querySelector('input[name=afp]').value = k[1];
					break
				case 'sub_id':
					document.cookie = 'sub_id = ' + k[1];
					document.querySelector('input[name=sub_id]').value = k[1];
					break
				case 'utm_content':
					document.cookie = 'utm_content = ' + k[1];
					document.querySelector('input[name=utm_content]').value = k[1];
					break
			}
		})
	} addValForInvesting();
	

	
	
	console.log(45454545);
</script>
	
	