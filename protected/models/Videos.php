<?php

/**
* This is the model class for table "{{videos}}".
*
* The followings are the available columns in table '{{videos}}':
    * @property integer $id
    * @property string $id_type
    * @property string $title
    * @property string $video_string
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Videos extends EActiveRecord
{
    public function tableName()
    {
        return '{{videos}}';
    }


    public function rules()
    {
        return array(
			array('video_string', 'required'),
            array('status, sort', 'numerical', 'integerOnly'=>true),
            array('id_type, title', 'length', 'max'=>255),
            array('video_string, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, id_type, title, video_string, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
            'id_type' => 'Относится к',
            'title' => 'Заголовок',
            'video_string' => 'Ссылка на видео YouTube',
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
		$criteria->compare('id_type',$this->id_type,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('video_string',$this->video_string,true);
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
	
	
	
	public static function relationTo($n=false)
	{
		$array = array('Grannys Bar', 'BarService', 'PartyBus');
		
		if( is_numeric ($n) )
			return $array[$n];
		else
			return $array;
	}


}
