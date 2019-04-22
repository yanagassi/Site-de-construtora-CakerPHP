<?php

App::uses('AppController', 'Controller');

class SocialNetworksController extends AppController
{
	public $helpers 		= array('Html', 'Form', 'Flash', 'Custom');
	public $components 		= array('Flash');
	public $uses 			= array('SocialNetwork');

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
		$this->SocialNetwork->recursive = 1;

		// Acl Extras Plugin => Enable
		//$this->Auth->authorize = 'actions';
		//$this->Auth->actionPath = 'controllers/';
	}

	public function index()
	{
		$this->autoRender = false; // Status => 0 = congelado, 1 = ativo, 2 = excluído
		echo 10;
	}

	public function ajax_delete()
	{
		$this->autoRender = false; // Status => 0 = congelado, 1 = ativo, 2 = excluído
		//$this->request->allowMethod('post');

		$model = $this->request->data['model'];
		$field = $this->request->data['name'];
		$val   = null;

		$this->$model->id = $this->request->data['id'];

		if ( empty($this->request->data['name']) )
		{
			$result = array
			(
				'status' => false,
				'msg' 	 => 'Erro ao apagar os dados. Tente novamente.'
			);
			return json_encode($result);
		}

		if ($this->$model->saveField($field, $val))
		{
			$result = array
			(
				'status' => true,
				'msg' 	 => 'Dados apagados com sucesso!'
			);
			return json_encode($result);
		}
		else
		{
			$result = array
			(
				'status' => false,
				'msg' 	 => 'Erro ao apagar os dados. Tente novamente.'
			);
			return json_encode($result);
		}
	}
}