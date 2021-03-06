<?php // no direct access
/*

# ------------------------------------------------------------------------
# JA Uvite template for Joomla 1.5
# ------------------------------------------------------------------------
# Copyright (C) 2004-2010 JoomlArt.com. All Rights Reserved.
# @license - PHP files are GNU/GPL V2. CSS / JS are Copyrighted Commercial,
# bound by Proprietary License of JoomlArt. For details on licensing, 
# Please Read Terms of Use at http://www.joomlart.com/terms_of_use.html.
# Author: JoomlArt.com
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# Redistribution, Modification or Re-licensing of this file in part of full, 
# is bound by the License applied. 
# ------------------------------------------------------------------------

*/
defined('_JEXEC') or die('Restricted access');
$cparams =& JComponentHelper::getParams('com_media');
 ?>
<!-- <?php if ($this->params->get('show_page_title')) : ?>
<h1 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx'));?>">
	<?php echo $this->escape($this->params->get('page_title')); ?>
</h1>
<?php endif; ?> -->
<?php if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) :?>
	<?php if ($this->params->get('show_description_image') && $this->category->image) : ?>
		<img src="<?php echo $this->baseurl . '/' . $cparams->get('image_path') . '/'. $this->category->image;?>" align="<?php echo $this->category->image_position;?>" hspace="6" alt="" />
	<?php endif; ?>
	<?php if ($this->params->get('show_description') && $this->category->description) : ?>
		<?php echo $this->category->description; ?>
	<?php endif; ?>
<?php endif; ?>
<?php if ($this->params->get('num_leading_articles')) : ?>
	<?php for ($i = $this->pagination->limitstart; $i < ($this->pagination->limitstart + $this->params->get('num_leading_articles')); $i++) : ?>
		<?php if ($i >= $this->total) : break; endif; ?>
		<?php
			$this->item =& $this->getItem($i, $this->params);
			echo $this->loadTemplate('item');
		?>
	<?php endfor; ?>
<?php else : $i = $this->pagination->limitstart; endif; ?>

<?php
$startIntroArticles = $this->pagination->limitstart + $this->params->get('num_leading_articles');
$numIntroArticles = $startIntroArticles + $this->params->get('num_intro_articles');
if (($numIntroArticles != $startIntroArticles) && ($i < $this->total)) : ?>
<div>
	<table width="100%"  cellpadding="0" cellspacing="0">
		<tr>
		<?php
			$divider = '';
			for ($z = 0; $z < $this->params->get('num_columns'); $z ++) :
				if ($z > 0) : $divider = " column_separator"; endif; ?>
				<td valign="top" width="<?php echo intval(100 / $this->params->get('num_columns')) ?>%" class="article_column<?php echo $divider ?>">
				<?php for ($y = 0; $y < ($this->params->get('num_intro_articles') / $this->params->get('num_columns')); $y ++) :
					if ($i < $this->total && $i < ($numIntroArticles)) :
						$this->item =& $this->getItem($i, $this->params);
						echo $this->loadTemplate('item');
						$i ++;
					endif;
				endfor; ?>
				</td>
		<?php endfor; ?>
		</tr>
		</table>
</div>
<?php endif; ?>
<?php if ($this->params->get('num_links') && ($i < $this->total)) : ?>
<div>
		<div class="blog_more<?php echo $this->escape($this->params->get('pageclass_sfx')) ?>">
			<?php
				$this->links = array_splice($this->items, $i - $this->pagination->limitstart);
				echo $this->loadTemplate('links');
			?>
		</div>
</div>
<?php endif; ?>
<?php if ($this->params->get('show_pagination')) : ?>
<div>
		<?php echo $this->pagination->getPagesLinks(); ?>
</div>
<?php endif; ?>
<?php if ($this->params->get('show_pagination_results')) : ?>
<div>
		<?php echo $this->pagination->getPagesCounter(); ?>
</div>
<?php endif; ?>
