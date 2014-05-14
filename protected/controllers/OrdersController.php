<?php

class OrdersController extends FrontController
{
	public $layout='//layouts/simple';

	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'insertorder'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel('Orders', $id),
		));
	}

	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Orders');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	
	public function actionInsertOrder($key)
	{
		//print_r($_GET);
		if(md5($key) == "2b88a28c68444647618deb11ef300b71")
		{
			$order = new Orders;
			
			$order->name = $_POST['name'];
			$order->phone = $_POST['phone'];
			$order->type_order = $_POST['service_name'];
			$order->params = serialize($_POST['params']);
			print_r($order->attributes);
			if($order->save())
			{
				if($order->type_order) $message .="<b>{$order->type_order}</b><br><br>";
				if($order->name) $message .="Имя: {$order->name}<br>";
				if($order->phone) $message .="Номер телефона: {$order->phone}<br>";
				
				foreach($order->convertParams() as $param_name => $param_value)
				{
					$message .= "<strong>$param_name</strong>: $param_value <br>"; 
				}
				
				//if($model->rating) $message .="Оценка: {$model->rating}<br>";
				//if($model->comment) $message .="Комментарий: {$model->comment}<br>";
				//$message.="{$model->create_time}";
				$message.="<a href='http://{$_SERVER['SERVER_NAME']}/admin/orders/update/id/{$order->id}'>Ссылка для просмотра</a><br>";

				$date = date('d.m.Y H:i');
				$message .="<br><br>Время заявки: {$date}<br>";	


//
				SiteHelper::sendMail("Получена заявка с мобильного приложения!",$message,Yii::app()->config->get('app.email'),"grannys@bar-tm.ru");
				
			}
			else
				throw new CHTTPException(404, "INVALID VALIDATION");
			
		}
		else throw new CHTTPException(404, "INVALID KEY");
	}
}
