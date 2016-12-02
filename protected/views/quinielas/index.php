<?php if (Yii::app()->user->isGuest):?>
<div class="alert alert-danger">
Para poder registrar tu quiniela, es necesario tener una cuenta de usuario. <?php echo CHtml::link('Crea tu cuenta aquí!', Yii::app()->createAbsoluteUrl('site/dingup'), array('class' => 'label label-danger'))?>
</div>
<?php endif;?>

<?php if (Yii::app()->request->getParam('quiniela') == null || Quiniela::model()->exists('id=:t0 AND activo=0', array(':t0' => Yii::app()->request->getParam('quiniela')))):?>
<div class="alert alert-info">
Arma tu quiniela y diviértete compitiendo con tus amigos de forma gratuita, actívala cuanto antes para que participes en la premiación.
</div>
<?php endif;?>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'quinielas-form',
)); ?>

<?php if (!Yii::app()->user->isGuest):?>
	<div class="form-group">
	<?php echo CHtml::label('Mi(s) Quiniela(s)', 'quiniela' , array('class' => 'col-sm-4 col-xs-12 control-label')); ?>
		<div class="control-group col-sm-8 col-xs-12">
			<?php echo CHtml::dropDownList(
			    'quiniela',
			    Yii::app()->request->getParam('quiniela'),
			    $mis_quinielas,
			    array(
			        'class' => 'form-control input-sm', 'maxlength' => 2,
			        'prompt' => Yii::t('base', 'select option'),
                    'onchange' => 'submit()'
                )
			); ?>
		</div>
	</div>
<?php endif;?>

<?php if (Yii::app()->request->getParam('quiniela')):?>
<?php
$tabla = array();
foreach (Resultado::model()->findAllByAttributes(array('id_quiniela' => Yii::app()->request->getParam('quiniela'))) as $item)
    $tabla[$item->id_partido][] = array($item->equipo->nombre, $item->goles, $item->equipo->alias);
foreach (Ganador::model()->findAllByAttributes(array('id_quiniela' => Yii::app()->request->getParam('quiniela'))) as $item)
    $tabla[$item->id_partido][] = $item->id_equipo ? array($item->equipo->nombre, $item->equipo->alias) : null;
?>
<table class="table table-bordered table-hover">
<tr>
<th style="text-align: center;">Nº Juego</th>
<th style="text-align: center;">Encuentro</th>
<th style="text-align: center;">Ganador</th>
</tr>
<tbody>
<?php foreach ($tabla as $game => $item):?>
<tr>
    <td style="text-align: center;">
        <div class="label label-info"><?php echo str_pad($game, 2, "0", STR_PAD_LEFT);?></div>
    </td>
    <td>
	    <div class="row" style="margin-bottom: 5px;">
	        <div class="col-xs-6">
	            <div class="badge pull-right" style="margin-left: 5px;"><?php echo $item[0][1];?></div>
		        <div class="hidden-xs pull-right"><?php echo $item[0][0];?></div>
		        <img src="<?php echo Yii::app()->baseUrl . "/media/banderas/{$item[0][2]}.png";?>" class="pull-left" style="width: 30px;" title="<?php echo $item[0][0];?>"/>
	        </div>
		    <div class="col-xs-6">
		        <div class="badge pull-left" style="margin-right: 5px;"><?php echo $item[1][1];?></div>
		        <div class="hidden-xs pull-left"><?php echo $item[1][0];?></div>
		        <img src="<?php echo Yii::app()->baseUrl . "/media/banderas/{$item[1][2]}.png";?>" class="pull-right" style="width: 30px;" title="<?php echo $item[1][0];?>"/>
	        </div>
	    </div>
    </td>
    <td>
        <?php if (isset($item[2])):?>
        <div class="hidden-xs pull-left"><?php echo $item[2][0];?></div>
        <img src="<?php echo Yii::app()->baseUrl . "/media/banderas/{$item[2][1]}.png";?>" class="pull-right hidden-xs" style="width: 30px;" title="<?php echo $item[2][1];?>"/>
        <div class="visible-xs" style="text-align: center;">
            <img src="<?php echo Yii::app()->baseUrl . "/media/banderas/{$item[2][1]}.png";?>" style="width: 30px;" title="<?php echo $item[2][1];?>"/>
        </center>
        <?php endif;?>
    </td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<?php else:?>

<?php $col = 0;?>
<?php foreach (Grupo::model()->findAll() as $grupo): ?>
<?php echo $col % 2 == 0?'<div class="row" style="margin-bottom: 5px;">':null?>
<div class="col-sm-6 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo CHtml::tag('h4', array(), Yii::t('base', Yii::t('base', 'grupo {letra}', array('{letra}' => $grupo->letra)))); ?>
		</div>
		<div class="panel-body">
		<table>
		<tbody>
		    <?php foreach (Encuentro::model()->with(array('partido' => array('condition' => 'fase="0"'), 'equipo' => array('condition' => "id_grupo={$grupo->id}")))->findAll(array('group' => 'id_partido')) as $game):?>
		    <?php $local = Encuentro::model()->findByAttributes(array('id_partido' => $game->id_partido, 'tipo' => 0))->equipo;?>
		    <?php $rival = Encuentro::model()->findByAttributes(array('id_partido' => $game->id_partido, 'tipo' => 1))->equipo;?>
		    <tr>
		    <td style="padding-right: 10px; padding-bottom: 10px;">
		    <div class="label label-info"><?php echo str_pad($game->id_partido, 2, "0", STR_PAD_LEFT);?></div>
		    </td>
		    <td>
    		    <div class="row" style="margin-bottom: 5px;">
    		        <div class="col-sm-4 col-xs-3" style="padding-right: 0px; padding-top: 5px;">
        		        <?php echo CHtml::hiddenField("{$game->id_partido}_e0", $local->id);?>
        		        <img src="<?php echo Yii::app()->baseUrl . "/media/banderas/{$local->alias}.png";?>" class="pull-right" style="width: 30px; padding: 5px;" title="<?php echo $rival->nombre;?>"/>
        		        <small class="pull-right hidden-xs" style="padding-top: 2px;"><?php echo $local->nombre;?></small>
    		        </div>
        	        <div class="col-sm-2 col-xs-3" style="padding-left: 0px;">
        	            <?php echo CHtml::textField("{$game->id_partido}_0", Yii::app()->request->getParam("{$game->id_partido}_0"), array('class' => 'form-control input-sm', 'maxlength' => 2));?>
        	        </div>
        		    <div class="col-sm-2 col-xs-3" style="padding-right: 0px;">
        		        <?php echo CHtml::textField("{$game->id_partido}_1", Yii::app()->request->getParam("{$game->id_partido}_1"), array('class' => 'form-control input-sm', 'maxlength' => 2));?>
        		    </div>
        		    <div class="col-sm-4 col-xs-3" style="padding-left: 0px; padding-top: 5px;">
        		        <?php echo CHtml::hiddenField("{$game->id_partido}_e1", $rival->id);?>
        		        <img src="<?php echo Yii::app()->baseUrl . "/media/banderas/{$rival->alias}.png";?>" class="pull-left" style="width: 30px; padding: 5px;" title="<?php echo $rival->nombre;?>"/>
        		        <small class="pull-left hidden-xs" style="padding-top: 2px;"><?php echo $rival->nombre;?></small>
    		        </div>
    		    </div>
		    </td>
		    </tr>
		    <?php endforeach;?>
		</tbody>
		</table>
		</div>
	</div>
</div>
<?php echo ++$col % 2 == 0?'</div>':null?>
<?php endforeach; ?>
<?php echo $col % 2 != 0?'</div>':null?>

<div class="row" style="margin-bottom: 5px;">
<div class="col-sm-6 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo CHtml::tag('h4', array(), Yii::t('base', Yii::t('base', 'octavos'))); ?>
		</div>
		<div class="panel-body">
		<table>
		<tbody>
		    <?php foreach (Partido::model()->findAll('fase="1"') as $game):?>
		    <?php $local = Encuentro::model()->findByAttributes(array('id_partido' => $game->id, 'tipo' => 0))->equipo->nombre;?>
		    <?php $rival = Encuentro::model()->findByAttributes(array('id_partido' => $game->id, 'tipo' => 1))->equipo->nombre;?>
		    <tr>
		    <td style="padding-right: 10px; padding-bottom: 10px;">
		    <div class="label label-info"><?php echo str_pad($game->id, 2, "0", STR_PAD_LEFT);?></div>
		    </td>
		    <td>
    		    <div class="row" style="margin-bottom: 5px;">
    		        <div class="col-sm-4 col-xs-3" style="text-align: right; padding-right: 0px;">
    		            <?php echo CHtml::dropDownList(
    		                "{$game->id}_e0",
    		                Yii::app()->request->getParam("{$game->id}_e0"),
    		                CHtml::listData(Equipo::model()->with(array('grupo' => array('condition' => 'letra=:t0', 'params' => array(':t0' => strtolower(substr($local, -1, 1))))))->findAll(), 'id', 'nombre')
    		            , array('class' => 'form-control input-sm', 'prompt' => $local));?>
    		        </div>
        	        <div class="col-sm-2 col-xs-3" style="padding-left: 0px;">
        	            <?php echo CHtml::textField("{$game->id}_0", Yii::app()->request->getParam("{$game->id}_0"), array('class' => 'form-control input-sm', 'maxlength' => 2));?>
        	        </div>
        		    <div class="col-sm-2 col-xs-3" style="padding-right: 0px;">
        		        <?php echo CHtml::textField("{$game->id}_1", Yii::app()->request->getParam("{$game->id}_1"), array('class' => 'form-control input-sm', 'maxlength' => 2));?>
        		    </div>
        		    <div class="col-sm-4 col-xs-3" style="padding-left: 0px;">
        		        <?php echo CHtml::dropDownList(
        		            "{$game->id}_e1",
        		            Yii::app()->request->getParam("{$game->id}_e1"),
        		            CHtml::listData(Equipo::model()->with(array('grupo' => array('condition' => 'letra=:t0', 'params' => array(':t0' => strtolower(substr($rival, -1, 1))))))->findAll(), 'id', 'nombre'),
        		            array('class' => 'form-control input-sm', 'prompt' => $rival));?>
    		        </div>
    		    </div>
		    </td>
		    </tr>
		    <?php endforeach;?>
		</tbody>
		</table>
		</div>
	</div>
</div>
<div class="col-sm-6 col-xs-12">
    <div class="panel panel-default">
		<div class="panel-heading">
			<?php echo CHtml::tag('h4', array(), Yii::t('base', Yii::t('base', 'cuartos'))); ?>
		</div>
		<div class="panel-body">
		<table>
		<tbody>
		    <?php foreach (Partido::model()->findAll('fase="2"') as $game):?>
		    <?php $local = Encuentro::model()->findByAttributes(array('id_partido' => $game->id, 'tipo' => 0))->equipo->nombre;?>
		    <?php $rival = Encuentro::model()->findByAttributes(array('id_partido' => $game->id, 'tipo' => 1))->equipo->nombre;?>
		    <tr>
		    <td style="padding-bottom: 10px;">
		        <div class="label label-info"><?php echo str_pad($game->id, 2, "0", STR_PAD_LEFT);?></div>
		    </td>
		    <td style="padding-bottom: 10px;">
		        <?php echo CHtml::link('<div class="fa fa-refresh"></div>', null, array(
		            'onclick' => '$(function(){
		                $("#'. $game->id .'_e0 option[value!=\'\']").remove();
		                var id1 = $("#'. substr($local, -2, 2) .'_e0").val();
		                var eq1 = $("#'. substr($local, -2, 2) .'_e0  option:selected").text();
		                if (id1 > 0) {
		                  $("#' . $game->id . '_e0").append("<option value=\'"+id1+"\'>"+eq1+"</option>");
                        }
		                var id2 = $("#'. substr($local, -2, 2) .'_e1").val();
		                var eq2 = $("#'. substr($local, -2, 2) .'_e1  option:selected").text();
		                if (id2 > 0) {
		                  $("#' . $game->id . '_e0").append("<option value=\'"+id2+"\'>"+eq2+"</option>");
                        }
		                $("#'. $game->id .'_e1 option[value!=\'\']").remove();
		                var id3 = $("#'. substr($rival, -2, 2) .'_e0").val();
		                var eq3 = $("#'. substr($rival, -2, 2) .'_e0  option:selected").text();
		                if (id3 > 0) {
		                  $("#' . $game->id . '_e1").append("<option value=\'"+id3+"\'>"+eq3+"</option>");
                        }
		                var id4 = $("#'. substr($rival, -2, 2) .'_e1").val();
		                var eq4 = $("#'. substr($rival, -2, 2) .'_e1  option:selected").text();
		                if (id4 > 0) {
		                  $("#' . $game->id . '_e1").append("<option value=\'"+id4+"\'>"+eq4+"</option>");
                        }
                    });',
		            'class' => 'btn btn-sm'));?>
		    </td>
		    <td>
    		    <div class="row" style="margin-bottom: 5px;">
    		        <div class="col-sm-4 col-xs-3" style="text-align: right; padding-right: 0px;">
    		            <?php echo CHtml::dropDownList(
    		                "{$game->id}_e0",
    		                Yii::app()->request->getParam("{$game->id}_e0"),
    		                array(),
    		                array(
    		                    'class' => 'form-control input-sm',
    		                    'prompt' => $local
                        ));?>
    		        </div>
        	        <div class="col-sm-2 col-xs-3" style="padding-left: 0px;">
        	            <?php echo CHtml::textField("{$game->id}_0", Yii::app()->request->getParam("{$game->id}_0"), array('class' => 'form-control input-sm', 'maxlength' => 2));?>
        	        </div>
        		    <div class="col-sm-2 col-xs-3" style="padding-right: 0px;">
        		        <?php echo CHtml::textField("{$game->id}_1", Yii::app()->request->getParam("{$game->id}_1"), array('class' => 'form-control input-sm', 'maxlength' => 2));?>
        		    </div>
        		    <div class="col-sm-4 col-xs-3" style="padding-left: 0px;">
        		        <?php echo CHtml::dropDownList(
        		            "{$game->id}_e1",
        		            Yii::app()->request->getParam("{$game->id}_e1"),
        		            array(),
        		            array(
        		                'class' => 'form-control input-sm',
        		                'prompt' => $rival
                        ));?>
    		        </div>
    		    </div>
		    </td>
		    </tr>
		    <?php endforeach;?>
		</tbody>
		</table>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo CHtml::tag('h4', array(), Yii::t('base', Yii::t('base', 'semifinal'))); ?>
		</div>
		<div class="panel-body">
		<table>
		<tbody>
		    <?php foreach (Partido::model()->findAll('fase="3"') as $game):?>
		    <?php $local = Encuentro::model()->findByAttributes(array('id_partido' => $game->id, 'tipo' => 0))->equipo->nombre;?>
		    <?php $rival = Encuentro::model()->findByAttributes(array('id_partido' => $game->id, 'tipo' => 1))->equipo->nombre;?>
		    <tr>
		    <td style="padding-bottom: 10px;">
		        <div class="label label-info"><?php echo str_pad($game->id, 2, "0", STR_PAD_LEFT);?></div>
		    </td>
		    <td style="padding-bottom: 10px;">
		        <?php echo CHtml::link('<div class="fa fa-refresh"></div>', null, array(
		            'onclick' => '$(function(){
		                $("#'. $game->id .'_e0 option[value!=\'\']").remove();
		                var id1 = $("#'. substr($local, -2, 2) .'_e0").val();
		                var eq1 = $("#'. substr($local, -2, 2) .'_e0  option:selected").text();
		                if (id1 > 0) {
		                  $("#' . $game->id . '_e0").append("<option value=\'"+id1+"\'>"+eq1+"</option>");
                        }
		                var id2 = $("#'. substr($local, -2, 2) .'_e1").val();
		                var eq2 = $("#'. substr($local, -2, 2) .'_e1  option:selected").text();
		                if (id2 > 0) {
		                  $("#' . $game->id . '_e0").append("<option value=\'"+id2+"\'>"+eq2+"</option>");
                        }
		                $("#'. $game->id .'_e1 option[value!=\'\']").remove();
		                var id3 = $("#'. substr($rival, -2, 2) .'_e0").val();
		                var eq3 = $("#'. substr($rival, -2, 2) .'_e0  option:selected").text();
		                if (id3 > 0) {
		                  $("#' . $game->id . '_e1").append("<option value=\'"+id3+"\'>"+eq3+"</option>");
                        }
		                var id4 = $("#'. substr($rival, -2, 2) .'_e1").val();
		                var eq4 = $("#'. substr($rival, -2, 2) .'_e1  option:selected").text();
		                if (id4 > 0) {
		                  $("#' . $game->id . '_e1").append("<option value=\'"+id4+"\'>"+eq4+"</option>");
                        }
                    });',
		            'class' => 'btn btn-sm'));?>
		    </td>
		    <td>
    		    <div class="row" style="margin-bottom: 5px;">
    		        <div class="col-sm-4 col-xs-3" style="text-align: right; padding-right: 0px;">
    		            <?php echo CHtml::dropDownList(
    		                "{$game->id}_e0",
    		                Yii::app()->request->getParam("{$game->id}_e0"),
    		                array(),
    		                array(
    		                    'class' => 'form-control input-sm',
    		                    'prompt' => $local
                        ));?>
    		        </div>
        	        <div class="col-sm-2 col-xs-3" style="padding-left: 0px;">
        	            <?php echo CHtml::textField("{$game->id}_0", Yii::app()->request->getParam("{$game->id}_0"), array('class' => 'form-control input-sm', 'maxlength' => 2));?>
        	        </div>
        		    <div class="col-sm-2 col-xs-3" style="padding-right: 0px;">
        		        <?php echo CHtml::textField("{$game->id}_1", Yii::app()->request->getParam("{$game->id}_1"), array('class' => 'form-control input-sm', 'maxlength' => 2));?>
        		    </div>
        		    <div class="col-sm-4 col-xs-3" style="padding-left: 0px;">
        		        <?php echo CHtml::dropDownList(
        		            "{$game->id}_e1",
        		            Yii::app()->request->getParam("{$game->id}_e1"),
        		            array(),
        		            array(
        		                'class' => 'form-control input-sm',
        		                'prompt' => $rival
                        ));?>
    		        </div>
    		    </div>
		    </td>
		    </tr>
		    <?php endforeach;?>
		</tbody>
		</table>
		</div>
	</div>
</div>
</div>

<div class="row" style="margin-bottom: 5px;">
<div class="col-sm-6 col-xs-12">
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<?php echo CHtml::tag('h4', array(), Yii::t('base', Yii::t('base', 'tercero'))); ?>
    	</div>
    	<div class="panel-body">
    		<table>
    		<tbody>
    		    <?php foreach (Partido::model()->findAll('fase="4"') as $game):?>
    		    <?php $local = Encuentro::model()->findByAttributes(array('id_partido' => $game->id, 'tipo' => 0))->equipo->nombre;?>
    		    <?php $rival = Encuentro::model()->findByAttributes(array('id_partido' => $game->id, 'tipo' => 1))->equipo->nombre;?>
    		    <tr>
    		    <td style="padding-bottom: 10px;">
    		        <div class="label label-info"><?php echo str_pad($game->id, 2, "0", STR_PAD_LEFT);?></div>
    		    </td>
    		    <td style="padding-bottom: 10px;">
    		        <?php echo CHtml::link('<div class="fa fa-refresh"></div>', null, array(
    		            'onclick' => '$(function(){
    		                $("#'. $game->id .'_win option[value!=\'\']").remove();
    		                $("#'. $game->id .'_e0 option[value!=\'\']").remove();
    		                var id1 = $("#'. substr($local, -2, 2) .'_e0").val();
    		                var eq1 = $("#'. substr($local, -2, 2) .'_e0  option:selected").text();
    		                if (id1 > 0) {
    		                  $("#' . $game->id . '_e0").append("<option value=\'"+id1+"\'>"+eq1+"</option>");
    		                  $("#' . $game->id . '_win").append("<option value=\'"+id1+"\'>"+eq1+"</option>");
                            }
    		                var id2 = $("#'. substr($local, -2, 2) .'_e1").val();
    		                var eq2 = $("#'. substr($local, -2, 2) .'_e1  option:selected").text();
    		                if (id2 > 0) {
    		                  $("#' . $game->id . '_e0").append("<option value=\'"+id2+"\'>"+eq2+"</option>");
    		                  $("#' . $game->id . '_win").append("<option value=\'"+id2+"\'>"+eq2+"</option>");
                            }
    		                $("#'. $game->id .'_e1 option[value!=\'\']").remove();
    		                var id3 = $("#'. substr($rival, -2, 2) .'_e0").val();
    		                var eq3 = $("#'. substr($rival, -2, 2) .'_e0  option:selected").text();
    		                if (id3 > 0) {
    		                  $("#' . $game->id . '_e1").append("<option value=\'"+id3+"\'>"+eq3+"</option>");
    		                  $("#' . $game->id . '_win").append("<option value=\'"+id3+"\'>"+eq3+"</option>");
                            }
    		                var id4 = $("#'. substr($rival, -2, 2) .'_e1").val();
    		                var eq4 = $("#'. substr($rival, -2, 2) .'_e1  option:selected").text();
    		                if (id4 > 0) {
    		                  $("#' . $game->id . '_e1").append("<option value=\'"+id4+"\'>"+eq4+"</option>");
    		                  $("#' . $game->id . '_win").append("<option value=\'"+id4+"\'>"+eq4+"</option>");
                            }
                        });',
    		            'class' => 'btn btn-sm'));?>
    		    </td>
    		    <td>
        		    <div class="row" style="margin-bottom: 5px;">
        		        <div class="col-sm-4 col-xs-3" style="text-align: right; padding-right: 0px;">
        		            <?php echo CHtml::dropDownList(
        		                "{$game->id}_e0",
        		                Yii::app()->request->getParam("{$game->id}_e0"),
        		                array(),
        		                array(
        		                    'class' => 'form-control input-sm',
        		                    'prompt' => $local
                            ));?>
        		        </div>
            	        <div class="col-sm-2 col-xs-3" style="padding-left: 0px;">
            	            <?php echo CHtml::textField("{$game->id}_0", Yii::app()->request->getParam("{$game->id}_0"), array('class' => 'form-control input-sm', 'maxlength' => 2));?>
            	        </div>
            		    <div class="col-sm-2 col-xs-3" style="padding-right: 0px;">
            		        <?php echo CHtml::textField("{$game->id}_1", Yii::app()->request->getParam("{$game->id}_1"), array('class' => 'form-control input-sm', 'maxlength' => 2));?>
            		    </div>
            		    <div class="col-sm-4 col-xs-3" style="padding-left: 0px;">
            		        <?php echo CHtml::dropDownList(
            		            "{$game->id}_e1",
            		            Yii::app()->request->getParam("{$game->id}_e1"),
            		            array(),
            		            array(
            		                'class' => 'form-control input-sm',
            		                'prompt' => $rival
                            ));?>
        		        </div>
        		    </div>
    		    </td>
    		    </tr>
    		    <?php endforeach;?>
    		    <tr><td colspan="3"><?php echo CHtml::dropDownList("{$game->id}_win", Yii::app()->request->getParam("{$game->id}_win"), array(), array('class' => 'form-control input-sm','prompt' => Yii::t('base', 'select ganador')));?></td></tr>
    		</tbody>
    		</table>
    	</div>
    </div>
</div>
<div class="col-sm-6 col-xs-12">
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<?php echo CHtml::tag('h4', array(), Yii::t('base', Yii::t('base', 'final'))); ?>
    	</div>
    	<div class="panel-body">
    		<table>
    		<tbody>
    		    <?php foreach (Partido::model()->findAll('fase="5"') as $game):?>
    		    <?php $local = Encuentro::model()->findByAttributes(array('id_partido' => $game->id, 'tipo' => 0))->equipo->nombre;?>
    		    <?php $rival = Encuentro::model()->findByAttributes(array('id_partido' => $game->id, 'tipo' => 1))->equipo->nombre;?>
    		    <tr>
    		    <td style="padding-bottom: 10px;">
    		        <div class="label label-info"><?php echo str_pad($game->id, 2, "0", STR_PAD_LEFT);?></div>
    		    </td>
    		    <td style="padding-bottom: 10px;">
    		        <?php echo CHtml::link('<div class="fa fa-refresh"></div>', null, array(
    		            'onclick' => '$(function(){
    		                $("#'. $game->id .'_win option[value!=\'\']").remove();
    		                $("#'. $game->id .'_e0 option[value!=\'\']").remove();
    		                var id1 = $("#'. substr($local, -2, 2) .'_e0").val();
    		                var eq1 = $("#'. substr($local, -2, 2) .'_e0  option:selected").text();
    		                if (id1 > 0) {
    		                  $("#' . $game->id . '_e0").append("<option value=\'"+id1+"\'>"+eq1+"</option>");
    		                  $("#' . $game->id . '_win").append("<option value=\'"+id1+"\'>"+eq1+"</option>");
                            }
    		                var id2 = $("#'. substr($local, -2, 2) .'_e1").val();
    		                var eq2 = $("#'. substr($local, -2, 2) .'_e1  option:selected").text();
    		                if (id2 > 0) {
    		                  $("#' . $game->id . '_e0").append("<option value=\'"+id2+"\'>"+eq2+"</option>");
    		                  $("#' . $game->id . '_win").append("<option value=\'"+id2+"\'>"+eq2+"</option>");
                            }
    		                $("#'. $game->id .'_e1 option[value!=\'\']").remove();
    		                var id3 = $("#'. substr($rival, -2, 2) .'_e0").val();
    		                var eq3 = $("#'. substr($rival, -2, 2) .'_e0  option:selected").text();
    		                if (id3 > 0) {
    		                  $("#' . $game->id . '_e1").append("<option value=\'"+id3+"\'>"+eq3+"</option>");
    		                  $("#' . $game->id . '_win").append("<option value=\'"+id3+"\'>"+eq3+"</option>");
                            }
    		                var id4 = $("#'. substr($rival, -2, 2) .'_e1").val();
    		                var eq4 = $("#'. substr($rival, -2, 2) .'_e1  option:selected").text();
    		                if (id4 > 0) {
    		                  $("#' . $game->id . '_e1").append("<option value=\'"+id4+"\'>"+eq4+"</option>");
    		                  $("#' . $game->id . '_win").append("<option value=\'"+id4+"\'>"+eq4+"</option>");
                            }
                        });',
    		            'class' => 'btn btn-sm'));?>
    		    </td>
    		    <td>
        		    <div class="row" style="margin-bottom: 5px;">
        		        <div class="col-sm-4 col-xs-3" style="text-align: right; padding-right: 0px;">
        		            <?php echo CHtml::dropDownList(
        		                "{$game->id}_e0",
        		                Yii::app()->request->getParam("{$game->id}_e0"),
        		                array(),
        		                array(
        		                    'class' => 'form-control input-sm',
        		                    'prompt' => $local
                            ));?>
        		        </div>
            	        <div class="col-sm-2 col-xs-3" style="padding-left: 0px;">
            	            <?php echo CHtml::textField("{$game->id}_0", Yii::app()->request->getParam("{$game->id}_0"), array('class' => 'form-control input-sm', 'maxlength' => 2));?>
            	        </div>
            		    <div class="col-sm-2 col-xs-3" style="padding-right: 0px;">
            		        <?php echo CHtml::textField("{$game->id}_1", Yii::app()->request->getParam("{$game->id}_1"), array('class' => 'form-control input-sm', 'maxlength' => 2));?>
            		    </div>
            		    <div class="col-sm-4 col-xs-3" style="padding-left: 0px;">
            		        <?php echo CHtml::dropDownList(
            		            "{$game->id}_e1",
            		            Yii::app()->request->getParam("{$game->id}_e1"),
            		            array(),
            		            array(
            		                'class' => 'form-control input-sm',
            		                'prompt' => $rival
                            ));?>
        		        </div>
        		    </div>
    		    </td>
    		    </tr>
    		    <?php endforeach;?>
    		    <tr><td colspan="3"><?php echo CHtml::dropDownList("{$game->id}_win", Yii::app()->request->getParam("{$game->id}_win"), array(), array('class' => 'form-control input-sm','prompt' => Yii::t('base', 'select ganador')));?></td></tr>
    		</tbody>
    		</table>
    	</div>
    </div>
</div>
</div>

<?php if (!Yii::app()->user->isGuest):?>
<?php echo CHtml::linkButton(Yii::t('base', 'save'), array('class' => 'btn btn-info btn-block', 'confirm' => Yii::t('base', 'confirm change'), 'params' => array('ok' => true)));?>
<?php endif;?>

<?php endif;?>

<?php $this->endWidget(); ?>

<script type="text/javascript">
$('input:text').on('keydown', function(e){
	if (($.inArray(e.keyCode, [110, 190]) !== -1 && $(this).val().split(".").length < 1) ||
			(e.keyCode == 65 && e.ctrlKey === true) ||
			(e.keyCode >= 35 && e.keyCode <= 39) ||
			e.keyCode == 8 || e.keyCode == 9 || e.keyCode == 46  ) {
		return;
	}
	if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		e.preventDefault();
	}
});
</script>