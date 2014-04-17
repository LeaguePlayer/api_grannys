<?php

/**
* This is the model class for table "{{boardmenu_composition}}".
*
* The followings are the available columns in table '{{boardmenu_composition}}':
    * @property integer $id
    * @property integer $id_boardmenu
    * @property string $title
    * @property double $composition
    * @property string $parameter
*/
class BoardmenuComposition extends EActiveRecord
{
    public function tableName()
    {
        return '{{boardmenu_composition}}';
    }


    public function rules()
    {
        return array(
            array('id_boardmenu, title, parameter', 'required'),
            array('id_boardmenu', 'numerical', 'integerOnly'=>true),
            array('composition', 'numerical'),
            array('title', 'length', 'max'=>255),
            array('parameter', 'length', 'max'=>50),
            // The following rule is used by search().
            array('id, id_boardmenu, title, composition, parameter', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'id_boardmenu' => 'Id Boardmenu',
            'title' => 'Title',
            'composition' => 'Composition',
            'parameter' => 'Parameter',
        );
    }



    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('id_boardmenu',$this->id_boardmenu);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('composition',$this->composition);
		$criteria->compare('parameter',$this->parameter,true);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


}
