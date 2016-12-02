<?php
class PasswordForm extends CFormModel{
    public $password;
    public $conf_password;

    public function rules(){
        return array(
            array(
                'conf_password, password',
                'required'
            ),
            array(
                'conf_password',
                'confirmPasswords'
            )
        );
    }

    public function confirmPasswords($attribute_name, $params){
        if ($this->password != $this->conf_password) {
            $this->addError($attribute_name, Yii::t('base', 'passwords not match'));
        }
    }

    public function attributeLabels(){
        return array(
            'password' => Yii::t('base', 'password'),
            'conf_password' => Yii::t('base', 'conf_password')
        );
    }
}