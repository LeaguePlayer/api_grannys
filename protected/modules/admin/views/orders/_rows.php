	<?php echo $form->textFieldControlGroup($model,'type_order',array('class'=>'span8','maxlength'=>255,'disabled'=>true)); ?>

	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'phone',array('class'=>'span8','maxlength'=>255)); ?>

	<?php
		echo "<h3>Параметры:</h3>";
		
		foreach($model->convertParams() as $param_name => $param_value)
		{
			echo "<strong>$param_name</strong>: $param_value <br />";
		}
		
	 ?>

