<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Меню Grannys Bar</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'boardmenu-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('boardmenu')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		array(
			'name'=>'id_type',
			'type'=>'raw',
			'value'=>'SiteHelper::getCategoryBoardmenu($data->id_type)',
			'filter'=>SiteHelper::getCategoryBoardmenu()
		),
		array(
			'name'=>'title',
			'type'=>'raw',
			'value'=>'CHtml::link($data->title, array("/admin/boardmenu/update/id/{$data->id}"))',
			
		),
		
		'price',
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Boardmenu::getStatusAliases($data->status)',
			'filter'=>Boardmenu::getStatusAliases()
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

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("boardmenu");', CClientScript::POS_END) ;?>