<?php
/**
 * @property integer $id
 * @property string $nombre
 * @property string $contenido
 */

class Estadio extends ActiveRecord{

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'estadio';
	}

	public function rules() {
		return array(
		array('nombre', 'required'),
		array('nombre', 'length', 'max' => 50),
		array('id, nombre, contenido', 'safe', 'on' => 'search'),
		);
	}

	public function attributeLabels() {
		return array(
		'id' => Yii::t('models.Estadio', 'id'),
		'nombre' => Yii::t('models.Estadio', 'nombre'),
		'contenido' => Yii::t('models.Estadio', 'contenido'),
		);
	}

	public function search() {
		$criteria=new CDbCriteria;
		$criteria->compare('id', $this->id);
		$criteria->compare('nombre', $this->nombre, true);
		$criteria->compare('contenido', $this->contenido, true);
		return new CActiveDataProvider($this, array('criteria' => $criteria,));
	}
	
}