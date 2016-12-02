<?php

class QuinielasController extends Controller {

    public function actionIndex() {
        $mis_quinielas = array();
        foreach (Quiniela::model()->findAllByAttributes(array(
            'id_usuario' => Yii::app()->user->id
        )) as $item) {
            $mis_quinielas[$item->id] = "Nº {$item->numero} " . ($item->activo ? '(activa)' : null);
        }
        if (Yii::app()->request->getPost('ok')) {
            try {
                $success = false;
                $transaction = Yii::app()->db->getCurrentTransaction() ? Yii::app()->db->getCurrentTransaction() : Yii::app()->db->beginTransaction();
                $quiniela = new Quiniela();
                $quiniela->activo = '0';
                $quiniela->numero = Yii::app()->db->createCommand()
                    ->select('MAX(numero)')
                    ->from('quiniela')
                    ->queryScalar() + 1;
                $quiniela->id_usuario = Yii::app()->user->id;
                if ($success = $quiniela->save()) {
                    $resultados = array();
                    for ($i = 1; $i <= 64; $i ++) {
                        $local = new Resultado();
                        $local->id_quiniela = $quiniela->id;
                        $local->id_partido = $i;
                        $local->id_equipo = Yii::app()->request->getPost("{$i}_e0");
                        $local->goles = Yii::app()->request->getPost("{$i}_0");
                        if (! $local->save()) {
                            $success = false;
                            break;
                        }
                        $rival = new Resultado();
                        $rival->id_quiniela = $quiniela->id;
                        $rival->id_partido = $i;
                        $rival->id_equipo = Yii::app()->request->getPost("{$i}_e1");
                        $rival->goles = Yii::app()->request->getPost("{$i}_1");
                        if (! $rival->save()) {
                            $success = false;
                            break;
                        }
                        $resultados[] = array(
                            $local->id_equipo,
                            $local->goles,
                            $rival->id_equipo,
                            $rival->goles
                        );
                        if ($success) switch ($i) {
                            case 57:
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = 49;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_e0");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = 50;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_e1");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                            break;
                            case 58:
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = 53;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_e0");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = 54;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_e1");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                            break;
                            case 59:
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = 51;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_e0");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = 52;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_e1");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                            break;
                            case 60:
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = 55;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_e0");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = 56;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_e1");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                            break;
                            case 61:
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = 57;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_e0");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = 58;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_e1");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                            break;
                            case 62:
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = 59;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_e0");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = 60;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_e1");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                            break;
                            case 63:
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = $i;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_win");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                                $posiciones[3] = $ganador->id_equipo;
                                $posiciones[4] = $local->id_equipo == $ganador->id_equipo ? $rival->id_equipo : $local->id_equipo;
                            break;
                            case 64:
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = 61;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_e0");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = 62;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_e1");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = $i;
                                $ganador->id_equipo = Yii::app()->request->getPost("{$i}_win");
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                                $posiciones[1] = $ganador->id_equipo;
                                $posiciones[2] = $local->id_equipo == $ganador->id_equipo ? $rival->id_equipo : $local->id_equipo;
                            break;
                            default:
                                if ($i > 48) continue;
                                $ganador = new Ganador();
                                $ganador->id_quiniela = $quiniela->id;
                                $ganador->id_partido = $i;
                                if ($local->goles > $rival->goles) {
                                    $ganador->id_equipo = $local->id_equipo;
                                } elseif ($rival->goles > $local->goles) {
                                    $ganador->id_equipo = $rival->id_equipo;
                                }
                                if (! $ganador->save()) {
                                    $success = false;
                                    break;
                                }
                        }
                    }
                }
                if ($success && Yii::app()->request->getPost("63_win") && Yii::app()->request->getPost("64_win")) {
                    $transaction->commit();
                    $this->widget('application.widgets.mail.Mail',
                        array(
                            'view' => 'quiniela',
                            'params' => array(
                                'to' => array(
                                    Yii::app()->user->email,
                                    Yii::app()->user->name
                                ),
                                'cc' => array(
                                    Yii::app()->params['email'],
                                    Yii::app()->name
                                ),
                                'resultados' => $resultados,
                                'posiciones' => $posiciones,
                                'subject' => 'Quiniela Nº ' . str_pad($quiniela->numero, 6, '0', STR_PAD_LEFT)
                            )
                        ));
                    Yii::app()->user->setFlash('success',
                        'Su quiniela se ha registrado con éxito.<br>Se le ha enviado un email con las instrucciones a seguir si desea activarla.');
                    $this->redirect(Yii::app()->homeUrl);
                } else {
                    Yii::app()->user->setFlash('danger',
                        'No se pudo registrar la quiniela. <br>Asegurese de llenar correctamente el formulario, TODOS los campos son obligatorios.<br>Si el inconveniente continua, contáctenos inmediatamente.');
                }
            } catch (Exception $e) {
                $transaction->rollback();
            }
        }
        $this->render('index', array(
            'mis_quinielas' => $mis_quinielas
        ));
    }

}