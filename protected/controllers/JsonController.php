<?php

class JsonController extends Controller
{
	protected $domain_grannys = "http://grannysbar.ru";
	protected $domain_barservice = "http://bar-tm.ru";
	protected $domain_app = "http://grannys.loc";
	
	public function actionGetGallery($site="grannys", $debug = false)
	{
		switch($site)
		{
			case 'grannys':
				$domain = $this->domain_grannys;
				$images = GalleriesItems::model()->findAll(array('condition'=>" d2 = '' ", 'order'=>'id DESC'));
			break;
			
			case 'barservice':
				$domain = $this->domain_barservice;
				$images = BarserviceGalleriesItems::model()->findAll(array('order'=>'id DESC'));
			break;
			
			case 'partybus':
				$domain = $this->domain_app;
				$images = Partybusgalleryitem::model()->findByPk(1)->getGalleryPhotos();
			break;
		}
		//echo count($images);die();
		if(!$debug)
			header('Content-type: application/json');
			
		$json = array();
		
		
		
		
		if( count($images) > 0 )
		{ 
			$result = 1;
			
			$n=0;
			foreach ($images as $image)
			{
				switch($site)
				{
					case 'grannys':
						$path_thumb = "{$domain}/files/gallery/{$image->page}/thumb/{$image->filename}";
						$path_big = "{$domain}/files/gallery/{$image->page}/img/{$image->filename}";
					break;
					
					case 'barservice':
					
						$page_barservice = BarservicePages::model()->findByPk($image->page);
						$path_thumb = "{$domain}/files/gallery/{$page_barservice->path}/thumb/{$image->filename}";
						$path_big = "{$domain}/files/gallery/{$page_barservice->path}/img/{$image->filename}";
						
					break;
					
					case 'partybus':
						$path_thumb = "{$domain}{$image->getUrl('small')}";
						$path_big = "{$domain}{$image->getUrl('medium')}";
						
						
					break;
				}
								
				$response[$n]['big'] = $path_big;
				$response[$n]['thumb'] = $path_thumb;
					
				if($debug)
					echo "<img src='{$path_thumb}' />";
					
				$n++;
			}
		}
		else
		{
			$result = 0;
			$error = "Фотографий нет";
		}
		
		$json['result'] = $result;
		$json['error'] = $error;
		$json['response'] = $response;
		
		
    	 if($debug)
		{
			echo "<pre>";
				print_r($json);
			echo "</pre>";
		}
		else
    	 	echo CJSON::encode($json);	
		
		// http://grannysbar.ru/files/gallery/97/img/bQ1uqa8h0kSoWWgIzOBsHRBhv3zBqL.jpg - big image
		// http://grannysbar.ru/files/gallery/97/thumb/bQ1uqa8h0kSoWWgIzOBsHRBhv3zBqL.jpg - thumb
	}
	
	
	public function actionGetInfo($site = "grannys", $type="origin", $debug = false)
	{
		switch($site)
		{
			case 'grannys':
				$page = Page::model()->findByPk(1);
			break;
			case 'iceman':
			echo $type;
				$page = ($type=="contacts") ? Page::model()->findByPk(2) : Page::model()->findByPk(3);
			break;
			case 'partybus':
				$page = Page::model()->findByPk(4);
			break;
		}
		
		
		if(!$debug)
			header('Content-type: application/json');
		$json = array();
		
		
		
		
		if( count($page) == 1 )
		{ 
			$result = 1;
			
			
			
				$response['title'] = $page->title;
				$response['text'] = $page->wswg_body;
				
		}
		else
		{
			$result = 0;
			$error = "Главный экран не найден";
		}
		
		$json['result'] = $result;
		$json['error'] = $error;
		$json['response'] = $response;
		
		
    	 if($debug)
		{
			echo "<pre>";
				print_r($json);
			echo "</pre>";
		}
		else
    	 	echo CJSON::encode($json);	
	}
	
	
	
	// BarService Table
	public function actionGetPage($page, $debug = false)
	{
		$show_page = false;
		$type_page = "table";
		
		switch($page)
		{
			case 'shop':
				$id_page = 26;
				$p_title = "О магазине";
			break;	
			case 'school':
				$id_page = 27;
				$p_title = "О школе барменов";
			break;	
			case 'events':
				$id_page = 28;
				$p_title = "О Выездном баре";
			break;	
			case 'about':
				$id_page = 33;
				$p_title = "О Выездном баре";
			break;
			
			case is_numeric($page):
				$id_page = $page;
				$show_page = true;
				
				if( in_array($id_page, array( 77 )) )
					$type_page = "order";
				else
					$type_page = "view";
				
			break;
			
			
		}
		
				
		
		if(!$debug)
			header('Content-type: application/json');
			
		$json = array();
		
		
		$page = BarservicePages::model()->findByPk($id_page);
		
		
		if( count($page) == 1 )
		{ 
			$result = 1;
			
			   $child_pages = BarservicePages::model()->findAll( array( 'order'=>'sort', 'condition' => "parent = :id_page and id not in (93, 31, 32, 34)", 'params' => array( ':id_page'=>$id_page ) ) );
			   
			   $childs = CHtml::listData($child_pages,'id','rusname');
			   
			   if(!$show_page)
			   {
				   $childs[$id_page] = $p_title; 
			   }
			   
			
				$response['title'] = $page->title;
				if(count($childs)>0) $response['childs'] = $childs;
				$response['type'] = $type_page;
				$response['text'] = $page->content->value;
				
				
				$response['text'] = preg_replace("/\<img.+src=('|\")(.*)('|\")/", "<img src=\"http://bar-tm.ru$2", $response['text']);
			
		}
		else
		{
			$result = 0;
			$error = "Главный экран не найден";
		}
		
		$json['result'] = $result;
		$json['error'] = $error;
		$json['response'] = $response;
		
		if($debug)
		{
			echo "<pre>";
				print_r($json);
			echo "</pre>";
		}
		else
    	 	echo CJSON::encode($json);	
	}



	public function actionGetStreet($site="grannys", $debug = false)
	{
		switch($site)
		{
			case 'grannys':
				$data[0]['street'] = Yii::app()->config->get('grannys.street');
				$data[0]['title'] = "Granny's Bar";
			break;
			case 'barservice':
				$data[0]['street'] = Yii::app()->config->get('barservice.street');
				$data[0]['title'] = "Bar Service";
			break;
			case 'iceman':
			
				$places = IcemanPlaces::model()->findAll( array( 'condition'=>"status = :status", 'params'=>array(':status'=>IcemanPlaces::STATUS_PUBLISH) ) ); 
				
				if( count($places) > 0 )
				{
					$z = 0;
					foreach($places as $place)
					{
						$data[$z]['street'] = $place->street;
						$data[$z]['title'] = $place->name;
				
						$z++;
					}
				}
				
			break;
		}
		
		
		if(!$debug)
			header('Content-type: application/json');
			
		$json = array();
		
		
		
		$n = 0;
		if( isset($data) )
		{ 
			$result = 1;
			
			foreach($data as $obj)
			{
				$response[$n]['street'] = $obj['street'];
				$response[$n]['title'] = $obj['title'];
						
					
				$n++;
			}
			
		}
		else
		{
			$result = 0;
			$error = "Нет данных";
		}
		
		$json['result'] = $result;
		$json['error'] = $error;
		$json['response'] = $response;
		
		
    	 if($debug)
		{
			echo "<pre>";
				print_r($json);
			echo "</pre>";
		}
		else
    	 	echo CJSON::encode($json);	
		
		// http://grannysbar.ru/files/gallery/97/img/bQ1uqa8h0kSoWWgIzOBsHRBhv3zBqL.jpg - big image
		// http://grannysbar.ru/files/gallery/97/thumb/bQ1uqa8h0kSoWWgIzOBsHRBhv3zBqL.jpg - thumb
	}
	
}