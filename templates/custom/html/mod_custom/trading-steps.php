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
		<div class="h2"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_PLATFORM_STEP_TITLE') ?> <span class="accent-color"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_PLATFORM_STEP_TITLE_ACCENT') ?></span></div>
		
		<div class="">
			<div class="row">
				<div class="offset-0 offset-lg-1 col-ld-10">
					<div class="platform_platrading-step">
						<div class="platform_platrading-step_item wow fadeInUp" data-wow-duration="1s">
							<img class="platform_platrading-step__img" src="/images/platform/step-1.svg" alt="Start Trading">
							<div class="platform_platrading-step_item_body">
								<div class="platform_platrading-step_item__title"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_PLATFORM_STEP_ONE_TITLE') ?></div>
								<div class="platform_platrading-step_item__text"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_PLATFORM_STEP_ONE_TEXT') ?></div>
							</div>
						</div>
						<div class="platform_platrading-step_item wow fadeInUp" data-wow-duration="1s">
							<img class="platform_platrading-step__img" src="/images/platform/step-2.svg" alt="Start Trading">
							<div class="platform_platrading-step_item_body">
								<div class="platform_platrading-step_item__title"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_PLATFORM_STEP_TWO_TITLE') ?></div>
								<div class="platform_platrading-step_item__text"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_PLATFORM_STEP_TWO_TEXT') ?></div>
							</div>
						</div>
						<div class="platform_platrading-step_item wow fadeInUp" data-wow-duration="1s">
							<img class="platform_platrading-step__img" src="/images/platform/step-3.svg" alt="Start Trading">
							<div class="platform_platrading-step_item_body">
								<div class="platform_platrading-step_item__title"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_PLATFORM_STEP_THREE_TITLE') ?></div>
								<div class="platform_platrading-step_item__text"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_PLATFORM_STEP_THREE_TEXT') ?></div>
							</div>
						</div>
						<div class="platform_platrading-step_item wow fadeInUp" data-wow-duration="1s">
							<img class="platform_platrading-step__img" src="/images/platform/step-4.svg" alt="Start Trading">
							<div class="platform_platrading-step_item_body">
								<div class="platform_platrading-step_item__title"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_PLATFORM_STEP_FOUR_TITLE') ?></div>
								<div class="platform_platrading-step_item__text"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_PLATFORM_STEP_FOUR_TEXT') ?></div>
							</div>
						</div>
					</div>
					<div class="mt-4">
						<a href="<?= $linkRegister ?>" class="btn"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_LIVE_BTN') ?></a>
						<a href="/demo" class="btn btn_transparent-accent"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_DEMO_BTN') ?></a>   
					</div>
				</div>
			</div>
		</div>
	</div>
</div>