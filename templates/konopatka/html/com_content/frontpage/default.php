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
defined('_JEXEC') or die('Restricted access'); ?>
<?php if ($this->params->get('show_page_title')) : ?>
	<?php echo $this->escape($this->params->get('page_title')); ?>
<?php if (isset($this->frontpage->description)) : ?>
	<?php if ($this->params->get('show_description_image') && $this->frontpage->description->image) : ?>
		<img src="<?php echo $this->escape($this->frontpage->description->link) ?>" align="<?php echo $this->escape($this->frontpage->description->image_position); ?>" hspace="6" alt="" />
	<?php endif; ?>
	<?php if ($this->params->get('show_description') && $this->frontpage->description->text) : ?>
		<?php echo $this->frontpage->description->text; ?>
	<?php endif; ?>
<?php endif; ?>
<?php if ($this->params->def('num_leading_articles', 1)) : ?>
	<?php for ($i = $this->pagination->limitstart; $i < $this->params->get('num_leading_articles'); $i++) : ?>
		<?php if ($i >= $this->total) : break; endif; ?>
		<div>
		<?php
			$this->item =& $this->getItem($i, $this->params);
			echo $this->loadTemplate('item');
		?>
		</div>
	<?php endfor; ?>
<?php else : $i = $this->pagination->limitstart; endif; ?>

<?php
$numIntroArticles = $this->total - $this->params->get('num_leading_articles', 4); 
$numIntroArticles = $numIntroArticles < $this->params->get('num_intro_articles', 4) ? $numIntroArticles : $this->params->get('num_intro_articles', 4);
if ($numIntroArticles && ($i < $this->total)) : ?>
<tr>
	<td valign="top">
		<table width="100%"  cellpadding="0" cellspacing="0">
		<tr>
		<?php
			$divider = '';
			for ($z = 0; $z < $this->params->def('num_columns', 2); $z ++) :
				if ($z > 0) : $divider = " column_separator"; endif; ?>
				<td valign="top" width="<?php echo intval(100 / $this->params->get('num_columns')) ?>%" class="article_column<?php echo $divider ?>">
				<?php for ($y = 0; $y < $numIntroArticles / $this->params->get('num_columns'); $y ++) :
					if ($i < $this->total) :
						$this->item =& $this->getItem($i, $this->params);
						echo $this->loadTemplate('item');
						$i ++;
					endif;
				endfor; ?>
				</td>
		<?php endfor; ?>
		</tr>
		</table>
	</td>
</tr>
<?php endif; ?>
<?php if ($this->params->def('num_links', 4) && ($i < $this->total)) : ?>
<tr>
	<td valign="top">
		<div class="blog_more<?php echo $this->escape($this->params->get('pageclass_sfx')) ?>">
			<?php
				$this->links = array_splice($this->items, $i);
				echo $this->loadTemplate('links');
			?>
		</div>
	</td>
</tr>
<?php endif; ?>

<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) : ?>
<tr>
	<td valign="top" align="center">
		<?php echo $this->pagination->getPagesLinks(); ?>
	</td>
</tr>
<?php if ($this->params->def('show_pagination_results', 1)) : ?>
<tr>
	<td valign="top" align="center">
		<?php echo $this->pagination->getPagesCounter(); ?>
	</td>
</tr>
<?php endif; ?>
<?php endif; ?>
</table>
