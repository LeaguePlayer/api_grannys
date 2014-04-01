<?php
/* @var $this BoardmenuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Boardmenus',
);

$this->menu=array(
	array('label'=>'Create Boardmenu', 'url'=>array('create')),
	array('label'=>'Manage Boardmenu', 'url'=>array('admin')),
);
?>

<h1>Boardmenus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
