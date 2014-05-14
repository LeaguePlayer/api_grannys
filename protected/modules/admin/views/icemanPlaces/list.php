<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление точками продаж IceMan</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'iceman-places-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('icemanplaces')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		array(
				'name'=>'name',
				'type'=>'raw',
				'value'=>'CHtml::link($data->name, array("/admin/icemanPlaces/update/id/{$data->id}"))',
			
		),
		
		'street',
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'IcemanPlaces::getStatusAliases($data->status)',
			'filter'=>IcemanPlaces::getStatusAliases()
		),
		
		array(
			'name'=>'create_time',
			'type'=>'raw',
			'value'=>'$data->create_time ? SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time)) : ""'
		),
		array(
			'name'=>'update_time',
			'type'=>'raw',
			'value'=>'$data->update_time ? SiteHelper::russianDate($data->update_time).\' в \'.date(\'H:i\', strtotime($data->update_time)) : ""'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>"{update} {delete}",
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("icemanplaces");', CClientScript::POS_END) ;?>