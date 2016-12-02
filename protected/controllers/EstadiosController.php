<?php

class EstadiosController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionView() {
        if ($id = Yii::app()->request->getPost('id')) {
            $this->render('view', array(
                'model' => Estadio::model()->findByPk($id)
            ));
        } else {
            $this->redirect(array(
                'index'
            ));
        }
    }

}