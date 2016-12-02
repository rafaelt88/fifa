<div class="panel panel-default">
	<div class="panel-heading" style="background-color: #d9534f; color: white;">
    	<h2><?php echo "Error {$code}:"; ?>
          <small style="color: white;"><?php echo $message; ?></small>
    	</h2>
	</div>
	<div class="panel-body  hidden-xs hidden-sm">
    	<center>
    	    <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/img/error/{$code}.png"); ?>
    	</center>
	</div>
</div>
