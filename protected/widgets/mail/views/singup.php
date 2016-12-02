<p>
	Estimado <b><?php echo $params['to'][1]; ?></b> <br>
</p>
<p>
	Su cuenta ha sido creada con éxito, ya puede comenzar a armar de forma
	gratuita y participar en las quinielas<br>
</p>
<p>
	Sus datos de accesos son:<br> <strong>correo electrónico: </strong><?php echo $params['to'][0]; ?><br>
	<strong>contraseña: </strong><?php echo $params['model']['pass']; ?><br>
</p>

<p>
	En nuestra página web existe una sección de <a
		href="http://brasil-2014.tk/faqs"> Preguntas Frecuentes</a>, la cual
	puede consultar para mayor información. Si tiene alguna otra inquietud,
	pregunta o sugerencia no dude en escribirnos. <br>
</p>
<br>
Atte. <?php echo Yii::app()->name; ?>
