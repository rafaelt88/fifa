<?php
$estadios = Estadio::model()->findAll();
$rand = rand(1, count($estadios));
?>
<div id="carrusel" class="carousel slide" data-ride="carousel">

	<div class="carousel-inner">
	    <?php foreach ($estadios as $item):?>
		<div class="item<?php echo $item->id == $rand ? ' active' : null;?>">
			<img class="img-rounded" src="<?php echo Yii::app()->homeUrl . "media/estadios/{$item->id}.jpg";?>"
				style="width: 100%;">
			<h3 class="carousel-caption"><?php echo CHtml::link($item->nombre, '#', array('submit' => array('view'), 'params' => array('id' => $item->id), 'style' => 'color: white;'));?></h2>

		</div>
		<?php endforeach;?>
	</div>

	<a class="left carousel-control" href="#carrusel" data-slide="prev"
		style="margin-top: 25%;">
		<span class="visible-xs fa fa-chevron-circle-left"></span>
		<span class="hidden-xs fa fa-chevron-circle-left fa-3x"></span>
	</a> <a class="right carousel-control" href="#carrusel"
		data-slide="next" style="margin-top: 25%;">
		<span class="visible-xs fa fa-chevron-circle-right"></span>
		<span class="hidden-xs fa fa-chevron-circle-right fa-3x"></span>
	</a>

	<ol class="carousel-indicators">
	    <?php foreach ($estadios as $item):?>
	    <li data-target="#carousel" data-slide-to="<?php echo $item->id - 1;?>" class="<?php echo $item->id == $rand ? ' active' : null;?>"></li>
		<?php endforeach;?>
	</ol>
</div>