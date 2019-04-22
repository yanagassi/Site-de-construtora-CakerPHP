<?php

App::uses('AppController', 'Controller');

class PagesController extends AppController {

	public $uses = array();
	public $components = array("Session","RequestHandler","Paginator","Utility","Email");
	public $helpers = array ('Html','Form', 'Js');
	public $layout = 'default';

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow();
	}

	public function index()
	{
		$this->theme = 'Portal';
		$this->set('title_for_layout', 'Home');
	}

	public function search()
	{
		$this->theme = 'Portal';
		$this->loadModel('Banner');
		$this->loadModel('Address');
		$this->loadModel('Advertisement');
		$this->loadModel('User');
		$this->loadModel('Rating');
		$this->loadModel('Product');
		$this->loadModel('Service');

		$this->Banner->recursive = 0;
		$query = array();

		$page 				   		= null;
		$limit 				   		= 15;

		if ( isset($this->request->query['page']) && !empty($this->request->query['page']) )
			$page = $this->request->query['page'];

		if ( isset($this->request->query['limit']) && !empty($this->request->query['limit']) )
			$limit = $this->request->query['limit'];

		//if ( $this->request->is('post') ) {

			$termo = $this->request->query["termo"];

			// if city sent
			if ( !empty($this->request->query['cidade']) )
			{
				if ( $this->request->query['cidade'] != 'Todas as cidades' )
				{
					$city_and_uf = preg_split("#/#", $this->request->query['cidade']);

					$conditions['and'][] = ['User.cidade IN' => [$city_and_uf[0]]];
					$conditions['and'][] = ['User.estado IN' => [$city_and_uf[1]]];
				}
			}

			$conditions['AND'][] = ['Advertisement.status' => 1 ];

			$conditions['OR'][]  = ['Advertisement.titulo_anuncio LIKE' => "%$termo%" ];

			$columns =
				[
					'DISTINCT User.id,User.nome,Advertisement.id',
					'User.id',
					'User.nome',
					'User.endereco',
					'User.cidade',
					'User.estado',
					'User.numero',
					'User.bairro',
					'User.telefone',
					'Advertisement.cliente_id',
					'Advertisement.id',
					'Advertisement.titulo_anuncio',
					'Advertisement.slug',
					'Advertisement.logo',
					'AVG(Rating.preco + Rating.prazo + Rating.qualidade) AS rating_avg'
				];

			$columns_group =
				[
					'User.id',
					'Advertisement.id'
					//,'Rating.id',
				];

			$joins[] =
				[
					'table' 		=> 'clientes',
					'alias' 		=> 'User',
					'type' 			=> 'LEFT',
					'conditions' 	=>
						[
							'User.id = Advertisement.cliente_id',
						]
				];

			$joins[] =
				[
					'table' 		=> 'avaliacos',
					'alias' 		=> 'Rating',
					'type' 			=> 'LEFT',
					'conditions' 	=>
						[
							'Advertisement.id = Rating.anuncio_id',
						]
				];

			$data = $this->request->query;

			if (
				!isset($data['type_person_pj']) &&
				!isset($data['type_person_pf']) &&
				!isset($data['type_product'])   &&
				!isset($data['type_services'])
			)
			{
				$columns[] = "AVG(Product.preco) AS final_price";

				$joins[] 	   =
					[
						'table' 		=> 'produtos',
						'alias' 		=> 'Product',
						'type' 			=> 'LEFT',
						'conditions' 	=>
							[
								'Advertisement.id = Product.anuncio_id',
							]
					];

				$joins[] 	   =
					[
						'table' 		=> 'servicos',
						'alias' 		=> 'Service',
						'type' 			=> 'LEFT',
						'conditions' 	=>
							[
								'Advertisement.id = Service.anuncio_id',
							]
					];

				$conditions['OR'][] = ['Product.nome LIKE' => "%$termo%" ];
				$conditions['OR'][] = ['Product.nome_popular LIKE' => "%$termo%" ];
				$conditions['OR'][] = ['Service.nome LIKE' => "%$termo%" ];
			}
			else
			{
				// => Busca em Pessoa Jurídica + Física + Título do Anuncio e Tabelas e Serviços
				if (isset($data['type_person_pj']) && $data['type_person_pj'] == 'JURÍDICA' && isset($data['type_person_pf']) && $data['type_person_pf'] == 'FÍSICA' && !isset($data['type_product']) && isset($data['type_services']) && $data['type_services'] == 'servicos')
				{
					$conditions['OR'][]  = [['Advertisement.titulo_anuncio LIKE' => "%$termo%" ], ['Advertisement.tipo' => $data['type_person_pj']], ['Advertisement.tipo' => $data['type_person_pf']]];

					$joins[] 	   =
						[
							'table' 		=> 'servicos',
							'alias' 		=> 'Service',
							'type' 			=> 'LEFT',
							'conditions' 	=>
								[
									'Advertisement.id = Service.anuncio_id',
								]
						];

					$conditions['OR'][]  = ['Service.nome LIKE' => "%$termo%"];

					$this->set('type_person_pj', 1);
					$this->set('type_person_pf', 1);
					$this->set('type_services', 1);
				}

				// => Busca em Pessoa Jurídica + Física + Título do Anuncio e Tabelas e Prdutos e Serviços (sem marcar)
				if (isset($data['type_person_pj']) && $data['type_person_pj'] == 'JURÍDICA' && isset($data['type_person_pf']) && $data['type_person_pf'] == 'FÍSICA' && !isset($data['type_product']) && !isset($data['type_services']) )
				{
					$conditions['OR'][]  = [['Advertisement.titulo_anuncio LIKE' => "%$termo%" ], ['Advertisement.tipo' => 'JURÍDICA']];
					$conditions['OR'][]  = [['Advertisement.titulo_anuncio LIKE' => "%$termo%" ], ['Advertisement.tipo' => 'FÍSICA']];

					$joins[] 	   =
						[
							'table' 		=> 'produtos',
							'alias' 		=> 'Product',
							'type' 			=> 'LEFT',
							'conditions' 	=>
								[
									'Advertisement.id = Product.anuncio_id',
								]
						];

					$joins[] 	   =
						[
							'table' 		=> 'servicos',
							'alias' 		=> 'Service',
							'type' 			=> 'LEFT',
							'conditions' 	=>
								[
									'Advertisement.id = Service.anuncio_id',
								]
						];

					$conditions['OR'][]  = ['Product.nome LIKE' => "%$termo%"];
					$conditions['OR'][]  = ['Product.nome_popular LIKE' => "%$termo%"];
					$conditions['OR'][]  = ['Service.nome LIKE' => "%$termo%"];

					$this->set('type_person_pj', 1);
					$this->set('type_person_pf', 1);
				}

				// => Busca em Pessoa Jurídica + Título do Anuncio e Tabelas de Produtos (marcados)
				if (isset($data['type_person_pj']) && $data['type_person_pj'] == 'JURÍDICA' && !isset($data['type_person_pf']) && isset($data['type_product']) && $data['type_product'] == 'produtos')
				{
					$columns[] = "AVG(Product.preco) AS final_price";

					$joins[] 	   =
						[
							'table' 		=> 'produtos',
							'alias' 		=> 'Product',
							'type' 			=> 'INNER',
							'conditions' 	=>
								[
									'Advertisement.id = Product.anuncio_id',
								]
						];

					$conditions['OR'][]   = ['Product.nome LIKE' => "%$termo%"];
					$conditions['OR'][]   = ['Product.nome_popular LIKE' => "%$termo%"];
					$conditions['AND'][]  = ['Advertisement.tipo' => $data['type_person_pj']];

					$this->set('type_person_pj', 1);
					$this->set('type_product', 1);
				}

				// => Busca em Pessoa Jurídica + Título do Anuncio e Tabelas de Serviços (marcados)
				if (isset($data['type_person_pj']) && $data['type_person_pj'] == 'JURÍDICA' && !isset($data['type_person_pf']) && isset($data['type_services']) && $data['type_services'] == 'servicos')
				{
					$joins[] 	   =
						[
							'table' 		=> 'servicos',
							'alias' 		=> 'Service',
							'type' 			=> 'INNER',
							'conditions' 	=>
								[
									'Advertisement.id = Service.anuncio_id',
								]
						];

					$conditions['OR'][]   = ['Service.nome LIKE' => "%$termo%"];
					$conditions['AND'][]  = ['Advertisement.tipo' => $data['type_person_pj']];

					$this->set('type_person_pj', 1);
					$this->set('type_services', 1);
				}

				// => Busca em Pessoa Jurídica + Título do Anuncio e Tabelas de Produtos e Serviços (nao marcados)
				if (isset($data['type_person_pj']) && $data['type_person_pj'] == 'JURÍDICA' && !isset($data['type_person_pf']) && !isset($data['type_product']) && !isset($data['type_services']) )
				{
					$conditions['OR'][]   = [['Advertisement.titulo_anuncio LIKE' => "%$termo%" ], ['Advertisement.tipo' => $data['type_person_pj']]];

					$joins[] 	   =
						[
							'table' 		=> 'produtos',
							'alias' 		=> 'Product',
							'type' 			=> 'LEFT',
							'conditions' 	=>
								[
									'Advertisement.id = Product.anuncio_id',
								]
						];

					$joins[] 	   =
						[
							'table' 		=> 'servicos',
							'alias' 		=> 'Service',
							'type' 			=> 'LEFT',
							'conditions' 	=>
								[
									'Advertisement.id = Service.anuncio_id',
								]
						];

					$conditions['OR'][]   = ['Product.nome LIKE' => "%$termo%"];
					$conditions['OR'][]   = ['Product.nome_popular LIKE' => "%$termo%"];
					$conditions['OR'][]   = ['Service.nome LIKE' => "%$termo%"];
					$conditions['AND'][]  = ['Advertisement.tipo' => $data['type_person_pj']];

					$this->set('type_person_pj', 1);
				}

				// => Busca em Pessoa Física e Tabelas de Serviços (marcados)
				if (isset($data['type_person_pf']) && $data['type_person_pf'] == 'FÍSICA' && !isset($data['type_person_pj']) && isset($data['type_services']) && $data['type_services'] == 'servicos')
				{
					$joins[] 	   =
						[
							'table' 		=> 'servicos',
							'alias' 		=> 'Service',
							'type' 			=> 'INNER',
							'conditions' 	=>
								[
									'Advertisement.id = Service.anuncio_id',
								]
						];

					$conditions['OR'][]   = ['Service.nome LIKE' => "%$termo%"];
					$conditions['AND'][]  = ['Advertisement.tipo' => $data['type_person_pf']];

					$this->set('type_person_pf', 1);
					$this->set('type_services', 1);
				}

				// 8 => Busca em Pessoa Física + Título do Anuncio do Profissional e Tabelas de Serviços (nao marcados)
				if (isset($data['type_person_pf']) && $data['type_person_pf'] == 'FÍSICA' && !isset($data['type_person_pj']) && !isset($data['type_services']) && !isset($data['type_products']) )
				{
					$conditions['OR'][]   = ['Advertisement.titulo_anuncio LIKE' => "%$termo%" ];

					$joins[] 	   =
						[
							'table' 		=> 'servicos',
							'alias' 		=> 'Service',
							'type' 			=> 'LEFT',
							'conditions' 	=>
								[
									'Advertisement.id = Service.anuncio_id',
								]
						];

					$conditions['OR'][]   = ['Service.nome LIKE' => "%$termo%"];
					$conditions['AND'][]  = ['Advertisement.tipo' => $data['type_person_pf']];

					$this->set('type_person_pf', 1);
				}

				// => Busca Somente na Tabelas de Produtos
				if (!isset($data['type_person_pj']) && !isset($data['type_person_pf']) && !isset($data['type_services']) && isset($data['type_product']) && $data['type_product'] == 'produtos')
				{
					$columns[] = "AVG(Product.preco) AS final_price";

					$joins[] 	   =
						[
							'table' 		=> 'produtos',
							'alias' 		=> 'Product',
							'type' 			=> 'INNER',
							'conditions' 	=>
								[
									'Advertisement.id = Product.anuncio_id',
								]
						];

					$conditions['OR'][]   = ['Product.nome LIKE' => "%$termo%"];
					$conditions['OR'][]   = ['Product.nome_popular LIKE' => "%$termo%"];

					$this->set('type_product', 1);
				}

				// => Busca em Tabelas de Serviços (marcados) sem título do anuncio
				if (!isset($data['type_person_pj']) && !isset($data['type_person_pf']) && !isset($data['type_product']) && isset($data['type_services']) && $data['type_services'] == 'servicos')
				{
					$joins[] 	   =
						[
							'table' 		=> 'servicos',
							'alias' 		=> 'Service',
							'type' 			=> 'INNER',
							'conditions' 	=>
								[
									'Advertisement.id = Service.anuncio_id',
								]
						];
					$conditions['OR'][]   = ['Service.nome LIKE' => "%$termo%"];

					$this->set('type_services', 1);
				}
			}

			$this->Paginator->settings = array
			(
				 'conditions'   => $conditions
				,'recursive'    => 2 // http://book.cakephp.org/2.0/en/models/model-attributes.html#recursive
				,'fields' 		=> $columns
				,'group' 		=> $columns_group
				,'joins' 		=> $joins
				,'limit'		=> $limit
				,'page'  		=> $page
			);

			$query = $this->Paginator->paginate('Advertisement');

			$pagination = $this->request->params['paging'];
			$numbers 	= $pagination['Advertisement']['count'];

			$this->Advertisement->registerReport($query);

			$query = (object) $query;
		//}

		$cidades = $this->Address->find('all',
			[
				 'order'     => ['Address.cidade' => 'DESC']
				,'fields' 	 => ['DISTINCT Address.cidade, Address.estado', 'Address.cidade', 'Address.estado']
			]
		);

		$this->set('cidades', $cidades);
		$this->set('termo', $termo);
		$this->set('anuncios', $query);
	}

	public function cakepage()
	{
		//$this->theme = 'WebSite';

		$path = func_get_args();

		$count = count($path);
//		if (!$count) {
//			return $this->redirect('/');
//		}
		if (in_array('..', $path, true) || in_array('.', $path, true)) {
			throw new ForbiddenException();
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}

	public function view( $id = null )
	{
		$this->theme = 'Portal';
		$this->loadModel('Advertisement');
		$status = 1; // active

		if ( filter_var($id, FILTER_VALIDATE_INT) === false ) // slug
		{
			if ( ! $this->Advertisement->findBySlugAndStatus($id,$status))
				throw new NotFoundException('O endereço que você solicitou não existe ou foi removido!');

			$anuncios = (object)$this->Advertisement->findBySlugAndStatus($id,$status);
		}
		else
		{
			if ( ! $this->Advertisement->findByIdAndStatus($id,$status) )
				throw new NotFoundException('O endereço que você solicitou não existe ou foi removido!');

			$anuncios = (object)$this->Advertisement->findByIdAndStatus($id,$status);
		}

		$this->set(compact('anuncios'));
	}

	public function aboutus(){ $this->theme = 'Portal'; }
	public function vantagensAnunciar(){ $this->theme = 'Portal'; }
	public function vantagensUtilizar(){ $this->theme = 'Portal'; }
	public function plans(){ $this->theme = 'Portal'; }

	public function contact()
	{
		$this->theme = 'Portal';
		if ( $this->request->is('post') )
		{
			$nome       			= $this->request->data["Contato"]["nome"];
			$email      			= $this->request->data["Contato"]["email"];
			$telefone   			= $this->request->data["Contato"]["telefone"];
			$mensagem   			= $this->request->data["Contato"]["mensagem"];

			$data['subject']        = "[".Configure::read('BRAND')."] - Contato do Site!";
			$data['intro']          = 'Novo formulário de contato foi preenchido através do Portal';
			$data['msg']            = $mensagem;
			$data['client']         = $nome;
			$data['email_client']   = $email;
			$data['email_to']       = "contato@construlista.com.br";
			$data['phone_client']   = $telefone;

			if ( ! $this->Email->sendMail($data) )
				$this->Flash->error(__('Problemas ao enviar seu formulário. Tente novamente ou contacte o administrador.'));
				// ToDo: Send email with problem and register on table error

			$this->Flash->success('Formulário Enviado com Sucesso!');
			return $this->redirect($this->referer());
		}
	}

	public function contact_partner()
	{
		$this->theme = 'Portal';
		if ( $this->request->is('post') )
		{
			$to       	= $this->request->data["Contato"]["to"];
			$nome       = $this->request->data["Contato"]["nome"];
			$assunto    = $this->request->data["Contato"]["assunto"];
			$email      = $this->request->data["Contato"]["email"];
			$telefone   = $this->request->data["Contato"]["telefone"];
			$mensagem   = $this->request->data["Contato"]["mensagem"];

			$data['subject']        = "[".Configure::read('BRAND')."] - Contato da Sua Página Parceiro!";
			$data['intro']          = "<b>Assunto:</b><br>$assunto";
			$data['msg']            = "<b>Menasgem:</b><br>$mensagem";
			$data['client']         = $nome;
			$data['email_client']   = $email;
			$data['email_to']       = $to;
			$data['phone_client']   = $telefone;

			if ( ! $this->Email->sendMailToPartner($data) )
				$this->Flash->error(__('Problemas ao enviar seu formulário. Tente novamente ou contacte o administrador.'));
				// ToDo: Send email with problem and register on table error

			$this->Flash->success('Formulário Enviado com Sucesso!');
			return $this->redirect($this->referer());
		}
	}
}