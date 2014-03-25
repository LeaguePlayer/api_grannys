<?php
$this->breadcrumbs=array(
	'Partybusgalleryitems'=>array('index'),
	$model->name,
);

<h1>View Partybusgalleryitem #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'gllr_gallery_id',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
