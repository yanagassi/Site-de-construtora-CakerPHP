<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('Text', 'Utility');
App::uses('CakeEmail', 	'Network/Email');
App::uses('AppController', 'Controller');

class NotificationsController extends AppController
{

	public $helpers 		= array('Html', 'Form', 'Flash', 'Custom');
	public $components 		= array('Flash', 'Session', 'Paginator', 'Email');
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
		$this->Auth->allow('eletronic_signature', 'view_by_email');

		if ( ! $this->isAuthorized( $this->Auth->user('id') ) && ! in_array($this->action, array('edit', 'delete')) ) // check if user is OwnedBy and is editing or deleting
		{
			// Acl Extras Plugin => Enable
			//$this->Auth->authorize = 'actions';
			//$this->Auth->actionPath = 'controllers/';
		}
	}

	public function index()
	{
		$this->Notification->recursive = 2;
		$this->Paginator->settings = $this->paginate;
		$this->set('title_for_layout', 'Notificações');

		$conditions = [];
		if ( AuthComponent::user('role') != 'admin' )
		{
			//$conditions['User.parent_id'] = AuthComponent::user('id');
		}

		$this->Paginator->settings = array
		(
			 'limit'        => 1000
			,'order' 		=> array('Notification.created' => 'desc')
			,'conditions'   => $conditions
			//,'recursive'    => 1
		);

		$result					   = $this->Paginator->paginate('Notification');

		if ($result)
		{
			$i=0;
			foreach ( $result as $item )
			{
				// Increment for AR
				if ( $item['Notification']['is_acknowledgment_receipt'] == true && $item['Notification']['is_acknowledgment_receipt_checked'] == true )
				{
					$result[$i]['Notification']['is_acknowledgment_receipt'] 		 = 'fa-check-square-o';
					$result[$i]['Notification']['is_acknowledgment_receipt_checked'] = 'text-success';
				}
				else if ( $item['Notification']['is_acknowledgment_receipt'] == true && $item['Notification']['is_acknowledgment_receipt_checked'] == false )
				{
					$result[$i]['Notification']['is_acknowledgment_receipt'] 		 = 'fa-check-square-o';
					$result[$i]['Notification']['is_acknowledgment_receipt_checked'] = 'text-danger';
				}
				else
				{
					$result[$i]['Notification']['is_acknowledgment_receipt'] 		 = 'fa-times';
					$result[$i]['Notification']['is_acknowledgment_receipt_checked'] = '';
					//<i class="fa fa-times" style="filter:alpha(opacity=50);filter: progid:DXImageTransform.Microsoft.Alpha(opacity=0.5);opacity:.50;"></i>
				}

				// Increment for AS
				if ( $item['Notification']['is_electronic_signature'] == true && $item['Notification']['is_electronic_signature_checked'] == true )
				{
					$result[$i]['Notification']['is_electronic_signature'] 		   = 'fa-file-pdf-o';
					$result[$i]['Notification']['is_electronic_signature_checked'] = 'text-success';
				}
				else if ( $item['Notification']['is_electronic_signature'] == true && $item['Notification']['is_electronic_signature_checked'] == false )
				{
					$result[$i]['Notification']['is_electronic_signature'] 		   = 'fa-file-pdf-o';
					$result[$i]['Notification']['is_electronic_signature_checked'] = 'text-danger';
				}
				else
				{
					$result[$i]['Notification']['is_electronic_signature'] 		   = 'fa-times';
					$result[$i]['Notification']['is_electronic_signature_checked'] = '';
					//<i class="fa fa-times" style="filter:alpha(opacity=50);filter: progid:DXImageTransform.Microsoft.Alpha(opacity=0.5);opacity:.50;"></i>
				}

				$i++;
			}
		}

		$numbers = count($result);
		$this->set(compact('result', 'numbers'));
	}

	public function add()
	{
		$this->set('title_for_layout', 'Notificações - Adicionar');

		if ($this->request->is('post'))
		{
			$this->request->data['Notification']['user_id'] = $this->Auth->user('id');
			$this->request->data['Notification']["token"] = sha1(Configure::read('Security.salt') . AuthComponent::user('email') . time());

			if ( empty($this->request->data['Notification']['body']) ) {
				$this->request->data['Notification']['body'] = "Este é um aviso de notificação via email. Você está recebendo-o através do Aveeze, sistema de notificações online.";
			}

			if ( empty($this->request->data['Notification']['file_name']["name"]))
			{
				unset($this->request->data['Notification']['file_name']);
			}
			else
			{
				$allowedExts = array("pdf");
				$extension = pathinfo($this->request->data['Notification']['file_name']["name"], PATHINFO_EXTENSION);

				if ( $this->request->data['Notification']['file_name']["type"] == "application/pdf" && $this->request->data['Notification']['file_name']['size'] < 5000000 && in_array($extension, $allowedExts) )
				{
					if ($this->request->data['Notification']['file_name']["error"] > 0) return $this->Flash->error(__("Erro 458, tente novamente ou contacte o admnistrador!"));
				}
				else
				{
					return $this->Flash->error(__("Erro, extensão não permitida! Ou tamanho maior que suportado."));
				}
			}

			$this->Notification->create();

			if ($this->Notification->save($this->request->data))
			{
				$email_data = array(
					"to_email"  		=> $this->request->data['Notification']['to_email'],
					"to_name"   		=> $this->request->data['Notification']['to_name'],
					"subject"   		=> "[". Configure::read('BRAND') ."] - Nova Notificação Enviada",
					"body"       		=> $this->request->data['Notification']['body'],
					"token" 			=> $this->request->data['Notification']["token"],
					"from_first_name" 	=> AuthComponent::user('first_name'),
					"from_last_name" 	=> AuthComponent::user('last_name'),
					"from_email" 		=> AuthComponent::user('email')
				);

				$email_data['is_acknowledgment_receipt'] = false;
				$email_data['is_electronic_signature']   = false;

				if ( !empty($this->request->data['Notification']['is_acknowledgment_receipt']) && $this->request->data['Notification']['is_acknowledgment_receipt'] ) $email_data['is_acknowledgment_receipt'] = true;
				if ( !empty($this->request->data['Notification']['is_electronic_signature'])   && $this->request->data['Notification']['is_electronic_signature'] )   $email_data['is_electronic_signature'] = true;

				if ( ! $this->Email->sendMail( $email_data ) ) return $this->Flash->error(__("469 - Ocorreu um erro ao enviar um email para o usuário. Tente novamente ou contacte o administrador!"));

				$this->Flash->success(__('Notificação enviada com sucesso'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('Erro 101 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function view($id = null)
	{
		$this->set('title_for_layout', 'Notificações - Visualizar');

		$this->Notification->id = $id;
		if (!$this->Notification->exists()) {
			throw new NotFoundException(__('Requisição Inválida'));
		}
		$this->set('notification', $this->Notification->findById($id));
	}

	public function view_by_email($token = null)
	{
		$this->layout = 'notification';

		if ( is_null($token) )
			return $this->redirect(array('action' => 'index'));

		$notification = $this->Notification->findByToken($token);

		if ( empty($notification) )
			return $this->Flash->error(__('Erro (5687) ao validar a Notificação. Tente novamente ou contacte o administrador'));

		$from_user 			= ClassRegistry::init('User')->findById($notification['Notification']['user_id']);
		$to_name 			= $notification['Notification']['to_name'];
		$id 	 			= $notification['Notification']['id'];
		$body 	 			= $notification['Notification']['body'];
		$date 	 			= $notification['Notification']['created'];
		$from_first_name 	= $from_user['User']['first_name'];
		$from_last_name 	= $from_user['User']['last_name'];
		$from_email 		= $from_user['User']['email'];

		$full_path_file = ClassRegistry::init('User')->findById( $notification['Notification']['user_id'] );
		if ( !empty($notification['Notification']['file_name']) )
		{
			$link_doc = '/uploads/customers/' . $full_path_file['User']['full_path_files'] .'/'. $notification['Notification']['file_name'];
		}else{
			$link_doc = '';
		}

		if ( empty($link_doc) )
		{
			$this->Notification->id = $notification['Notification']['id'];
			$data['Notification']['is_acknowledgment_receipt_checked'] = true;
			$data['Notification']['acknowledgment_receipt_visualized'] = date("Y-m-d H:i:s");

			if ( ! $this->Notification->save($data['Notification']) )
			{
				return $this->Flash->error(__('Erro (5688) ao validar o Aviso de Recebimento (AR). Tente novamente ou contacte o administrador'));
			}

			$this->Flash->success(__('Aviso de Recebimento (AR) Realizado com Sucesso!'));
		}
		else
		{
			if ($this->request->is(array('post', 'put')))
			{
				$this->Notification->id = $notification['Notification']['id'];
				$data['Notification']['is_acknowledgment_receipt_checked'] = true;
				$data['Notification']['acknowledgment_receipt_visualized'] = date("Y-m-d H:i:s");

				if ( ! $this->Notification->save($data['Notification']) )
				{
					return $this->Flash->error(__('Erro (5688) ao validar o Aviso de Recebimento (AR). Tente novamente ou contacte o administrador'));
				}

				$this->Flash->success(__('Aviso de Recebimento (AR) Realizado com Sucesso!'));
			}
		}

		$this->set(compact('to_name', 'id', 'date', 'body', 'from_first_name', 'from_last_name', 'from_email', 'is_electronic_signature', 'link_doc', 'link_signature'));
	}

	public function eletronic_signature($token = null)
	{
		$this->layout = 'notification';

		if ( is_null($token) )
			return $this->redirect(array('action' => 'index'));

		$notification = $this->Notification->findByToken($token);

		if ( empty($notification) )
			return $this->Flash->error(__('Erro (5687) ao validar a Notificação. Tente novamente ou contacte o administrador'));

		$this->Notification->id = $notification['Notification']['id'];

		if ($this->request->is(array('post', 'put')))
		{
			$this->Notification->id = $notification['Notification']['id'];
			$notification['Notification']['is_electronic_signature_checked'] = true;
			$notification['Notification']['electronic_signature_signed'] = date("Y-m-d H:i:s");

			if ($notification['Notification']['is_acknowledgment_receipt'])
			{
				$notification['Notification']['is_acknowledgment_receipt_checked'] = true;
				$notification['Notification']['acknowledgment_receipt_visualized'] = date("Y-m-d H:i:s");
			}


			if ( ! $this->Notification->save($notification['Notification']) )
			{
				return $this->Flash->error(__('Erro (5688) ao validar a Assinatura Eletrônica. Tente novamente ou contacte o administrador'));
			}

			$this->Flash->success(__('Assinatura Eletrônica Realizada com Sucesso!'));
		}

		if ( $notification['Notification']['is_electronic_signature'] )
		{
			$is_electronic_signature = true;
			$full_path_file = ClassRegistry::init('User')->findById( $notification['Notification']['user_id'] );

			if ( !empty($notification['Notification']['file_name']) )
			{
				$link_doc = '/uploads/customers/' . $full_path_file['User']['full_path_files'] .'/'. $notification['Notification']['file_name'];
			}else{
				$link_doc = '';
			}

			$link_signature = Configure::read('HOST') . '/notificacoes/assinatura-eletronica/token/' . $token;
		}

		$from_user 						 = ClassRegistry::init('User')->findById($notification['Notification']['user_id']);
		$to_name 						 = $notification['Notification']['to_name'];
		$id 	 						 = $notification['Notification']['id'];
		$body 	 						 = $notification['Notification']['body'];
		$date 	 						 = $notification['Notification']['created'];
		$from_first_name 				 = $from_user['User']['first_name'];
		$from_last_name 				 = $from_user['User']['last_name'];
		$from_email 					 = $from_user['User']['email'];
		$is_electronic_signature_checked = $notification['Notification']['is_electronic_signature_checked'];

		$this->set(compact('to_name', 'id', 'date', 'body', 'from_first_name', 'from_last_name', 'from_email', 'is_electronic_signature', 'is_electronic_signature_checked', 'link_doc', 'link_signature'));
	}

	public function edit($id = null)
	{
		$this->set('title_for_layout', 'Notificações - Editar');

		$this->Notification->id = $id;
		if (!$this->Notification->exists()) {
			throw new NotFoundException(__('Requisição Inválida'));
		}

		if ($this->request->is(array('post', 'put')))
		{
			if ($this->Notification->save($this->request->data))
			{
				$this->Flash->success(__('Dados salvo com sucesso'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('Erro 102 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
		}
		else
		{
			$this->request->data = $this->Notification->findById($id);
		}
	}

	public function delete($id)
	{
		$this->autoRender = false; // request from ajax
		$this->request->allowMethod('post');

		if ($this->request->is(array('post', 'put')))
		{
			if ($this->Notification->delete($id))
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
		// The owner of a post can edit and delete it
		if (in_array($this->action, array('edit', 'delete')))
		{
			$itemId = (int) $this->request->params['pass'][0];
			if ($this->Notification->isOwnedBy($itemId, $user['id']))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

}
