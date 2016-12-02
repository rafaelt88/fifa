<?php

class SiteController extends Controller {

    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction'
            )
        );
    }

    public function accessRules() {
        return array(
            array(
                'deny',
                'actions' => array(
                    'login',
                    'forgot',
                    'singup'
                ),
                'users' => array(
                    '@'
                )
            ),
            array(
                'allow',
                'actions' => array(
                    'logout',
                    'password'
                ),
                'users' => array(
                    '@'
                )
            ),
            array(
                'deny',
                'actions' => array(
                    'logout',
                    'password'
                ),
                'users' => array(
                    '*'
                )
            )
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionContact() {
        $model = new ContactForm();
        if (Yii::app()->request->isPostRequest) {
            $model->setAttributes(Yii::app()->request->getPost('ContactForm'));
            if ($model->validate()) {
                $this->widget('application.widgets.mail.Mail',
                    array(
                        'view' => 'contact',
                        'params' => array(
                            'to' => array(
                                $model->email,
                                $model->name
                            ),
                            'cc' => array(
                                Yii::app()->params['email'],
                                Yii::app()->name
                            ),
                            'subject' => $model->subject
                        )
                    ));
                $this->redirect(Yii::app()->homeUrl);
            }
        }
        $this->render('contact', array(
            'model' => $model
        ));
    }

    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }

    public function actionLogin() {
        $model = new LoginForm();
        if (Yii::app()->request->getPost('LoginForm')) {
            $model->setAttributes(Yii::app()->request->getPost('LoginForm'));
            if ($model->validate()) {
                Yii::app()->user->setFlash('success', 'Ha iniciado sesión satisfactoriamente.');
                $this->redirect(Yii::app()->homeUrl);
            } else {
                Yii::app()->user->setFlash('danger',
                    'No se pudo inciar sesión,
                    verifique sus datos de acceso.<br>
                    Si el inconveniente persiste, no dude en contactarnos.');
            }
        }
        $this->render('login', array(
            'model' => $model
        ));
    }

    public function actionForgot() {
        $model = new PasswordForm();
        if (Yii::app()->request->getPost('username')) {
            if ($model = Usuario::model()->findByAttributes(
                array(
                    'email' => Yii::app()->request->getPost('username')
                ))) {
                $model->pass = bin2hex(openssl_random_pseudo_bytes(4));
                $this->widget('application.widgets.mail.Mail',
                    array(
                        'view' => 'forgot',
                        'params' => array(
                            'to' => array(
                                $model->email,
                                "{$model->nombre}, {$model->apellido}"
                            ),
                            'cc' => array(
                                Yii::app()->params['email'],
                                Yii::app()->name
                            ),
                            'subject' => 'Contraseña restablecida con éxito.',
                            'model' => $model->getAttributes()
                        )
                    ));
                if (Yii::app()->db->createCommand()->update('usuario',
                    array(
                        'pass' => md5($model->pass)
                    ))) {
                    Yii::app()->user->setFlash('success',
                        "Su contraseña se ha restablecido satisfactoriamente.<br>
                    Le hemos enviado un email con su nueva contraseña. <br>
                            Si no recibió el correo, no dude en contactarnos.");
                    $this->redirect(Yii::app()->homeUrl);
                }
            }
            Yii::app()->user->setFlash('danger',
                "Hubo un error al restablecer su contraseña,
                    verifique los datos ingresados. <br>
                    Si el inconveniente persiste no dude en contactarnos.");
        }
        $this->render('forgot', array(
            'model' => $model
        ));
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        Yii::app()->controller->redirect(Yii::app()->homeUrl);
    }

    public function actionFaqs() {
        $this->render('faqs');
    }

    public function actionRules() {
        $this->render('rules');
    }

    public function actionSingup($view = 'singup') {
        $model = new Usuario();
        if (Yii::app()->request->getPost('Usuario')) {
            $model->setAttributes(Yii::app()->request->getPost('Usuario'));
            if ($model->validate(
                array(
                    'cedula',
                    'nombre',
                    'apellido',
                    'email'
                ))) {
                $model->pass = bin2hex(openssl_random_pseudo_bytes(4));
                $this->widget('application.widgets.mail.Mail',
                    array(
                        'view' => 'singup',
                        'params' => array(
                            'to' => array(
                                $model->email,
                                "{$model->nombre}, {$model->apellido}"
                            ),
                            'cc' => array(
                                Yii::app()->params['email'],
                                Yii::app()->name
                            ),
                            'subject' => 'Cuenta creada con éxito.',
                            'model' => $model->getAttributes()
                        )
                    ));
                $model->pass = md5($model->pass);
                if ($model->save()) {
                    Yii::app()->user->setFlash('success',
                        "Su cuenta fue creada
                    satisfactoriamente, le hemos enviado un email con sus datos de acceso. <br>
                    Si no recibió el correo, no dude en contactarnos.");
                    $this->redirect(Yii::app()->homeUrl);
                }
            }
            Yii::app()->user->setFlash('danger',
                "Hubo un error al crear su cuenta,
                verifique los datos del formulario. <br>
                Si el inconveniente persiste no dude en contactarnos.");
        }
        $this->render($view, array(
            'model' => $model
        ));
    }

    public function actionPassword() {
        $model = new PasswordForm();
        if (Yii::app()->request->getPost('PasswordForm')) {
            $model->setAttributes(Yii::app()->request->getPost('PasswordForm'));
            if ($model->validate()) {
                Usuario::model()->updateByPk(Yii::app()->user->id,
                    array(
                        'pass' => md5($model->password)
                    ));
                Yii::app()->user->setFlash('success', 'Su contraseña se cambio satisfactoriamente.');
                $this->redirect(Yii::app()->homeUrl);
            } else {
                Yii::app()->user->setFlash('danger',
                    'No se pudo cambiar su contraseña. <br>Verifique los datos ingresados.');
            }
        }
        $this->render('password', array(
            'model' => $model
        ));
    }

}
