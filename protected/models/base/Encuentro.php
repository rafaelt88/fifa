<?php
/**
 * @property integer $id_partido
 * @property integer $id_equipo
 * @property integer $goles
 * @property boolean $tipo
 *
 * @property Equipo $equipo
 * @property Partido $partido
 */

class Encuentro extends ActiveRecord{

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'encuentro';
	}

	public function rules() {
		return array(
		array('id_partido, id_equipo, tipo', 'required'),
		array('id_partido, id_equipo, goles, tipo', 'numerical', 'integerOnly' => true),
		array('tipo', 'boolean', 'allowEmpty' => true),
		array('id_equipo', 'exist', 'allowEmpty' => true, 'attributeName' => 'id', 'className' => 'Equipo'),
		array('id_partido', 'exist', 'allowEmpty' => true, 'attributeName' => 'id', 'className' => 'Partido'),
		array('id_partido, id_equipo, goles, tipo', 'safe', 'on' => 'search'),
		);
	}

	public function relations() {
		return array(
		'equipo' => array(self::BELONGS_TO, 'Equipo', 'id_equipo'),
		'partido' => array(self::BELONGS_TO, 'Partido', 'id_partido'),
		);
	}
	
	public function attributeLabels() {
		return array(
		'id_partido' => Yii::t('models.Encuentro', 'id_partido'),
		'id_equipo' => Yii::t('models.Encuentro', 'id_equipo'),
		'goles' => Yii::t('models.Encuentro', 'goles'),
		'tipo' => Yii::t('models.Encuentro', 'tipo'),
		);
	}

	public function search() {
		$criteria=new CDbCriteria;
		$criteria->compare('id_partido', $this->id_partido);
		$criteria->compare('id_equipo', $this->id_equipo);
		$criteria->compare('goles', $this->goles);
		$criteria->compare('tipo', $this->tipo);
		return new CActiveDataProvider($this, array('criteria' => $criteria,));
	}
	
	public static function lists($data = null, $key = null) {
		switch ($data) {
			case 'tipo':
				$lists = json_decode('{"es":["Local","Visitante"]}', true);
				$data = $lists[Yii::app()->language];
				return array_key_exists($key, $data)?$data[$key]:$data;
				break;
			default:
				return false;
		}
	}
}