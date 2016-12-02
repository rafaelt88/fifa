<div class="col-sm-5 hidden-xs">
    <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/mascota.png" style="margin-top: 80px;"/>
</div>
<div class="col-sm-7 col-xs-12">
    <div class="panel panel-default">
    	<div class="panel-heading">
    	<h4><?php echo Yii::t('base', 'contact');?></h4>
    	</div>
    	<?php $form = $this->beginWidget('CActiveForm', array(
    		'id' => 'contact-form',
    	)); ?>
    	<div class="panel-body">
        	<div class="form-group">
        	<?php echo $form->label($model, 'name', array('class' => 'col-sm-4 col-xs-12 control-label')); ?>
        		<div class="control-group col-sm-8">
        			<?php echo $form->textField($model, 'name', array('class' => 'form-control input-sm', 'placeholder' => Yii::t('base', 'name'))); ?>
        			<?php echo $form->error($model, 'name'); ?>
        		</div>
        	</div>

        	<div class="form-group">
        	<?php echo $form->label($model, 'email', array('class' => 'col-sm-4 col-xs-12 control-label')); ?>
        		<div class="control-group col-sm-8">
        			<?php echo $form->textField($model, 'email', array('class' => 'form-control input-sm', 'placeholder' => Yii::t('base', 'example@email.com'))); ?>
        			<?php echo $form->error($model, 'email'); ?>
        		</div>
        	</div>

        	<div class="form-group">
        	<?php echo $form->label($model, 'subject', array('class' => 'col-sm-4 col-xs-12 control-label')); ?>
        		<div class="control-group col-sm-8">
        			<?php echo $form->textField($model, 'subject', array('class' => 'form-control input-sm', 'placeholder' => Yii::t('base', 'subject'))); ?>
        			<?php echo $form->error($model, 'subject'); ?>
        		</div>
        	</div>

        	<div class="form-group">
        	<?php echo $form->label($model, 'body', array('class' => 'col-sm-4 col-xs-12 control-label')); ?>
        		<div class="control-group col-sm-8">
        			<?php echo $form->textArea($model, 'body', array('class' => 'form-control input-sm', 'rows' => '4','style' => 'resize: none', 'placeholder' => Yii::t('base', 'body'))); ?>
        			<?php echo $form->error($model, 'body'); ?>
        		</div>
        	</div>

        	<?php if(CCaptcha::checkRequirements()): ?>

        	<div class="form-group">
        		<div class="col-sm-4 control-label">
        		<?php $this->widget('CCaptcha', array(
        		    'clickableImage' => true,
        		    'showRefreshButton' => false
        		)); ?>
        		</div>
        		<div class="control-group col-sm-8">
        		    <?php echo CHtml::tag('small', array(), Yii::t('base', 'captcha'));?>
        			<?php echo $form->textField($model, 'captcha', array('class' => 'form-control input-sm', 'placeholder' => Yii::t('base', 'captcha'))); ?>
        			<?php echo $form->error($model, 'captcha'); ?>
        		</div>
        	</div>

        	<?php endif; ?>
    	</div>
        <div class="panel-footer">
    	    <?php echo CHtml::linkButton(Yii::t('base', 'send contact'), array('class' => 'btn btn-info btn-block'));?>
        </div>
    	<?php $this->endWidget(); ?>
    </div>
</div>