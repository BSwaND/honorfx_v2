<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<div class="pop-up__overflow">
  <div class="pop-up__container">
    <button type="button" class="pop-up__close"></button>
    <div class="pop-up__content">
		<h1 class="pop-up__title"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_ACCOUNT_TYPES_POP_UP_TITLE') ?></span></h1>
      	<p class="pop-up__text"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_ACCOUNT_TYPES_POP_UP_TEXT') ?>
        <span class="accent-color"><?= JText::_('TPL_CUSTOM_MOD_CUSTOM_ACCOUNT_TYPES_POP_UP_TEXT_ACCENT') ?></span>
      </p>
	    <a class="btn header__btn" href="https://my.honorfx.com/<?= JText::_('TPL_CUSTOM_MOD_CUSTOM_LANGUAGE_TAG') ?>/signup">
        <span class="btn__inner">
          <?= JText::_('TPL_CUSTOM_MOD_CUSTOM_ACCOUNT_TYPES_POP_UP_BUTTON') ?>
        </span></a>
    </div>
  </div>
</div>