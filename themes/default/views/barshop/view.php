<?php
$this->breadcrumbs=array(
	'Barshops'=>array('index'),
	$model->title,
);

<h1>View Barshop #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'price',
		'fixed_price',
		'img_preview',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
