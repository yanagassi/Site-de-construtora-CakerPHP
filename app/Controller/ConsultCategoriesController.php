<?php
App::uses('AppController', 'Controller');
class ConsultCategoriesController extends AppController
{
	public $helpers 		= array('Html','Form','Flash','Custom');
	public $components 		= array('Flash','Session','Paginator','Email','Pagseguro','Utility','RequestHandler','Serasa','Validation');
	public $uses 			= array();

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
		$this->Auth->deny();

		if ( ! $this->isAuthorized( $this->Auth->user('id') ) && ! in_array($this->action, array('edit', 'delete')) ) // check if user is OwnedBy and is editing or deleting
		{
			// Acl Extras Plugin => Enable
			//$this->Auth->authorize = 'actions';
			//$this->Auth->actionPath = 'controllers/';
		}

		$percent_table = '50%';
		if ( $this->RequestHandler->isMobile() ) $percent_table = '100%';

		$this->set(compact('percent_table'));
	}

	public function index()
	{
		$this->Paginator->settings = $this->paginate;
		$this->Paginator->settings = array
		(
			 'order' 		=> array('ConsultCategory.created' => 'asc')
			,'recursive'    => 1
		);

		$data = $this->Paginator->paginate('ConsultCategory');

		$numbers = count($data);
		$this->set(compact('data','numbers'));
	}

	public function add()
	{
		if ($this->request->is('post'))
		{
			$this->request->data['ConsultCategory']['value_serasa'] = $this->Utility->numberFormatToUS($this->request->data['ConsultCategory']['value_serasa']);
			$this->request->data['ConsultCategory']['value_aveeze'] = $this->Utility->numberFormatToUS($this->request->data['ConsultCategory']['value_aveeze']);

			$this->ConsultCategory->create();

			if ($this->ConsultCategory->save($this->request->data))
			{
				$this->Flash->success(__('Dados salvo com sucesso'));
				return $this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Flash->error(__('Erro 148 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
			}
		}
	}

	public function view(){}

	public function edit($id = null)
	{
		$this->ConsultCategory->id = $id;
		if (!$this->ConsultCategory->exists()) {
			throw new NotFoundException(__('Requisição Inválida'));
		}

		if ($this->request->is(array('post', 'put')))
		{
			$this->request->data['ConsultCategory']['value_serasa'] = $this->Utility->numberFormatToUS($this->request->data['ConsultCategory']['value_serasa']);
			$this->request->data['ConsultCategory']['value_aveeze'] = $this->Utility->numberFormatToUS($this->request->data['ConsultCategory']['value_aveeze']);

			if ($this->ConsultCategory->save($this->request->data))
			{
				$this->Flash->success(__('Dados salvo com sucesso'));
				return $this->redirect(array('action' => 'index'));
			}else{
				$this->Flash->error(__('Erro 109 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
			}

		}
		else
		{
			$this->request->data = $this->ConsultCategory->findById($id);
		}
	}

	public function isAuthorized($user = null)
	{
		if ( $this->Auth->user('role') == 'admin' ) return true; // Only admins can access admin functions

		if ( ! in_array($this->action, array('edit', 'delete')) ) return true; // Everybody can view and add

		if ( ! $this->Post->isOwnedBy((int) $this->request->params['pass'][0], $user['id']) ) return false; // Only owner can edit or delete

		return true;
	}
}