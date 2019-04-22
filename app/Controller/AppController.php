<?php

App::uses('CakeEmail', 	'Network/Email');
App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $components = array
    (
        'Flash',
        'Session',
        'RequestHandler',
        'Security',
        'Utility',
        'DebugKit.Toolbar',
        'Acl',
        'Auth' => array
        (
            'loginRedirect' => [
                'controller' => 'pages',
                'action' => 'dashboard'
            ],
            'logoutRedirect' => '/'
            ,'authenticate' => [
                'Form' => [
                    //'passwordHasher' => 'Custom',
                    'fields' => [
                        'username' => 'cpf',
                        'password' => 'senha'
                    ],
                ]
            ]
            ,'authorize' => ['Controller']
        )
    );

    function beforeRender()
    {
        if($this->name == 'CakeError') {
            $this->layout = 'error';
        }
    }

    function beforeFilter()
    {
        if ( $this->RequestHandler->isMobile() )
        {
            $this->is_mobile = true;
            $this->set('is_mobile', true );
            //$this->autoRender = false;
        }

        // Use this for passwordHasher on Controller/Component/Auth/CustomPasswordHasher.php
        // https://book.cakephp.org/2.0/en/core-libraries/components/security-component.html#handling-blackhole-callbacks
        $this->Security->blackHoleCallback = 'blackhole';

        $pagseguro_result = $this->getPagseguroConfig();

        Configure::write
        (
            [
                 'SCHEME'     	               => $this->setScheme()
                ,'BRAND'                       => 'CONSTRULISTA'
                ,'BRAND_SLOGAN'                => 'A forma mais fácil de encontrar material ou contratar um serviço para sua construção, reforma ou manutenção.'
                ,'HOST'                        => 'https://www.construlista.com.br'
                ,'ENV'                         => $pagseguro_result['environment']

                ,'PAGSEGURO_URL'               => $pagseguro_result['pagseguro_credential_url']
                ,'PAGSEGURO_URL_STATIC'        => $pagseguro_result['pagseguro_credential_static_url']
                ,'PAGSEGURO_EMAIL'             => $pagseguro_result['pagseguro_credential_email']
                ,'PAGSEGURO_TOKEN'             => $pagseguro_result['pagseguro_credential_token']

                ,'PAGSEGURO_APP_ID'            => $pagseguro_result['pagseguro_credential_app_id']
                ,'PAGSEGURO_APP_KEY'           => $pagseguro_result['pagseguro_credential_app_key']

                ,'PAGSEGURO_VENDOR_EMAIL'      => $pagseguro_result['pagseguro_credential_vendor_email']
                ,'PAGSEGURO_VENDOR_PASS'       => $pagseguro_result['pagseguro_credential_vendor_pass']
                ,'PAGSEGURO_VENDOR_PUBLIC_KEY' => $pagseguro_result['pagseguro_credential_vendor_public_key']

                ,'PAGSEGURO_CUSTOMER_EMAIL'    => 'c81690575857062385406@sandbox.pagseguro.com.br'
                ,'PAGSEGURO_CUSTOMER_PASS'     => '9FR404X076h796Kv'
            ]
        );

        /*
        $this->log($pagseguro_result, 'error');
        $this->log(Configure::read('ENV'), 'error');
        $this->log($_SERVER["SERVER_NAME"], 'error');
        */

        // Load ajax div msg for Portal Layout on default Template => Elements/Flash
        $this->Flash->ajaxPortalError('',   array('key' => 'ajax-portal-error'));
        $this->Flash->ajaxPortalSuccess('', array('key' => 'ajax-portal-success'));

        $this->Flash->ajaxError('', array('key' => 'ajax-error'));
        $this->Flash->ajaxSuccess('', array('key' => 'ajax-success'));

        $cidades = ClassRegistry::init('Address')->find('all', array(
            'fields' => array('DISTINCT Address.cidade', 'Address.estado'),
            'order' => 'Address.cidade DESC',
        ));

        $this->set(compact('cidades'));
    }

    public function blackhole($type) {
        // handle errors.
    }

    public function getPagseguroConfig()
    {
        if ($_SERVER["SERVER_NAME"] == 'construlista.com.br' || $_SERVER["SERVER_NAME"] == 'www.construlista.com.br') { // Production

            // Credentials
            $payments['environment']                            = 'PRD';
            $payments['pagseguro_credential_url']               = 'https://ws.pagseguro.uol.com.br';
            $payments['pagseguro_credential_static_url']        = 'https://stc.pagseguro.uol.com.br';
            $payments['pagseguro_credential_email']             = 'construlista.construlista@gmail.com';
            $payments['pagseguro_credential_token']	            = '0284A82F297045A69D3CB05C5E627838';

            // Credentials App
            $payments['pagseguro_credential_app_id']            = 'app6913347939';
            $payments['pagseguro_credential_app_key']	        = '9BBF86CE8A8A549FF43BFFAF252CF55E';

            // Credentials Vendor Test
            $payments['pagseguro_credential_vendor_email']      = 'v37959806279222638437@sandbox.pagseguro.com.br';
            $payments['pagseguro_credential_vendor_pass']	    = '3e50m85518030062';
            $payments['pagseguro_credential_vendor_public_key']	= 'PUBA010991D005C4CADA3972E5500D4324F';
        }
        else // Homolog
        {
            // Credentials
            $payments['environment']                            = 'HML';
            $payments['pagseguro_credential_url']               = 'https://ws.sandbox.pagseguro.uol.com.br';
            $payments['pagseguro_credential_static_url']        = 'https://stc.sandbox.pagseguro.uol.com.br';
            $payments['pagseguro_credential_email']             = 'construlista.construlista@gmail.com';
            $payments['pagseguro_credential_token']	            = 'E6A8CCBFBDCC46A69FCD855FEE81D84A';

            // Credentials App
            $payments['pagseguro_credential_app_id']            = 'app6913347939';
            $payments['pagseguro_credential_app_key']	        = '9BBF86CE8A8A549FF43BFFAF252CF55E';

            // Credentials Vendor Test
            $payments['pagseguro_credential_vendor_email']      = 'v37959806279222638437@sandbox.pagseguro.com.br';
            $payments['pagseguro_credential_vendor_pass']	    = '3e50m85518030062';
            $payments['pagseguro_credential_vendor_public_key']	= 'PUBA010991D005C4CADA3972E5500D4324F';
        }

       return $payments;
    }

    public function isAuthorized($user = null)
    {
        // Any registered user can access public functions
        if (empty($this->request->params['admin'])) {
            return true;
        }

        // Only admins can access admin functions
        if (isset($this->request->params['admin'])) {
            return (bool)($user['role'] === 'admin');
        }

        // Default deny
        return false;
    }

    public function get_main_domain($url)
    {
        $pieces = parse_url($url);
        $domain = isset($pieces['host']) ? $pieces['host'] : '';
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }
        return null;
    }

    public function getNameFromSubDomain($url)
    {
        $tmp = explode('.', $url);
        $subdomain = next($tmp);
        return $subdomain;
    }

    public function setScheme()
    {
        if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) // ToDo: https://book.cakephp.org/2.0/en/core-libraries/components/security-component.html
            $scheme = 'https://';
        else {
            $scheme = 'http://';
        }
        return $scheme;
    }
}
