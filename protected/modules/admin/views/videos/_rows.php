	<?php echo $form->dropDownListControlGroup($model,'id_type', Videos::relationTo(),array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'title',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'video_string',array('class'=>'span8','prepend' => 'http://www.youtube.com/watch?v=' )); ?>
    
    

	<?php echo $form->dropDownListControlGroup($model, 'status', Videos::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
