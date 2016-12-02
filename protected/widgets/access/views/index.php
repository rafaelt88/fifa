<div class="modal fade" id="access-modal" tabindex="-1" role="dialog" data-backdrop="static" style="margin-top: 50px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">
					<?php echo Yii::t('base', 'confirm your identity');?>
				</h4>
			</div>
			<div class="modal-body">
            	<?php $form = $this->beginWidget('CActiveForm');?>

            	<?php echo CHtml::hiddenField('access_key', null); ?>

        		<div class="form-group">
        			<?php echo CHtml::label(Yii::t('base', 'password'), null, array('class' => 'col-sm-4 col-xs-12 control-label')); ?>
        			<div class="col-sm-8  col-xs-12">
        			<?php echo CHtml::passwordField('password', Yii::app()->request->getPost('password'), array('class' => 'form-control input-sm', 'maxlength' => 32, 'placeholder' => Yii::t('base', 'type your password'))); ?>
        			</div>
        		</div>

    			<?php echo CHtml::submitButton(Yii::t('base', 'confirm') , array('class' => 'btn btn-info btn-block', 'id' => 'submit'));?>

    			<?php $this->endWidget();?>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	$('#access-modal').modal('show');
	$('#access-modal').on('hidden.bs.modal', function (e) {
		 location.href = '<?php echo Yii::app()->homeUrl;?>';
	});
});
</script>
