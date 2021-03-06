<?php

/**
* This is the model class for table "{{barshop}}".
*
* The followings are the available columns in table '{{barshop}}':
    * @property integer $id
    * @property string $title
    * @property integer $price
    * @property integer $fixed_price
    * @property string $img_preview
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Barshop extends EActiveRecord
{
    public function tableName()
    {
        return '{{barshop}}';
    }


    public function rules()
    {
        return array(
            array('price, fixed_price, status, id_category, sort', 'numerical', 'integerOnly'=>true),
            array('title, img_preview', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, title, price, fixed_price, img_preview, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
            'title' => 'Название позиции',
            'price' => 'Цена',
            'fixed_price' => 'Является окончательной ценой',
            'img_preview' => 'Изображение',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
			'id_category'=>'Категория товара',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
			'imgBehaviorPreview' => array(
				'class' => 'application.behaviors.UploadableImageBehavior',
				'attributeName' => 'img_preview',
				'versions' => array(
					'icon' => array(
						'centeredpreview' => array(90, 90),
					),
					'small' => array(
						'resize' => array(200, 180),
					),
					'medium' => array(
						'resize' => array(87, 87),
					)
				),
			),
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('fixed_price',$this->fixed_price);
		$criteria->compare('img_preview',$this->img_preview,true);
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
	
	public static function getCategory($n = false)
	{
		$array = array( 'Барный инвентарь'=>array(0=>'Барный инвентарь', 1=>'Инвентарь для бариста'), 2=>'Кофе, горячий шоколад', 'Сиропы'=>array(3=>'Барная вишня',4=>'Сиропы марки "Barline"', 5=>'Сиропы марки "MONIN", Франция'), 'Чай'=>array(6=>'Весовой чай торговой марки Tea Garten',7=>'Пакетированный чай торговой марки SVAY'),'Чай весовой'=>array(8=>'Черный чай', 9=>'Зеленый чай', 10=>'Фруктовый чай, ароматизированный', 11=>'Травяной чай, ароматизированный'), 12=>'Расходные материалы' );	
		
		if(is_numeric($n))
		{
			foreach($array as $key => $value)
			{
				
				
					if(is_array($value))
					{
						if(in_array($n, array_keys($value)))
						{
							return $value[$n];
							break;
						}
					}
					elseif($key == $n)
					{
						return $value;	
					}
			}
		}
		else
			return $array;
		
		
	}


}
