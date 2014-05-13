<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->name,
);

<h1>View Orders #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type_order',
		'name',
		'phone',
		'params',
		'create_time',
		'update_time',
	),
)); ?>
