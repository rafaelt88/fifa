<?php

/**
 * Componente para validar contraseña de acceso dentro de una sessión.
 * $this->controller->widget('application.widgets.access.Access');
 * @author Rafael J Torres <rafaelt88@gmail.com>
 */
class Access extends CWidget {

    public function run() {
        if (! Yii::app()->request->getPost('access_key')) {
            if (Usuario::model()->exists('id=:t0 AND pass=:t1',
                array(
                    ':t0' => Yii::app()->user->id,
                    ':t1' => md5(Yii::app()->request->getPost('password'))
                ))) {
                $_POST['access_key'] = true;
                return;
            } else {
                $this->render('index');
            }
        }
    }

}