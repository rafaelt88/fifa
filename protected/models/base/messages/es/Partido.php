<?php
return array(
	'id' => 'Partido',
	'input.id' => 'Partido',

	'fecha' => 'Fecha',
	'input.fecha' => 'Fecha',

	'fase' => 'Fase',
	'input.fase' => 'Fase',

	'id_equipo' => Equipo::model()->getAttributeLabel('id'),
	'input.id_equipo' => Equipo::model()->getAttributeLabel('id'),
);