<h1>Управление фотогалереями</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'partybusgalleryitem-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('partybusgalleryitem')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		array(
			'name'=>'name',
			'type'=>'raw',
			'value'=>'CHtml::link($data->name, array("/admin/partybusgalleryitem/update/id/{$data->id}"))',
			
		),
		
		
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Partybusgalleryitem::getStatusAliases($data->status)',
			'filter'=>Partybusgalleryitem::getStatusAliases()
		),
		
		
		array(
			'name'=>'update_time',
			'type'=>'raw',
			'value'=>'$data->update_time ? SiteHelper::russianDate($data->update_time).\' в \'.date(\'H:i\', strtotime($data->update_time)) : ""'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>"{update}",
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("partybusgalleryitem");', CClientScript::POS_END) ;?>