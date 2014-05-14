<?php
$this->breadcrumbs=array(
	"Точки продаж IceMan"=>array('list'),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('list')),
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Редактирование точки продаж</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>