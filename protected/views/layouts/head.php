<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo Yii::app()->charset;?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="description" content="<?php echo Yii::app()->params->application['description'];?>">
<meta name="author" content="<?php echo Yii::app()->params->application['autor'];?>">
<title><?php echo Yii::app()->controller->pageTitle;?></title>
<link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl;?>/img/favicon.ico">
<?php
$assets = YII_DEBUG ? Yii::app()->assetManager->publish(Yii::app()->theme->basePath):Yii::app()->theme->baseUrl;
Yii::app()->clientscript
    ->registerCssFile($assets . '/css/bootstrap' . (YII_DEBUG ? null: '.min') . '.css')
    ->registerCssFile($assets . '/css/font-awesome' . (YII_DEBUG ? null: '.min') . '.css')
    ->registerScriptFile($assets . '/js/bootstrap' . (YII_DEBUG ? null: '.min') . '.js', CClientScript::POS_END)
    ->registerCoreScript('jquery');
?>
<style type="text/css">
.contenido {
    max-width: 970px;
    margin-top: 10px;
}
table{
width: 100%;
}

p {
	text-align: justify;
}
</style>
</head>