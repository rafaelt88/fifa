<p>
	Estimado <b><?php echo $params['to'][1]; ?></b> <br>
</p>
<p>Su contraseña se ha restablecido satisfactoriamente.</p>
<p>
	Sus nuevos datos de accesos son:<br> <strong>correo electrónico: </strong><?php echo $params['to'][0]; ?><br>
	<strong>contraseña: </strong><?php echo $params['model']['pass']; ?><br>
</p>

<p>
	<br>Atte. <?php echo Yii::app()->name; ?>
