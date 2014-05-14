<?php
$this->breadcrumbs=array(
	'Videoses'=>array('index'),
	$model->title,
);

<h1>View Videos #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_type',
		'title',
		'video_string',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
