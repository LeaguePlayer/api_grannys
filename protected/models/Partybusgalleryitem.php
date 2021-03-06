<?php

/**
* This is the model class for table "{{partybusgalleryitem}}".
*
* The followings are the available columns in table '{{partybusgalleryitem}}':
    * @property integer $id
    * @property string $name
    * @property integer $gllr_gallery_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Partybusgalleryitem extends EActiveRecord
{
    public function tableName()
    {
        return '{{partybusgalleryitem}}';
    }


    public function rules()
    {
        return array(
            array('gllr_gallery_id, status, sort', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, name, gllr_gallery_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
            'name' => 'Название галереи',
            'gllr_gallery_id' => 'Галерея',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
			'galleryBehaviorGallery_id' => array(
				'class' => 'appext.imagesgallery.GalleryBehavior',
				'idAttribute' => 'gllr_gallery_id',
				'versions' => array(
					'small' => array(
						'adaptiveResize' => array(137, 137), 
					),
					'iphone' => array(
						'adaptiveResize' => array(320, 480),
					),
					'iphone_retina' => array(
						'adaptiveResize' => array(640, 960),
					),
					'ipad' => array(
						'adaptiveResize' => array(768, 1024),
					),
					'ipad_retina' => array(
						'adaptiveResize' => array(1536, 2048),
					),
				),
				'name' => true,
				'description' => true,
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('gllr_gallery_id',$this->gllr_gallery_id);
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
