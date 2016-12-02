<?php $inverse = false; $fecha = null;?>
<ul class="timeline">
    <?php foreach (Yii::app()->db->createCommand()->select('*')->from('partido')->join('encuentro', 'id_partido=partido.id')->group('fecha')->queryAll() as $item):?>
    <?php if ($fecha != $item['fecha']): ?>
    <?php $fecha = $item['fecha']; $inverse = !$inverse;?>
    <?php endif;?>
    <li class="<?php echo $inverse ? 'timeline-inverted' : null;?>">
		<div class="timeline-badge info">
			<small style="font-size: 14px;"><?php echo date('d-M', strtotime($item['fecha']));?></small>
		</div>
		<div class="timeline-panel">
			<div class="timeline-body">
			<?php foreach (Encuentro::model()->with(array('partido' => array('condition' => 'fecha="' . $item['fecha'] . '"')))->findAllByAttributes(array('tipo' => 0)) as $local):?>
			    <?php $rival = Encuentro::model()->findByAttributes(array('id_partido' => $local->id_partido, 'tipo' => 1));?>
			    <div class="row">
			    <div class="col-xs-6" style="padding: 0px;">
			        <div class="label label-info"><?php echo str_pad($local->partido->id, 2, "0", STR_PAD_LEFT);?></div>
			        <div class="badge pull-right"><?php echo $local->goles;?></div>
			        <?php if ($local->equipo->alias):?>
			        <img src="<?php echo Yii::app()->baseUrl . "/media/banderas/{$local->equipo->alias}.png";?>" class="pull-right" style="width: 30px; padding: 5px;" title="<?php echo $local->equipo->nombre;?>"/>
			        <?php endif;?>
			        <div class="pull-right hidden-xs"><?php echo $local->equipo->nombre;?></div>
		        </div>
		        <div class="col-xs-6" style="padding: 0px;">
		            <div class="pull-left" style="padding-left: 5px; padding-right: 5px;">-</div>
		            <div class="badge pull-left"><?php echo $rival->goles;?></div>
			        <?php if ($rival->equipo->alias):?>
			        <img src="<?php echo Yii::app()->baseUrl . "/media/banderas/{$rival->equipo->alias}.png";?>" class="pull-left" style="width: 30px; padding: 5px;" title="<?php echo $rival->equipo->nombre;?>"/>
			        <?php endif;?>
			        <div class="hidden-xs"><?php echo $rival->equipo->nombre;?></div>
		        </div>
		        </div>
			<?php endforeach;?>
			</div>
		</div>
	</li>
	<?php endforeach;?>
</ul>

<div class="pull-right">
<?php echo CHtml::link('Calendario Oficial de la FIFA', Yii::app()->theme->baseUrl . '/calendario.pdf', array('class' => 'label label-danger', 'target' => '_fifa'));?>
</div>