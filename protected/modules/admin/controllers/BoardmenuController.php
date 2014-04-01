<?php

class BoardmenuController extends AdminController
{
	public function actionCreate()
	{
		Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/boardmenu.js', CClientScript::POS_END);
		$model = new Boardmenu;	
		
		
		
		if(isset($_POST['Boardmenu']))
		{
			$model->attributes = $_POST['Boardmenu'];
			
			
			
			
			if($model->save())
			{
				if(isset($_POST['Composition']))
				{
					$composition = $_POST['Composition'];
					
					for($i=0; $i<count($composition['title']); $i++)
					{
						$composition_model = new BoardmenuComposition;
						$composition_model->id_boardmenu = $model->id;
						$composition_model->title = $composition['title'][$i];
						$composition_model->composition = $composition['composition'][$i];
						$composition_model->parameter = $composition['parameter'][$i];
						
						$composition_model->save();
					}
				}
				
				$this->redirect("/admin/boardmenu/list");	
			}
			
		}
		
		
		$this->render("create", array('model'=>$model) );
	}
	
	
	public function actionUpdate($id)
	{
		Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/boardmenu.js', CClientScript::POS_END);
		$model =  Boardmenu::model()->findByPk($id);	
		
		
		
		if(isset($_POST['Boardmenu']))
		{
			$model->attributes = $_POST['Boardmenu'];
			
			//echo "<pre>";
			//print_r($_POST);die();
			//echo "</pre>";
			
			if($model->save())
			{
				if(isset($_POST['Composition']))
				{
					$composition = $_POST['Composition'];
					$array_id_exist = array();
					for($i=0; $i<count($composition['title']); $i++)
					{
						$find_issue = BoardmenuComposition::model()->findByPk($composition['id'][$i]);
						if( !empty($composition['id'][$i]) ) $array_id_exist[] = $composition['id'][$i];
						
						$composition_model = (is_object($find_issue)) ? $find_issue : new BoardmenuComposition;
						$composition_model->id_boardmenu = $model->id;
						$composition_model->title = $composition['title'][$i];
						$composition_model->composition = $composition['composition'][$i];
						$composition_model->parameter = $composition['parameter'][$i];
						
						if($composition_model->save())
							$array_id_exist[] = $composition_model->id;
					}
					
					// удаляем 
					//print_r($array_id_exist);
					if( count($array_id_exist) >0 )
					{
						$array_id_exist_string = implode(", ", $array_id_exist);
					
						BoardmenuComposition::model()->deleteAll("id not in ({$array_id_exist_string}) and id_boardmenu = {$model->id}");
					}
					
				}
				
				$this->redirect("/admin/boardmenu/list");	
			}
			
		}
		
		
		$this->render("create", array('model'=>$model) );
	}
}
