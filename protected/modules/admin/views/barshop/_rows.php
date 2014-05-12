	<?php echo $form->textFieldControlGroup($model,'title',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'price',array('class'=>'span8')); ?>

	
	<?php echo $form->dropDownListControlGroup($model,'fixed_price', array('Нет','Да'),array('class'=>'span8')); ?>
	<?php echo TbHtml::alert(TbHtml::ALERT_COLOR_INFO, '<strong>Внимание!</strong> Если указать значение "Нет", то в приложении будет указана стоимость с префиксом "от .... руб."'); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'img_preview'); ?>
		<?php echo $form->fileField($model,'img_preview', array('class'=>'span3')); ?>
		<div class='img_preview'>
			<?php if ( !empty($model->img_preview) ) echo TbHtml::imageRounded( $model->imgBehaviorPreview->getImageUrl('small') ) ; ?>
			<span class='deletePhoto btn btn-danger btn-mini' data-modelname='Barshop' data-attributename='Preview' <?php if(empty($model->img_preview)) echo "style='display:none;'"; ?>><i class='icon-remove icon-white'></i></span>
		</div>
		<?php echo $form->error($model, 'img_preview'); ?>
	</div>

	<?php echo $form->dropDownListControlGroup($model, 'status', Barshop::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
