<?php

/**
* This is the model class for table "galleries_items".
*
* The followings are the available columns in table 'galleries_items':
    * @property integer $id
    * @property integer $page
    * @property integer $item_id
    * @property string $filename
    * @property integer $user
    * @property integer $time
    * @property integer $views
    * @property string $ext
    * @property string $thumb_prefix
    * @property integer $sort
    * @property string $alt
    * @property string $title
    * @property string $description
    * @property integer $just_added
    * @property string $d1
    * @property string $d2
    * @property string $d3
    * @property string $d4
    * @property string $d5
    * @property string $d6
    * @property string $d7
    * @property string $d8
*/
class GalleriesItems extends EActiveRecord
{
    public function tableName()
    {
        return 'galleries_items';
    }


    public function rules()
    {
        return array(
            array('page, item_id, filename, time, ext, thumb_prefix, alt, title, description, d1, d2, d3, d4, d5, d6, d7, d8', 'required'),
            array('page, item_id, user, time, views, sort, just_added', 'numerical', 'integerOnly'=>true),
            array('filename, alt, title, d1, d2, d3, d4, d5, d6, d7, d8', 'length', 'max'=>255),
            array('ext', 'length', 'max'=>10),
            array('thumb_prefix', 'length', 'max'=>24),
            // The following rule is used by search().
            array('id, page, item_id, filename, user, time, views, ext, thumb_prefix, sort, alt, title, description, just_added, d1, d2, d3, d4, d5, d6, d7, d8', 'safe', 'on'=>'search'),
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
            'item_id' => 'Item',
            'filename' => 'Filename',
            'user' => 'User',
            'time' => 'Time',
            'views' => 'Views',
            'ext' => 'Ext',
            'thumb_prefix' => 'Thumb Prefix',
            'sort' => 'Sort',
            'alt' => 'Alt',
            'title' => 'Title',
            'description' => 'Description',
            'just_added' => 'Just Added',
            'd1' => 'D1',
            'd2' => 'D2',
            'd3' => 'D3',
            'd4' => 'D4',
            'd5' => 'D5',
            'd6' => 'D6',
            'd7' => 'D7',
            'd8' => 'D8',
        );
    }



    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('page',$this->page);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('user',$this->user);
		$criteria->compare('time',$this->time);
		$criteria->compare('views',$this->views);
		$criteria->compare('ext',$this->ext,true);
		$criteria->compare('thumb_prefix',$this->thumb_prefix,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('alt',$this->alt,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('just_added',$this->just_added);
		$criteria->compare('d1',$this->d1,true);
		$criteria->compare('d2',$this->d2,true);
		$criteria->compare('d3',$this->d3,true);
		$criteria->compare('d4',$this->d4,true);
		$criteria->compare('d5',$this->d5,true);
		$criteria->compare('d6',$this->d6,true);
		$criteria->compare('d7',$this->d7,true);
		$criteria->compare('d8',$this->d8,true);
        $criteria->order = 'sort';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    public function getDbConnection()
    {
    return Yii::app()->grannys;
    }


    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


}
