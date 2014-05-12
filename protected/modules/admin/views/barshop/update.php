<?php
$this->breadcrumbs=array(
	"Барный инвентарь"=>array('list'),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('list')),
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Редактирование позиции "<?=$model->title?>"</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>