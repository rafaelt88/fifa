<?php
$navbar = array();
$navbar['equipos'] = Yii::app()->createAbsoluteUrl('equipos');
$navbar['grupos'] = Yii::app()->createAbsoluteUrl('grupos');
$navbar['estadios'] = Yii::app()->createAbsoluteUrl('estadios');
$navbar['resultados'] = Yii::app()->createAbsoluteUrl('resultados');
$navbar['quinielas'] = Yii::app()->createAbsoluteUrl('quinielas');
?>
<div class="hidden-xs">
    <div class="col-sm-2" style="margin-bottom: 10px; padding-left: 40px;">
        <a href="<?php echo Yii::app()->homeUrl;?>" title="<?php echo Yii::app()->name;?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/logo.png"/></a>
    </div>

    <div class="col-sm-10" style="margin-bottom: 10px;">
        <div class="navbar navbar-inverse" role="navigation" style="margin-bottom: 0px;">
            <div class="navbar-header">
        		<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <nav class="collapse navbar-collapse">
              <ul class="nav navbar-nav nav-pills">
              <?php foreach ($navbar as $label => $url):?>
                <li>
                    <?php echo CHtml::link(Yii::t('base', "{$label}"), $url);?>
                </li>
              <?php endforeach;?>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <?php if (Yii::app()->user->isGuest):?>
                  <li><?php echo CHtml::link(Yii::t('base', 'login'), Yii::app()->createAbsoluteUrl('site/login'))?></li>
                  <?php else:?>
                  <li><?php echo CHtml::link(Yii::t('base', 'logout'), Yii::app()->createAbsoluteUrl('site/logout'))?></li>
                  <?php endif;?>
              </ul>
            </nav>
        </div>
        <?php if (!Yii::app()->user->isGuest):?>
            <div class="pull-left">Bienvenido, <div class="label label-primary"><?php echo Yii::app()->user->name;?></div></div>
            <div class="label label-warning pull-right" style="margin-top: 3px;"><?php echo CHtml::link(Yii::t('base', 'change password'), Yii::app()->createAbsoluteUrl('site/password'), array('style' => 'color: white;'))?></div>
        <?php endif;?>
    </div>
</div>

<div class="visible-xs" style="padding-bottom: 50px;">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo Yii::app()->homeUrl;?>"><?php echo Yii::app()->name;?></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          <?php foreach ($navbar as $label => $url):?>
              <li><?php echo CHtml::link(Yii::t('base', "{$label}"), $url);?></li>
          <?php endforeach;?>
              <?php if (Yii::app()->user->isGuest):?>
              <li><?php echo CHtml::link(Yii::t('base', 'login'), Yii::app()->createAbsoluteUrl('site/login'))?></li>
              <?php else:?>
              <li><?php echo CHtml::link(Yii::t('base', 'logout'), Yii::app()->createAbsoluteUrl('site/logout'))?></li>
              <?php endif;?>
          </ul>
        </div>
      </div>
    </div>
</div>