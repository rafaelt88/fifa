<?php
return array(
	'id_partido' => Partido::model()->getAttributeLabel('id'),
	'input.id_partido' => Partido::model()->getAttributeLabel('id'),

	'id_equipo' => Equipo::model()->getAttributeLabel('id'),
	'input.id_equipo' => Equipo::model()->getAttributeLabel('id'),

	'goles' => 'Goles',
	'input.goles' => 'Goles',

	'tipo' => 'Tipo',
	'input.tipo' => 'Tipo',

	'id_quiniela' => Quiniela::model()->getAttributeLabel('id'),
	'input.id_quiniela' => Quiniela::model()->getAttributeLabel('id'),
);