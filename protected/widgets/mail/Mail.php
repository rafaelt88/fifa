<?php
/**
 * Componente para el envio de emails, requiere la configuración, del servidor
 * de correos, así como los datos de una cuenta de envío.
 * $this->controller->widget('application.widgets.mail.Mail', array(
 *     'view' => 'contact',
 *     'params' => array(
 *         'to' => array(
 *             'to@example.com',
 *             'To Name'
 *         ),
 *         'cc' => array(
 *             'example@example.com, 'Example Name'
 *         ),
 *         'subject' => $model->subject
 *     )
 * ));
 * @author Rafael J Torres <rafaelt88@gmail.com>
 */
require_once 'models/PHPMailer.php';

class Mail extends CWidget {
    public $mail;
    public $view;
    public $params;

    public function init() {
        $this->mail = new PHPMailer();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->Username = 'brasil2014.tk@gmail.com';
		$this->mail->Password = 'alemania2014';
        $this->mail->Mailer = 'smtp';
        $this->mail->Port = 465;
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->CharSet = 'utf-8';
        $this->mail->ContentType = 'text/html';
    }

    public function run() {
        $this->setFrom();
        $this->setTo();
        $this->setCc();
        $this->setSubject();
        $this->setBody();
        if ($this->mail->Send()) {
            Yii::app()->user->setFlash('success', 'Su correo ha sido enviado exitosamente.');
        } else {
            Yii::app()->user->setFlash('warning', 'Su correo NO pudo ser enviado.');
        }
    }

    /**
     * Asignar la dirección de envío
     */
    public function setFrom() {
        if (isset($this->params['from'])) {
            $this->mail->SetFrom($this->params['from'][0], $this->params['from'][1]);
        } else {
            $this->mail->SetFrom($this->mail->Username, Yii::app()->name);
        }
    }

    /**
     * Asignar la(s) dirección(es) de destino
     */
    public function setTo() {
        if (count($this->params['to']) > 2) {
            foreach ($this->params['to'] as $email => $name) {
                $this->mail->AddAddress($email, $name);
            }
        } else {
            $this->mail->AddAddress($this->params['to'][0], $this->params['to'][1]);
        }
    }

    /**
     * Asignar la dirección de envío copia
     */
    public function setCc() {
        if (isset($this->params['cc'])) {
            $this->mail->AddCC($this->params['cc'][0], $this->params['cc'][1]);
        }
    }

    /**
     * Asignar el encabezado
     */
    public function setSubject() {
        if (isset($this->params['subject'])) {
            $this->mail->Subject = $this->params['subject'];
        } else {
            $this->mail->Subject = $this->t($this->view);
        }
    }

    /**
     * Asignar el cuerpo en funcion a la vista
     */
    public function setBody() {
        ob_start();
        $this->render($this->view, array(
            'params' => $this->params
        ));
        $this->mail->MsgHTML(ob_get_contents());
        ob_end_clean();
    }

}