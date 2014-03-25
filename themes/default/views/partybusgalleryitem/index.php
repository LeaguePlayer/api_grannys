<?php
/* @var $this PartybusgalleryitemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Partybusgalleryitems',
);

$this->menu=array(
	array('label'=>'Create Partybusgalleryitem', 'url'=>array('create')),
	array('label'=>'Manage Partybusgalleryitem', 'url'=>array('admin')),
);
?>

<h1>Partybusgalleryitems</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
