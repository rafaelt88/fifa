<?php
/**
 * @property integer $id
 * @property string $fecha
 * @property string $fase
 * @property integer $id_equipo
 *
 * @property Equipo[] $equipos
 * @property Quiniela[] $quinielas
 * @property Equipo $equipo
 */

class Partido extends ActiveRecord{

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'partido';
	}

	public function rules() {
		return array(
		array('fecha, fase', 'required'),
		array('id_equipo', 'numerical', 'integerOnly' => true),
		array('fecha', 'date', 'format' => 'dd/mm/yyyy'),
		array('id_equipo', 'exist', 'allowEmpty' => true, 'attributeName' => 'id', 'className' => 'Equipo'),
		array('id, fecha, fase, id_equipo', 'safe', 'on' => 'search'),
		);
	}

	public function relations() {
		return array(
		'equipos' => array(self::MANY_MANY, 'Equipo', 'encuentro(id_partido, id_equipo)'),
		'quinielas' => array(self::MANY_MANY, 'Quiniela', 'resultado(id_partido, id_quiniela)'),
		'equipo' => array(self::BELONGS_TO, 'Equipo', 'id_equipo'),
		);
	}
	
	public function attributeLabels() {
		return array(
		'id' => Yii::t('models.Partido', 'id'),
		'fecha' => Yii::t('models.Partido', 'fecha'),
		'fase' => Yii::t('models.Partido', 'fase'),
		'id_equipo' => Yii::t('models.Partido', 'id_equipo'),
		);
	}

	public function search() {
		$criteria=new CDbCriteria;
		$criteria->compare('id', $this->id);
		$criteria->compare('fecha', $this->fecha);
		$criteria->compare('fase', $this->fase, true);
		$criteria->compare('id_equipo', $this->id_equipo);
		return new CActiveDataProvider($this, array('criteria' => $criteria,));
	}
	
	public static function lists($data = null, $key = null) {
		switch ($data) {
			case 'fase':
				$lists = json_decode('{"es":{"0":"Grupos","1":"Octavos","2":"Cuartos","3":"Semi-Final","4":"Final Tercer Lugar","5":"Final"}', true);
				$data = $lists[Yii::app()->language];
				return array_key_exists($key, $data)?$data[$key]:$data;
				break;
			default:
				return false;
		}
	}
}