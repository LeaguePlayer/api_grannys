<?php
/**
 * Миграция m140513_092014_config_values
 *
 * @property string $prefix
 */
 
class m140513_092014_config_values extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	
    public function safeUp()
    {
       $this->insert("{{config}}", array("param"=>"grannys.street", "value"=>"г. Тюмень, ул. Мельникайте 98", "default"=>"", "label"=>"Адрес Grannys Bar", "type"=>"string", "variants"=>"") );
	   
	   $this->insert("{{config}}", array("param"=>"barservice.street", "value"=>"г. Тюмень, ул. Мельникайте 98", "default"=>"", "label"=>"Адрес Bar Service", "type"=>"string", "variants"=>"") );
	   
	   $this->insert("{{config}}", array("param"=>"app.email", "value"=>"", "default"=>"", "label"=>"E-Mail администратора (сюда будут приходить заявки)", "type"=>"string", "variants"=>"") );

    }
 
    public function safeDown()
    {
        
    }
 
    /**
     * Удаляет таблицы, указанные в $this->dropped из базы.
     * Наименование таблиц могут сожержать двойные фигурные скобки для указания
     * необходимости добавления префикса, например, если указано имя {{table}}
     * в действительности будет удалена таблица 'prefix_table'.
     * Префикс таблиц задается в файле конфигурации (для консоли).
     */
   
 
    /**
     * Добавляет префикс таблицы при необходимости
     * @param $name - имя таблицы, заключенное в скобки, например {{имя}}
     * @return string
     */
    protected function tableName($name)
    {
        if($this->getDbConnection()->tablePrefix!==null && strpos($name,'{{')!==false)
            $realName=preg_replace('/{{(.*?)}}/',$this->getDbConnection()->tablePrefix.'$1',$name);
        else
            $realName=$name;
        return $realName;
    }
 
    /**
     * Получение установленного префикса таблиц базы данных
     * @return mixed
     */
    protected function getPrefix(){
        return $this->getDbConnection()->tablePrefix;
    }
}