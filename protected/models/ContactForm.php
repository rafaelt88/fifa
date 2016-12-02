<?php
class ContactForm extends CFormModel{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $captcha;

    public function rules(){
        return array(
            array(
                'name, email, subject, body',
                'required'
            ),
            array(
                'email',
                'email'
            ),
            array(
                'captcha',
                'captcha',
                'allowEmpty' => ! CCaptcha::checkRequirements()
            )
        );
    }

    public function attributeLabels(){
        return array(
            'name' => Yii::t('base', 'name'),
            'email' => Yii::t('base', 'email'),
            'subject' => Yii::t('base', 'subject'),
            'body' => Yii::t('base', 'body'),
        );
    }

}