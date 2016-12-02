<?php

class ActiveRecord extends CActiveRecord {

    public function getName() {
        $name = ucwords(preg_replace('/_/', ' ', $this->tableName()));
        return $name;
    }

    public function toString() {
        return json_encode($this->getAttributes());
    }

    public function evalRelation($relation) {
        foreach ($this->relations() as $key => $val) {
            if ($relation === $key) {return $val;}
        }
    }

    public function evalAttribute($relation) {
        foreach ($this->getAttributes() as $key => $val) {
            if ($relation === $key) {return array(
                    $key,
                    $val
                );}
        }
    }

    public function getHasOne($data, $params = null) {
        return CActiveRecord::model($data[1])->findByPk($params ? $params : $this->getAttribute($data[2]));
    }

    public function getBelongTo($data, $params = null) {
        if (is_array($params)) {
            switch (count($params)) {
                case 1:
                    return Yii::app()->db->createCommand()
                        ->select($params[0])
                        ->from(CActiveRecord::model($data[1])->tableName())
                        ->queryAll();
                break;
                case 2:
                    $result = array();
                    foreach (Yii::app()->db->createCommand()
                        ->select("{$params[0]}, {$params[1]}")
                        ->from(CActiveRecord::model($data[1])->tableName())
                        ->queryAll() as $model) {
                        $result[$model[$params[0]]] = $model[$params[1]];
                    }
                    return $result;
                break;
                default:
                    $result = array();
                    foreach (Yii::app()->db->createCommand()
                        ->from(CActiveRecord::model($data[1])->tableName())
                        ->queryAll() as $model) {
                        $temp = null;
                        foreach (explode('"', $params[1]) as $var) {
                            if ($var == null) continue;
                            $temp .= isset($model[$var]) ? $model[$var] : $var;
                        }
                        $result[$model[$params[0]]] = $temp;
                    }
                    return $result;
            }
        }
        return CActiveRecord::model($data[1])->findByPk($params ? $params : $this->getAttribute($data[2]));
    }

    public function getHasMany($data, $params = null) {
        if (is_null($params)) {
            return Yii::app()->db->createCommand()
                ->from(CActiveRecord::model($data[1])->tableName())
                ->where("{$data[2]}={$this->getPrimaryKey()}")
                ->queryAll();
        } elseif (is_array($params)) {
            switch (count($params)) {
                case 1:
                    return Yii::app()->db->createCommand()
                        ->select($params[0])
                        ->from($data[1])
                        ->where("{$data[2]}={$this->getPrimaryKey()}")
                        ->queryAll();
                break;
                case 2:
                    $result = array();
                    foreach (Yii::app()->db->createCommand()
                        ->select("$params[0], $params[1]")
                        ->from(CActiveRecord::model($data[1])->tableName())
                        ->where("{$data[2]}={$this->getPrimaryKey()}")
                        ->queryAll() as $model) {
                        $result[$model[$params[0]]] = $model[$params[1]];
                    }
                    return $result;
                break;
                default:
                    $result = array();
                    foreach (Yii::app()->db->createCommand()
                        ->from(CActiveRecord::model($data[1])->tableName())
                        ->where("{$data[2]}={$this->getPrimaryKey()}")
                        ->queryAll() as $model) {
                        $temp = null;
                        foreach (explode('"', $params[1]) as $var) {
                            if ($var == null) continue;
                            $temp .= isset($model[$var]) ? $model[$var] : $var;
                        }
                        $result[$model[$params[0]]] = $temp;
                    }
                    return $result;
            }
        }
        return CActiveRecord::model($data[1])->findByPk($params);
    }

    public function getManyMany($data, $params = null) {
        $many = preg_split('/ /', preg_replace('/(\(|\)|\, )/', ' ', $data[2]));
        if (is_null($params)) {
            return Yii::app()->db->createCommand()
                ->from("{$many[0]} t")
                ->join(CActiveRecord::model($data[1])->tableName() . ' r',
                "t.{$many[2]}=r." . CActiveRecord::model($data[1])->getTableSchema()->primaryKey)
                ->where("t.{$many[1]}={$this->getPrimaryKey()}")
                ->queryAll();
        } elseif (is_array($params)) {
            switch (count($params)) {
                case 1:
                    return Yii::app()->db->createCommand()
                        ->select($params[0])
                        ->from("{$many[0]} t")
                        ->join(CActiveRecord::model($data[1])->tableName() . ' r',
                        "t.{$many[2]}=r." . CActiveRecord::model($data[1])->getTableSchema()->primaryKey)
                        ->where("t.{$many[1]}={$this->getPrimaryKey()}")
                        ->queryAll();
                break;
                default:
                    $result = array();
                    foreach (Yii::app()->db->createCommand()
                        ->select("{$params[0]}, {$params[1]}")
                        ->from("{$many[0]} t")
                        ->join(CActiveRecord::model($data[1])->tableName() . ' r',
                        "t.{$many[2]}=r." . CActiveRecord::model($data[1])->getTableSchema()->primaryKey)
                        ->where("t.{$many[1]}={$this->getPrimaryKey()}")
                        ->queryAll() as $model) {
                        $result[$model[$params[0]]] = $model[$params[1]];
                    }
                    return $result;
            }
        }
        return CActiveRecord::model($data[1])->findByPk($params);
    }

    public function getList($data, $params) {
        if ($data[1] === 'list') {return $this->lists($data[0]);}
        return $this->lists($data[0], $params ? $params : $data[1]);
    }

    public function get($relation, $params = null) {
        $data = $this->evalRelation($relation);
        $data = $data ? $data : $this->evalAttribute($relation);
        switch ($data[0]) {
            case CActiveRecord::HAS_ONE:
                return $this->getHasOne($data);
            break;
            case CActiveRecord::BELONGS_TO:
                return $this->getBelongTo($data, $params);
            break;
            case CActiveRecord::HAS_MANY:
                return $this->getHasMany($data, $params);
            break;
            case CActiveRecord::MANY_MANY:
                return $this->getManyMany($data, $params);
            break;
            default:
                return $this->getList($data, $params);
        }
        throw new CHttpException(400, Yii::t('yii', 'Your request is invalid.'));
    }

    public function convert() {
        foreach ($this->metaData->columns as $column => $data) {
            if (preg_match('/(update)$/', $data->name)) {
                $this->setAttribute($data->name, date('Y-m-d'));
            } elseif (is_null($this->getAttribute($data->name)) || $this->getAttribute($data->name) == '') {
                $this->setAttribute($data->name, null);
            } elseif (preg_match('/^(date)/', $data->dbType)) {
                $this->setAttribute($data->name,
                    date('Y-m-d', strtotime(preg_replace('/\//', '-', $this->getAttribute($data->name)))));
            } elseif (array_key_exists($data->name, Yii::app()->params['pattern'])) {
                $this->setAttribute($data->name, preg_replace('/[\.\-\(\)]/', null, $this->getAttribute($data->name)));
            }
        }
    }

    public function revert() {
        foreach ($this->metaData->columns as $column => $data) {
            if (is_null($this->getAttribute($data->name)) || $this->getAttribute($data->name) == '') {
                $this->setAttribute($data->name, '');
            } elseif (preg_match('/^(datetime|timestamp)/', $data->dbType)) {
                $this->setAttribute($data->name, date('d/m/Y h:i A', strtotime($this->getAttribute($data->name))));
            } elseif (preg_match('/^(date)/', $data->dbType)) {
                $this->setAttribute($data->name, date('d/m/Y', strtotime($this->getAttribute($data->name))));
            }
        }
    }

    public function afterFind() {
        if (Yii::app()->controller->getModule() != 'gii') {
            $this->revert();
        }
        return parent::afterFind();
    }

    public function beforeValidate() {
        $this->convert();
        return parent::beforeValidate();
    }

    public function afterValidate() {
        $this->revert();
        return parent::afterValidate();
    }

    public function beforeSave() {
        $this->convert();
        return parent::beforeSave();
    }

    public function debug($exit = null) {
        if (defined('YII_DEBUG') && isset($this)) {
            $model = preg_replace('/ /', null, ucwords(preg_replace('/_/', ' ', $this->tableName())));
            echo "<h3>$model</h3>";
            echo "<b><u>Attributes:</u></b><br>";
            foreach ($this->getAttributes() as $attri => $data) {
                echo "<b>$attri</b>: $data " .
                     ($this->getError($attri) ? "<i>{$this->getError($attri)}</i>" : null) .
                     "<br>";
            }
            echo "<br>";
            if (Yii::app()->request->getParam($model)) {
                echo "<b><u>" . (Yii::app()->request->getIsPostRequest() ? 'POST' : 'GET') . ": </u></b><br>" . preg_replace(
                    '/\",\"/', '"<br>"', substr(json_encode(Yii::app()->request->getParam($model)), 1, - 1)) . "<hr>";
            }
        }
        if (! is_null($exit)) {
            Yii::app()->end();
        }
    }

}
