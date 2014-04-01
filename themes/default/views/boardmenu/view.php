<?php
$this->breadcrumbs=array(
	'Boardmenus'=>array('index'),
	$model->title,
);

<h1>View Boardmenu #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_type',
		'title',
		'price',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
