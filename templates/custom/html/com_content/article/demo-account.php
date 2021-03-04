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
	
	if(!empty($_POST))
	{
		$first_name = $_POST['first-name'];
		$last_name = $_POST['last-name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$referrer_url = $_POST['referrer_url'];
		$ib_id = $_POST['ib_id'];
		
		$leverage = $_POST['leverage'];
		$balance = $_POST['balance'];
		
		$curl = curl_init();
		
		curl_setopt_array($curl, [
				CURLOPT_URL => "http://api.honorfx.com/keyMetatrader/rest/create-demo-account",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => 'first_name=' . $first_name . '&last_name=' . $last_name . '&email=' . $email . '&phone=' . $phone . '&referrer_url=' . $referrer_url . '&ib_id=' . $ib_id . '&leverage=' . $leverage . '&balance='. $balance  ,
				CURLOPT_HTTPHEADER => [
						"cache-control: no-cache",
						"content-type: application/x-www-form-urlencoded"
				],
		]);
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		
		
		if ($err)
		{
			echo "cURL Error #:" . $err;
		}
		if($response == '"done"')
		{
			$session->set('answer', true);
		}
		else
		{
			echo 'Error!';
		}
		JFactory::getApplication()->redirect('/success');
	}
	
?>
<?php include_once(JPATH_BASE .'/templates/custom/html/com_content/article/_header.php');  ?>

<div class="item-page<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Article">
	<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />
	<?= $this->item->event->afterDisplayTitle ?>
	<?= $this->item->event->beforeDisplayContent ?>
	<?//= $this->item->text ?>
	
	<div class="demo-account mt-5 mb-5">
		<div class="container">
			<div class="registration-block section__dafault">
				<div class="container">
					<h1 class="h2"><span class="accent-color">HonorFX</span><br>Demo Trading Account</h1>
					<div class="section_descript">Trade CFDs on Forex, Metals, Indices and more in a <br> risk-free demo account</div>
					
					<form id="demo" class="registr-form  uForm" method="post">
						<div class="row">
							<div class="col-12 col-md-6">
								<label class="label">First Name
									<input id="reg-name" name="first-name" type="text" class="input" pattern="[A-Za-z\s]{2,60}" title="The name must not be less than 2 letters and without numbers" required>
								</label>
							</div>
							<div class="col-12 col-md-6">
								<label class="label">Last Name
									<input id="reg-last-name" name="last-name" type="text" class="input" pattern="[A-Za-z\s]{2,60}" title="The last name must not be less than 2 letters and without numbers" required>
								</label>
							</div>
							<div class="col-12">
								<label class="label">E-mail
									<input id="reg-email" name="email" type="email" class="input" title="Enter valid email" required>
								</label>
							</div>
							<div class="col-12">
								<label class="label">Mobile number
									<input id="reg-phone" name="phone" type="tel" class="input" required>
								</label>
							</div>
							
							<div class="col-12 col-md-6">
								<label class="label">Leverage
									<div class="select-block_initialization select-block_initialization__col-row">
										<select id="leverage" name="leverage" >
											<option value="1:1">1:1</option>
											<option value="1:50">1:50</option>
											<option value="1:100">1:100</option>
											<option value="1:200">1:200</option>
											<option value="1:500">1:500</option>
										</select>
										<div class="select-block_btn"><span>1:1</span></div>
									</div>
								</label>
							</div>
							<div class="col-12 col-md-6">
								<label class="label">Balance (USD)
									<div class="select-block_initialization select-block_initialization__col-row">
										<select id="balance"  name="balance">
											<option value="100$">100$</option>
											<option value="1000$">1000$</option>
											<option value="5000$">5000$</option>
											<option value="10000$">10000$</option>
										</select>
										<div class="select-block_btn"><span>100$</span></div>
									</div>
								</label>
							</div>
							
							<div class="col-12 hidden-info-inputs d-none" style="display:none;">
								<label class="label">Referrer Url
									<input id="referrer_url" name="referrer_url" type="text">
								</label>
								<label class="label">Ib Id
									<input id="ib_id" name="ib_id" type="text">
								</label>
							</div>
							<div class="col-12 mt-2">
								<label class="checkbox-custom__wrapper">
									<input id="agree" type="checkbox" class="checkbox-custom" required checked>
									<span class="checkbox-custom__box"></span>
									<span>I agree that HonorFX may provide me with products, services, promotional and educational information by telephone, SMS or email.</span>
								</label>
							</div>
							<div class="col-12 text-center mt-4">
								<button type="submit" class="btn">Submit</button>
							</div>
						</div>
					</form>
				
				</div>
			</div>
			<script>
				fetch('https://api.sypexgeo.net/')
						.then(response => response.json())
						.then(data => {
							//let country = data['country']['name_en'];
							let code = '+'+data['country']['phone'];
							jQuery('#reg-phone').val(code);
						})
						.catch(console.log);
			</script>
		</div>
	
	</div>
	
	<?= $this->item->event->afterDisplayContent ?>
</div>

<div class="text-color"></div>