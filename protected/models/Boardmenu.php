<?php

/**
* This is the model class for table "{{boardmenu}}".
*
* The followings are the available columns in table '{{boardmenu}}':
    * @property integer $id
    * @property integer $id_type
    * @property string $title
    * @property string $price
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Boardmenu extends EActiveRecord
{
    public function tableName()
    {
        return '{{boardmenu}}';
    }


    public function rules()
    {
        return array(
			array('id_type, title', 'required'),
            array('id_type, status, sort', 'numerical', 'integerOnly'=>true),
            array('title', 'length', 'max'=>255),
            array('price', 'length', 'max'=>10),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, id_type, title, price, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
			  'composition' => array(self::HAS_MANY, 'BoardmenuComposition', 'id_boardmenu', 'order' => '`id` DESC'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'id_type' => 'Категория товара',
            'title' => 'Название продукта',
            'price' => 'Стоимость продукта',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
                'setUpdateOnCreate' => true,
			),
        ));
    }

    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('id_type',$this->id_type);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = 'sort';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


}
