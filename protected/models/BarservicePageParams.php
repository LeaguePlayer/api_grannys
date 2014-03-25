<?php

/**
* This is the model class for table "page_params".
*
* The followings are the available columns in table 'page_params':
    * @property integer $id
    * @property integer $page
    * @property string $name
    * @property string $title
    * @property string $desc
    * @property string $value
*/
class BarservicePageParams extends EActiveRecord
{
    public function tableName()
    {
        return 'page_params';
    }


    public function rules()
    {
        return array(
            array('page, name, title, desc, value', 'required'),
            array('page', 'numerical', 'integerOnly'=>true),
            array('title, desc', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, page, name, title, desc, value', 'safe', 'on'=>'search'),
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
            'page' => 'Page',
            'name' => 'Name',
            'title' => 'Title',
            'desc' => 'Desc',
            'value' => 'Value',
        );
    }



    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('page',$this->page);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('value',$this->value,true);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    public function getDbConnection()
    {
    return Yii::app()->barservice;
    }


    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


}
