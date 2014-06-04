<?php

class JsonController extends Controller
{
	protected $domain_grannys = "http://grannysbar.ru";
	protected $domain_barservice = "http://bar-tm.ru";
	protected $domain_app = "http://grannys.amobile-studio.ru";
	
	
	public $order_views = array( 77=>"Online заказ выездного бара", 69=>"Магазин - уточнить по наличию" );
	
	
	public function actionGetGallery($site="grannys", $debug = false)
	{
		
		switch($site)
		{
			case 'grannys':
          //	$domain = $this->domain_grannys;
          //	$images = GalleriesItems::model()->findAll(array('condition'=>" d2 = '' ", 'order'=>'id DESC'));
          
          $domain = $this->domain_app;
				$images = Partybusgalleryitem::model()->findByPk(3)->getGalleryPhotos();
			break;
			
			case 'barservice':
          //$domain = $this->domain_barservice;
          //	$images = BarserviceGalleriesItems::model()->findAll(array('order'=>'id DESC'));
          
          $domain = $this->domain_app;
				$images = Partybusgalleryitem::model()->findByPk(2)->getGalleryPhotos();
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
				
                  //	$path_thumb = "{$domain}/files/gallery/{$image->page}/thumb/{$image->filename}";
                  //	$path_big = "{$domain}/files/gallery/{$image->page}/img/{$image->filename}";
                  
                  $path_thumb = "{$domain}{$image->getUrl('small')}";
						$ipad = "{$domain}{$image->getUrl('ipad')}";
						$ipad_retina = "{$domain}{$image->getUrl('ipad_retina')}";
						
						$iphone = "{$domain}{$image->getUrl('iphone')}";
						$iphone_retina = "{$domain}{$image->getUrl('iphone_retina')}";
					
								
				$response[$n]['ipad'] = $ipad;
				$response[$n]['ipad_retina'] = $ipad_retina;
				$response[$n]['iphone'] = $iphone;
				$response[$n]['iphone_retina'] = $iphone_retina;
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
				$page = Page::model()->findByPk(8);
			break;
			case 'iceman':
          //echo $type;
				$page = ($type=="contacts") ? Page::model()->findByPk(5) : Page::model()->findByPk(6);
			break;
			case 'partybus':
				$page = Page::model()->findByPk(7);
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


	public function actionGetVideos($site = "grannys", $debug = false)
	{
		switch($site)
		{
			case 'grannys':
				$id_type = 0;
			break;
			case 'barservice':
         		$id_type = 1;
			break;
			case 'partybus':
				$id_type = 2;
			break;
		}
		
		
		if(!$debug)
			header('Content-type: application/json');
		$json = array();
		
		$videos = Videos::model()->findAll( array( 'order'=>'sort ASC', 'condition'=>"id_type = {$id_type} and status = :status", 'params'=>array(':status'=>Videos::STATUS_PUBLISH) ) );
		
		
		if( count($videos) > 0 )
		{ 
			$result = 1;
			
			$n=0;
			foreach($videos as $video)
			{
				$response[$n]['title'] = $video->title;
				$response[$n]['video'] = $video->video_string;
				
				$n++;
			}
			
			
				
				
		}
		else
		{
			$result = 0;
			$error = "Нет видео";
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
				$p_title = "О Bar Service";
			break;
			
			case is_numeric($page):
				$id_page = $page;
				$show_page = true;
				
				if( in_array($id_page, array_keys($this->order_views) ) )
					$type_page = $this->order_views[$id_page];
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
			
			   $child_pages = BarservicePages::model()->findAll( array( 'order'=>'sort', 'condition' => "parent = :id_page and id not in (93, 31, 32, 34, 43, 44, 101, 45, 71, 72, 42)", 'params' => array( ':id_page'=>$id_page ) ) );
			   
			  // $childs = CHtml::listData($child_pages,'id','rusname');
			   
			   if(!$show_page)
			   {
				   $childs[0]['title'] = $p_title; 
				   $childs[0]['id_page'] = $id_page; 
				   
			   }
			   
			   $n = 1;
			   
			   if($id_page==26)
			   {
				   foreach ( Barshop::getCategory() as  $name_category => $category )
					{
						if(is_array($category))
						{
							$keys = array_keys($category);
							$id_category = array_shift($keys);	
						}
						else 
						{
							$id_category = $name_category;
							$name_category = $category;
							
						}
						
						
						
						
							$childs[$n]['title'] = $name_category;
							$childs[$n]['id'] = $id_category;
							$childs[$n]['type'] = "inventory";
						$n++;
					}
			   }
			   	
			   	
				
				foreach ($child_pages as $p_child)
				{
					$childs[$n]['title'] = $p_child->rusname;
					$childs[$n]['id_page'] = $p_child->id;
					$childs[$n]['type'] = (in_array($p_child->id, array_keys($this->order_views))) ? "order_view" : "";
					$childs[$n]['service_name'] = $this->order_views[$p_child->id];
					$n++;
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
	
	
	
	public function actionGetMenu($id_category = 1, $debug = false)
	{
		$domain = $this->domain_app;
		
		
		$ids_categories = $id_category;
		
		foreach ( SiteHelper::getCategoryBoardmenu() as $category )
		{
			if(is_array($category))
			{
				if(in_array($id_category, array_keys($category)))
				{
					$ids_categories = implode(", ",array_keys($category));
					break;
				}
			}
			
		}
		
		
		
		 $Boardmenu = Boardmenu::model()->findAll("status = :status and id_type in ({$ids_categories})",array(':status'=>Boardmenu::STATUS_PUBLISH));
		
		
		if(!$debug)
			header('Content-type: application/json');
		$json = array();
		
		
		
		
		if( count($Boardmenu) > 0 )
		{ 
			$result = 1;
			
			
			
			$n = 0;
			$tmp = 0;
			$section = -1;
			$ex_section;
			foreach($Boardmenu as $menu)
			{
				if($ex_section!=$menu->id_type) 
				{
					$n = 0;
						$ex_section=$menu->id_type;
					$section++;
				}
				
				
				$bulk_parameter = SiteHelper::getParameter($menu->bulk_parameter);
				
				$response['menu'][$section][$n]['type']['id'] = $menu->id_type;
				$response['menu'][$section][$n]['type']['title'] = SiteHelper::getCategoryBoardmenu($menu->id_type);
				//$response['menu'][$n]['title'] = $menu->title;
				$response['menu'][$section][$n]['title'] = $menu->title;
				$response['menu'][$section][$n]['title'] .= ($menu->bulk>0) ? ", {$menu->bulk} {$bulk_parameter}" : "";
				$response['menu'][$section][$n]['category'] = $menu->id_type;
				$response['menu'][$section][$n]['price'] = $menu->price;
				$response['image'][$tmp][$n]['url'] = "{$domain}{$menu->getImageUrl('medium')}";
				$response['image'][$tmp][$n]['title'] = "{$response['menu'][$n]['title']}, {$menu->price} руб.";
				if( count($menu->composition) > 0 )
				{
					$z = 0;
					$string_composition = "";
						foreach($menu->composition as $composition)
						{
							$z++;
							$param = SiteHelper::getParameter($composition->parameter);
							
							$string_composition .= ($composition->composition>0) ? "{$composition->composition} {$param}" : "";
							$string_composition .= "{$composition->title}";
							
							if(count($menu->composition)!=$z)
								$string_composition .= ", ";
								
								
						}
						$response['menu'][$section][$n]['composition'] = $string_composition;
				}
				
				$response['section'][$section] = SiteHelper::getCategoryBoardmenu($menu->id_type);
				
				$tmp++;
				$n++;
				
			}
				$response['rows'] = $tmp;
				$response['category'] = SiteHelper::getCategoryBoardmenu(false,true);
				
			
				
				
		}
		else
		{
			$result = 0;
			$error = "Нет записей по меню";
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
	
	
	
	public function actionGetBarshop($id_category = 0, $debug = false)
	{
		$domain = $this->domain_app;
		
		$ids_categories = $id_category;
		
		foreach ( Barshop::getCategory() as $category )
		{
			if(is_array($category))
			{
				if(in_array($id_category, array_keys($category)))
				{
					$ids_categories = implode(", ",array_keys($category));
					break;
				}
			}
			
		}
		
		
	
		 $barshop = Barshop::model()->findAll(array('order'=>'id_category ASC', 'condition'=>"status = :status and id_category in ({$ids_categories})",'params'=>array(':status'=>Boardmenu::STATUS_PUBLISH)));
		
		
		if(!$debug)
			header('Content-type: application/json');
		$json = array();
		
		
		
		
		if( count($barshop) > 0 )
		{ 
			$result = 1;
			
			$n = 0;
			$tmp = 0;
			$section = -1;
			$ex_section;
			foreach($barshop as $menu)
			{
				if($ex_section!=$menu->id_category) 
				{
					$n = 0;
						$ex_section=$menu->id_category;
					$section++;
				}
				$response['menu'][$section][$n]['title'] = $menu->title;
				$response['menu'][$section][$n]['preview'] = "{$domain}{$menu->getImageUrl()}";
				
				if( $menu->price )
				{
					$response['menu'][$section][$n]['price'] =  ($menu->fixed_price) ? "{$menu->price} руб." : "от {$menu->price} руб.";
				}
				else
					$response['menu'][$section][$n]['price'] =  "по запросу";
				//$response['menu'][$n]['price'] =  ($menu->fixed_price) ? "{$menu->price} руб." : "от {$menu->price} руб.";
				$response['image'][$tmp]['url'] = "{$domain}{$menu->getImageUrl('small')}";
				$response['image'][$tmp]['title'] = "{$menu->title}, {$response['menu'][$n]['price']}";
				$response['section'][$section] = Barshop::getCategory($menu->id_category);
				
				$tmp++;
				$n++;
			}
				
				$response['rows'] = $tmp;
				
		}
		else
		{
			$result = 0;
			$error = "Нет записей по меню";
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
	
}