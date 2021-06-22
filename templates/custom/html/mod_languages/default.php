<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_languages
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('stylesheet', 'mod_languages/template.css', array('version' => 'auto', 'relative' => true));

if ($params->get('dropdown', 0) && !$params->get('dropdownimage', 1))
{
	JHtml::_('formbehavior.chosen');
}

?>

<div class="lang_block <?php echo $moduleclass_sfx; ?>">
	<?php foreach ($list as $language) { ?>
		<?php if($language->active){ ?>
			<div class="lang_active"><?php echo JHtml::_('image', 'mod_languages/' . $language->image . '.gif', '', null, true); ?><?= $language->title_native ?> <span class="arrow-tr"></span></div>
		<?php } ?>
	<?php } ?>
	
	<ul class="lang_dropdown">
	<?php foreach ($list as $language) { ?>
			<?php if(!$language->active) { ?>

					<li><a href="<?= $language->link ?>"><?php echo JHtml::_('image', 'mod_languages/' . $language->image . '.gif', '', null, true); ?><?= $language->title_native ?></a></li>
			
			<?php }?>
	<?php } ?>
	</ul>
</div>