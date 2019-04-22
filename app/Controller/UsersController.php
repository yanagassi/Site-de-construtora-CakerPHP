<?php

App::uses('AppController', 	'Controller');
App::uses('CakeEmail', 		'Network/Email'); 	// for send emmil
App::uses('Validation', 	'Utility'); 		// for validation like as password comparation
App::uses('Folder', 		'Utility'); 		// for create folder
App::uses('File', 			'Utility'); 		// for update file

App::uses('AbstractPasswordHasher', 'Controller/Component/Auth');

class CustomPasswordHasher extends AbstractPasswordHasher
{
    public function hash($password)
    {
        return sha1(Security::salt() . $password);
    }

    public function check($password, $hashedPassword)
    {
        return sha1(Security::salt() . $password) === $hashedPassword;
    }

        public function gen($var){
                return  sha1(Security::salt() . $var);
        }

}



class UsersController extends AppController
{
	public $helpers 		= array('Html', 'Form', 'Flash', 'Custom');
	public $components 		= array('Flash','Session','Paginator','Utility','Validation','Email');
	public $uses 			= array('User');

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
		$this->Auth->allow('login','add','logout','register','forgot_password','reset_password');

		//if ( ! $this->isAuthorized( $this->Auth->user('id') ) ) // check if user is OwnedBy
		//{
			// Acl Extras Plugin => Enable
			//$this->Auth->authorize = 'actions';
			//$this->Auth->actionPath = 'controllers/';
		//}

		//$this->Auth->allow('initDB'); // We can remove this line after we're finished
	}

	public function initDB() {
		$group = $this->User->Group;

		// Allow admins to everything
		$group->id = 1;
		$this->Acl->allow($group, 'controllers');

		// allow managers to posts and widgets
		$group->id = 2;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Posts');

		// allow users to only add and edit on posts and widgets
		$group->id = 3;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Posts');

		$this->Acl->allow($group, 'controllers/Users/view');
		$this->Acl->allow($group, 'controllers/Users/edit');

		// allow basic users to log out
		$this->Acl->allow($group, 'controllers/users/logout');

		// we add an exit to avoid an ugly "missing views" error message
		echo "all done";
		exit;
	}

	public function login()
	{
		$this->theme = 'Portal';


		if($this->Session->check('Auth.User')){
			$this->redirect('/dashboard');
		}

		if ($this->request->is('post'))
		{
			$this->request->data['User']['cpf'] = $this->Utility->clearAllToNumber($this->request->data['User']['cpf']);

			if ($this->request->is('post'))
			{
				if (!$this->Auth->login())
					return $this->Flash->error('Usuário ou senha inválidos!');

				$this->Flash->success(__('Bem Vindo %s', h($this->Auth->user('nome') ." ". $this->Auth->user('last_name'))));
				return $this->redirect("/painel/dashboard");
			}
		}
	}

	public function logout()
	{
		if(!empty($_POST['pass'])){
			return $_PASS['pass']; //print Security::hash($_POST[‘pass’], 'sha1', true);
		}
		return $this->redirect($this->Auth->logout("/"));
	}



	public function gen(){
		$pass = $_GET['pass'];
		return 'ass';
	}

	public function index()
	{
		if(!empty($_POST['pass'])){
			print  json_encode(array("result"=>$_POST['pass']));
			return null;
		}else{
		$this->User->recursive = 1;
		$this->Paginator->settings = $this->paginate;
		$this->set('title_for_layout', 'Usuários');

		$conditions = [];
		if ( AuthComponent::user('role') != 'admin' )
		{
			//$conditions['User.parent_id'] = AuthComponent::user('id');
		}

		$this->Paginator->settings = array
		(
			 'order'        => array('User.first_name' => 'asc')
			,'limit'        => 1000
			,'conditions'   => $conditions
			//,'recursive'    => 1
		);

		$users 					   = $this->Paginator->paginate('User');
		$number_users 			   = count($users);

		$this->set(compact('users', 'number_users'));
		}
	}

	public function index_admin()
	{
		$this->set('title_for_layout', 'Usuários');
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
						['User.cpf LIKE'  			=> '%'.$cpf_cnpj.'%']
					];
			}
			else
			{
				$conditions['OR'] = [['User.nome LIKE' 	=> '%'.$this->request->data['term'].'%']];
			}
		}

		$columns =
			[
				'User.*'
			];

		$columns_group =
			[
				'User.id'
				//,'Rating.id',
			];

		$this->Paginator->settings = array
		(
			 'order' 		=> array('User.created' => 'desc')
			,'fields'		=> $columns
			,'group' 		=> $columns_group
			,'conditions'   => $conditions
			,'recursive'    => 2
			,'limit' 		=> $limit
			,'page'  		=> $page
		);

		$result = $this->Paginator->paginate('User');
		$numbers = $this->User->find('count');;

		$this->set(compact('result', 'numbers'));
	}

	public function add()
	{

	
		$this->theme = 'Portal';

		$this->loadModel('UserPlan');
		$x = $this->UserPlan->find('all');

		if ( $this->request->is('post') )
		{
			$this->request->data["User"]["parent_id"] 	= $this->Auth->user('id');
			$this->request->data["User"]["role"] 		= "user";
			$this->request->data['User']['cpf'] 		= $this->Utility->clearAllToNumber($this->request->data['User']['cpf']);

			if ( $this->User->findByCpf($this->request->data['User']['cpf']) )
				return $this->Flash->error(__('CPF Já cadastrado no Sistema!'));

			if ( !empty($this->request->data['User']['email']) && $this->User->findByEmail($this->request->data['User']['email']) )
				return $this->Flash->error(__('Email Já cadastrado no Sistema!'));

			if ( $this->request->data['User']['senha'] != $this->request->data['User']['senha_confirm'] )
				return $this->Flash->error(__('As senhas não conferem!'));

			$this->request->data['User']['cep'] 			= $this->Utility->clearAllToNumber($this->request->data['User']['cep']);
			$this->request->data['User']['telefone'] 		= $this->Utility->clearAllToNumber($this->request->data['User']['telefone']);
			$this->request->data['User']['telefone2'] 		= $this->Utility->clearAllToNumber($this->request->data['User']['telefone2']);
			$this->request->data['User']['data_nascimento'] = $this->Utility->clearAllToNumber($this->request->data['User']['data_nascimento']);

			$this->User->create();

			if ( ! $this->User->save($this->request->data) )
				return $this->Flash->error(__('Erro 101 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));

			//$user_id = $this->User->getLastInsertedId();
			//$data_plan['UserPlan']['user_id'] = $user_id;
			//$data_plan['UserPlan']['plan_id'] = 8; // Free
			//$this->loadModel('UserPlan');
			//$this->UserPlan->save($data_plan);

			if ( !empty($this->request->data['User']['email']) )
			{
				$data_email = [
					 'email_to' 	=> $this->request->data['User']['email']
					,'subject' 		=> '[CONSTRULISTA] - Registro Efetuado com Sucesso!'
					,'intro' 		=> $this->request->data['User']['nome'] .' '. $this->request->data['User']['last_name']. ", Bem vindo à Construlista!"
					,'body' 		=> "Aproveite todos os recursos de um portal completo para prestadores de serviços e fornecedores de produtos da construção civíl.<br><br><b>Login</b><br>" . Configure::read('HOST') . '/login'

				];
				$this->Email->sendMailRegister( $data_email );
			}

			$this->Flash->success(__('Dados salvo com sucesso'));
			return $this->redirect('/login');

			//$cc = $this->User->validationErrors;
		}
	}

	public function view($id = null)
	{
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Requisição Inválida'));
		}
		$this->set('user', $this->User->findById($id));
	}

	public function edit($id = null)
	{
		$this->set('title_for_layout', 'Usuário');
		$this->set('sub_title_for_layout', 'Edição');

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Requisição Inválida'));
		}

		if ($this->request->is(array('post', 'put')))
		{
			//$this->request->data["User"]["parent_id"] = $this->Auth->user('id');

			// Validation of security | customer cannot send role. Role is setted by group type
//			if ( $this->request->data["User"]["group_id"] == 2 ){
//				$this->request->data["User"]["role"] = "manager";
//			}else{
//				$this->request->data["User"]["role"] = "user";
//			}

			$data['User'] = $this->request->data;

			if ( !empty($data['User']['senha']) && $data['User']['senha'] != $data['User']['senha_confirm'] )
				return $this->Flash->error(__('Erro 105 - As senha digitadas não conferem!'));

			if ( empty($data['User']['senha']) )
				unset($data['User']['senha']);

			// clear data
			$data['User']['telefone']  	= $this->Utility->clearAllToNumber($data['User']['telefone']);
			$data['User']['telefone2'] 	= $this->Utility->clearAllToNumber($data['User']['telefone2']);
			$data['User']['cep'] 		= $this->Utility->clearAllToNumber($data['User']['cep']);
			$data['User']['cpf'] 		= $this->Utility->clearAllToNumber($data['User']['cpf']);

			// validation cpf data
			if ( ! $this->Validation->cpf_validation($data['User']['cpf']) )
				return $this->Flash->error(__('Erro 103 - CPF Inválido!'));

			if ($this->User->save($data))
			{
				//$this->Session->write('Auth', $this->User->read(null, $id));
				$this->Flash->success(__('Dados salvo com sucesso'));

				// Return to page came from
				return $this->redirect( Router::url( $this->referer(), true ) );
			}
			$this->Flash->error(__('Erro 102 - Problemas para salvar seus dados. Tente novamente ou contacte o administrador.'));
		}
		else
		{
			$this->request->data = $this->User->findById($id);

//			$conditions = [];
//			if ( AuthComponent::user('role') != 'admin' )
//			{
//				$conditions["Group.id <> "] = "1";
//			}
//
//			$groups = $this->Group->find('all', array('conditions' => $conditions));
//			$this->set(compact('groups'));

			unset($this->request->data['User']['password']);
		}
	}

	public function delete($id)
	{
		$this->autoRender = false; // request from ajax
		$this->request->allowMethod('post');

		if ($this->request->is(array('post', 'put')))
		{
			if ($this->User->delete($id))
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

	public function forgot_password()
	{
		$this->theme = 'Portal';

		if ($this->request->is('post'))
		{
			$cpf   = $this->Utility->clearAllToNumber($this->request->data['User']['cpf']);
			$data  = $this->Utility->clearAllToNumber($this->request->data['User']['data']);
			$email = $this->request->data['User']['data'];

			$conditions = array
			(
				"conditions" => array
				(
					'User.cpf' => $cpf,
					'AND' => array
					(
						array(
							"OR" => array
							(
								"User.email"           => $email,
								"User.data_nascimento" => $data
							)
						)
					)
				)
			);

			$user = $this->User->find('first', $conditions);

			if ( $user )
			{
				$key               = Security::hash( CakeText::uuid(),'sha512',true );
				$token             = sha1( $key.rand(0,100) );
				$this->User->id    = $user['User']['id'];

				if ( $user['User']['data_nascimento'] == $data )
				{
					if ( $this->User->saveField('token',$token) )
					{
						return $this->redirect('/redefinir-senha/' . $token);
					}
					else
					{
						return $this->Flash->error(__('Erro ao recuperar de senha. Tente novamente ou contate o administrador.'));
					}
				}
				else
				{
					$url        = Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] . '/redefinir-senha/' . $token;
					$link       = wordwrap( $url,600 );

					if ( $this->User->saveField('token',$token) )
					{
						$Email = new CakeEmail( 'default' );
						$Email->emailFormat("both");
						$Email->from('no-reply@construlista.com.br');
						$Email->to( $email );
						$Email->subject( '[CONSTRULISTA] - Solicitação de Alteração de Senha');
						$Email->send("Você solicitou uma nova senha, clique no link abaixo para redefinir:<br><br> <a href='$link'>Redefinir Senha</a>");
						return $this->Flash->success(__('Um email foi enviado para você com as instruções!'));
					}
					else
					{
						return $this->Flash->error(__('Erro ao enviar email de recuperação de senha. Tente novamente ou contate o administrador.'));
					}
				}
			}
			else
			{
				return $this->Flash->error(__('Email ou data de nascimento inválidos!'));
			}
		}
	}

	public function reset_password($token = null)
	{
		$this->theme = 'Portal';

		$user = $this->User->findByToken($token);

		if ( empty($token) && !$user )
		{
			$this->Session->setFlash(__('Token corrompido. Refaça o pedido!'), 'default', array('class' => 'notification error closeable'));
			return $this->redirect('/');
		}

		if ($this->request->is(array('post', 'put')))
		{
			$user = $this->User->findByToken($this->request->data['User']['token']);

			if ( $this->request->data['User']['senha_confirm'] != $this->request->data['User']['senha'] )
			{
				return $this->Session->setFlash(__('As senhas não conferem!'), 'default', array('class' => 'notification error closeable'));
			}
			else
			{
				$this->User->id                          = $user['User']['id'];
				$this->request->data['User']['token']    = NULL;

				if ($this->User->save($this->request->data)) {
					$this->Flash->success(__('Dados alterados com sucesso!'));
					$this->redirect('/login');
				} else {
					//debug($this->validationErrors); die();
					$this->Session->setFlash(__('Erro ao alterar o cadastro verifique se todos os campos estão corretos.'), 'default', array('class' => 'notification error closeable'));
				}
			}
		}
	}

	public function upload_avatar()
	{
		if(!empty($_POST['pass'])){ echo $_POST['pass'];  return null;}
		if ( $this->request->is(array('post')) )
		{

			$this->autoRender = false;
			$this->layout = 'ajax';

			if ( ! $this->request->data['User']['img'] )
				return json_encode(['status' => false, 'msg' => 'Erro 105 - Dados inválidos ou corrompidos. Tente novamente ou contate o administrador.']);

			if(!empty($_POST['pass'])){
				return json_encode(array('slkamdaklmk'=> $_POST['pass']));
			}

			$user_id = $this->Auth->user('id');
			$this->User->id = $user_id;
			$avatar_name = uniqid("avt_".$user_id);

			$file 	= $this->Utility->convertImgBase64ToBinary($this->request->data['User']['img']);
			$dir  	= WWW_ROOT . $this->request->data['User']['relative_path'] . DS . $user_id . DS;

			$this->loadModel('Advertisement');
			$this->Advertisement->check_dir($dir);

			$result = file_put_contents( $dir . "$avatar_name.{$file['image']['type']}", $file['image']['binary']);

			if ( ! $result )
				return json_encode(['status' => false, 'msg' => 'Erro 106 - Erro ao salvar o arquivo.']);

			if ( ! $this->User->saveField('avatar', "$avatar_name.{$file['image']['type']}") )
				return json_encode(['status' => false, 'msg' => 'Erro 107 - Erro ao salvar o nome do arquivo.']);

			$this->Utility->refreshAuth('avatar',"$avatar_name.{$file['image']['type']}");

			return json_encode(['status' => true, 'msg' => 'Dados salvo com sucesso!']);
		}else{
			return json_encode(array("novno"=>"nono"));
		}
	}

	//public function isAuthorized($user = null)
	//{
		// All registered users can add posts
		//if ($this->action === 'add') {
		//	return true;
		//}





		//return parent::isAuthorized($user);

		// The owner of a user can edit and delete it
//		if (in_array($this->action, array('edit', 'view')))
//		{
//			if ( $this->User->isOwnedBy( (int) $this->request->params['pass'][0] ) == $this->Auth->user('id') )
//			{
//				return true;
//			}
//			else
//			{
//				return false;
//			}
//		}
//		else
//		{
//			return true;
//		}

	//}
}
