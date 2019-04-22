<?php

class PagseguroComponent extends Component
{
    public function add_plan($data = array())
    {
        $email = Configure::read('PAGSEGURO_EMAIL');
        $token = Configure::read('PAGSEGURO_TOKEN');

        $url = Configure::read('PAGSEGURO_URL') . "/pre-approvals/request?email=$email&token=$token";
        $data_request = array
        (
             "reference"    => 10
            ,"preApproval"  => array
            (
                 "name"                     => "Ouro"
                ,"charge"                   => "AUTO"
                ,"period"                   => "MONTHLY"
                ,"amountPerPayment"         => '89.90'
                ,"expiration"               => array
                (
                     "value"                => 12
                    ,"unit"                 => "MONTHS"
                )
            )
        );

        $ch = curl_init();

        $data_string = json_encode($data_request);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=ISO-8859-1', 'Accept: application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1', 'Content-Length: ' . strlen($data_string)));

        $result = curl_exec($ch);
        return $result;
    }

    public function edit_plan($data)
    {
        $email = Configure::read('PAGSEGURO_EMAIL');
        $token = Configure::read('PAGSEGURO_TOKEN');

        $url = "https://".Configure::read('PAGSEGURO_URL_TRANSACTION_SIGNATURE')."/pre-approvals/request/".$data['Plan']['code_pagseguro']."/payment?email=$email&token=$token";
        $data_request = array
        (
             "amountPerPayment"    => $data['Plan']['value']
            ,"updateSubscriptions" => false
        );

        $ch = curl_init();

        $data_string = json_encode($data_request);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=ISO-8859-1', 'Accept: application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1', 'Content-Length: ' . strlen($data_string)));

        $result = curl_exec($ch);
        return $result;
    }

    public function add_signature($data)
    {
        $email              = Configure::read('PAGSEGURO_EMAIL');
        $token              = Configure::read('PAGSEGURO_TOKEN');
        $comprador_email    = ( Configure::read('ENV') == 'PRD' ? $data['User']['email'] : Configure::read('PAGSEGURO_CUSTOMER_EMAIL') );

        $url = Configure::read('PAGSEGURO_URL')."/pre-approvals?email=$email&token=$token";

        $data_request = array
        (
             'plan'                         => $data['Plan']['plan_id'] // Código do plano ao qual a assinatura será vinculada. Formato: Obtido no método /pre-approvals/request.
            ,'reference'                    => $data['Plan']['reference']
            ,'sender'                       =>
            [
                 'name'                     => $data['User']['first_name'] .' '. $data['User']['last_name']
                ,'email'                    => $comprador_email
                ,'hash'                     => $data['UserPayment']['senderHash']
                ,'phone'                    =>
                [
                     'areaCode'             => $data['User']['phone_area_code']
                    ,'number'               => $data['User']['phone_number']
                ]
                ,'address'                  =>
                [
                     'street'               => $data['Address']['street']
                    ,'number'               => $data['Address']['number']
                    ,'complement'           => $data['Address']['complement']
                    ,'district'             => $data['Address']['neighborhood']
                    ,'city'                 => $data['Address']['city']
                    ,'state'                => $data['Address']['state']
                    ,'country'              => 'BRA'
                    ,'postalCode'           => $data['Address']['cep']
                ]
                ,'documents'                =>
                [
                    0                       =>
                    [
                         'type'             => 'CPF'
                        ,'value'            => $data['User']['cpf']
                    ]
                ]
            ]
            ,'paymentMethod' => array
            (
                 'type'                     => 'CREDITCARD'
                ,'creditCard'               =>
                [
                     'token'                => $data['UserPayment']['cc_token']
                    ,'holder'               =>
                    [
                         'name'             => $data['User']['first_name'] .' '. $data['User']['last_name']
                        ,'birthDate'        => $data['User']['birthday']
                        ,'documents'        =>
                        [
                            (0) =>
                            [
                                 'type'     => 'CPF'
                                ,'value'    => $data['User']['cpf']
                            ]
                        ]
                        ,'phone'            =>
                        [
                             'areaCode'     => $data['User']['phone_area_code']
                            ,'number'       => $data['User']['phone_number']
                        ]
                        ,'billingAddress'   =>
                        [
                             'street'       => $data['Address']['street']
                            ,'number'       => $data['Address']['number']
                            ,'complement'   => $data['Address']['complement']
                            ,'district'     => $data['Address']['neighborhood']
                            ,'city'         => $data['Address']['city']
                            ,'state'        => $data['Address']['state']
                            ,'country'      => 'BRA'
                            ,'postalCode'   => $data['Address']['cep']
                        ]
                    ]
                ]
            )
        );

        $ch = curl_init();

        $data_string = json_encode($data_request);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=ISO-8859-1', 'Accept: application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1', 'Content-Length: ' . strlen($data_string)));

        $result = curl_exec($ch);
        $error  = curl_error($ch);
        $result = json_decode($result);

        if ($error || empty($result))
        {
            return false;
        }
        else
        {
            return $result->code;
        }
    }

    public function get_session_id()
    {
        $email              = Configure::read('PAGSEGURO_EMAIL');
        $token              = Configure::read('PAGSEGURO_TOKEN');
        $url                = Configure::read('PAGSEGURO_URL')."/v2/sessions/?email=$email&token=$token";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml;charset=ISO-8859-1'));

        $result = curl_exec($ch);

        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($result);
        if ($xml === false) {
            echo "Failed loading XML\n";
            foreach(libxml_get_errors() as $error) {
                echo "\t", $error->message;
            }
        }

        $result = json_decode(json_encode($xml), true);
        return $result['id'];
    }

    public function get_payment_information($pre_approval_code)
    {
        $pre_approval_code = '79FAC24F04042F8004AD2F8904350C57'; // sandbox = 79FAC24F04042F8004AD2F8904350C57 | prd = 7C9AF89499995030040C8FB4352E7472

        $email = Configure::read('PAGSEGURO_EMAIL');
        $token = Configure::read('PAGSEGURO_TOKEN');
        $url   = Configure::read('PAGSEGURO_URL')."/v2/pre-approvals/$pre_approval_code?email=$email&token=$token"; // codigo assinatura

// prd
//        $email = 'construlista.construlista@gmail.com';
//        $token = '0284A82F297045A69D3CB05C5E627838';
//        $url   = "https://ws.pagseguro.uol.com.br/v2/pre-approvals/$pre_approval_code?email=$email&token=$token"; // codigo assinatura

        $ch = curl_init();
        $timeout = 60;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, 0); // 1=show debug | 0=don't show debug
        $data = curl_exec($ch);
        $err  = curl_error($data);
        curl_close($data);

        if ($err || empty($data))
        {
            return false;
        }
        else
        {
            $xml    = simplexml_load_string($data); // Lendo o arquivo XML
            $result = (array) $xml; // XML para Array
            return $result;
        }
    }

    public function signature_cancel($pre_approval_code = null)
    {
        $email = Configure::read('PAGSEGURO_EMAIL');
        $token = Configure::read('PAGSEGURO_TOKEN');
        $url   = Configure::read('PAGSEGURO_URL')."/v2/pre-approvals/cancel/$pre_approval_code?email=$email&token=$token";
        $curl  = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($response);
        if ($xml === false) {
            echo "Failed loading XML\n";
            foreach(libxml_get_errors() as $error) {
                echo "\t", $error->message;
            }
        }

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            $response = json_decode(json_encode($xml), true);
            return $response;
        }
    }

    public function pagseguro_get_transaction_by_date()
    {
//        $d           = new DateTime('NOW');
//        $final_date  = $d->date;
//        $initialDate = $d->modify('-1 month');
//        $initialDate = $d->format('2018-11-15\T00:00');

        $finalDate  = '2018-12-05T10:55';
        $initialDate = '2018-11-06T16:55';

        $email = Configure::read('PAGSEGURO_EMAIL');
        $token = Configure::read('PAGSEGURO_TOKEN');

        $page = 1;
        $maxPageResults = 1000;
        //$url   = Configure::read('PAGSEGURO_URL')."/v2/transactions?initialDate=$initialDate&finalDate=$finalDate&page=$page&maxPageResults=$maxPageResults&email=$email&token=$token";
        $url   = Configure::read('PAGSEGURO_URL')."/v2/pre-approvals/notifications?&email=$email&token=$token&interval=30";

        /* gets the data from a URL */
        $ch = curl_init();
        $timeout = 60;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, 1); // 1=show debug | 0=don't show debug
        $data = curl_exec($ch);
        $err  = curl_error($data);
        curl_close($ch);

        if ($err || empty($data))
        {
            return false;
        }
        else
        {
            $xml    = simplexml_load_string($data); // Lendo o arquivo XML
            $result = (array) $xml; // XML para Array
            return $result;
        }
    }

}