<div class="alert alert-info hidden-xs">
    <ul class="nav nav-pills nav-justified">
    <li><div class="badge"><?php echo Yii::t('base', 'j');?></div> <?php echo Yii::t('base', 'pj')?></li>
    <li><div class="badge"><?php echo Yii::t('base', 'g');?></div> <?php echo Yii::t('base', 'pg')?></li>
    <li><div class="badge"><?php echo Yii::t('base', 'e');?></div> <?php echo Yii::t('base', 'pe')?></li>
    <li><div class="badge"><?php echo Yii::t('base', 'p');?></div> <?php echo Yii::t('base', 'pp')?></li>
    <li><div class="badge"><?php echo Yii::t('base', 'g');?></div> <?php echo Yii::t('base', 'gf')?></li>
    <li><div class="badge"><?php echo Yii::t('base', 'c');?></div> <?php echo Yii::t('base', 'gc')?></i>
    <li><div class="badge"><?php echo Yii::t('base', 'pts');?></div> <?php echo Yii::t('base', 'ptos')?></li>
    </ul>
</div>
<div class="row">
<?php foreach (Grupo::model()->findAll() as $grupo): ?>
<div class="col-sm-6 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo CHtml::tag('h4', array(), Yii::t('base', Yii::t('base', 'grupo {letra}', array('{letra}' => $grupo->letra)))); ?>
		</div>
		<div class="panel-body">
		<table class="table table-bordered table-hover">
		<thead>
		    <tr>
		        <th><?php echo Yii::t('base', 'equipo');?></th>
		        <th width="25px;"><?php echo Yii::t('base', 'j');?></th>
		        <th width="25px;"><?php echo Yii::t('base', 'g');?></th>
		        <th width="25px;"><?php echo Yii::t('base', 'e');?></th>
		        <th width="25px;"><?php echo Yii::t('base', 'p');?></th>
		        <th width="25px;"><?php echo Yii::t('base', 'g');?></th>
		        <th width="25px;"><?php echo Yii::t('base', 'c');?></th>
		        <th width="25px;"><?php echo Yii::t('base', 'pts');?></th>
	        </tr>
		</thead>
		<tbody>
		    <?php foreach (Equipo::model()->findAllByAttributes(array('id_grupo' => $grupo->id)) as $equipo):?>
		    <?php $pj = $pg = $pe = $gf = $gc = 0;
		    $encuentros = Encuentro::model()->findAll('id_equipo=:t0 AND goles IS NOT NULL', array(':t0' => $equipo->id));
		    foreach ($encuentros as $item) {
                if ($rival = Encuentro::model()->find('id_partido=:t0 AND tipo=:t1 AND goles IS NOT NULL', array(
                    ':t0' => $item->id_partido,
                    ':t1' => !$item->tipo,
                ))) {
                    $pj++;
                    if ($item->goles > $rival->goles) {
                        $pg++;
                    } elseif ($item->goles == $rival->goles) {
                        $pe++;
                    }
                    $gf += $item->goles;
                    $gc += $rival->goles;
                }
		    }
		    ?>
		    <tr>
		        <td>
		        <img src="<?php echo Yii::app()->baseUrl . "/media/banderas/{$equipo->alias}.png";?>" style="width: 30px; margin-left: 10px; margin-right: 10px; float: left;" title="<?php echo $equipo->nombre;?>"/>
		        <div class=""><?php echo $equipo->nombre;?></div></td>
		        <td><?php echo $pj;?></td>
		        <td><?php echo $pg;?></td>
		        <td><?php echo $pe;?></td>
		        <td><?php echo $pj - $pg - $pe;?></td>
		        <td><?php echo $gf;?></td>
		        <td><?php echo $gc;?></td>
		        <td><?php echo $pg * 3 + $pe;?></td>
		    </tr>
		    <?php endforeach;?>
		</tbody>
		</table>
		</div>
	</div>
</div>
<?php endforeach; ?>
</div>