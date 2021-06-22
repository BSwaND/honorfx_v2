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
<?php include_once(JPATH_BASE .'/templates/custom/html/com_content/article/_header.php');  ?>
<div class="item-page<?php echo $this->pageclass_sfx; ?>" >
	<?= $this->item->event->afterDisplayTitle ?>
	<?= $this->item->event->beforeDisplayContent ?>
	<?= $this->item->text ?>
	<?= $this->item->event->afterDisplayContent ?>
</div>

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