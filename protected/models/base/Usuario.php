<?php
/**
 * @property integer $id
 * @property string $cedula
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $pass
 *
 * @property Quiniela[] $quinielas
 */

class Usuario extends ActiveRecord{

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'usuario';
	}

	public function rules() {
		return array(
		array('cedula, nombre, apellido, email, pass', 'required'),
		array('nombre, apellido, pass', 'length', 'max' => 32),
		array('email', 'length', 'max' => 90),
		array('cedula, email', 'unique'),
		array('email', 'email'),
		array('email', 'filter', 'filter' => 'strtolower'),
		array('nombre, apellido', 'filter', 'filter' => 'ucwords'),
		array('id, cedula, nombre, apellido, email, pass', 'safe', 'on' => 'search'),
		);
	}

	public function relations() {
		return array(
		'quinielas' => array(self::HAS_MANY, 'Quiniela', 'id_usuario'),
		);
	}
	
	public function attributeLabels() {
		return array(
		'id' => Yii::t('models.Usuario', 'id'),
		'cedula' => Yii::t('models.Usuario', 'cedula'),
		'nombre' => Yii::t('models.Usuario', 'nombre'),
		'apellido' => Yii::t('models.Usuario', 'apellido'),
		'email' => Yii::t('models.Usuario', 'email'),
		'pass' => Yii::t('models.Usuario', 'pass'),
		);
	}

	public function search() {
		$criteria=new CDbCriteria;
		$criteria->compare('id', $this->id);
		$criteria->compare('cedula', $this->cedula, true);
		$criteria->compare('nombre', $this->nombre, true);
		$criteria->compare('apellido', $this->apellido, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('pass', $this->pass, true);
		return new CActiveDataProvider($this, array('criteria' => $criteria,));
	}
	
}