<?php
$this->breadcrumbs=array(
	'Iceman Places'=>array('index'),
	$model->name,
);

<h1>View IcemanPlaces #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'street',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
