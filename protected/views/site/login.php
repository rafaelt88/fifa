<div class="col-sm-5 hidden-xs">
    <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/mascota.png"/>
</div>
<div class="col-sm-7 col-xs-12">
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h4><?php echo Yii::t('base', 'login');?></h4>
    	</div>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
        ));
        ?>
        <div class="panel-body">
    		<div class="form-group">
    			<div class="control-group col-sm-12">
        		<?php echo $form->textField($model, 'username', array('class' => 'form-control input-sm', 'placeholder' => Yii::t('base', 'username'), 'maxlength' => 30));?>
        		<?php echo $form->error($model, 'username');?>
        		</div>
            </div>

    		<div class="form-group">
    		    <div class="control-group col-sm-12">
    		    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control input-sm', 'placeholder' => Yii::t('base', 'password'), 'maxlength' => 32));?>
    		    <?php echo $form->error($model, 'password');?>
    		    </div>
            </div>
    	</div>
    	<div class="panel-footer">
    	    <?php echo CHtml::submitButton(Yii::t('base', 'access'), array('class' => 'btn btn-info btn-block'));?>
    	</div>
    	<?php $this->endWidget('CActiveForm');?>
    </div>
    <?php echo CHtml::link(Yii::t('base', 'singup now'), Yii::app()->createAbsoluteUrl('site/singup'), array('class' => 'btn btn-xs btn-success pull-left'));?>
    <?php echo CHtml::link(Yii::t('base', 'forgot password'), Yii::app()->createAbsoluteUrl('site/forgot'), array('class' => 'btn btn-xs btn-danger pull-right'));?>
</div>