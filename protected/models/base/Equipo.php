<?php
/**
 * @property integer $id
 * @property string $nombre
 * @property integer $id_grupo
 *
 * @property Partido[] $partidos
 * @property Grupo $grupo
 */

class Equipo extends ActiveRecord{

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'equipo';
	}

	public function rules() {
		return array(
		array('nombre', 'required'),
		array('id_grupo', 'numerical', 'integerOnly' => true),
		array('nombre', 'length', 'max' => 50),
		array('id_grupo', 'exist', 'allowEmpty' => true, 'attributeName' => 'id', 'className' => 'Grupo'),
		array('id, nombre, id_grupo', 'safe', 'on' => 'search'),
		);
	}

	public function relations() {
		return array(
		'partidos' => array(self::MANY_MANY, 'Partido', 'encuentro(id_equipo, id_partido)'),
		'grupo' => array(self::BELONGS_TO, 'Grupo', 'id_grupo'),
		);
	}
	
	public function attributeLabels() {
		return array(
		'id' => Yii::t('models.Equipo', 'id'),
		'nombre' => Yii::t('models.Equipo', 'nombre'),
		'id_grupo' => Yii::t('models.Equipo', 'id_grupo'),
		);
	}

	public function search() {
		$criteria=new CDbCriteria;
		$criteria->compare('id', $this->id);
		$criteria->compare('nombre', $this->nombre, true);
		$criteria->compare('id_grupo', $this->id_grupo);
		return new CActiveDataProvider($this, array('criteria' => $criteria,));
	}
	
}