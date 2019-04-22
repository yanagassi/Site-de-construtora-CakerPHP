<?php

App::uses('AppController', 'Controller');

class ProductsController extends AppController {

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
		$result_check_plan 	= $this->Product->check_limit_plan($ad_result);
		return $result_check_plan;
	}

	public function ajax_add()
	{
		$this->layout = 'ajax';
		$this->autoRender = false;
		$this->request->allowMethod('post');
		$model = $this->modelClass;

		// Check limit plans
		if ( $this->check_limit_plan( $this->request->data['Product']['anuncio_id'] ) )
			return json_encode(['status' => false, 'msg' => 'Seu plano não permite cadastrar mais produtos. Faça um upgrade para adicionar mais produtos!']);

		$this->request->data['Product']['preco'] = $this->Utility->numberFormatToUS($this->request->data['Product']['preco']);

		if ($this->$model->save($this->request->data, array('deep' => true, 'validate' => false)))
		{
			$result = array
			(
				'status' => true,
				'msg' 	 => 'Dados salvo com sucesso!',
				'id' 	 => $this->$model->getLastInsertId()
			);
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

	public function add_sheet()
	{
		if ($this->request->is(array('post', 'put')))
		{
			$model 		= $this->modelClass;
			$anuncio_id = $this->request->data['Product']['anuncio_id'];
			$file 		= fopen($this->request->data['Product']['file_name']['tmp_name'], "r");

			$this->$model->query("DELETE FROM produtos WHERE anuncio_id = $anuncio_id AND is_imported = 1");

			$n_linha = 0;
			while (($data = fgetcsv($file, 0, ",")) !== FALSE) {
				if ( !empty($data[0]) && !empty($data[1]) && !empty($data[2]) ) // check if required fields there are content
				{
					if ($n_linha !== 0 && $n_linha !== 1)
					{
						$data[2] = $this->Utility->numberFormatToUS($data[2]);

						$sql = "INSERT INTO produtos (anuncio_id, nome, unidade, preco) VALUES($anuncio_id, '$data[0]' ,'$data[1]', '$data[2]')";
						$this->$model->query($sql);
					}
					$n_linha++;
				}
			}

			fclose($file);
			$n_linha = $n_linha - 2;

			$this->Flash->success(__('Foram importados ' . $n_linha . ' produtos com sucesso.'));

			return $this->redirect(Router::url($this->referer(), true));
		}

		$this->Flash->error(__('Erro 102 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
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