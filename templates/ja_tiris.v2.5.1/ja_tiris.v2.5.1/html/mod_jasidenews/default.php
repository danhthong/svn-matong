<?php
/**
 * ------------------------------------------------------------------------
 * JA Tiris Template for Joomla 2.5
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - Copyrighted Commercial Software
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites:  http://www.joomlart.com -  http://www.joomlancers.com
 * This file may not be redistributed in whole or significant part.
 * ------------------------------------------------------------------------
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="ja-sidenews-list clearfix">
  <?php foreach( $list as $item ) :

		if( $showdate) {
			$item->date =  strtotime ( $item->modified ) ? $item->created : $item->modified;
		}
		if(isset($item->text)){
			$item->text = $item->introtext . $item->text;
		}else{
			$item->text = $item->introtext;
		}

	?>
  <div class="ja-slidenews-item"> <a class="ja-title" href="<?php echo  $item->link; ?>"><?php echo  $helper->trimString( $item->title, $titleMaxChars );?></a>
    <?php if( $showimage ):  ?>
    <?php echo $helper->renderImage ($item, $params, $descMaxChars, $iwidth, $iheight ); ?>
    <?php endif; ?>
    
    <?php if ($descMaxChars!=0) : ?>
    <?php echo $helper->trimString( strip_tags($item->introtext), $descMaxChars); ?>
    <?php endif;?>
    <?php if (isset($item->date)) : ?><br />
    <span class="ja-createdate"><?php echo JHTML::_('date', $item->date, JText::_('DATE_FORMAT_LC3')); ?> </span>
    <?php endif; ?>
    <?php if( $showMoredetail ) : ?>
    <br /><a class="readon" href="<?php echo  $item->link; ?>"> <?php echo JTEXT::_("MORE_DETAIL"); ?></a>
    <?php endif;?>
  </div>
  <?php endforeach; ?>
</div>
