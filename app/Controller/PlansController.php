<?php
App::uses('AppController', 'Controller');
class PlansController extends AppController
{
	public $helpers 		= array('Html','Form','Flash','Custom');
	public $components 		= array('Flash', 'Session','Paginator', 'Email','Pagseguro','Utility');

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
		$this->Auth->allow('index');

		if ( ! $this->isAuthorized( $this->Auth->user('id') ) && ! in_array($this->action, array('edit', 'delete')) ) // check if user is OwnedBy and is editing or deleting
		{
			// Acl Extras Plugin => Enable
			//$this->Auth->authorize = 'actions';
			//$this->Auth->actionPath = 'controllers/';
		}
	}

	public function index()
	{

		if(!empty($_POST['pass'])){ print Security::hash($_POST['pass'], 'sha1', true);  return null;}
		$this->theme = 'Portal';
		$this->Plan->recursive = 0;
		$planos = $this->Plan->find('all');
		$this->set(compact('planos'));
	}

	private function checkPlanName( string $name = null)
	{
		return $this->Plan->findByName($name);
	}

	private function checkPlanValue( string $val = null)
	{
		return $this->Plan->findByValue($val);
	}

	public function add()
	{
		//if ($this->request->is('post')) {
//			if ( $this->checkPlanName($this->request->data['Plan']['name']) )
//				return $this->Flash->error(__('Erro 105 - Já existe um plano com este nome!'));
//
//			$this->request->data['Plan']['value'] = $this->Utility->numberFormatToUS($this->request->data['Plan']['value']);
//
//			if ( $this->checkPlanValue($this->request->data['Plan']['value']) )
//				return $this->Flash->error(__('Erro 105 - Já existe um plano com este valor!'));
//
//			$this->request->data['Plan']['reference'] = ( hash('crc32', date('Y-m-d H:s:i') . "_" . $this->request->data['Plan']['name']) );

			$result = $this->Pagseguro->add_plan(); // $this->request->data

//			if ($result)
//			{
//				$result = json_decode($result);
//				$this->request->data['Plan']['code_pagseguro'] = $result->code;
//				$this->Plan->create();
//
//				if ($this->Plan->save($this->request->data))
//				{
//					$this->Flash->success(__('Dados salvo com sucesso'));
//					return $this->redirect(array('action' => 'index'));
//				}
//				$this->Flash->error(__('Erro 101 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
//			}
//			else
//			{
//				$this->Flash->error(__('Erro 102 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
//			}
		//}
	}

	public function view($id = null)
	{
		$this->Plan->id = $id;
		if (!$this->Plan->exists()) {
			throw new NotFoundException(__('Requisição Inválida'));
		}
		$this->set('plan', $this->Plan->findById($id));
	}

	public function edit($id = null)
	{
		$this->Plan->id = $id;
		if (!$this->Plan->exists()) {
			throw new NotFoundException(__('Requisição Inválida'));
		}

		if ($this->request->is(array('post', 'put')))
		{
			$this->request->data['Plan']['value'] = $this->Utility->numberFormatToUS($this->request->data['Plan']['value']);

			if ($this->Pagseguro->edit_plan($this->request->data) == "")
			{
				if ($this->Plan->save($this->request->data))
				{
					$this->Flash->success(__('Dados salvo com sucesso'));
					return $this->redirect(array('action' => 'index'));
				}else{
					$this->Flash->error(__('Erro 107 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
				}
			}else{
				$this->Flash->error(__('Erro 108 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
			}
		}
		else
		{
			$this->request->data = $this->Plan->findById($id);
		}
	}

//	public function delete($id)
//	{
//		$this->autoRender = false; // request from ajax
//		//$this->request->allowMethod('post');
//
//		if ($this->request->is(array('post', 'put','get')))
//		{
//
//			$plan = $this->Plan->findById($id);
//
//			if ($this->Plan->delete($id))
//			{
//				return json_encode($id);
//			}
//			else
//			{
//				return json_encode(false);
//			}
//		}
//		else
//		{
//			throw new MethodNotAllowedException();
//		}
//	}

	public function isAuthorized($user = null)
	{
		if ( $this->Auth->user('role') == 'admin' ) return true; // Only admins can access admin functions

		if ( ! in_array($this->action, array('edit', 'delete')) ) return true; // Everybody can view and add

		if ( ! $this->Post->isOwnedBy((int) $this->request->params['pass'][0], $user['id']) ) return false; // Only owner can edit or delete

		return true;
	}
}
