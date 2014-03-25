	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'gllr_gallery_id'); ?>
		<?php if ($model->galleryBehaviorGallery_id->getGallery() === null) {
			echo '<p class="help-block">Прежде чем загружать изображения, нужно сохранить текущее состояние</p>';
		} else {
			$this->widget('appext.imagesgallery.GalleryManager', array(
				'gallery' => $model->galleryBehaviorGallery_id->getGallery(),
				'controllerRoute' => '/admin/gallery',
			));
		} ?>
	</div>

	<?php echo $form->dropDownListControlGroup($model, 'status', Partybusgalleryitem::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
