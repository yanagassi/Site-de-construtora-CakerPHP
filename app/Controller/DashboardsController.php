<?php

class DashboardsController extends AppController
{
	public $helpers 		= array('Html', 'Form', 'Flash', 'Custom');
	public $components 		= array('Flash', 'Session', 'Paginator','Utility','Validation');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow();
		$this->Auth->deny('dashboard');
	}

	public function index_admin()
	{
		$this->set('title_for_layout', 'Newsletter');
		$this->set('sub_title_for_layout', 'Lista');

		$conditions = [];

		$options = array
		(
			 'order' 		=> array('Newsletter.created' => 'desc')
			,'conditions'   => $conditions
		);

		$result  = $this->Newsletter->find('all', $options);
		$numbers = $this->Newsletter->find('count');

		$this->set(compact('result', 'numbers'));
	}

	public function index()
	{
		$this->loadModel('Advertisement');
		$this->loadModel('Report');
		$this->loadModel('Rating');
		$this->loadModel('Product');
		$this->loadModel('Service');
		$this->loadModel('Rating');

		$q_advertisement  = $this->Advertisement->find('all', ['conditions' => ['Advertisement.cliente_id' => $this->Auth->user('id'), 'Advertisement.status' => 1], 'fields' => ['Advertisement.id'], 'recursive' => 0]);
		$w_in 			  = [];
		foreach ( $q_advertisement as $item )
		{
			$w_in[] = $item['Advertisement']['id']; // construct where_in clause
		}

		$adv_number 	   = count($q_advertisement);
		$adv_views 		   = $this->Report->find('count',  ['conditions' => ['Report.advertisement_id' => $w_in, 	'Report.advertisement_view' 	=> 1, ['and' => ['Report.created >= ' => date('Y-m-01 00:00:00')],['Report.created <=' => date('Y-m-t 23:59:59')]]]]);
		$adv_clicks	  	   = $this->Report->find('count',  ['conditions' => ['Report.advertisement_id' => $w_in, 	'Report.advertisement_clicked' 	=> 1, ['and' => ['Report.created >= ' => date('Y-m-01 00:00:00')],['Report.created <=' => date('Y-m-t 23:59:59')]]]]);
		$adv_rates 		   = $this->Rating->find('count',  ['conditions' => ['Rating.anuncio_id' 	   => $w_in], 										  ['and' => ['Rating.created >= ' => date('Y-m-01 00:00:00')],['Rating.created <=' => date('Y-m-t 23:59:59')]]]);
		$adv_phone_clicks  = $this->Report->find('count',  ['conditions' => ['Report.advertisement_id' => $w_in, 	'Report.phone_clicked' 			=> 1, ['and' => ['Report.created >= ' => date('Y-m-01 00:00:00')],['Report.created <=' => date('Y-m-t 23:59:59')]]]]);
		$adv_email_clicks  = $this->Report->find('count',  ['conditions' => ['Report.advertisement_id' => $w_in, 	'Report.email_clicked' 			=> 1, ['and' => ['Report.created >= ' => date('Y-m-01 00:00:00')],['Report.created <=' => date('Y-m-t 23:59:59')]]]]);
		$adv_service_views = $this->Report->find('count',  ['conditions' => ['Report.advertisement_id' => $w_in, 	'Report.service_view' 			=> 1, ['and' => ['Report.created >= ' => date('Y-m-01 00:00:00')],['Report.created <=' => date('Y-m-t 23:59:59')]]]]);
		$adv_product_views = $this->Report->find('count',  ['conditions' => ['Report.advertisement_id' => $w_in, 	'Report.product_view' 			=> 1, ['and' => ['Report.created >= ' => date('Y-m-01 00:00:00')],['Report.created <=' => date('Y-m-t 23:59:59')]]]]);
		$adv_product_total = $this->Product->find('count', ['group' => 		['Product.nome']]);
		$adv_service_total = $this->Service->find('count', ['group' => 		['Service.nome']]);
		$adv_rating_total  = $this->Rating->find('count');

		$this->set(compact('adv_number','adv_views','adv_clicks','adv_rates','adv_phone_clicks','adv_email_clicks','adv_service_views','adv_product_views','adv_product_total','adv_service_total','adv_rating_total'));
	}

	public function add_phone_click()
	{
		$this->theme = 'Portal';
		$this->autoRender = false; // request from ajax

		if ($this->request->is(array('post')))
		{
			$this->loadModel('Report');

			$ip_address = $this->Utility->getClientIpServer();

			$this->Report->create();
			$this->request->data['Report']['ip_address'] 				= $ip_address;
			$this->request->data['Report']['advertisement_id'] 			= $this->request->data['Report']['advertisement_id'];
			$this->request->data['Report']['phone_clicked'] 			= 1;

			if ($this->Report->save($this->request->data))
				return json_encode(['status' => true, 'msg' => 'Dados salvos com sucesso!']);
		}
		else
		{
			throw new MethodNotAllowedException();
		}
	}

	public function add_advertisement_click()
	{
		$this->theme = 'Portal';
		$this->autoRender = false;

		if ($this->request->is(array('post')))
		{
			$this->loadModel('Report');
			$ip_address = $this->Utility->getClientIpServer();

			$this->Report->create();
			$this->request->data['Report']['ip_address'] 			= $ip_address;
			$this->request->data['Report']['advertisement_id'] 		= $this->request->data['Report']['advertisement_id'];
			$this->request->data['Report']['advertisement_clicked'] = 1;

			if ($this->Report->save($this->request->data))
				return json_encode(['status' => true, 'msg' => 'Dados salvos com sucesso!']);
		}
		else
		{
			throw new MethodNotAllowedException();
		}
	}

	public function add_email_click()
	{
		$this->theme = 'Portal';
		$this->autoRender = false;

		if ($this->request->is(array('post')))
		{
			$this->loadModel('Report');
			$ip_address = $this->Utility->getClientIpServer();

			$this->Report->create();
			$this->request->data['Report']['ip_address'] 		= $ip_address;
			$this->request->data['Report']['advertisement_id'] 	= $this->request->data['Report']['advertisement_id'];
			$this->request->data['Report']['email_clicked'] 	= 1;

			if ($this->Report->save($this->request->data))
				return json_encode(['status' => true, 'msg' => 'Dados salvos com sucesso!']);
		}
		else
		{
			throw new MethodNotAllowedException();
		}
	}

	public function ajax_delete($id, $status = null)
	{
		$this->autoRender = false; //(0=inactive, 1=active,2=deleted)
		$this->request->allowMethod('post');
		$model = $this->modelClass;
		$this->$model->id = $id;

		if ($this->$model->saveField('status',$status))
		{
			return json_encode($id);
		}
		else
		{
			return json_encode(false);
		}
	}
}