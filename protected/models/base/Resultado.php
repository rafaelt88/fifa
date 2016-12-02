<?php
/**
 * @property integer $id_partido
 * @property integer $id_quiniela
 * @property integer $goles
 * @property integer $id_equipo
 *
 * @property Equipo $equipo
 * @property Partido $partido
 * @property Quiniela $quiniela
 */

class Resultado extends ActiveRecord{

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'resultado';
	}

	public function rules() {
		return array(
		array('id_partido, id_quiniela, goles, id_equipo', 'required'),
		array('id_partido, id_quiniela, goles, id_equipo', 'numerical', 'integerOnly' => true),
		array('id_equipo', 'exist', 'allowEmpty' => true, 'attributeName' => 'id', 'className' => 'Equipo'),
		array('id_partido', 'exist', 'allowEmpty' => true, 'attributeName' => 'id', 'className' => 'Partido'),
		array('id_quiniela', 'exist', 'allowEmpty' => true, 'attributeName' => 'id', 'className' => 'Quiniela'),
		array('id_partido, id_quiniela, goles, id_equipo', 'safe', 'on' => 'search'),
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
		'id_partido' => Yii::t('models.Resultado', 'id_partido'),
		'id_quiniela' => Yii::t('models.Resultado', 'id_quiniela'),
		'goles' => Yii::t('models.Resultado', 'goles'),
		'id_equipo' => Yii::t('models.Resultado', 'id_equipo'),
		);
	}

	public function search() {
		$criteria=new CDbCriteria;
		$criteria->compare('id_partido', $this->id_partido);
		$criteria->compare('id_quiniela', $this->id_quiniela);
		$criteria->compare('goles', $this->goles);
		$criteria->compare('id_equipo', $this->id_equipo);
		return new CActiveDataProvider($this, array('criteria' => $criteria,));
	}
	
}