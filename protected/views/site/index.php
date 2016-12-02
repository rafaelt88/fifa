<?php
echo CHtml::link(Yii::t('base', 'singup now'), Yii::app()->createAbsoluteUrl('site/singup'),
    array(
        'class' => 'btn btn-lg btn-danger pull-left',
        'style' => 'position: absolute; left: 50px; top: 30px;'
    ));
?>

<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/principal.jpg"
	class="img-rounded" style="width: 100%" />