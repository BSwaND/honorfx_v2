<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

	
	$linkRegisterModule = JModuleHelper::getModuleById('94');
	$linkRegister = JModuleHelper::renderModule($linkRegisterModule);

	
?>
	
	
	<div class="section about_open-account">
		<div class="container">
			<h2 class="h2">Open Live Acount or <br /><span class="accent-color">Demo Acount</span></h2>
			<div class="section_descript">Unlock your trading potential</div>
			<div class="about_open-account_wrapper-card">
				<div class="row">
					<div class="col-md-4">
						<div class="about_open-account_card">
							<div class="about_open-account_card__title">FOR NEW TRADERS</div>
							<ul class="ul_custom">
								<li class="ul_custom__li">Start Trading with Micro lots</li>
								<li class="ul_custom__li">Discover MT4/MT5 Platform</li>
								<li class="ul_custom__li">No minimum deposit</li>
								<li class="ul_custom__li">Use leverage upto 1:500</li>
								<li class="ul_custom__li">Access Free Trading Education</li>
							</ul>
							<div class="about_open-account_card_footer"><a class="btn btn_card" href="<?= $linkRegister ?>">open Live Account</a></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="about_open-account_card">
							<div class="about_open-account_card__title">FOR EXPERIENCED TRADERS</div>
							<ul class="ul_custom">
								<li class="ul_custom__li">Advanced Trading Tools</li>
								<li class="ul_custom__li">Fast, Automated Execution</li>
								<li class="ul_custom__li">Tight Spreads</li>
								<li class="ul_custom__li">Tier 1 Liquidity</li>
								<li class="ul_custom__li">Expert News &amp; Analysis</li>
							</ul>
							<div class="about_open-account_card_footer"><a class="btn btn_card" href="<?= $linkRegister ?>">open Live Account</a></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="about_open-account_card">
							<div class="about_open-account_card__title">FOR INTRODUCING BROKERS</div>
							<ul class="ul_custom">
								<li class="ul_custom__li">Customized Rebate Scheme</li>
								<li class="ul_custom__li">Increase Your Income</li>
								<li class="ul_custom__li">Dedicated Partner Support</li>
								<li class="ul_custom__li">Expert Account Managers</li>
								<li class="ul_custom__li">Exclusive Promotional Material</li>
							</ul>
							<div class="about_open-account_card_footer"><a class="btn btn_card" href="<?= $linkRegister ?>">open Live Account</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>