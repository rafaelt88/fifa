<?php

class Controller extends CController {
    public $layout = '//layouts/content';

    public function init() {
        if (! Yii::app()->request->getUrlReferrer() && Yii::app()->request->getUrl() != Yii::app()->homeUrl) {
            $this->redirect(Yii::app()->homeUrl);
        }
        Yii::app()->messages->extensionPaths['models'] = 'application.models.base.messages';
    }

    public function filters() {
        return array(
            'accessControl'
        );
    }

}
