<?php
/**
 * @version		$Id: tag.php 785 2011-04-28 12:39:17Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2011 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<!-- Start K2 Generic Layout -->
<div id="k2Container" class="genericView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

	<?php if($this->params->get('show_page_title')): ?>
	<!-- Page title -->
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php endif; ?>

	<?php if($this->params->get('userFeed')): ?>
	<!-- RSS feed icon -->
	<div class="k2FeedIcon">
		<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<?php if(count($this->items)): ?>
	<div class="genericItemList">
		<?php foreach($this->items as $item): ?>

		<!-- Start K2 Item Layout -->
		<div class="genericItemView">

			<div class="genericItemHeader">			
			  <?php if($item->params->get('genericItemTitle')): ?>
			  <!-- Item title -->
			  <h2 class="genericItemTitle">
			  	<?php if ($item->params->get('genericItemTitleLinked')): ?>
					<a href="<?php echo $item->link; ?>">
			  		<?php echo $item->title; ?>
			  	</a>
			  	<?php else: ?>
			  	<?php echo $item->title; ?>
			  	<?php endif; ?>
			  </h2>
			  <?php endif; ?>
		  </div>
		  <div class="catItemMeta clearfix">
		  		<?php if($item->params->get('genericItemDateCreated')): ?>
				<!-- Date created -->
				<span class="genericItemDateCreated">
					<span class="italic"><?php echo JText::_('Post'); ?></span>
					<?php echo JHTML::_('date', $item->created , JText::_('DATE_FORMAT_LC3')); ?>
				</span>
				<?php endif; ?>
				<?php if($item->params->get('genericItemCategory')): ?>
			<!-- Item category name -->
			<span class="genericItemCategory">
				<span class="italic"><?php echo JText::_('In'); ?></span>
				<a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a>
			</span>
			<?php endif; ?>
		  </div>
		  <div class="genericItemBody">
			  <?php if($item->params->get('genericItemImage') && !empty($item->imageGeneric)): ?>
			  <!-- Item Image -->
			  <div class="genericItemImageBlock">
				  <span class="genericItemImage">
				    <a href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo $item->image_caption; else echo $item->title; ?>">
				    	<img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo $item->image_caption; else echo $item->title; ?>" style="width:<?php echo $item->params->get('itemImageGeneric'); ?>px; height:auto;" />
				    </a>
				  </span>
			  </div>
			  <?php endif; ?>
			  
			  <?php if($item->params->get('genericItemIntroText')): ?>
			  <!-- Item introtext -->
			  <div class="genericItemIntroText">
			  	<?php echo $item->introtext; ?>
			  </div>
			  <?php endif; ?>

		  </div>
		  
		  <?php if($item->params->get('genericItemExtraFields') && count($item->extra_fields)): ?>
		  <!-- Item extra fields -->  
		  <div class="genericItemExtraFields">
		  	<h4><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h4>
		  	<ul>
				<?php foreach ($item->extra_fields as $key=>$extraField): ?>
				<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
					<span class="genericItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
					<span class="genericItemExtraFieldsValue"><?php echo ($extraField->type=='date')?JHTML::_('date', $extraField->value, JText::_('K2_DATE_FORMAT_LC')):$extraField->value; ?></span>		
				</li>
				<?php endforeach; ?>
				</ul>
		  </div>
		  <?php endif; ?>
		  <?php if ($item->params->get('genericItemReadMore')): ?>
			<!-- Item "read more..." link -->
			<div class="genericItemReadMore">
				<a class="k2ReadMore" href="<?php echo $item->link; ?>">
					<?php echo JText::_('Read more'); ?>
				</a>
			</div>
			<?php endif; ?>

			<div class="clr"></div>
		</div>
		<!-- End K2 Item Layout -->
		
		<?php endforeach; ?>
	</div>

	<!-- Pagination -->
	<?php if($this->pagination->getPagesLinks()): ?>
	<div class="k2Pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
		<p class="counter"><?php echo $this->pagination->getPagesCounter(); ?></p>
	</div>
	<?php endif; ?>

	<?php endif; ?>
	
</div>
<!-- End K2 Generic Layout -->
