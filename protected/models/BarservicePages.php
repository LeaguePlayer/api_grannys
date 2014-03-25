<?php

/**
* This is the model class for table "pages".
*
* The followings are the available columns in table 'pages':
    * @property integer $id
    * @property string $title
    * @property string $name
    * @property string $rusname
    * @property integer $component
    * @property string $template
    * @property string $outtemplate
    * @property integer $parent
    * @property string $description
    * @property string $path
    * @property integer $isfolder
    * @property integer $hidden
    * @property integer $user_create
    * @property integer $time_create
    * @property integer $show_childs
    * @property integer $show_as_child
    * @property integer $sort
    * @property string $titlepic
    * @property integer $titlepic_w
    * @property integer $titlepic_h
    * @property integer $modified
    * @property string $changefreq
    * @property double $priority
    * @property integer $visible_in_sitemap
    * @property string $seo_desc
    * @property string $seo_keywords
    * @property string $og_image
*/
class BarservicePages extends EActiveRecord
{
    public function tableName()
    {
        return 'pages';
    }


    public function rules()
    {
        return array(
            array('title, name, rusname, component, template, outtemplate, parent, description, path, user_create, time_create, titlepic, titlepic_w, titlepic_h, seo_desc, seo_keywords, og_image', 'required'),
            array('component, parent, isfolder, hidden, user_create, time_create, show_childs, show_as_child, sort, titlepic_w, titlepic_h, modified, visible_in_sitemap', 'numerical', 'integerOnly'=>true),
            array('priority', 'numerical'),
            array('title, name, template', 'length', 'max'=>200),
            array('rusname, changefreq', 'length', 'max'=>250),
            array('outtemplate', 'length', 'max'=>50),
            array('titlepic, og_image', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, title, name, rusname, component, template, outtemplate, parent, description, path, isfolder, hidden, user_create, time_create, show_childs, show_as_child, sort, titlepic, titlepic_w, titlepic_h, modified, changefreq, priority, visible_in_sitemap, seo_desc, seo_keywords, og_image', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
			'content' => array(self::HAS_ONE, 'BarservicePageParams', 'page', 'condition'=>"content.name = 'content'"),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'name' => 'Name',
            'rusname' => 'Rusname',
            'component' => 'Component',
            'template' => 'Template',
            'outtemplate' => 'Outtemplate',
            'parent' => 'Parent',
            'description' => 'Description',
            'path' => 'Path',
            'isfolder' => 'Isfolder',
            'hidden' => 'Hidden',
            'user_create' => 'User Create',
            'time_create' => 'Time Create',
            'show_childs' => 'Show Childs',
            'show_as_child' => 'Show As Child',
            'sort' => 'Sort',
            'titlepic' => 'Titlepic',
            'titlepic_w' => 'Titlepic W',
            'titlepic_h' => 'Titlepic H',
            'modified' => 'Modified',
            'changefreq' => 'Changefreq',
            'priority' => 'Priority',
            'visible_in_sitemap' => 'Visible In Sitemap',
            'seo_desc' => 'Seo Desc',
            'seo_keywords' => 'Seo Keywords',
            'og_image' => 'Og Image',
        );
    }



    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('rusname',$this->rusname,true);
		$criteria->compare('component',$this->component);
		$criteria->compare('template',$this->template,true);
		$criteria->compare('outtemplate',$this->outtemplate,true);
		$criteria->compare('parent',$this->parent);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('isfolder',$this->isfolder);
		$criteria->compare('hidden',$this->hidden);
		$criteria->compare('user_create',$this->user_create);
		$criteria->compare('time_create',$this->time_create);
		$criteria->compare('show_childs',$this->show_childs);
		$criteria->compare('show_as_child',$this->show_as_child);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('titlepic',$this->titlepic,true);
		$criteria->compare('titlepic_w',$this->titlepic_w);
		$criteria->compare('titlepic_h',$this->titlepic_h);
		$criteria->compare('modified',$this->modified);
		$criteria->compare('changefreq',$this->changefreq,true);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('visible_in_sitemap',$this->visible_in_sitemap);
		$criteria->compare('seo_desc',$this->seo_desc,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
		$criteria->compare('og_image',$this->og_image,true);
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
