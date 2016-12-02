<img src="<?php echo Yii::app()->homeUrl . "media/estadios/{$model->id}.jpg";?>"
	class="img-thumbnail pull-left"
	style="width: 50%; margin-right: 20px; margin-bottom: 20px;">
<?php echo CHtml::tag('h4', array(), $model->nombre);?>
<hr>
<?php echo $model->contenido;?>