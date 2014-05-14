	<?php echo $form->dropDownListControlGroup($model,'id_type', Videos::relationTo(),array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'title',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textAreaControlGroup($model,'video_string',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Videos::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
