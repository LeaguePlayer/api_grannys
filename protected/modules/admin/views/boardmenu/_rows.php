	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'img_preview'); ?>
		<?php echo $model->getImage('medium'); ?><br>
		<?php echo $form->fileField($model,'img_preview', array('class'=>'span8')); ?>
		<?php echo $form->error($model, 'img_preview'); ?>
	</div>
	
	<?php echo $form->dropDownListControlGroup($model,'id_type',SiteHelper::getCategoryBoardmenu(), array('class'=>'span12')); ?>

	<?php echo $form->textFieldControlGroup($model,'title',array('class'=>'span12','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'price',array('class'=>'span12','maxlength'=>10)); ?>
    
    
    <div class="control-group">
    		<label class="control-label" for="Boardmenu_id_type">Категория товара</label>
        <div class="place_c">
        
        	<? if( count($model->composition) > 0 ) { ?>
            	<? foreach ($model->composition as $object) { ?>
                	<?=$this->renderPartial('_sub_rows', array('object'=>$object) );?>
            	 <? } ?>
            <? } else { ?>
            	<?=$this->renderPartial('_sub_rows', array('object'=>NULL) );?>
            <? } ?>
        </div>
        <?php echo TbHtml::button('Добавить ингредиент', array('class'=>'add_row')); ?>
     </div>
     
     
     <?php echo $form->textFieldControlGroup($model,'bulk',array('class'=>'span12','maxlength'=>255)); ?>
     
     <?php echo $form->dropDownListControlGroup($model,'bulk_parameter', SiteHelper::getParameter() ,array('class'=>'span12')); ?>
     
     <?php echo $form->textAreaControlGroup($model,'short_desc',array('class'=>'span12','maxlength'=>255)); ?>
     

	<?php echo $form->dropDownListControlGroup($model, 'status', Boardmenu::getStatusAliases(), array('class'=>'span12', 'displaySize'=>1)); ?>
