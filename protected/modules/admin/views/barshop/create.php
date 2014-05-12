<?php
$this->breadcrumbs=array(
	"Барный инвентарь"=>array('list'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('list')),
);
?>

<h1>Добавление позиции в Барный инвентарь</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>