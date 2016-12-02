<div class="col-sm-5 hidden-xs">
    <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/mascota.png"/>
</div>
<div class="col-sm-7 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
    	    <h4><?php echo Yii::t('base', 'forgot');?></h4>
		</div>
    	<?php
    	$form = $this->beginWidget('CActiveForm', array(
    		'id' => 'help-form',
    	)); ?>
    	<div class="panel-body">

    	    <div class="form-group">
    	        <div class="control-group col-sm-12">
            		<?php echo CHtml::textField('username', null, array('id' => 'username', 'class' => 'form-control input-sm', 'placeholder' => Yii::t('base', 'username'), 'maxlength' => 30));?>
        		</div>
            </div>

    	</div>


        <div class="panel-footer">
    	    <?php echo CHtml::submitButton(Yii::t('base', 'send password'), array('class' => 'btn btn-info btn-block'));?>
    	</div>

    	<?php $this->endWidget(); ?>
    </div>

</div>
