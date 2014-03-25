<?php
/* @var $this IcemanPlacesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Iceman Places',
);

$this->menu=array(
	array('label'=>'Create IcemanPlaces', 'url'=>array('create')),
	array('label'=>'Manage IcemanPlaces', 'url'=>array('admin')),
);
?>

<h1>Iceman Places</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
