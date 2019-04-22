<?php

App::uses('AppController', 'Controller');

class ServicesController extends AppController {

	public $helpers 		= array('Html','Form','Flash','Custom');
	public $components 		= array('Flash','Session','Paginator','Email','Utility','Date','Validation');
	public $uses 			= array();

	public function beforeFilter()
	{
		parent::beforeFilter();
		//$this->Auth->allow();
	}

	public function check_limit_plan($anuncio_id = null)
	{
		if ( $anuncio_id == null )
			return json_encode(['status' => false, 'msg' => 'Erro 411 - Ocorreu um erro ao checar seu plano. Contate o administrador.']);

		$this->loadModel('Advertisement');
		$ad_result 			= $this->Advertisement->findById($anuncio_id);
		$result_check_plan 	= $this->Service->check_limit_plan($ad_result);
		return $result_check_plan;
	}

	public function ajax_add()
	{
		$this->layout = 'ajax';
		$this->autoRender = false;
		$this->request->allowMethod('post');
		$model = $this->modelClass;

		// Check limit plans
		if ( $this->check_limit_plan( $this->request->data['Service']['anuncio_id'] ) )
			return json_encode(['status' => false, 'msg' => 'Seu plano não permite cadastrar mais produtos. Faça um upgrade para adicionar mais produtos!']);

		if ($this->$model->save($this->request->data, array('deep' => true, 'validate' => false)))
		{
			$result = array
			(
				'status' => true,
				'msg' 	 => 'Dados salvo com sucesso!',
				'id' 	 => $this->$model->getLastInsertId()
			);
			$result = $result;
			return json_encode($result);
		}
		else
		{
			$result = array
			(
				'status' => false,
				'msg' 	 => 'Ocorreu um erro, tente novamente ou contacte o administrador!'
			);
			return json_encode($result);
		}
	}

	public function ajax_delete($id)
	{
		$this->layout = 'ajax';
		$this->autoRender = false;
		$this->request->allowMethod('post');
		$model = $this->modelClass;

		if ($this->$model->delete($id))
		{
			return json_encode($id);
		}
		else
		{
			return json_encode(false);
		}
	}

}