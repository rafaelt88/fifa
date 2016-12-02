<?php
/**
 * @property integer $id
 * @property string $letra
 *
 * @property Equipo[] $equipos
 */

class Grupo extends ActiveRecord{

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'grupo';
	}

	public function rules() {
		return array(
		array('letra', 'required'),
		array('id, letra', 'safe', 'on' => 'search'),
		);
	}

	public function relations() {
		return array(
		'equipos' => array(self::HAS_MANY, 'Equipo', 'id_grupo'),
		);
	}
	
	public function attributeLabels() {
		return array(
		'id' => Yii::t('models.Grupo', 'id'),
		'letra' => Yii::t('models.Grupo', 'letra'),
		);
	}

	public function search() {
		$criteria=new CDbCriteria;
		$criteria->compare('id', $this->id);
		$criteria->compare('letra', $this->letra, true);
		return new CActiveDataProvider($this, array('criteria' => $criteria,));
	}
	
}