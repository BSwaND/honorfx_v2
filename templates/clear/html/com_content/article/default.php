<?php
	/**
	 * @package     Joomla.Site
	 * @subpackage  com_content
	 *
	 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
	 * @license     GNU General Public License version 2 or later; see LICENSE.txt
	 */
	defined('_JEXEC') or die;
?> 

<?php include_once(JPATH_BASE .'/templates/clear/html/com_content/article/_header.php');  ?>
<div class="<?php echo $this->pageclass_sfx; ?>" >
	<?= $this->item->event->afterDisplayTitle ?>
	<?= $this->item->event->beforeDisplayContent ?>
	<?= $this->item->text ?>
	<?= $this->item->event->afterDisplayContent ?>
</div>

<?php 
	/*$module = JModuleHelper::getModules('test'); 
	echo JModuleHelper::renderModule($module[0], $attribs);*/
?>

