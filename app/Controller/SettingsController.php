<?php

App::uses('AppController', 'Controller');

class SettingsController extends AppController
{
	public $helpers 		= array('Html', 'Form', 'Flash', 'Custom');
	public $components 		= array('Flash');
	public $uses 			= array('Setting');

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
		$this->Setting->recursive = 1;

		// Acl Extras Plugin => Enable
		//$this->Auth->authorize = 'actions';
		//$this->Auth->actionPath = 'controllers/';

	}

	public function index(){}

	public function add()
	{
		if ($this->request->is('post'))
		{
			$this->request->data['Setting']['user_id'] = $this->Auth->user('id');
			$this->Setting->create();
			if ($this->Setting->save($this->request->data))
			{
				$this->Flash->success(__('Dados salvo com sucesso'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('Erro 101 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
		}
	}

	public function view()
	{
		$this->set('setting', $this->Setting->findByUserId( $this->Auth->user('id') ));
	}

	public function edit()
	{
		$setting = $this->Setting->findByUserId( $this->Auth->user('id') );
		if ( $setting )
		{
			$this->set('setting', $setting);

			$this->Setting->id = $setting["Setting"]["id"];

			if ($setting["Setting"]["id"] && !$this->Setting->exists()) throw new NotFoundException(__('Requisição Inválida'));

			if ($this->request->is(array('post', 'put')))
			{
				if ($this->Setting->saveAssociated($this->request->data))
				{
					$this->Flash->success(__('Dados salvo com sucesso'));
					return $this->redirect('/configuracoes');
				}
				$this->Flash->error(__('Erro 102 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
			}
		}
	}

	public function delete($id)
	{
		$this->autoRender = false; // request from ajax
		$this->request->allowMethod('post');

		if ($this->request->is(array('post', 'put')))
		{
			if ($this->Setting->delete($id))
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
}