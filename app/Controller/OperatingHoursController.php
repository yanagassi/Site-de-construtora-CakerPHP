<?php

App::uses('AppController', 'Controller');

class OperatingHoursController extends AppController {

	public $helpers 		= array('Html','Form','Flash','Custom');
	public $components 		= array('Flash','Session','Paginator','Email','Utility','Date','Validation');
	public $uses 			= array();

	public function beforeFilter()
	{
		parent::beforeFilter();
		//$this->Auth->allow();
	}

	public function ajax_add()
	{
		$this->layout = 'ajax';
		$this->autoRender = false;
		$this->request->allowMethod('post');
		$model = $this->modelClass;

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