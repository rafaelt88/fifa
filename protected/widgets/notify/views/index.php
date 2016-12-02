<div id="message-<?php echo $num;?>" class="alert alert-<?php echo $type; ?> alert-dismissable" style="z-index: 1000; position: fixed; top: <?php echo $num * 50;?>px;">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<?php echo $text; ?>
</div>

<script>
$('#message-<?php echo $num;?>').delay(3000).fadeOut('slow');
</script>