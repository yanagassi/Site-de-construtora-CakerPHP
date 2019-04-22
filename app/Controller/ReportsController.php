<?php

class ReportsController extends AppController {

	public $helpers 		= array('Html','Form','Flash','Custom');
	public $components 		= array('Flash','Session','Paginator','Email','Utility','Date','Validation');
	public $uses 			= [];

	public function beforeFilter()
	{
		parent::beforeFilter();
	}

	public function index()
	{
		$this->set('title_for_layout', 'Relatórios');
		$this->set('sub_title_for_layout', 'Lista');

		$this->loadModel('Advertisement');
		$this->loadModel('Product');
		$this->loadModel('Service');

		$columns =
			[
				'Report.advertisement_id',
				'Advertisement.titulo_anuncio',
				'SUM(Report.advertisement_view) as adv_view',
				'SUM(Report.advertisement_clicked) as adv_click',
				'SUM(Report.phone_clicked) as adv_phone_click',
				'SUM(Report.email_clicked) as adv_email_click',
				'SUM(Report.product_view) as adv_product_view',
				'SUM(Report.service_view) as adv_service_view',
			];

		$columns_group =
			[
				'Report.advertisement_id'
			];

		$conditions =
			[
				'User.id' 					=> $this->Auth->user('id'),
				'Advertisement.status' 		=> true,
				[
					'and' =>
					['Report.created >= ' 	=> date('Y-m-01 00:00:00')],
					['Report.created <= ' 	=> date('Y-m-t 23:59:59')]
				]
			];

		$joins[] =
			[
				'table' 		=> 'anuncios',
				'alias' 		=> 'Advertisement',
				'type' 			=> 'INNER',
				'conditions' 	=>
					[
						'Report.advertisement_id = Advertisement.id',
					]
			];

		$joins[] =
			[
				'table' 		=> 'clientes',
				'alias' 		=> 'User',
				'type' 			=> 'INNER',
				'conditions' 	=>
					[
						'Advertisement.cliente_id = User.id',
					]
			];

		$options = array
		(
			 'fields' 		=> $columns
			,'group' 		=> $columns_group
			,'joins' 		=> $joins
			,'conditions'   => $conditions
			,'recursive'    => 2
		);

		$q_advertisement  = $this->Advertisement->find('all', ['conditions' => ['Advertisement.cliente_id' => $this->Auth->user('id'), 'Advertisement.status' => 1], 'fields' => ['Advertisement.id'], 'recursive' => 0]);

		foreach ( $q_advertisement as $item )
		{
			$w_in[] = $item['Advertisement']['id']; // construct where_in clause
		}

		$adv_product_total = $this->Report->find('all', ['conditions' => ['Report.advertisement_id' => $w_in], 'fields' => ['DISTINCT Report.product_view_word', 'Report.product_view_word']]);
		$adv_service_total = $this->Report->find('all', ['conditions' => ['Report.advertisement_id' => $w_in], 'fields' => ['DISTINCT Report.service_view_word', 'Report.service_view_word']]);

		$result  = $this->Report->find('all',  $options);
		$numbers = count($result);

		$this->set(compact('result','numbers','adv_product_total','adv_service_total'));
	}

	public function index_admin()
	{
		$this->set('title_for_layout', 'Anúncios');
		$this->set('sub_title_for_layout', 'Lista');

		$page 				   		= null;
		$limit 				   		= 10;
		$conditions 				= [];

		if ( isset($this->request->query['page']) && !empty($this->request->query['page']) )
			$page = $this->request->query['page'];

		if ( isset($this->request->query['limit']) && !empty($this->request->query['limit']) )
			$limit = $this->request->query['limit'];

		// if search cpf/cnpj or title advertisement
		if ( isset($this->request->data['term']) && !empty($this->request->data['term']) )
		{
			if ( strlen($this->request->data['term']) > 0 && ctype_digit(substr($this->request->data['term'], 0, 2)) )
			{
				$cpf_cnpj = $this->Utility->clearAllToNumber($this->request->data['term']);

				$conditions['OR'] =
				[
					['Advertisement.cpf LIKE'  			=> '%'.$cpf_cnpj.'%'],
					['Advertisement.cnpj LIKE'        	=> '%'.$cpf_cnpj.'%']
				];
			}
			else
			{
				$conditions['OR'] = [['Advertisement.titulo_anuncio LIKE' 	=> '%'.$this->request->data['term'].'%']];
			}
		}

		$columns =
			[
				'Advertisement.*'
			];

		$columns_group =
			[
				'Advertisement.id'
				//,'Rating.id',
			];

		$this->Paginator->settings = array
		(
			 'order' 		=> array('Advertisement.created' => 'desc')
			,'fields'		=> $columns
			,'group' 		=> $columns_group
			,'conditions'   => $conditions
			,'recursive'    => 2
			,'limit' 		=> $limit
			,'page'  		=> $page
		);

		$result = $this->Paginator->paginate('Advertisement');
		$numbers = $this->Advertisement->find('count');;

		$this->set(compact('result', 'numbers'));
	}

	public function add()
	{
		$this->set('title_for_layout', 'Anúncios');
		$model = $this->modelClass;

		if ($this->request->is('post'))
		{
			$this->request->data[$model]['cliente_id'] = $this->Auth->user('id');
			$this->request->data[$model]['plano_id']   = 8; // gratis => ToDo: Refactoring
			$this->request->data[$model]['status'] = 1; // active

			if ($this->$model->save($this->request->data))
			{
				$this->Flash->success(__('Dados salvo com sucesso'));

				$last_id_inserted = $this->$model->getLastInsertId();

				return $this->redirect(array('action' => "edit/$last_id_inserted"));
			}
			$this->Flash->error(__('Erro 109 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
		}

//		if ($this->request->is('post'))
//		{
//			$this->request->data['Agreement']['value'] = $this->Utility->numberFormatToUS($this->request->data['Agreement']['value']);
//
//			$this->request->data['Agreement']['user_id'] = $this->Auth->user('id');
//
//			$cpf_cnpj = $this->request->data['Agreement']['cpf_cnpj'];
//			if ( strlen($cpf_cnpj) == 14 ) {
//				$cpf_cnpj = $this->Validation->cpf_validation( $cpf_cnpj );
//				if ( $cpf_cnpj == false )
//					return $this->Flash->error(__("CPF Inválido"));
//			}
//			else
//			{
//				$cpf_cnpj = $this->Validation->cnpj_validation( $cpf_cnpj );
//				if ( $cpf_cnpj == false )
//					return $this->Flash->error(__("CNPJ Inválido"));
//			}
//
//
//			if ( empty($this->request->data['Agreement']['file_name']["name"]))
//			{
//				unset($this->request->data['Agreement']['file_name']);
//			}
//			else
//			{
//				$allowedExts = array("pdf");
//				$extension = pathinfo($this->request->data['Agreement']['file_name']["name"], PATHINFO_EXTENSION);
//
//				if ( $this->request->data['Agreement']['file_name']["type"] == "application/pdf" && $this->request->data['Agreement']['file_name']['size'] < 5000000 && in_array($extension, $allowedExts) )
//				{
//					if ($this->request->data['Agreement']['file_name']["error"] > 0) return $this->Flash->error(__("Erro 459, tente novamente ou contacte o admnistrador!"));
//				}
//				else
//				{
//					return $this->Flash->error(__("Erro, extensão não permitida! Ou tamanho maior que suportado."));
//				}
//			}
//
//			if ( ! $this->Date->formatDate($this->request->data['Agreement']['validity']) )
//			{
//				return $this->Flash->error(__('Erro 110 - Data de validade informada incorreta'));
//			}
//
//			$this->request->data['Agreement']['validity'] = $this->Date->formatDate($this->request->data['Agreement']['validity']);
//
//			$this->request->data['Agreement']['cpf_cnpj'] = preg_replace('/[^0-9]/', '',$this->request->data['Agreement']['cpf_cnpj']);
//
//			$this->Agreement->create();
//
//			if ($this->Agreement->save($this->request->data))
//			{
//				$this->Flash->success(__('Dados salvo com sucesso'));
//				return $this->redirect(array('action' => 'index'));
//			}
//			$this->Flash->error(__('Erro 109 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
//
//		}
	}

	public function edit($id = null)
	{
		$this->set('title_for_layout', 'Anúncios');

		$this->Flash->ajaxError('', array('key' => 'ajax-error'));
		$this->Flash->ajaxSuccess('', array('key' => 'ajax-success'));

		$model = $this->modelClass;
		$this->$model->id = $id;

		if (!$this->$model->exists())
			throw new NotFoundException(__('Requisição Inválida'));

		if ($this->request->is(array('post', 'put')))
		{
			$data = $this->request->data;
			$data["Advertisement"]["id"] = $id;
			unset($data["Phone"]);

			if ( !empty($data["Advertisement"]['logo']["name"]) ) // Logo
			{
				if ( $this->Utility->imagePrepare( $this->request->data[$model]['logo'], $size = 5000000 /* 5Mb */ ) == false )
					return $this->Session->setFlash(__("Erro, extensão não permitida, ou tamanho de imagem muito grande!"), 'change-box', array('class'=>'error'));

				if ( getimagesize($data[$model]['logo']['tmp_name']) !== false)
				{
					//$data["Advertisement"]['file_logo_binary'] 	= base64_encode(file_get_contents( $data[$model]['logo']['tmp_name'] ));
					//$data["Advertisement"]['file_logo_type'] 	= pathinfo($data[$model]['logo']['name'], PATHINFO_EXTENSION);
					//$data["Advertisement"]['file_logo_size'] 	= $data[$model]['logo']['size'];
				}
				else
				{
					return $this->Session->setFlash(__("Erro, arquivo corrompido ou em branco!"), 'change-box', array('class'=>'error'));
				}
			}
			else
			{
				unset($data[$model]['logo']);
			}

			if ( !empty($data["Advertisement"]['foto_capa']["name"]) ) // foto capa
			{
				if ( $this->Utility->imagePrepare( $this->request->data[$model]['foto_capa'], $size = 5000000 /* 5Mb */ ) == false )
					return $this->Session->setFlash(__("Erro, extensão não permitida, ou tamanho de imagem muito grande!"), 'change-box', array('class'=>'error'));

				if ( getimagesize($data[$model]['foto_capa']['tmp_name']) !== false)
				{
					//$data["Advertisement"]['file_logo_binary'] 	= base64_encode(file_get_contents( $data[$model]['foto_capa']['tmp_name'] ));
					//$data["Advertisement"]['file_logo_type'] 	= pathinfo($data[$model]['foto_capa']['name'], PATHINFO_EXTENSION);
					//$data["Advertisement"]['file_logo_size'] 	= $data[$model]['foto_capa']['size'];

				}
				else
				{
					return $this->Session->setFlash(__("Erro, arquivo corrompido ou em branco!"), 'change-box', array('class'=>'error'));
				}
			}
			else
			{
				unset($data[$model]['foto_capa']);
			}

			if ($this->$model->saveAssociated($data, array('validate' => false)))
			{
				$this->Flash->success(__('Dados salvo com sucesso'));

				// Return to page came from
				$result = $this->$model->findById($id);
				$this->set(compact('result'));

				return $this->redirect( Router::url( $this->referer(), true ) );
			}
			$this->Flash->error(__('Erro 102 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
		}
		else
		{
			$result = $this->$model->findById($id);
			$this->set(compact('result'));
		}
	}

	public function photo_logo($id = null)
	{
		$this->set('title_for_layout', 'Anúncios');
		$model = $this->modelClass;
		$result = $this->$model->findById($id);
		$this->set(compact('result'));
	}

	public function photo_capa($id = null)
	{
		$this->set('title_for_layout', 'Anúncios');
		$model = $this->modelClass;
		$result = $this->$model->findById($id);
		$this->set(compact('result'));
	}

	public function remove_photo_logo($id = null)
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$model = $this->modelClass;
		$result = $this->$model->findById($id);

		$logo = WWW_ROOT . 'uploads/anuncio/logo/' . $id . DS . $result['Advertisement']['logo'];

		if (is_file($logo))
		{
			unlink($logo);
		}

		$this->$model->id = $id;

		if ( $this->$model->saveField('logo', null, array('validate'=>false, 'callbacks'=>false)) )
		{
			$result = array
			(
				'status' => true,
				'msg' 	 => 'Dados salvo com sucesso!'
			);
			return json_encode($result);
		}
		else
		{
			$result = array
			(
				'status' => false,
				'msg' 	 => 'Problema ao remover sua foto. Tente novamente ou contate o administrador!'
			);
			return json_encode($result);
		}
	}

	public function remove_photo_capa($id = null)
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$model = $this->modelClass;
		$result = $this->$model->findById($id);

		$img = WWW_ROOT . 'uploads/anuncio/foto_capa/' . $id . DS . $result['Advertisement']['foto_capa'];

		if (is_file($img))
		{
			unlink($img);
		}

		$this->$model->id = $id;

		if ( $this->$model->saveField('foto_capa', null, array('validate'=>false, 'callbacks'=>false)) )
		{
			$result = array
			(
				'status' => true,
				'msg' 	 => 'Dados salvo com sucesso!'
			);
			return json_encode($result);
		}
		else
		{
			$result = array
			(
				'status' => false,
				'msg' 	 => 'Problema ao remover sua foto. Tente novamente ou contate o administrador!'
			);
			return json_encode($result);
		}
	}

	public function upload_image()
	{
		if ( $this->request->is(array('post')) )
		{
			$model = $this->modelClass;

			$this->autoRender = false;
			$this->layout = 'ajax';

			if (!$this->request->data[$model]['img'])
				return json_encode(['status' => false, 'msg' => 'Erro 105 - Dados inválidos ou corrompidos. Tente novamente ou contate o administrador.']);

			$id 	  		  = $this->request->data[$model]['id'];
			$img_name 		  = uniqid($this->request->data[$model]['field'] . "_" . $id);

			$file = $this->Utility->convertImgBase64ToBinary($this->request->data[$model]['img']);
			$dir = WWW_ROOT . $this->request->data[$model]['relative_path'] . DS . $id . DS;

			$this->$model->check_dir($dir);

			$result = file_put_contents($dir . "$img_name.{$file['image']['type']}", $file['image']['binary']);

			if ( ! $result )
				return json_encode(['status' => false, 'msg' => 'Erro 106 - Erro ao salvar o arquivo.']);

			$this->$model->id = $id;

			if ( ! $this->$model->saveField($this->request->data[$model]['field'], "$img_name.{$file['image']['type']}", array('validate'=>false, 'callbacks'=>false)) )
				return json_encode(['status' => false, 'msg' => 'Erro 107 - Erro ao salvar o nome do arquivo.']);

			return json_encode(['status' => true, 'msg' => 'Dados salvo com sucesso!']);
		}
	}

	public function upload_img_gallery()
	{
		$id = $_POST['id'];
		$this->autoRender = false;
		$ds = DIRECTORY_SEPARATOR;
		$storeFolder = 'uploads/anuncio/galeria/'.$_POST['id'];
		$photo_limit = 10;

		if (!empty($_FILES))
		{
			$targetPath  = WWW_ROOT.$storeFolder.$ds;
			$extension   = pathinfo($_FILES['file']['name'][0], PATHINFO_EXTENSION);

			$tempFile 	 = $_FILES['file']['tmp_name'][0];
			$nomeArquivo = 'construlista_' . uniqid() . '.' . $extension;
			$targetFile  = $targetPath . $nomeArquivo;

			$this->loadModel('Photo');

			$count = $this->Photo->find('count', array(
				'conditions' => array('Photo.anuncio_id' => $id)
			));

			if ( $count <= $photo_limit )
			{
				$sql = "INSERT INTO fotos (foto, anuncio_id) VALUES('$nomeArquivo', $id)";
				$this->Photo->query($sql);

				mkdir($targetPath, 0755, true);

				if ( ! move_uploaded_file($tempFile, $targetFile) )
					echo "uploaded failure";
			}
			else
			{
				$result = array
				(
					'error' => 'Você atingiu o número máximo de imagens!'
				);
				return json_encode($result);
			}
		}
	}

	public function remove_img_gallery($id, $idAnuncio, $foto)
	{
		$this->autoRender = false ;
		$ds = DIRECTORY_SEPARATOR;
		$storeFolder = 'uploads/anuncio/galeria/'.$idAnuncio;

		$targetPath = WWW_ROOT.$storeFolder.$ds;
		$targetFile =  $targetPath. $foto;

		if ( file_exists( $targetFile ) )
		{
			if (unlink($targetFile))
			{
				$this->loadModel('Photo');
				$sql = "DELETE FROM fotos WHERE id = $id";
				$this->Photo->query($sql);
				$this->Flash->success(__('Foto removida com sucesso.'));
				$this->redirect($this->referer());
			}
			else
			{
				$this->Flash->error(__('Erro 149 - Erro ao excluir foto. A foto não existe no servidor!'));
				$this->redirect($this->referer());
			}
		}
		else
		{
			$this->Flash->error(__('Erro 150 - Erro ao excluir foto. A foto não existe no servidor!'));
			$this->redirect($this->referer());
		}
	}

	public function edit_ajax($id = null)
	{
		$this->layout = 'ajax';
		$this->autoRender = false; // request from ajax

		if ($this->request->is(array('post')))
		{
			$model 				= $this->request->data('model');

			if ( $model != "Advertisement" )
			{
				$this->loadModel($model);
				$associated_model = $this->$model->findByAnuncioId($id);
				if ( $associated_model )
					$this->$model->id = $associated_model[$model]['id'];
			}
			else
			{
				$this->Advertisement->id = $id;
			}

			$this->request->data[$model]['anuncio_id'] = $id;
			$this->request->data[$this->request->data('model')][$this->request->data('name')] = $this->request->data('val');

			if ( isset($this->request->data[$model]['cpf'])  )
			{
				if ( ! $this->Validation->cpf_validation($this->request->data[$model]['cpf']) )
					return json_encode(['status' => false, 'msg' => 'CPF Inválido']);
			}

			if ( isset($this->request->data[$model]['cnpj'])  )
			{
				if ( ! $this->Validation->cnpj_validation($this->request->data[$model]['cnpj']) )
					return json_encode(['status' => false, 'msg' => 'CNPJ Inválido']);
			}

			// Check and save slug if exists
			if ( isset($this->request->data[$model]['slug'])  )
			{
				if ( ! $this->$model->findBySlugAndId($this->request->data[$model]['slug'],$id) )
				{
					if ( $this->$model->findBySlug($this->request->data[$model]['slug']) )
						return json_encode(['status' => false, 'msg' => 'Este nome já está sendo usado!']);
				}
//				else if ( $this->$model->findBySlug($this->request->data[$model]['slug']) )
//				{
//					return json_encode(['status' => false, 'msg' => 'Você alterou o nome e este já está sendo usado!']);
//				}
			}

			if ($this->$model->save($this->request->data, array('deep' => true, 'validate' => false)))
			{
				$result = array
				(
					'status' => true,
					'msg' 	 => 'Dados salvo com sucesso!'
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
		else
		{
			$result = array
			(
				'status' => false,
				'msg' 	 => 'Requisição inválida! Certifique-se de ter preenchido os dados obrigatórios.'
			);
			return json_encode($result);
		}
	}

	public function edit_ajax_slug()
	{
		$this->layout = 'ajax';
		$this->autoRender = $this->layout = false;
		$model = $this->modelClass;

		$search           = $this->request->query['term'];
		$id 	          = $this->request->query['id'];
		$this->$model->id = $id;

		if ($this->request->is(array('post')) && !empty($search)) {
			$conditions = array
			(
				"conditions" => array
				(
					"Advertisement.slug"  => $search,
					"Advertisement.id <>" => $id,
				)
			, "fields" => "DISTINCT Advertisement.slug"
			);

			$query = $this->Advertisement->find('all', $conditions);

			if ($query)
			{
				$result = array
				(
					'status' => false,
					'msg' => 'Este nome já está sendo usado!'
				);
				return json_encode($result);
			}
			else
			{
				$this->request->data[$this->request->data('model')][$this->request->data('name')] = $this->request->data('val');

				if ($this->$model->save($this->request->data, array('deep' => true, 'validate' => false)))
				{
					$result = array
					(
						'status' => true,
						'msg' 	 => 'Dados salvo com sucesso!'
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
		}

	}

	public function ajax_delete($id, $status = null)
	{
		$this->autoRender = false; // Status => 0 = congelado, 1 = ativo, 2 = excluído
		$this->request->allowMethod('post');
		$model = $this->modelClass;
		$this->$model->id = $id;

		if ( $status == null ) $status = 2;

		if ($this->$model->saveField('status',$status))
		{
			return json_encode($id);
		}
		else
		{
			return json_encode(false);
		}
	}

	public function ajax_delete_admin($id, $status = null)
	{
		$this->autoRender = false; // Status => 0 = congelado, 1 = ativo, 2 = excluído
		$this->request->allowMethod('post');
		$model = $this->modelClass;
		$this->$model->id = $id;

		if ( $status != 1 ) $status = 2; // delete

		if ($this->$model->saveField('status',$status))
		{
			return json_encode($id);
		}
		else
		{
			return json_encode(false);
		}
	}

	public function edit_ajax_multiple_fields($id = null)
	{
		$this->layout = 'ajax';
		$this->autoRender = false; // request from ajax

		if ($this->request->is(array('post', 'put')))
		{
			$model 				= key($this->request->data);
			$this->$model->id 	= $id;
			$associated_model 	= $this->$model->findByAnuncioId($this->request->data[$model]['anuncio_id']);

			if ( $associated_model )
				$this->$model->id = $associated_model[$model]['id'];

			if ($this->$model->save($this->request->data, array('deep' => true, 'validate' => false)))
			{
				// Check and save lat/long if cep is setted
				if ( isset($this->request->data[$model]['cep'])  )
				{
					$gmaps = $this->Advertisement->getLatAndLongByZipCode($this->request->data[$model]['cep']);

					if ( $gmaps )
					{
						$data['Address']['anuncio_id']  = $this->request->data[$model]['anuncio_id'];
						$data['Address']['lat'] 		= $gmaps['lat'];
						$data['Address']['long'] 		= $gmaps['long'];
						$this->Address->save($data);
					}
					else
					{
						$gmaps2 = $this->Advertisement->getLatAndLongByAddress($this->request->data[$model]);

						if ( $gmaps2 )
						{
							$data['Address']['anuncio_id']  = $this->request->data[$model]['anuncio_id'];
							$data['Address']['lat']  		= $gmaps2['lat'];
							$data['Address']['long'] 		= $gmaps2['long'];
							$this->Address->save($data);
						}
					}
				}

				$result = array
				(
					'status' => true,
					'msg' 	 => 'Dados salvo com sucesso!'
				);
				return json_encode($result);
			}
			else
			{
				$x = $this->validationErrors;

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



	public function view(){}

	public function del(){}

	public function add_rating()
	{
		$this->loadModel('Rating');
		$this->autoRender = false;

		if( $this->request->is('ajax') )
		{
			$anuncioId = (int)$this->request->data['anuncio_id'];
			$IP = $this->Utility->getClientIpServer();
			$retorno = $this->Rating->query("SELECT * FROM avaliacos WHERE anuncio_id = $anuncioId AND IP = '$IP'");

			if ( count($retorno) == 0 )
			{
				$data['Rating'] = $this->request->data;
				$this->Rating->create();
				if ($this->Rating->save($data))
				{
					$result = array
					(
						'status' => true,
						'msg' 	 => 'Sua avaliação e muito importante, principalmente para que outros usuários possam analisar as melhores empresas, produtos e serviços.'
					);
					return json_encode($result);
				}
				else
				{
					$result = array
					(
						'status' => false,
						'msg' 	 => 'Ocorreu um erro (334) interno no sistema. Tente novamente mais tarde.'
					);
					return json_encode($result);
				}
			}
			else
			{
				$result = array
				(
					'status' => false,
					'msg' 	 => 'Você já avaliou este anúncio!'
				);
				return json_encode($result);
			}
		}
	}

	public function search_agreements()
	{
		$this->layout = 'agreement_public';

		if ($this->request->is('post')) {

			$search_term = $this->request->data['Agreement']['search_term'];

			$this->Paginator->settings = $this->paginate;
			$conditions = array();
			$limit = 20;

			$conditions['Agreement.is_public'] = 1;

			if (!empty($search_term) && !empty($search_term)) {
				$conditions['Agreement.cpf_cnpj'] = $search_term;
				$limit = 20;
			}

			$this->Paginator->settings = array(
				 'order' => array('Agreement.date' => 'desc')
				, 'limit' => $limit
				, 'conditions' => $conditions
			);

			$result = $this->Paginator->paginate('Agreement');

			$search_total_result = count($result);
			$this->set(compact('result','search_term', 'search_total_result'));
		}
	}

	public function search_agreements_view($id = null)
	{
		$this->layout = 'agreement_public';

		$this->Agreement->id = $id;
		if (!$this->Agreement->exists()) {
			throw new NotFoundException(__('Requisição Inválida'));
		}
		$this->set('agreement', $this->Agreement->findById($id));
	}

	public function search_agreements_pay($id = null)
	{
		$this->layout = 'agreement_public';

		$this->Agreement->id = $id;
		if (!$this->Agreement->exists()) {
			throw new NotFoundException(__('Requisição Inválida'));
		}

		if ($this->request->is('post')) {

		}

		$agreement = $this->Agreement->findById($id);
		$plans = array();
		$user = array('User');

		$this->set(compact('agreement','plans','user'));
	}

	public function isAuthorized($user = null)
	{
		$model = $this->modelClass;

		if ( $this->Auth->user('role') == 'admin' ) return true; // Only admins can access admin functions

		if ( ! in_array($this->action, array('edit', 'delete')) ) return true; // Everybody can view and add

		if ( ! $this->$model->isOwnedBy((int) $this->request->params['pass'][0], $user['id']) ) return false; // Only owner can edit or delete

		return true;
	}

	public function save_binary_logo()
	{
		$this->autoRender = false;

		$result  = $this->Advertisement->find('all');

		foreach ( $result as $anuncio )
		{
			//$item

			// busca dir by id anuncio
			// verifica se tem arquivo no dir

			$files = scandir(WWW_ROOT . "/uploads/anuncio/anuncio/logo/" . $anuncio['Advertisement']['id'],1);
			$size  = null;

			// lê o arquivo
			if ( in_array('logo.jpg', $files) )
			{
				$logo 		= WWW_ROOT . '/uploads/anuncio/anuncio/logo/' . $anuncio['Advertisement']['id'] . '/logo.jpg';
				$img 		= file_get_contents($logo);
				$extenstion = pathinfo($logo);
				$size 		= filesize($logo);
			}
			elseif ( in_array('logo.jpeg', $files) )
			{
				$logo = WWW_ROOT . '/uploads/anuncio/anuncio/logo/' . $anuncio['Advertisement']['id'] . '/logo.jpeg';
				$img 		= file_get_contents($logo);
				$extenstion = pathinfo($logo);
				$size 		= filesize($logo);
			}
			elseif ( in_array('/logo.gif', $files) )
			{
				$logo = WWW_ROOT . '/uploads/anuncio/anuncio/logo/' . $anuncio['Advertisement']['id'] . '/logo.gif';
				$img 		= file_get_contents($logo);
				$extenstion = pathinfo($logo);
				$size 		= filesize($logo);
			}
			elseif ( in_array('logo.png', $files) )
			{
				$logo = WWW_ROOT . '/uploads/anuncio/anuncio/logo/' . $anuncio['Advertisement']['id'] . '/logo.png';
				$img 		= file_get_contents($logo);
				$extenstion = pathinfo($logo);
				$size 		= filesize($logo);
			}

			if ( $size != null && $size !== false)
			{
				//echo "copy + paste the data below, use it as a string in ur JavaScript Code<br><br>";
				//echo "<textarea id='data' style=''>data:".$check["mime"].";base64,".$data."</textarea>";
				// Tested decoded in https://www.base64-image.de/

				// transforma para base64
//				$data["Advertisement"]['file_logo_binary'] 	= base64_encode($img);
//				$data["Advertisement"]['file_logo_type'] 	= $extenstion['extension'];
//				$data["Advertisement"]['file_logo_size'] 	= $size;

//				$this->Advertisement->id = $anuncio['Advertisement']['id'];
//
//				if ($this->Advertisement->save($data))
//				{
//					echo $this->Advertisement->id;
//				}
//				else
//				{
//					echo "False: " . $this->Advertisement->id;
//				}

			}
		}
	}

	public function save_binary_foto_capa()
	{
		$this->autoRender = false;

		$result  = $this->Advertisement->find('all');

		foreach ( $result as $anuncio )
		{
			//$item

			// busca dir by id anuncio
			// verifica se tem arquivo no dir

			$files = scandir(WWW_ROOT . "/uploads/anuncio/anuncio/foto_capa/" . $anuncio['Advertisement']['id'],1);
			$size  = null;

			// lê o arquivo
			if ( $files[0] && $files[0] != ".." && $files[0] != "." )
			{
				$logo 		= WWW_ROOT . '/uploads/anuncio/anuncio/foto_capa/' . $anuncio['Advertisement']['id'] .'/'. $files[0];
				$img 		= file_get_contents($logo);
				$extenstion = pathinfo($logo);
				$size 		= filesize($logo);
			}

			if ( $size != null && $size !== false)
			{
				//echo "copy + paste the data below, use it as a string in ur JavaScript Code<br><br>";
				//echo "<textarea id='data' style=''>data:".$check["mime"].";base64,".$data."</textarea>";
				// Tested decoded in https://www.base64-image.de/

				// transforma para base64
				$data["Advertisement"]['file_foto_capa_binary'] 	= base64_encode($img);
				$data["Advertisement"]['file_foto_capa_type'] 		= $extenstion['extension'];
				$data["Advertisement"]['file_foto_capa_size'] 		= $size;

				$this->Advertisement->id = $anuncio['Advertisement']['id'];

				if ($this->Advertisement->save($data))
				{
					echo $this->Advertisement->id;
				}
				else
				{
					echo "False: " . $this->Advertisement->id;
				}

			}
		}
	}

	public function save_binary_galeria()
	{
		$this->autoRender = false;

		$this->loadModel('Photo');
		$ad  = $this->Advertisement->find('all');

		foreach ( $ad as $item )
		{
			$result = $this->Photo->find('all', array('conditions' => array('Photo.anuncio_id' =>$item['Advertisement']['id'])));

			//$item

			// busca dir by id anuncio
			// verifica se tem arquivo no dir

			$files = scandir(WWW_ROOT . "/uploads/anuncio/anuncio/galeria/" . $item['Advertisement']['id']);
			unset($files[0]); // remove "."
			unset($files[1]); // remove ".."
			$size  = null;

			$i=2;
			foreach ( $result as $anuncio )
			{
				if ( $i < 13 || $i <= sizeof($files) )
				{
					$logo 		= WWW_ROOT . '/uploads/anuncio/anuncio/galeria/' . $anuncio['Photo']['anuncio_id'] .'/'. $files[$i];
					$img 		= file_get_contents($logo);
					$extenstion = pathinfo($logo);
					$size 		= filesize($logo);

					if ( $size != null && $size !== false)
					{
						//echo "copy + paste the data below, use it as a string in ur JavaScript Code<br><br>";
						//echo "<textarea id='data' style=''>data:".$check["mime"].";base64,".$data."</textarea>";
						// Tested decoded in https://www.base64-image.de/

						// transforma para base64
						$data["Photo"]['foto_binary'] = base64_encode($img);
						$data["Photo"]['foto_type']   = $extenstion['extension'];
						$data["Photo"]['foto_size']   = $size;

						$this->Photo->id = $anuncio['Photo']['id'];

						if ($this->Photo->save($data))
						{
							echo $this->Photo->id . ',';
						}
						else
						{
							echo ",False: " . $this->Photo->id;
						}
						$i++;
					}
				}
			}
		}
	}

	public function get_email_advertisement($id = null)
	{
		$this->autoRender = false;

		if( $this->request->is('get') )
		{
			$this->Advertisement->recursive = -1;
			$retorno = $this->Advertisement->findById($id);

			if ( $retorno )
			{
				$result = array
				(
					'status' => true,
					'msg' 	 => $retorno['Advertisement']['email']
				);
				return json_encode($result);
			}
			else
			{
				$result = array
				(
					'status' => false,
					'msg' 	 => 'Ocorreu um erro (464) interno no sistema. Tente novamente mais tarde.'
				);
				return json_encode($result);
			}
		}
	}

	public function saveAllLatAndLongFromAddress()
	{
		$this->loadModel('Address');
		$address = $this->Address->find('all');

		foreach ( $address as $item )
		{
			if ( !empty($item['Address']['cep']) )
			{
				$cep = $this->Utility->clearAllToNumber($item['Address']['cep']);

				if ( empty($item['Address']['lat']) && empty($item['Address']['long']) )
				{
					$gmaps = $this->Advertisement->getLatAndLongByZipCode($cep);

					if ( $gmaps )
					{
						$this->Address->id  	 = $item['Address']['id'];
						$data['Address']['lat']  = $gmaps['lat'];
						$data['Address']['long'] = $gmaps['long'];

						$this->Address->save($data);
					}
					else
					{
						$gmaps2 = $this->Advertisement->getLatAndLongByAddress($item['Address']);

						if ( $gmaps2 )
						{
							$this->Address->id  	 = $item['Address']['id'];
							$data2['Address']['lat']  = $gmaps2['lat'];
							$data2['Address']['long'] = $gmaps2['long'];

							$this->Address->save($data2);
						}
					}
				}
			}

		}
	}

}