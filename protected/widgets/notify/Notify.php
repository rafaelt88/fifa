<?php

/**
 * Componente de notificaciones popup
 * @author Rafael J Torres <rafaelt88@gmail.com>
 */
class Notify extends CWidget {

    public function run() {
        $i = 0;
        foreach (Yii::app()->user->getFlashes() as $type => $text) {
            $this->render('index',
                array(
                    'num' => $i ++,
                    'type' => $type ? $type : 'info',
                    'text' => $text
                ));
        }
    }

}