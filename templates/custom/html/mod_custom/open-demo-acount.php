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
			<h2 class="h2"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_TITLE') ?> <br /><span class="accent-color"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_TITLE_ACCENT') ?></span></h2>
			<div class="section_descript"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_SUB_TITLE') ?></div>
			<div class="about_open-account_wrapper-card wow fadeInUp" data-wow-duration="2s">
				<div class="row">
					<div class="col-md-4">
						<div class="about_open-account_card">
							<div class="about_open-account_card__title"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_NEW') ?></div>
							<ul class="ul_custom">
								<li class="ul_custom__li"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_NEW_LI_1') ?></li>
								<li class="ul_custom__li"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_NEW_LI_2') ?></li>
								<li class="ul_custom__li"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_NEW_LI_3') ?></li>
								<li class="ul_custom__li"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_NEW_LI_4') ?></li>
								<li class="ul_custom__li"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_NEW_LI_5') ?></li>
							</ul>
							<div class="about_open-account_card_footer">
								<a class="btn btn_card" href="index.php?option=com_content&view=article&id=8">
									<?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_DEMO_BTN') ?>
								</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="about_open-account_card">
							<div class="about_open-account_card__title"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_EXPERIENCED') ?></div>
							<ul class="ul_custom">
								<li class="ul_custom__li"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_EXPERIENCED_LI_1') ?></li>
								<li class="ul_custom__li"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_EXPERIENCED_LI_2') ?></li>
								<li class="ul_custom__li"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_EXPERIENCED_LI_3') ?></li>
								<li class="ul_custom__li"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_EXPERIENCED_LI_4') ?></li>
								<li class="ul_custom__li"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_EXPERIENCED_LI_5') ?></li>
							</ul>
							<div class="about_open-account_card_footer"><a class="btn btn_card" href="<?= $linkRegister ?>"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_LIVE_BTN') ?></a></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="about_open-account_card">
							<div class="about_open-account_card__title"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_INTRODUCING') ?></div>
							<ul class="ul_custom">
								<li class="ul_custom__li"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_INTRODUCING_LI_1') ?></li>
								<li class="ul_custom__li"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_INTRODUCING_LI_2') ?></li>
								<li class="ul_custom__li"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_INTRODUCING_LI_3') ?></li>
								<li class="ul_custom__li"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_INTRODUCING_LI_4') ?></li>
								<li class="ul_custom__li"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_FOR_INTRODUCING_LI_5') ?></li>
							</ul>
							<div class="about_open-account_card_footer"><a class="btn btn_card" href="<?= $linkRegister ?>"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_OPEN_ACCOUNT_LIVE_BTN') ?></a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>