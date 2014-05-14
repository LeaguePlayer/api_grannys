<?php
$this->breadcrumbs=array(
	"Заявки"=>array('list'),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('list')),
	
);
?>

<h1>Просмотр заявки</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>