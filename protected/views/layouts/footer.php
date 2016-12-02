<?php $footer = array();
$footer['contact'] = Yii::app()->createAbsoluteUrl('site/contact');
$footer['rules'] = Yii::app()->createAbsoluteUrl('site/rules');
$footer['faqs'] =  Yii::app()->createAbsoluteUrl('site/faqs');
?>

<div class="col-sm-12 hidden-xs">
    <hr>
    <ul class="nav nav-pills nav-justified">
    	<?php foreach ($footer as $label => $url):?>
    	<li><?php echo CHtml::link(Yii::t('base', $label), $url);?></li>
    	<?php endforeach;?>
    	<li>
    		<ul class="list-inline text-right">
    			<li><?php echo CHtml::link('<span class="fa fa-facebook fa-2x"></span>', Yii::app()->params->facebook['url'], array('target' => '_blank', 'title' => Yii::app()->params->facebook['user'])); ?>
    			</li>
    			<li><?php echo CHtml::link('<span class="fa fa-arrow-circle-up fa-2x"></span>', '#', array('title' => Yii::t('base', 'back to top'))); ?>
    			</li>
    		</ul>
    	</li>
    </ul>
</div>

<div class="col-sm-12 visible-xs" style="padding: 0px; margin-left: -10px; margin-right: -10px;">
    <ul class="nav nav-pills nav-justified">
    	<?php foreach ($footer as $label => $url):?>
    	<li><?php echo CHtml::link(Yii::t('base', $label), $url);?></li>
    	<?php endforeach;?>
    </ul>
</div>