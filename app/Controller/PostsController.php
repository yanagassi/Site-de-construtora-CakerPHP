<?php
App::uses('AppController', 'Controller');
class PostsController extends AppController
{
	public $helpers 		= array('Html', 'Form', 'Flash', 'Custom');
	public $components 		= array('Flash');

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
	}

	public function index()
	{
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
	}

	public function add()
	{
		if ($this->request->is('post'))
		{
			$this->request->data['Post']['user_id'] = $this->Auth->user('id');
			$this->Post->create();
			if ($this->Post->save($this->request->data))
			{
				$this->Flash->success(__('Dados salvo com sucesso'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('Erro 101 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
		}
	}

	public function view($id = null)
	{
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Requisição Inválida'));
		}
		$this->set('post', $this->Post->findById($id));
	}

	public function edit($id = null)
	{
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Requisição Inválida'));
		}

		if ($this->request->is(array('post', 'put')))
		{
			if ($this->Post->save($this->request->data))
			{
				$this->Flash->success(__('Dados salvo com sucesso'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('Erro 102 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
		}
		else
		{
			$this->request->data = $this->Post->findById($id);
		}
	}

	public function delete($id)
	{
		$this->autoRender = false; // request from ajax
		$this->request->allowMethod('post');

		if ($this->request->is(array('post', 'put')))
		{
			if ($this->Post->delete($id))
			{
				return json_encode($id);
			}
			else
			{
				return json_encode(false);
			}
		}
		else
		{
			throw new MethodNotAllowedException();
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