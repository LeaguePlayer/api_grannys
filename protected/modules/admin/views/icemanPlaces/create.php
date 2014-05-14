<?php
$this->breadcrumbs=array(
	"Точки продаж IceMan"=>array('list'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('list')),
);
?>

<h1>Добавление точки продаж</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>