<?php
$this->breadcrumbs=array(
	"Меню Grannys Bar"=>array('list'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('list')),
);
?>

<h1>Добавление позиции</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>