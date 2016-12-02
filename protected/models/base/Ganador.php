<?php
/**
 * @property integer $id_quiniela
 * @property integer $id_partido
 * @property integer $id_equipo
 *
 * @property Equipo $equipo
 * @property Partido $partido
 * @property Quiniela $quiniela
 */

class Ganador extends ActiveRecord{

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'ganador';
	}

	public function rules() {
		return array(
		array('id_quiniela, id_partido', 'required'),
		array('id_quiniela, id_partido, id_equipo', 'numerical', 'integerOnly' => true),
		array('id_equipo', 'exist', 'allowEmpty' => true, 'attributeName' => 'id', 'className' => 'Equipo'),
		array('id_partido', 'exist', 'allowEmpty' => true, 'attributeName' => 'id', 'className' => 'Partido'),
		array('id_quiniela', 'exist', 'allowEmpty' => true, 'attributeName' => 'id', 'className' => 'Quiniela'),
		array('id_quiniela, id_partido, id_equipo', 'safe', 'on' => 'search'),
		);
	}

	public function relations() {
		return array(
		'equipo' => array(self::BELONGS_TO, 'Equipo', 'id_equipo'),
		'partido' => array(self::BELONGS_TO, 'Partido', 'id_partido'),
		'quiniela' => array(self::BELONGS_TO, 'Quiniela', 'id_quiniela'),
		);
	}
	
	public function attributeLabels() {
		return array(
		'id_quiniela' => Yii::t('models.Ganador', 'id_quiniela'),
		'id_partido' => Yii::t('models.Ganador', 'id_partido'),
		'id_equipo' => Yii::t('models.Ganador', 'id_equipo'),
		);
	}

	public function search() {
		$criteria=new CDbCriteria;
		$criteria->compare('id_quiniela', $this->id_quiniela);
		$criteria->compare('id_partido', $this->id_partido);
		$criteria->compare('id_equipo', $this->id_equipo);
		return new CActiveDataProvider($this, array('criteria' => $criteria,));
	}
	
}