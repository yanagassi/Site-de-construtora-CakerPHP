<?php

class NewslettersController extends AppController
{
	public $helpers 		= array('Html', 'Form', 'Flash', 'Custom');
	public $components 		= array('Flash', 'Session', 'Paginator','Utility','Validation');

	/*
	 * Possible Class in Flash:
	 * alert-success
	 * alert-success
	 * alert-warning
	 * alert-danger
	 * */

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('add');

		//if ( ! $this->isAuthorized( $this->Auth->user('id') ) ) // check if user is OwnedBy
		//{
			// Acl Extras Plugin => Enable
			//$this->Auth->authorize = 'actions';
			//$this->Auth->actionPath = 'controllers/';
		//}

		//$this->Auth->allow('initDB'); // We can remove this line after we're finished
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

	}

	public function add()
	{
		$this->theme = 'Portal';
		$this->autoRender = false; // request from ajax

		if ($this->request->is(array('post', 'put')))
		{
			if ( empty($this->request->data['Newsletter']['name']) )
				return json_encode( array('status' => false, 'msg' => 'Informe seu nome') );

			if ( empty($this->request->data['Newsletter']['email']) && empty($this->request->data['Newsletter']['celular']) )
				return json_encode( array('status' => false, 'msg' => 'Email ou Celular é obrigatório!') );

			$this->request->data['Newsletter']['celular'] = $this->Utility->clearAllToNumber($this->request->data['Newsletter']['celular']);

			$query = $this->Newsletter->findByEmailOrCelular($this->request->data['Newsletter']['email'],$this->request->data['Newsletter']['celular']);

			if ($query)
			{
				$this->request->data['Newsletter']['id'] = $query['Newsletter']['id'];
				$this->request->data['Newsletter']['status'] = 1;
			}

			if ($this->Newsletter->save($this->request->data))
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