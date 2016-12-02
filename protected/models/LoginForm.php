<?php

class LoginForm extends CFormModel {
    public $username;
    public $password;
    private $_identity;

    public function rules() {
        return array(
            array(
                'username, password',
                'required'
            ),
            array(
                'username',
                'filter',
                'filter' => 'strtolower'
            ),
            array(
                'password',
                'authenticate'
            )
        );
    }

    public function attributeLabels() {
        return array(
            'username' => Yii::t('base', 'username'),
            'password' => Yii::t('base', 'password')
        );
    }

    public function authenticate($attribute, $params) {
        if (! $this->hasErrors()) {
            if ($usuario = Usuario::model()->findByAttributes(
                array(
                    'email' => $this->username,
                    'pass' => md5($this->password)
                ))) {
                Yii::app()->session->regenerateID();
                Yii::app()->user->setState('id', $usuario->id);
                Yii::app()->user->setState('name', "{$usuario->apellido}, {$usuario->nombre}");
                Yii::app()->user->setState('email', $usuario->email);
                $teams = array();
                foreach (Equipo::model()->findAll(array('condition' => 'id_grupo IS NOT NULL', 'order' => 'nombre ASC')) as $item) {
                    $teams[$item->id] = $item->nombre;
                }
                Yii::app()->user->setState('teams', $teams);
                return Yii::app()->user->login(new CUserIdentity($this->username, $this->password));
            } else {
                $this->addError('password', 'Usuario y/o Contraseña incorrecta.');
            }
        }
    }

}