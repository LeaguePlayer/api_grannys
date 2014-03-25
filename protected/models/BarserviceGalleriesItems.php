<?php

/**
* This is the model class for table "galleries_items".
*
* The followings are the available columns in table 'galleries_items':
    * @property integer $id
    * @property integer $page
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
*/
class BarserviceGalleriesItems extends EActiveRecord
{
    public function tableName()
    {
        return 'galleries_items';
    }


    public function rules()
    {
        return array(
            array('page, filename, time, ext, thumb_prefix, alt, title, description', 'required'),
            array('page, user, time, views, sort, just_added', 'numerical', 'integerOnly'=>true),
            array('filename, alt, title', 'length', 'max'=>255),
            array('ext', 'length', 'max'=>10),
            array('thumb_prefix', 'length', 'max'=>24),
            // The following rule is used by search().
            array('id, page, filename, user, time, views, ext, thumb_prefix, sort, alt, title, description, just_added', 'safe', 'on'=>'search'),
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
        );
    }



    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('page',$this->page);
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
        $criteria->order = 'sort';
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
