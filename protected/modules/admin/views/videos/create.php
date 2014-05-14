<?php
$this->breadcrumbs=array(
	"Видеогалерея"=>array('list'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('list')),
);
?>

<h1>Добавление видео</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>