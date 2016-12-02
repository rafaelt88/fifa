<?php
return array(
	'id_partido' => Partido::model()->getAttributeLabel('id'),
	'input.id_partido' => Partido::model()->getAttributeLabel('id'),

	'id_quiniela' => Quiniela::model()->getAttributeLabel('id'),
	'input.id_quiniela' => Quiniela::model()->getAttributeLabel('id'),

	'goles' => 'Goles',
	'input.goles' => 'Goles',

	'id_equipo' => Equipo::model()->getAttributeLabel('id'),
	'input.id_equipo' => Equipo::model()->getAttributeLabel('id'),
);