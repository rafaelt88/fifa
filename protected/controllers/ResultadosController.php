<?php

class ResultadosController extends Controller {

    public function actionIndex() {
        Yii::app()->clientscript->registerCssFile(Yii::app()->theme->baseUrl . '/css/timeline.css');
        $this->render('index');
    }

}