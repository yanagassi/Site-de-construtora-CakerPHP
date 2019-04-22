<?php
App::uses('CakeEmail', 'Network/Email');

class EmailComponent extends Component
{
    function sendMail($data = array())
    {
        $Email = new CakeEmail('default');
        $Email->config();
        $Email->from('no-reply@construlista.com.br');
        $Email->to( $data["email_to"] );
        $Email->bcc('contato@construlista.com.br');
        $Email->bcc('saulostopa@gmail.com');
        $Email->emailFormat('both');
        $Email->subject($data["subject"]);

        $content['subject']             = $data["subject"];
        $content['welcome']             = Configure::read('BRAND');
        $content['slogan']              = Configure::read('BRAND_SLOGAN');
        $content['intro']               = $data['intro'];
        $content['host']                = Configure::read('HOST');
        $content['body']                = $data["msg"];
        $content['client']              = $data["client"];
        $content['email_client']        = $data["email_client"];
        $content['phone_client']        = $data["phone_client"];
        $content['link']                = '';

        $Email->template('default', 'default');
        $Email->emailFormat('html');
        $Email->viewVars($content);

        if ( ! $Email->send() ) return false;

        return true;
    }

    function sendMailAdvertisement($data = array())
    {
        $Email = new CakeEmail('default');
        $Email->config();
        $Email->from('no-reply@construlista.com.br');
        $Email->to( $data["email_to"] );
        $Email->bcc('contato@construlista.com.br');
        $Email->bcc('saulostopa@gmail.com');
        $Email->emailFormat('html');
        $Email->template('default', 'advertisement');
        $Email->subject($data["subject"]);

        $content['welcome']             = Configure::read('BRAND');
        $content['slogan']              = Configure::read('BRAND_SLOGAN');
        $content['host']                = Configure::read('HOST');

        $content['subject']             = $data["subject"];
        $content['intro']               = $data['intro'];
        $content['body']                = $data["body"];

        $Email->viewVars($content);

        if ( ! $Email->send() ) return false;

        return true;
    }

    function sendMailRegister($data = array())
    {
        $Email = new CakeEmail('default');
        $Email->config();
        $Email->from('no-reply@construlista.com.br');
        $Email->to( $data["email_to"] );
        $Email->bcc('contato@construlista.com.br');
        $Email->bcc('saulostopa@gmail.com');
        $Email->emailFormat('html');
        $Email->template('default', 'register');
        $Email->subject($data["subject"]);

        $content['welcome']             = Configure::read('BRAND');
        $content['slogan']              = Configure::read('BRAND_SLOGAN');
        $content['host']                = Configure::read('HOST');

        $content['subject']             = $data["subject"];
        $content['intro']               = $data['intro'];
        $content['body']                = $data["body"];

        $Email->viewVars($content);

        if ( ! $Email->send() ) return false;

        return true;
    }

    function sendMailToPartner($data = array())
    {
        $Email = new CakeEmail('default');
        $Email->config();
        $Email->from('no-reply@construlista.com.br');
        $Email->to( $data["email_to"] );
        $Email->bcc('contato.parceiro@construlista.com.br');
        $Email->bcc('saulostopa@gmail.com');
        $Email->emailFormat('both');
        $Email->subject($data["subject"]);

        $content['subject']             = $data["subject"];
        $content['welcome']             = Configure::read('BRAND');
        $content['slogan']              = Configure::read('BRAND_SLOGAN');
        $content['intro']               = $data['intro'];
        $content['host']                = Configure::read('HOST');
        $content['body']                = $data["msg"];
        $content['client']              = $data["client"];
        $content['email_client']        = $data["email_client"];
        $content['phone_client']        = $data["phone_client"];
        $content['link']                = '';

        $Email->template('default', 'contact_partner');
        $Email->emailFormat('html');
        $Email->viewVars($content);

        if ( ! $Email->send() ) return false;

        return true;
    }
}