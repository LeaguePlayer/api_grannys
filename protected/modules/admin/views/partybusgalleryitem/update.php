<?php
$this->breadcrumbs=array(
	"Фотогалереи"=>array('list'),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('list')),

);
?>

<h1>Редактирование галереи</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>