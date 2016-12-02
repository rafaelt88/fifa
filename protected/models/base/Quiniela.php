<?php
/**
 * @property integer $id
 * @property integer $numero
 * @property boolean $activo
 * @property integer $id_usuario
 *
 * @property Partido[] $partidos
 * @property Usuario $usuario
 */

class Quiniela extends ActiveRecord{

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'quiniela';
	}

	public function rules() {
		return array(
		array('numero, activo, id_usuario', 'required'),
		array('numero, activo, id_usuario', 'numerical', 'integerOnly' => true),
		array('activo', 'boolean', 'allowEmpty' => true),
		array('numero', 'unique'),
		array('id_usuario', 'exist', 'allowEmpty' => true, 'attributeName' => 'id', 'className' => 'Usuario'),
		array('id, numero, activo, id_usuario', 'safe', 'on' => 'search'),
		);
	}

	public function relations() {
		return array(
		'partidos' => array(self::MANY_MANY, 'Partido', 'resultado(id_quiniela, id_partido)'),
		'usuario' => array(self::BELONGS_TO, 'Usuario', 'id_usuario'),
		);
	}
	
	public function attributeLabels() {
		return array(
		'id' => Yii::t('models.Quiniela', 'id'),
		'numero' => Yii::t('models.Quiniela', 'numero'),
		'activo' => Yii::t('models.Quiniela', 'activo'),
		'id_usuario' => Yii::t('models.Quiniela', 'id_usuario'),
		);
	}

	public function search() {
		$criteria=new CDbCriteria;
		$criteria->compare('id', $this->id);
		$criteria->compare('numero', $this->numero);
		$criteria->compare('activo', $this->activo);
		$criteria->compare('id_usuario', $this->id_usuario);
		return new CActiveDataProvider($this, array('criteria' => $criteria,));
	}
	
	public static function lists($data = null, $key = null) {
		switch ($data) {
			case 'activo':
				$lists = json_decode('{"es":["No","Si"]}', true);
				$data = $lists[Yii::app()->language];
				return array_key_exists($key, $data)?$data[$key]:$data;
				break;
			default:
				return false;
		}
	}
}