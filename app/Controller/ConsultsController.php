<?php
App::uses('AppController', 'Controller');
class ConsultsController extends AppController
{
	public $helpers 		= array('Html','Form','Flash','Custom');
	public $components 		= array('Flash','Session','Paginator','Email','Pagseguro','Utility','RequestHandler','Serasa','Validation');
	public $uses 			= array('Consult','ConsultCategory');

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

		$result = $this->Paginator->paginate('ConsultCategory');

		$numbers = count($result);
		$this->set(compact('result','numbers'));
	}
	public function add(){}
	public function view(){}
	public function edit(){}

	public function isAuthorized($user = null)
	{
		if ( $this->Auth->user('role') == 'admin' ) return true; // Only admins can access admin functions

		if ( ! in_array($this->action, array('edit', 'delete')) ) return true; // Everybody can view and add

		if ( ! $this->Post->isOwnedBy((int) $this->request->params['pass'][0], $user['id']) ) return false; // Only owner can edit or delete

		return true;
	}

	public function cdc_pessoa_fisica_simplificada()
	{
		$result = [];
		if ($this->request->is('post')) {

			if (!$this->Validation->cpf_validation($this->request->data['Consult']['document']))
				return $this->Flash->error(__('Erro 125 - CPF Inválido!'));

			if (!$this->Validation->checkDate($this->request->data['Consult']['birthday']))
				return $this->Flash->error(__('Erro 125 - Data de Nascimento Inválida!'));

			$result = $this->Serasa->cdc_pessoa_fisica_simplificada($this->request->data);

			if ($result->Status)
			{
				$this->request->data['Consult']['consult_category_id'] = 1; // Consulta CDC Pessoa Física Simplificada
				$this->request->data['Consult']['user_id'] = $this->Auth->user('id');
				$this->request->data['Consult']['result_serasa'] = serialize($result);

				if ($this->Consult->save($this->request->data)) {
					$this->Flash->success(__($result->Mensagem));
				} else {
					$this->Flash->error(__($result->Mensagem));
				}
			}else{
				$this->Flash->error(__($result->Mensagem));
			}
		}

		$this->set(compact('result'));
	}

	public function cdc_pessoa_fisica_estendida()
	{
		$result = [];
		if ($this->request->is('post'))
		{
			if (!$this->Validation->cpf_validation($this->request->data['Consult']['document']))
				return $this->Flash->error(__('Erro 125 - CPF Inválido!'));

			$result = $this->Serasa->cdc_pessoa_fisica_estendida($this->request->data);

			if ($result->Status)
			{
				$this->request->data['Consult']['consult_category_id'] = 2; // Consulta CDC Pessoa Física Estendida
				$this->request->data['Consult']['user_id'] = $this->Auth->user('id');
				$this->request->data['Consult']['result_serasa'] = serialize($result);

				if ($this->Consult->save($this->request->data)) {
					$this->Flash->success(__($result->Mensagem));
				} else {
					$this->Flash->error(__($result->Mensagem));
				}
			}else{
				$this->Flash->error(__($result->Mensagem));
			}
		}

		$this->set(compact('result'));
	}

	public function cdc_pessoa_juridica_simplificada()
	{
		$result = [];
		if ($this->request->is('post')) {

			if (!$this->Validation->cnpj_validation($this->request->data['Consult']['document']))
				return $this->Flash->error(__('Erro 125 - CNPJ Inválido!'));

			$result = $this->Serasa->cdc_pessoa_juridica_simplificada($this->request->data);

			if ($result->Status)
			{
				$this->request->data['Consult']['consult_category_id'] = 3; // Consulta CDC Pessoa Jurídica Simplificada
				$this->request->data['Consult']['user_id'] = $this->Auth->user('id');
				$this->request->data['Consult']['result_serasa'] = serialize($result);

				if ($this->Consult->save($this->request->data)) {
					$this->Flash->success(__($result->Mensagem));
				} else {
					$this->Flash->error(__($result->Mensagem));
				}
			}else{
				$this->Flash->error(__($result->Mensagem));
			}
		}

		$this->set(compact('result'));
	}

	public function cdc_sintese_cadastral()
	{
		$result = [];
		if ($this->request->is('post'))
		{
			if ( $this->Validation->limpaCPF_CNPJ($this->request->data['Consult']['document']) > 11 )
			{
				if (!$this->Validation->cnpj_validation($this->request->data['Consult']['document']))
					return $this->Flash->error(__('Erro 125 - CNPJ Inválido!'));
			}else{
				if (!$this->Validation->cpf_validation($this->request->data['Consult']['document']))
					return $this->Flash->error(__('Erro 125 - CPF Inválido!'));
			}


			$result = $this->Serasa->cdc_sintese_cadastral($this->request->data);

			if ($result['Status'])
			{
				$this->request->data['Consult']['consult_category_id'] = 4; // Consulta CDC - Síntese Cadastral
				$this->request->data['Consult']['user_id'] = $this->Auth->user('id');
				$this->request->data['Consult']['result_serasa'] = serialize($result);

				if ($this->Consult->save($this->request->data)) {
					$this->Flash->success(__($result['Mensagem']));
				} else {
					$this->Flash->error(__($result['Mensagem']));
				}
			}else{
				$this->Flash->error(__($result['Mensagem']));
			}
		}

		$this->set(compact('result'));
	}

	public function cdc_rf_pessoa_fisica()
	{
		$result = [];
		if ($this->request->is('post'))
		{
			if (!$this->Validation->cpf_validation($this->request->data['Consult']['document']))
				return $this->Flash->error(__('Erro 125 - CPF Inválido!'));

			$result = $this->Serasa->cdc_rf_pessoa_fisica($this->request->data);

			if ($result->Status)
			{
				$this->request->data['Consult']['consult_category_id'] = 5; // Consulta CDC - RF - Consulta Pessoa Física
				$this->request->data['Consult']['user_id'] = $this->Auth->user('id');
				$this->request->data['Consult']['result_serasa'] = serialize($result);

				if ($this->Consult->save($this->request->data)) {
					$this->Flash->success(__($result->Mensagem));
				} else {
					$this->Flash->error(__($result->Mensagem));
				}
			}else{
				$this->Flash->error(__($result->Mensagem));
			}
		}

		$this->set(compact('result'));
	}

	public function cdc_rf_pessoa_juridica_nfe()
	{
		$result = [];
		if ($this->request->is('post'))
		{
			if (!$this->Validation->cnpj_validation($this->request->data['Consult']['document']))
				return $this->Flash->error(__('Erro 125 - CNPJ Inválido!'));

			$result = $this->Serasa->cdc_rf_pessoa_juridica_nfe($this->request->data);

			if ($result->Status)
			{
				$this->request->data['Consult']['consult_category_id'] = 6; // Consulta Pessoa Jurídica
				$this->request->data['Consult']['user_id'] = $this->Auth->user('id');
				$this->request->data['Consult']['result_serasa'] = serialize($result);

				if ($this->Consult->save($this->request->data)) {
					$this->Flash->success(__($result->Mensagem));
				} else {
					$this->Flash->error(__($result->Mensagem));
				}
			}else{
				$this->Flash->error(__($result->Mensagem));
			}
		}

		$this->set(compact('result'));
	}

	public function cdc_rf_pessoa_juridica_extendida()
	{
		$result = [];
		if ($this->request->is('post'))
		{
			if (!$this->Validation->cnpj_validation($this->request->data['Consult']['document']))
				return $this->Flash->error(__('Erro 125 - CNPJ Inválido!'));

			$result = $this->Serasa->cdc_rf_pessoa_juridica_extendida($this->request->data);

			if ($result['Status'])
			{
				$this->request->data['Consult']['consult_category_id'] = 7; // Consulta CDC - RF - Consulta Pessoa Jurídica Estendida
				$this->request->data['Consult']['user_id'] = $this->Auth->user('id');
				$this->request->data['Consult']['result_serasa'] = serialize($result);

				if ($this->Consult->save($this->request->data)) {
					$this->Flash->success(__($result['Mensagem']));
				} else {
					$this->Flash->error(__($result['Mensagem']));
				}
			}else{
				$this->Flash->error(__($result['Mensagem']));
			}
		}

		$this->set(compact('result'));
	}

	public function cdc_rf_pessoa_juridica_simples_nacional()
	{
		$result = [];
		if ($this->request->is('post'))
		{
			if (!$this->Validation->cnpj_validation($this->request->data['Consult']['document']))
				return $this->Flash->error(__('Erro 125 - CNPJ Inválido!'));

			$result = $this->Serasa->cdc_rf_pessoa_juridica_simples_nacional($this->request->data);

			if ($result['Status'])
			{
				$this->request->data['Consult']['consult_category_id'] = 8; // Consulta CDC - RF - Consulta Pessoa Jurídica Simples Nacional
				$this->request->data['Consult']['user_id'] = $this->Auth->user('id');
				$this->request->data['Consult']['result_serasa'] = serialize($result);

				if ($this->Consult->save($this->request->data)) {
					$this->Flash->success(__($result['Mensagem']));
				} else {
					$this->Flash->error(__($result['Mensagem']));
				}
			}else{
				$this->Flash->error(__($result['Mensagem']));
			}
		}

		$this->set(compact('result'));
	}

	public function serasa_experian_pefin()
	{
		$result = [];
		if ($this->request->is('post'))
		{
			if (!$this->Validation->cnpj_validation($this->request->data['Consult']['document']))
				return $this->Flash->error(__('Erro 125 - CNPJ Inválido!'));

			$result = $this->Serasa->serasa_experian_pefin($this->request->data);

			if ($result->Status)
			{
				$this->request->data['Consult']['consult_category_id'] = 9; // SERASA Experian - PEFIN - Pendências Financeiras
				$this->request->data['Consult']['user_id'] = $this->Auth->user('id');
				$this->request->data['Consult']['result_serasa'] = serialize($result);

				if ($this->Consult->save($this->request->data)) {
					$this->Flash->success(__($result->Transacao->CodigoStatusDescricao));
				} else {
					$this->Flash->error(__($result->Transacao->CodigoStatusDescricao));
				}
			}else{
				$this->Flash->error(__($result->Transacao->CodigoStatusDescricao));
			}
		}

		$this->set(compact('result'));
	}

	public function serasa_experian_crednet()
	{
		$result = [];
		if ($this->request->is('post'))
		{
			if (!$this->Validation->cnpj_validation($this->request->data['Consult']['document']))
				return $this->Flash->error(__('Erro 125 - CNPJ Inválido!'));

			$result = $this->Serasa->serasa_experian_crednet($this->request->data);

			if ($result->Status)
			{
				$this->request->data['Consult']['consult_category_id'] = 9; // SERASA Experian - CREDNET - Pendências Financeiras + Cartórios Estaduais
				$this->request->data['Consult']['user_id'] = $this->Auth->user('id');
				$this->request->data['Consult']['result_serasa'] = serialize($result);

				if ($this->Consult->save($this->request->data)) {
					$this->Flash->success(__($result->Transacao->CodigoStatusDescricao));
				} else {
					$this->Flash->error(__($result->Transacao->CodigoStatusDescricao));
				}
			}else{
				$this->Flash->error(__($result->Transacao->CodigoStatusDescricao));
			}
		}

		$this->set(compact('result'));
	}

	public function serasa_experian_crednet_estendida()
	{
		$result = [];
		if ($this->request->is('post'))
		{
			if (!$this->Validation->cnpj_validation($this->request->data['Consult']['document']))
				return $this->Flash->error(__('Erro 125 - CNPJ Inválido!'));

			$result = $this->Serasa->serasa_experian_crednet_estendida($this->request->data);

			if ($result->Status)
			{
				$this->request->data['Consult']['consult_category_id'] = 10; // CREDNET - ESTENDIDA - Pendências Financeiras + Cartórios Estaduais + Opcionais: Quadro de Socios, Participações
				$this->request->data['Consult']['user_id'] = $this->Auth->user('id');
				$this->request->data['Consult']['result_serasa'] = serialize($result);

				if ($this->Consult->save($this->request->data)) {
					$this->Flash->success(__($result->Transacao->CodigoStatusDescricao));
				} else {
					$this->Flash->error(__($result->Transacao->CodigoStatusDescricao));
				}
			}else{
				$this->Flash->error(__($result->Transacao->CodigoStatusDescricao));
			}
		}

		$this->set(compact('result'));
	}

	public function serasa_experian_concentre()
	{
		$result = [];
		if ($this->request->is('post'))
		{
			if (!$this->Validation->cnpj_validation($this->request->data['Consult']['document']))
				return $this->Flash->error(__('Erro 125 - CNPJ Inválido!'));

			$result = $this->Serasa->serasa_experian_concentre($this->request->data);

			if ($result->Status)
			{
				$this->request->data['Consult']['consult_category_id'] = 11; // CONCENTRE - Consulta CONCENTRE CPF/CNPJ
				$this->request->data['Consult']['user_id'] = $this->Auth->user('id');
				$this->request->data['Consult']['result_serasa'] = serialize($result);

				if ($this->Consult->save($this->request->data)) {
					$this->Flash->success(__($result->Transacao->CodigoStatusDescricao));
				} else {
					$this->Flash->error(__($result->Transacao->CodigoStatusDescricao));
				}
			}else{
				$this->Flash->error(__($result->Transacao->CodigoStatusDescricao));
			}
		}

		$this->set(compact('result'));
	}

	public function serasa_experian_cheques()
	{
		$result = [];
		if ($this->request->is('post'))
		{
			if (!$this->Validation->cnpj_validation($this->request->data['Consult']['document']))
				return $this->Flash->error(__('Erro 125 - CNPJ Inválido!'));

			$result = $this->Serasa->serasa_experian_cheques($this->request->data);

			if ($result->Status)
			{
				$this->request->data['Consult']['consult_category_id'] = 11; // CONCENTRE - Consulta CONCENTRE CPF/CNPJ
				$this->request->data['Consult']['user_id'] = $this->Auth->user('id');
				$this->request->data['Consult']['result_serasa'] = serialize($result);

				if ($this->Consult->save($this->request->data)) {
					$this->Flash->success(__($result->Transacao->CodigoStatusDescricao));
				} else {
					$this->Flash->error(__($result->Transacao->CodigoStatusDescricao));
				}
			}else{
				$this->Flash->error(__($result->Transacao->CodigoStatusDescricao));
			}
		}

		$this->set(compact('result'));
	}

}