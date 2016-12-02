<?php $this->widget('application.widgets.access.Access'); ?>
<div class="panel panel-default">
	<div class="panel-heading">
	<?php echo CHtml::tag('h4', array(), Yii::t('base', 'change password'));?>
	</div>
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'password-form',
	)); ?>
	<div class="panel-body">

    	<div class="form-group">
    	<?php echo $form->labelEx($model, 'password', array('class' => 'col-sm-4 col-xs-12 control-label')); ?>
    		<div class="control-group col-sm-8">
    			<?php echo $form->passwordField($model, 'password', array('class' => 'form-control input-sm', 'placeholder' => Yii::t('base', 'password'), 'maxlength' => 32)); ?>
    			<?php echo $form->error($model, 'password'); ?>
    		</div>
    	</div>

    	<div class="form-group">
    	<?php echo $form->labelEx($model, 'conf_password', array('class' => 'col-sm-4 col-xs-12 control-label')); ?>
    		<div class="control-group col-sm-8">
    			<?php echo $form->passwordField($model, 'conf_password', array('class' => 'form-control input-sm', 'placeholder' => Yii::t('base', 'conf_password'), 'maxlength' => 32)); ?>
    			<?php echo $form->error($model, 'conf_password'); ?>
    		</div>
    	</div>

    </div>

    <div class="panel-footer">
	    <?php echo CHtml::submitButton(Yii::t('base', 'save password'), array('class' => 'btn btn-info btn-block', 'id' => 'submit'));?>
	</div>

	<?php $this->endWidget(); ?>
</div>