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

<div class="section platform_step_section">
	<div class="container">
		<div class="h2">Start Trading in <span class="accent-color">4 steps</span></div>
		
		<div class="">
			<div class="row">
				<div class="offset-0 offset-lg-1 col-ld-10">
					<div class="platform_platrading-step">
						<div class="platform_platrading-step_item wow fadeInUp" data-wow-duration="1s">
							<img class="platform_platrading-step__img" src="/images/platform/step-1.svg" alt="Start Trading">
							<div class="platform_platrading-step_item_body">
								<div class="platform_platrading-step_item__title">Register</div>
								<div class="platform_platrading-step_item__text">Open your live trading account with HonorFX</div>
							</div>
						</div>
						<div class="platform_platrading-step_item wow fadeInUp" data-wow-duration="1s">
							<img class="platform_platrading-step__img" src="/images/platform/step-2.svg" alt="Start Trading">
							<div class="platform_platrading-step_item_body">
								<div class="platform_platrading-step_item__title">Verify</div>
								<div class="platform_platrading-step_item__text">Upload your documents to verify your account</div>
							</div>
						</div>
						<div class="platform_platrading-step_item wow fadeInUp" data-wow-duration="1s">
							<img class="platform_platrading-step__img" src="/images/platform/step-3.svg" alt="Start Trading">
							<div class="platform_platrading-step_item_body">
								<div class="platform_platrading-step_item__title">Fund</div>
								<div class="platform_platrading-step_item__text">Login to your Client Portal and Fund your account</div>
							</div>
						</div>
						<div class="platform_platrading-step_item wow fadeInUp" data-wow-duration="1s">
							<img class="platform_platrading-step__img" src="/images/platform/step-4.svg" alt="Start Trading">
							<div class="platform_platrading-step_item_body">
								<div class="platform_platrading-step_item__title">Trade</div>
								<div class="platform_platrading-step_item__text">Start trading on more than 165 instruments</div>
							</div>
						</div>
					</div>
					<div class="mt-4">
						<a href="<?= $linkRegister ?>" class="btn">Open Live Account</a>
						<a href="<?= $linkRegister ?>" class="btn btn_transparent-accent">Open Demo Account</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>