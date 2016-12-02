<br>
Estimado
<b><?php echo $params['to'][1]; ?></b>
<br>
<p>
	Su <b><?php echo $params['subject'];?></b> ha sido registrada con
	éxito, para activarla deberá responder este email adjuntado el
	comprobante de pago (depósito o transferencia).
</p>
<h1>RESULTADOS</h1>
<table>
<?php $equipos = Yii::app()->user->getState('teams');?>
<?php foreach ($params['resultados'] as $game => $item):?>
    <tr>
		<td><b>Nº <?php echo $game + 1;?></b></td>
		<td><?php echo $equipos[$item[0]];?></td>
		<td><?php echo $item[1];?></td>
		<td><?php echo $item[3];?></td>
		<td><?php echo $equipos[$item[2]];?></td>
	</tr>
<?php endforeach;?>
</table>

<h1>POSICIONES</h1>
<table>
<?php for ($i = 1 ; $i <= 4 ; $i++):?>
    <tr>
		<td><b><?php echo $i;?>º Lugar</b></td>
		<td><?php echo $equipos[$params['posiciones'][$i]];?></td>
	</tr>
<?php endfor;?>
</table>

<h1>REGLAS DEL CONCURSO</h1>
<p>
	<b>Costo: </b>El costo para activar la quiniela es de DOSCIENTOS
	CINCUENTA BOLIVARES (Bs. 250).
<div style="background-color: gray;">
	<b>Nota: </b>Si se activa durante el concurso, habrá una penalización
	de DIEZ BOLIVARES (Bs. 10) por partido jugado.
</div>
</p>

<p>
	<b>General: </b>El puntaje es acumulativo por juego, acertando
	resultado o ganador.
<ul>
	<li>Tres (3) puntos por acertar resultado.</li>
	<li>Un (1) punto por acertar ganador.</li>
</ul>
</p>
<p>
	<b>Extra: </b>Se obtienen puntos adicionales por acertar las posiciones
	finales.
<ul>
	<li>Diez (10) puntos por acertar Campeón.</li>
	<li>Ocho (8) puntos por acertar 2º Lugar.</li>
	<li>Cuatro (4) puntos por acertar 3º Lugar.</li>
	<li>Dos (2) puntos por acertar 4º Lugar.</li>
</ul>
</p>
<p>
	<b>Premiación: </b>Se picará el pote acumulado de las quinielas
	activas, entre los cuatro (4) mejores resultados.
<ul>
	<li>Cincuenta por ciento (50%) al Primero.</li>
	<li>Veinte por ciento (20%) al Segundo.</li>
	<li>Diez por ciento (10%) al Tercero.</li>
	<li>Cinco por ciento (5%) al Cuarto.</li>
</ul>
<div style="background-color: gray;">
	<b>Nota: </b>En caso de empates, se dividirá el total a repartir.
</div>
</p>
<h1>CUENTAS BANCARIAS</h1>
<p>
	Titular: <b>RAFAEL TORRES</b><br> Cédula: <b>V-18.125.352</b><br>
	Correo: <b>rafaelt88@gmail.com</b><br> <b>0105-0747-22-0747014523</b>
	Mercantil (Cta. Ahorro)<br> <b>0102-0151-99-0000085737</b> Venezuela
	(Cta. Corriente)<br> <b>0134-0030-08-0302167187</b> Banesco (Cta.
	Ahorro)<br> <b>0108-0341-14-0100023371</b> Provincial (Cta. Corriente)<br>
	<br>
</p>
<p>
	En nuestra página web existe una sección de <a
		href="http://brasil-2014.tk/faqs"> Preguntas Frecuentes</a>, la cual
	puede consultar para mayor información. Si tiene alguna otra inquietud,
	pregunta o sugerencia no dude en escribirnos. <br>
</p>
Atte. <?php echo Yii::app()->name; ?>
<br>