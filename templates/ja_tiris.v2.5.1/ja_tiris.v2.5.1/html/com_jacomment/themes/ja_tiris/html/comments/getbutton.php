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
defined( '_JEXEC' ) or die( 'Restricted access' );
    
require_once (JPATH_SITE.DS.'components'.DS.'com_jacomment'.DS.'models'.DS.'comments.php');
require_once (JPATH_SITE.DS.'components'.DS.'com_jacomment'.DS.'helpers'.DS.'jahelper.php');
$model = new JACommentModelComments(); 
$helper = new JACommentHelpers ( );
$app = JFactory::getApplication();
//add style of template for component					
JHTML::stylesheet('style.css', 'components/com_jacomment/themes/'.$theme.'/css/');
if(file_exists(JPATH_BASE.DS.'templates'.DS.$app->getTemplate().DS.'html'.DS."com_jacomment".DS."themes".DS. $theme .DS."css".DS."style.css")){		
	JHTML::stylesheet('style.css', 'templates/'.$app->getTemplate().'/html/com_jacomment/themes/'.$theme.'/css/');	 
}
$lang =& JFactory::getLanguage();											
if ( $lang->isRTL() ) {
	if(file_exists(JPATH_BASE.DS.'components/com_jacomment/themes/'.$theme.'/css/style_rtl.css')){
		JHTML::stylesheet('style_rtl.css', 'components/com_jacomment/themes/'.$theme.'/css/');
	}
	if(file_exists(JPATH_BASE.DS.'templates'.DS.$app->getTemplate().DS.'html'.DS."com_jacomment".DS."themes".DS. $theme .DS."css".DS."style_rtl.css")){		
		JHTML::stylesheet('style_rtl.css', 'templates/'.$app->getTemplate().'/html/com_jacomment/themes/'.$theme.'/css/');	 
	}
}

$display_comment_link 	= $plgParams->get('display_comment_link',1);
$display_comment_count 	= $plgParams->get('display_comment_count',1);

//display normal addbutton and count in com_content
if(!isset($typeDisplay)){
	if($display_comment_count){
		$search  = '';
		$search .= ' AND c.option="'.$option.'"';
		$search .= ' AND c.contentid='.$id.'';
		//get all Item is approved
		if(!$helper->isSpecialUser()){	
			$search .= ' AND type=1';
		}
		$totalType 				= $model->getTotalByType($search);
		 
		if($totalType)       
			$totalAll         		= (int)array_sum($totalType);
		else 
			$totalAll         		= 0;
	}
?>
	<?php if($display_comment_link){?>	
		<div class="jac-add-button"><a class="jac-links" href="<?php echo $links."#ja-contentwrap"; ?>" title="<?php echo JText::_('ADD_COMMENT'); ?>"><?php echo JText::_('ADD_COMMENT'); ?></a>
		<?php if(!$display_comment_count){?>		
			</div>
		<?php }?>					
	<?php }?>
	
	<?php if($display_comment_count){?>
		<?php if(!$display_comment_link){?>
		<div class="jac-add-button">
		<?php }?>		
		<span class="jac-count-comment"><?php echo '('.$totalAll.')';?></span></div>
	<?php }?>	
<?php		
}
//only display addbutton or count for system template
else{
?>
<?php //display add comment button ?>	
<?php if($typeDisplay == "onlyButton" && $display_comment_link):?>	
	<a class="jac_links jac-links<?php echo $id;?>" href=<?php echo $links."#ja-contentwrap"; ?> title="<?php echo JText::_('ADD_COMMENT'); ?>"><?php echo JText::_('ADD_COMMENT'); ?></a>	
<?php endif; ?>
<?php //display count button?>
<?php if($typeDisplay == "onlyCount" && $display_comment_count):
		$search  = '';
		$search .= ' AND c.option="'.$option.'"';
		$search .= ' AND c.contentid='.$id.'';				
		//get all Item is approved
		if(!$helper->isSpecialUser()){$search .= ' AND type=1';}
		$totalType = $model->getTotalByType($search);	 
		if($totalType){$totalAll = (int)array_sum($totalType);
		}else{ $totalAll = 0;}		
?>	
	<span class="jac-links<?php echo $id;?>">(<?php echo $totalAll ?>)</span>
<?php endif;?>
<?php }?>