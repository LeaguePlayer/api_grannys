<?php
/* @var $this BarshopController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Barshops',
);

$this->menu=array(
	array('label'=>'Create Barshop', 'url'=>array('create')),
	array('label'=>'Manage Barshop', 'url'=>array('admin')),
);
?>

<h1>Barshops</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
