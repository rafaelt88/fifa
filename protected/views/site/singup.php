<div class="col-sm-5 hidden-xs">
    <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/mascota.png"/>
</div>
<div class="col-sm-7 col-xs-12">
    <div class="panel panel-default">
    	<div class="panel-heading">
    	<h4><?php echo Yii::t('base', 'singup now');?></h4>
    	</div>
    	<?php $form = $this->beginWidget('CActiveForm', array(
    		'id' => 'usuario-form',
    	)); ?>
    	<div class="panel-body">
    	
    	<div class="alert alert-info">
    	<p>Asegurate de ingresar tu correo correctamente.<br>
    	Recibirás una contraseña provisional que luego puedes cambiar.</p>
    	</div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cedula', array('class' => 'control-label col-sm-4 col-xs-12', 'for' => 'Usuario_cedula'));?>
        <div class="col-sm-8 col-xs-12">
        <?php $this->widget('CMaskedTextField', array(
            'model' => $model,
            'attribute' => 'cedula',
            'mask' => Yii::app()->params['pattern']['cedula']['MASK'],
            'charMap' => Yii::app()->params['pattern']['cedula']['CHARMAP'],
            'htmlOptions' => array('class' => 'form-control input-sm', 'placeholder' => Yii::app()->params['pattern']['cedula']['MASK']),
        )); ?>
        <?php echo $form->error($model, 'cedula', array('class' => 'text-danger'));?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'nombre', array('class' => 'control-label col-sm-4 col-xs-12', 'for' => 'Usuario_nombre'));?>
        <div class="col-sm-8 col-xs-12">
        <?php echo $form->textField($model, 'nombre', array('class' => 'form-control input-sm', 'placeholder' => Yii::t('models.Usuario', 'input.nombre'), 'maxlength' => 50));?>
        <?php echo $form->error($model, 'nombre', array('class' => 'text-danger'));?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'apellido', array('class' => 'control-label col-sm-4 col-xs-12', 'for' => 'Usuario_apellido'));?>
        <div class="col-sm-8 col-xs-12">
        <?php echo $form->textField($model, 'apellido', array('class' => 'form-control input-sm', 'placeholder' => Yii::t('models.Usuario', 'input.apellido'), 'maxlength' => 50));?>
        <?php echo $form->error($model, 'apellido', array('class' => 'text-danger'));?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'email', array('class' => 'control-label col-sm-4 col-xs-12', 'for' => 'Usuario_email'));?>
        <div class="col-sm-8 col-xs-12">
        <?php echo $form->emailField($model, 'email', array('class' => 'form-control input-sm', 'placeholder' => Yii::t('base', 'example@email.com'), 'maxlength' => 90, 'style' => 'text-transform:lowercase;'));?>
        <?php echo $form->error($model, 'email', array('class' => 'text-danger'));?>
        </div>
    </div>

        </div>

        <div class="panel-footer">
    	    <?php echo CHtml::linkButton(Yii::t('base', $this->action->id), array('class' => 'btn btn-info btn-block'));?>
        </div>
    	<?php $this->endWidget(); ?>
    </div>
</div>