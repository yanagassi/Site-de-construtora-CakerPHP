<?php
App::uses('AppController', 'Controller');
class PaymentsController extends AppController
{
	public $helpers 		= array('Html','Form','Flash','Custom');
	public $components 		= array('Flash', 'Session','Paginator', 'Email','Pagseguro','Utility');
	public $uses 			= array();

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
		$this->loadModel('Advertisement');
		$this->loadModel('UserPlan');
		$this->loadModel('PagseguroPayment');

		$advertisement 			= $this->Advertisement->findById($this->request->data['Advertisement']['id']);
		$user_plan 				= $this->UserPlan->findByAdvertisementId($this->request->data['Advertisement']['id']);
		$payment_information 	= $this->PagseguroPayment->findByAdvertisementIdAndStatus($this->request->data['Advertisement']['id'],1);
		//$order 					= $this->Pagseguro->get_payment_information($payment_information['PagseguroPayment']['pagseguro_code']);
		//$orders_by_date 		= $this->Pagseguro->pagseguro_get_transaction_by_date();

		$this->set(compact('advertisement','user_plan','payment_information'));
	}

	public function add()
	{
		$pagseguro_session_id = $this->Pagseguro->get_session_id();
		$advertisement_id 	  = $this->request->query['advertisement_id'];
		$plan_id		 	  = $this->request->query['plan_id'];

		$this->loadModel('Plan');
		$this->loadModel('PagseguroPayment');
		$this->loadModel('UserPlan');

		$plan_info = $this->Plan->findById($plan_id);

		if ( $plan_id == 8 ) // trocando para o Grátis
		{
			$check_current_plan = $this->PagseguroPayment->findByAdvertisementIdAndStatus($advertisement_id,1);
			if ( $check_current_plan ) // É troca de plano
			{
				// Cancela o atual
				$result = $this->Pagseguro->signature_cancel($check_current_plan['PagseguroPayment']['pagseguro_code']);

				$this->log($result, 'error');
				$this->log(Configure::read('ENV'), 'error');

				if ( isset($result['status']) && $result['status'] == 'ok' )
				{
					// troca status do plano atual para 0
					$this->PagseguroPayment->id = $check_current_plan['PagseguroPayment']['id'];
					$this->PagseguroPayment->saveField('status', false);

					// Troca de plano para o free
					$user_plan 										= $this->UserPlan->findByAdvertisementId($advertisement_id);
					$data_user_plan['UserPlan']['id'] 				= $user_plan['UserPlan']['id'];
					$data_user_plan['UserPlan']['plan_id'] 			= 8;
					$this->UserPlan->save($data_user_plan);

					$this->Flash->success(__('Alterações realizadas com sucesso!'));
					return $this->redirect('/painel/anuncios/');
				}
				else
				{
					return $this->Flash->error(__('Erro 401 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
				}
			}
		}

		if ($this->request->is(array('post', 'put')))
		{
			// Prepara dados necessários do form

			$plan 											= $this->Plan->findById($plan_id);

			$this->request->data['User']['cpf'] 			= $this->Utility->clearAllToNumber($this->request->data['User']['cpf']);
			$this->request->data['User']['cell_phone'] 		= $this->Utility->clearAllToNumber($this->request->data['User']['cell_phone']);
			$this->request->data['User']['phone_area_code'] = substr($this->Utility->clearAllToNumber($this->request->data['User']['cell_phone']), 0, 2);

			$this->request->data['User']['phone_number'] 	= substr($this->Utility->clearAllToNumber($this->request->data['User']['cell_phone']), 2, 9);
			$this->request->data['Plan']['plan_id'] 		= ( Configure::read('ENV') == 'PRD' ? $plan['Plan']['pagseguro_id'] : $plan['Plan']['pagseguro_sandbox_id'] );
			$this->request->data['Plan']['reference'] 		= $advertisement_id;

			$this->request->data['Address']['cep'] 			= $this->Utility->clearAllToNumber($this->request->data['Address']['cep']);

			$this->log($this->request->data, 'error');
			$this->log(Configure::read('ENV'), 'error');

			// Checa se cliente quer trocar de plano ou é uma nova assinatura
			$check_current_plan = $this->PagseguroPayment->findByAdvertisementIdAndStatus($advertisement_id,1);
			if ( $check_current_plan ) // É troca de plano
			{
				// Cancela o atual
				$result = $this->Pagseguro->signature_cancel($check_current_plan['PagseguroPayment']['pagseguro_code']);

				$this->log($result, 'error');
				$this->log(Configure::read('ENV'), 'error');

				if ( isset($result['status']) && $result['status'] == 'ok' )
				{
					// troca status do plano atual para 0
					$this->PagseguroPayment->id = $check_current_plan['PagseguroPayment']['id'];
					$this->PagseguroPayment->saveField('status', false);

					// Anuncio do Saulo para teste - plano bronze 1.99
					if ( $advertisement_id == 335 )
						$plan['Plan']['plan_id'] = 'EC652BC6535363FEE454CF90D6F7F700';

					// Troca de plano
					$result = $this->Pagseguro->add_signature($this->request->data);

					$this->log($result, 'error');
					$this->log(Configure::read('ENV'), 'error');
				}
				else
				{
					return $this->Flash->error(__('Erro 401 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
				}
			}
			else
			{
				// Anuncio do Saulo para teste - plano bronze 1.99
				if ( $advertisement_id == 335 )
					$plan['Plan']['plan_id'] = 'EC652BC6535363FEE454CF90D6F7F700';

				// Assinatura nova
				$result = $this->Pagseguro->add_signature($this->request->data);

				$this->log($result, 'error');
				$this->log(Configure::read('ENV'), 'error');
			}

			if ( ! $result )
			{
				return $this->Flash->error(__('Erro 402 - Seu cartão de crédito resusou a solicitação. Tente novamente ou contacte a operadora.'));
			}


			// Retornar e salvar registro na tabela de pagamentos pagseguro
			$data_plan['PagseguroPayment']['pagseguro_code'] 	= $result;
			$data_plan['PagseguroPayment']['status'] 			= 1;
			$data_plan['PagseguroPayment']['advertisement_id'] 	= $advertisement_id;
			$data_plan['PagseguroPayment']['value'] 			= $plan['Plan']['valor_plano'];
			$data_plan['PagseguroPayment']['cc_final_number'] 	= substr($this->request->data['payment']['ps_cc_number'],12,4); // pega os últimos 4 números do cc
			$this->PagseguroPayment->save($data_plan);

			$this->log($data_plan, 'error');
			$this->log(Configure::read('ENV'), 'error');

			// Altera o plano do usuário
			$user_plan 										= $this->UserPlan->findByAdvertisementId($advertisement_id);
			$data_user_plan['UserPlan']['id'] 				= $user_plan['UserPlan']['id'];
			$data_user_plan['UserPlan']['advertisement_id'] = $advertisement_id;
			$data_user_plan['UserPlan']['plan_id'] 			= $plan['Plan']['id'];
			$this->UserPlan->save($data_user_plan);

			$this->log($data_user_plan, 'error');
			$this->log(Configure::read('ENV'), 'error');

			// Redir para tela de anúncios
			$this->Flash->success(__('Assinatura realizada com sucesso!'));
			return $this->redirect('/painel/anuncios/');

		}

		$this->set(compact('advertisement_id','plan_id','pagseguro_session_id','plan_info'));
	}

	public function view()
	{
		$result = $this->Pagseguro->signature_cancel($this->request->data['PagseguroPayment']['pagseguro_code']);
	}

	public function del()
	{
		$result = $this->Pagseguro->signature_cancel($this->request->data['PagseguroPayment']['pagseguro_code']);

		if ( $result['status'] != 'ok' )
		{
			$this->Flash->error(__('Erro 101 - Problemas para cancelar sua assinatura. Tente novamente ou contacte o administrador.'));
			return $this->redirect('/painel/anuncios/financeiro');
		}

		$this->loadModel('PagseguroPayment');
		$id = $this->request->data['PagseguroPayment']['id'];
		$this->PagseguroPayment->id = $id;
		$this->PagseguroPayment->saveField('status', false);

		$this->loadModel('UserPlan');
		$user_plan_id = $this->request->data['UserPlan']['id'];
		$this->UserPlan->id = $user_plan_id;
		$this->UserPlan->saveField('plan_id', 8);

		$this->Flash->success(__('Assinatura cancelada com sucesso!'));
		return $this->redirect('/painel/anuncios/');
	}

	public function edit(){}

	public function isAuthorized($user = null)
	{
		if ( $this->Auth->user('role') == 'admin' ) return true; // Only admins can access admin functions

		if ( ! in_array($this->action, array('edit', 'delete')) ) return true; // Everybody can view and add

		if ( ! $this->Post->isOwnedBy((int) $this->request->params['pass'][0], $user['id']) ) return false; // Only owner can edit or delete

		return true;
	}
}