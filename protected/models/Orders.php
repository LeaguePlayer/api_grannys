<?php

/**
* This is the model class for table "{{orders}}".
*
* The followings are the available columns in table '{{orders}}':
    * @property integer $id
    * @property string $type_order
    * @property string $name
    * @property string $phone
    * @property string $params
    * @property string $create_time
    * @property string $update_time
*/
class Orders extends EActiveRecord
{
    public function tableName()
    {
        return '{{orders}}';
    }


    public function rules()
    {
        return array(
            array('type_order, name, phone', 'length', 'max'=>255),
            array('params, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, type_order, name, phone, params, create_time, update_time', 'safe', 'on'=>'search'),
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
            'type_order' => 'Тип заявки',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'params' => 'Параметры',
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
		$criteria->compare('type_order',$this->type_order,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'id DESC',
			),
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
	
	
	public $array_with_values_of_param = array(
													"hours"=>"Количество часов",
													"reason"=>"Повод заказа",
													"category"=>"Категория вечеринки",
													"comment"=>"Комментарий к заказу",
													"mans"=>"Количество человек",
												
											);

	public function convertParams()
	{
		$result = array();
		foreach(unserialize($this->params) as $key => $value)
			$result[$this->array_with_values_of_param[$key]] = $value;
		
		return $result;
	
	}

}
