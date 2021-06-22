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
		$manager_id = $_POST['manager_id'];
		
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
				CURLOPT_POSTFIELDS => 'first_name=' . $first_name . '&last_name=' . $last_name . '&email=' . $email . '&phone=' . $phone . '&referrer_url=' . $referrer_url . '&ib_id=' . $ib_id . '&leverage=' . $leverage . '&balance='. $balance . '&manager_id='. $manager_id ,
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

<?= $this->item->event->afterDisplayTitle ?>
<?= $this->item->event->beforeDisplayContent ?>
<?//= $this->item->text ?>

<div class="demo-account mt-5 mb-5">
	<div class="container">
		<div class="registration-block section__dafault">
			<div class="container">
				<h1 class="h2"><span class="accent-color">
					HonorFX</span><br><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_DEMO_ACCOUNT_TITLE') ?>
				</h1>
				<div class="section_descript">
					<?= JText::_('TPL_CUSTOM_MOD_CUSTOM_DEMO_ACCOUNT_DESCRIPTION') ?>
				</div>
				
				<form id="demo" class="registr-form  uForm" method="post">
						<?php /*
					<input type="hidden" name="referrer_url" value="<?= htmlspecialchars($_COOKIE['referrer']) ?>">
					<input type="hidden" name="ib_id" value="">
					<input type="hidden" name="manager_id" value="">
					*/?>
					<div class="row">
						<div class="col-12 col-md-6">
							<label class="label"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_DEMO_ACCOUNT_LABEL_FIRST_NAME') ?>
								<input id="reg-name" name="first-name" type="text" class="input" pattern="[A-Za-z\s]{2,60}" title="The name must not be less than 2 letters and without numbers" required>
							</label>
						</div>
						<div class="col-12 col-md-6">
							<label class="label"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_DEMO_ACCOUNT_LABEL_LAST_NAME') ?>
								<input id="reg-last-name" name="last-name" type="text" class="input" pattern="[A-Za-z\s]{2,60}" title="The last name must not be less than 2 letters and without numbers" required>
							</label>
						</div>
						<div class="col-12">
							<label class="label"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_DEMO_ACCOUNT_LABEL_EMAIL') ?>
								<input id="reg-email" name="email" type="email" class="input" title="Enter valid email" required>
							</label>
						</div>
						<div class="col-12">
							<label class="label"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_DEMO_ACCOUNT_LABEL_TELEPHONE') ?>
								<input id="reg-phone" name="phone" type="tel" class="input" required>
							</label>
						</div>
						
						<div class="col-12 col-md-6">
							<label class="label"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_DEMO_ACCOUNT_LABEL_LEVERAGE') ?>
								<div class="select-block_initialization select-block_initialization__col-row">
									<select id="leverage" name="leverage" >
										<option value="1">1:1</option>
										<option value="50">1:50</option>
										<option value="100">1:100</option>
										<option value="200">1:200</option>
										<option value="500">1:500</option>
									</select>
									<div class="select-block_btn"><span>1:1</span></div>
								</div>
							</label>
						</div>
						<div class="col-12 col-md-6">
							<label class="label"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_DEMO_ACCOUNT_LABEL_BALANCE') ?>
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
								<input name="referrer_url" type="text" value="<?= htmlspecialchars($_COOKIE['referrer']) ?>">
								<input name="ib_id" type="text" value="<?= htmlspecialchars($_COOKIE['1825b7fc00c894def505222b814a4f7c']) ?>">
								<input name="manager_id" type="text" value="<?= htmlspecialchars($_COOKIE['0efa14672a91fa0768d9f7e3d4330593']) ?>">
						</div>
						<div class="col-12 mt-2">
							<label class="checkbox-custom__wrapper">
								<input id="agree" type="checkbox" class="checkbox-custom" required checked>
								<span class="checkbox-custom__box"></span>
								<span><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_DEMO_ACCOUNT_LABEL_CHECKBOX_AGREE') ?></span>
							</label>
						</div>
						<div class="col-12 text-center mt-4">
							<button type="submit" class="btn">
								<?= JText::_('TPL_CUSTOM_MOD_CUSTOM_DEMO_ACCOUNT_SUBMIT_BUTTON') ?>
							</button>
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

<div class="text-color"></div>

<!-- <div class="item-page<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Article">
	<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />
</div> -->
<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "Article",
		"name": "<?= $this->item->title ?>",
		"headline": "<?= $this->item->title ?>",
		"datePublished": "<?= $this->item->created ?> ",
		"dateModified": "<?= $this->item->modified ?> ",
		"mainEntityOfPage": "https://honorfx.com",
		"url": "https://honorfx.com",
		"image": "http://schema.org/ImageObject",
		
		"author": {
			"@type": "Person",
			"givenName": "<?= $this->item->author ?>",
			"familyName": "<?= $this->item->author ?>",
			"name": "<?= $this->item->author ?>"
		},

		"publisher": {
			"@type": "Organization",
			"name": "<?= $this->item->author ?>",
			"logo": {
				"@type": "ImageObject",
				"url": "https://honorfx.com/img/layout/honorfx_logo.png"
			}
		}
	}
</script>