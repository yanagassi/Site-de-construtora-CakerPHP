<?php

//Router::connectNamed(false);

Router::connect('/',                           			['controller' => 'Pages', 'action' => 'index']);
Router::connect('/cake',					   			['controller' => 'Pages', 'action' => 'cakepage']);
Router::connect('/quem-somos',                			['controller' => 'Pages', 'action' => 'aboutus']);
Router::connect('/vantagens-em-anunciar',     			['controller' => 'Pages', 'action' => 'vantagensAnunciar']);
Router::connect('/vantagens',     						['controller' => 'Pages', 'action' => 'vantagensAnunciar']);
Router::connect('/vantagens-em-utilizar',     			['controller' => 'Pages', 'action' => 'vantagensUtilizar']);
Router::connect('/planos',                    			['controller' => 'Plans', 'action' => 'index']);
Router::connect('/contato',                   			['controller' => 'Pages', 'action' => 'contact']);

Router::connect('/busca',                      			['controller' => 'Pages', 'action' => 'search']);
Router::connect('/avaliar',                   			['controller' => 'Pages', 'action' => 'add_rating']);

Router::connect(‘/gen’,  					['controller' => 'Users', 'action' => ‘gen’]);

Router::connect('/login',                     			['controller' => 'Users', 'action' => 'login']);
Router::connect('/cadastro',                  			['controller' => 'Users', 'action' => 'add']);
Router::connect('/logout',								['controller' => 'users', 'action' => 'logout']);
Router::connect('/sair',								['controller' => 'users', 'action' => 'logout']);
Router::connect('/esqueci-minha-senha/', 				['controller' => 'Users', 'action' => 'forgot_password']);
Router::connect('/redefinir-senha/*',	 				['controller' => 'Users', 'action' => 'reset_password']);


Router::redirect(
	'/clientes/add/*',
	array('controller' => 'users', 'action' => 'add'),
	// or array('persist'=>array('id')) for default routing where the
	// view action expects $id as an argument
	array('persist' => true)
);


// Painel Area
Router::connect('/dashboard',            				['controller' => 'Dashboards', 		'action' => 'index']);
Router::connect('/painel',            					['controller' => 'Dashboards',		'action' => 'index']);
Router::connect('/painel/dashboard',            		['controller' => 'Dashboards',		'action' => 'index']);
Router::connect('/painel/perfil/*',             		['controller' => 'Users',			'action' => 'edit'], ['id' => '[0-9]+']);
Router::connect('/painel/avatar/*',             		['controller' => 'Users',			'action' => 'upload_avatar'], ['id' => '[0-9]+']);

Router::connect('/painel/anuncios',            			['controller' => 'Advertisements']);
Router::connect('/painel/anuncios/novo',    			['controller' => 'Advertisements', 'action' => 'add']);
Router::connect('/painel/anuncios/editar/*',    		['controller' => 'Advertisements', 'action' => 'edit'], ['id' => '[0-9]+']);
Router::connect('/painel/anuncios/telefone/novo/*',    	['controller' => 'Phones', 'action' => 'add'], ['id' => '[0-9]+']);

Router::connect('/painel/anuncios/financeiro',          			['controller' => 'Payments', 'action' => 'index']);
Router::connect('/painel/anuncios/financeiro/novo',  				['controller' => 'Payments', 'action' => 'add']);
Router::connect('/painel/anuncios/financeiro/editar/*',    			['controller' => 'Payments', 'action' => 'edit'], 	['id' => '[0-9]+']);
Router::connect('/painel/anuncios/financeiro/cancelar',    			['controller' => 'Payments', 'action' => 'del']);

Router::connect('/painel/relatorios',            		['controller' => 'Reports']);

Router::connect('/painel/servicos',            			['controller' => 'Services']);
Router::connect('/painel/produtos',            			['controller' => 'Products']);
Router::connect('/painel/planos',            			['controller' => 'Plans']);


// Admin Area
Router::connect('/admin/newsletters',            		['controller' => 'Newsletters', 	'action' => 'index_admin']);
Router::connect('/admin/anuncios',            			['controller' => 'Advertisements', 	'action' => 'index_admin']);
Router::connect('/admin/anuncios/novo',    				['controller' => 'Advertisements', 'action' => 'add']);
Router::connect('/admin/usuarios',            			['controller' => 'Users', 			'action' => 'index_admin']);
Router::connect('/admin/socialnetworks/ajax_delete',  	['controller' => 'SocialNetworks', 	'action' => 'ajax_delete']);

Router::connect('/admin/usuarios/editar/*',             ['controller' => 'Users',			'action' => 'edit'], ['id' => '[0-9]+']);

Router::connect
(
	'/:slug-:id', // E.g. /blog/3-CakePHP_Rocks
	array('controller' => 'Pages', 'action' => 'view'),
	array(
		'pass' => array('id', 'slug'),
		'id' => '[0-9]+'
	)
);

// Route to 404
// ToDo: Refactoring
// With this config, all routes needs be setted here
Router::connect
(
	'/:slug', // E.g. /blog/3-CakePHP_Rocks
	array('controller' => 'Pages', 'action' => 'view'),
	array(
		'pass' => array('slug')
	)
);

/* Just For Testing */
Router::connect('/posts', 						array('controller' => 'posts', 'action' => 'index'));
Router::connect('/posts/visualizar/*', 			array('controller' => 'posts', 'action' => 'view'), array("id" => "[0-9]+"));
Router::connect('/posts/editar/*', 				array('controller' => 'posts', 'action' => 'edit'), array("id" => "[0-9]+"));
Router::connect('/posts/adicionar', 			array('controller' => 'posts', 'action' => 'add'));
Router::connect('/posts/deletar/*',				array('controller' => 'posts', 'action' => 'delete'), array("id" => "[0-9]+"));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';
