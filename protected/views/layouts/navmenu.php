<p style="margin-top: 5px;">
	<strong><?php echo Yii::app()->user->name;?></strong><br />
	<small><?php echo Yii::app()->user->group;?></small>
</p>

<hr />

<div class="list-group">
<?php
foreach (Yii::app()->user->getState('access') as $module => $item) {
    if (! is_array($item)) {
        echo CHtml::link(Yii::t('base', $module), Yii::app()->createAbsoluteUrl($item),
            array(
                'class' => 'list-group-item'
            ));
    } else {
        echo CHtml::link(Yii::t('base', $module), "#{$module}",
            array(
                'class' => 'list-group-item' . (isset($this->module) && $this->getModule()->getId() == $module?' active':null),
                'data-toggle' => 'collapse'
            ));
        echo CHtml::openTag('div', array(
            'class' => 'collapse' . (isset($this->module) && $this->getModule()->getId() == $module?' in':null),
            'id' => $module
        ));
        foreach ($item as $controller => $action) {
            echo CHtml::link('<span class="fa fa-level-up fa-rotate-90" style="margin-right: 10px;"></span>' . Yii::t('base', $controller),
                Yii::app()->createAbsoluteUrl("{$module}/{$controller}"),
                array(
                    'class' => 'list-group-item' . ($this->getId() == $controller?' list-group-item-info':null),
                    'style' => 'font-size: 12px;'
                ));
        }
        echo CHtml::closeTag('div');
    }
}
?>
</div>
