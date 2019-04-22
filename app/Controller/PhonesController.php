<?php

App::uses('AppController', 'Controller');

class PhonesController extends AppController {

	public $helpers 		= array('Html','Form','Flash','Custom');
	public $components 		= array('Flash','Session','Paginator','Email','Utility','Date','Validation');
	public $uses 			= array();

	public function beforeFilter()
	{
		parent::beforeFilter();
		//$this->Auth->allow();
	}

	public function edit($id = null)
	{
		$this->set('title_for_layout', 'Anúncios');
		$model = $this->modelClass;
		$this->$model->id = $id;

		if (!$this->$model->exists())
			throw new NotFoundException(__('Requisição Inválida'));

		if ($this->request->is(array('post', 'put')))
		{
			$data[$model] = $this->request->data;

			if ($this->$model->save($data))
			{
				$this->Flash->success(__('Dados salvo com sucesso'));

				// Return to page came from
				return $this->redirect( Router::url( $this->referer(), true ) );
			}
			$this->Flash->error(__('Erro 102 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
		}
		else
		{
			$result = $this->$model->findById($id);

			$model = $result[$model];
			$phone = $result['Phone'];

			$this->set(compact('model','phone'));
		}
	}

	public function add($id = null)
	{
		$this->set('title_for_layout', 'Anúncios - Adição de Telefone');
		$model = $this->modelClass;

		if ($this->request->is('post','put'))
		{
			$data[$model] = $this->request->data;
			$this->$model->create();

			if ($this->$model->save($this->request->data))
			{
				$this->Flash->success(__('Dados salvo com sucesso'));
				return $this->redirect("admin/anuncios/editar/$id");
			}
			$this->Flash->error(__('Erro 109 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));

		}
	}

	public function view(){}
	public function del(){}

	public function ajax_add_phone()
	{
		$this->layout = 'ajax';
		$this->autoRender = false; // request from ajax

		$this->request->data['Phone']['telefone'] = $this->Utility->clearAllToNumber($this->request->data['Phone']['telefone']);

		if ($this->request->is(array('post', 'put')))
		{
			if ($this->Phone->save($this->request->data, array('deep' => true, 'validate' => false)))
			{
				$result = array
				(
					'status' => true,
					'msg' 	 => 'Dados salvo com sucesso!',
					'id' 	 => $this->Phone->getLastInsertId()
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
		else
		{
			$result = array
			(
				'status' => false,
				'msg' 	 => 'Requisição inválida!'
			);
			return json_encode($result);
		}
	}

	public function ajax_delete($id)
	{
		$model = $this->modelClass;
		$this->autoRender = false; // request from ajax
		$this->request->allowMethod('post');

		if ($this->request->is(array('post', 'put')))
		{
			if ($this->$model->delete($id))
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