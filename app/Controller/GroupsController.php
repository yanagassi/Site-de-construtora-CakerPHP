<?php

App::uses('AppController', 	'Controller');

class GroupsController extends AppController
{
	public $helpers 		= array('Html', 'Form', 'Flash', 'Custom');
	public $components 		= array('Flash', 'Session');

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
	}

	public function index()
	{
		$this->Group->recursive = 0;
		$this->set('groups', $this->paginate());
	}

	public function add()
	{
		if ($this->request->is('post'))
		{
			$this->Group->create();
			if ($this->Group->save($this->request->data))
			{
				$this->Flash->success(__('Dados salvo com sucesso'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('Erro 301 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
		}
	}

	public function view($id = null)
	{
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Requisição Inválida'));
		}
		$this->set('group', $this->Group->findById($id));
	}

	public function edit($id = null)
	{
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Requisição Inválida'));
		}

		if ($this->request->is(array('post', 'put')))
		{
			if ($this->Group->save($this->request->data))
			{
				$this->Flash->success(__('Dados salvo com sucesso'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('Erro 302 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
		}
		else
		{
			$this->request->data = $this->Group->findById($id);
		}
	}

	public function delete($id)
	{
		$this->autoRender = false; // request from ajax
		$this->request->allowMethod('post');

		if ($this->request->is(array('post', 'put')))
		{
			if ($this->Group->delete($id))
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
		// The owner of a user can edit and delete it
		// ToDo : Refactoring => Validate if is admin or manager
		return true;

	}
}