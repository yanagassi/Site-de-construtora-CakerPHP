<?php

class SerasaComponent extends Component
{
    public function cdc_pessoa_fisica_simplificada($data)
    {
        $user = Configure::read('SERASA_EMAIL');
        $pass = Configure::read('SERASA_SENHA');

        $url = Configure::read('SERASA_URL_REST')."/cdc/pessoafisicasimplificada.ashx";

        $credentials = [
             "Credenciais"    => [
                  "Email" => $user
                 ,"Senha" => $pass
             ]
        ];

        $data = [
             "Documento"        => $data['Consult']['document']
            ,"DataNascimento"   => $data['Consult']['birthday']
        ];

        if ( Configure::read('SERASA_ENV') == 'HML' )
        {
            $data = [
                 "Documento"          => "999.999.999-99"
                ,"DataNascimento"     => "04/10/1950"
            ];
        }

        $data_request = array_merge($credentials,$data);

        $ch = curl_init();

        $data_string = json_encode($data_request);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;;charset=utf-8'));

        $result = curl_exec($ch);
        $result = json_decode($result);

        return $result;
    }

    public function cdc_pessoa_fisica_estendida($data)
    {
        $user = Configure::read('SERASA_EMAIL');
        $pass = Configure::read('SERASA_SENHA');

        $url = Configure::read('SERASA_URL_REST')."/cdc/pessoafisicaestendida.ashx";

        $credentials = [
            "Credenciais"    => [
                 "Email" => $user
                ,"Senha" => $pass
            ]
        ];

        $data = [
             "Documento"        => $data['Consult']['document']
        ];

        if ( Configure::read('SERASA_ENV') == 'HML' )
        {
            $data = [
                "Documento"          => "999.999.999-99"
            ];
        }

        $data_request = array_merge($credentials,$data);

        $ch = curl_init();

        $data_string = json_encode($data_request);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;;charset=utf-8'));

        $result = curl_exec($ch);
        $result = json_decode($result);

        return $result;
    }

    public function cdc_pessoa_juridica_simplificada($data)
    {
        $user = Configure::read('SERASA_EMAIL');
        $pass = Configure::read('SERASA_SENHA');

        $url = Configure::read('SERASA_URL_REST')."/cdc/pessoajuridicasimplificada.ashx";

        $credentials = [
            "Credenciais"    => [
                 "Email" => $user
                ,"Senha" => $pass
            ]
        ];

        $data = [
             "Documento"        => $data['Consult']['document']
        ];

        if ( Configure::read('SERASA_ENV') == 'HML' )
        {
            $data = [
                 "Documento"          => "99.999.999/9999-62"
            ];
        }

        $data_request = array_merge($credentials,$data);

        $ch = curl_init();

        $data_string = json_encode($data_request);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;;charset=utf-8'));

        $result = curl_exec($ch);
        $result = json_decode($result);

        return $result;
    }

    public function cdc_sintese_cadastral($data)
    {
        $user = Configure::read('SERASA_EMAIL');
        $pass = Configure::read('SERASA_SENHA');

        $url = Configure::read('SERASA_URL_SOA')."/cdc/cdc.asmx?op=SinteseCadastral";

        $credentials = [
            "Credenciais"    => [
                 "Email" => $user
                ,"Senha" => $pass
            ]
        ];

        $data = [
            "Documento"        => $data['Consult']['document']
        ];

        if ( Configure::read('SERASA_ENV') == 'HML' )
        {
            $data = [
                "Documento"          => "99.999.999/9999-62" // ou 999.999.999-99
            ];
        }

        $soap_request =  '<?xml version="1.0" encoding="utf-8"?>';
        $soap_request .= '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://www.w3.org/2003/05/soap-envelope">';
            $soap_request .= '<soap:Body>';
                $soap_request .= '<SinteseCadastral xmlns="SOAWebServices">';
                    $soap_request .= '<Credenciais>';
                        $soap_request .= '<Email>'.$user.'</Email>';
                        $soap_request .= '<Senha>'.$pass.'</Senha>';
                    $soap_request .= '</Credenciais>';
                    $soap_request .= '<Documento>'.$data['Documento'].'</Documento>';
                $soap_request .= '</SinteseCadastral>';
            $soap_request .= '</soap:Body>';
        $soap_request .= '</soap:Envelope>';

        $header = array(
            "Content-type: text/xml; charset=utf-8",
            "Content-length: ".strlen($soap_request)
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soap_request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);

        libxml_use_internal_errors(true);
        $clean_xml = str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $result);

        $xml = simplexml_load_string($clean_xml);
        if ($xml === false) {
            echo "Failed loading XML\n";
            foreach(libxml_get_errors() as $error) {
                echo "\t", $error->message;
            }
        }

        $result = json_decode(json_encode($xml), true);
        $result = $result['Body']['SinteseCadastralResponse']['SinteseCadastralResult'];

        return $result;
    }

    public function cdc_rf_pessoa_fisica($data)
    {
        $user = Configure::read('SERASA_EMAIL');
        $pass = Configure::read('SERASA_SENHA');

        $url = Configure::read('SERASA_URL_REST')."/cdc/pessoafisicanfe.ashx";

        $credentials = [
            "Credenciais"    => [
                 "Email" => $user
                ,"Senha" => $pass
            ]
        ];

        $data = [
             "Documento"        => $data['Consult']['document']
            ,"DataNascimento"   => $data['Consult']['birthday']
        ];

        if ( Configure::read('SERASA_ENV') == 'HML' )
        {
            $data = [
                 "Documento"          => "999.999.999-99"
                ,"DataNascimento"     => "04/10/1950"
            ];
        }

        $data_request = array_merge($credentials,$data);

        $ch = curl_init();

        $data_string = json_encode($data_request);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;;charset=utf-8'));

        $result = curl_exec($ch);
        $result = json_decode($result);

        return $result;
    }

    public function cdc_rf_pessoa_juridica_nfe($data)
    {
        $user = Configure::read('SERASA_EMAIL');
        $pass = Configure::read('SERASA_SENHA');

        $url = Configure::read('SERASA_URL_REST')."/cdc/pessoajuridicanfe.ashx";

        $credentials = [
            "Credenciais"    => [
                 "Email" => $user
                ,"Senha" => $pass
            ]
        ];

        $data = [
             "Documento"        => $data['Consult']['document']
        ];

        if ( Configure::read('SERASA_ENV') == 'HML' )
        {
            $data = [
                "Documento"          => "99.999.999/9999-62"
            ];
        }

        $data_request = array_merge($credentials,$data);

        $ch = curl_init();

        $data_string = json_encode($data_request);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;;charset=utf-8'));

        $result = curl_exec($ch);
        $result = json_decode($result);

        return $result;
    }

    public function cdc_rf_pessoa_juridica_extendida($data)
    {
        $user = Configure::read('SERASA_EMAIL');
        $pass = Configure::read('SERASA_SENHA');

        $url = Configure::read('SERASA_URL_SOA')."/cdc/cdc.asmx?op=PessoaJuridicaNFeEstendida";

        $data = [
            "Documento"        => $data['Consult']['document']
        ];

        if ( Configure::read('SERASA_ENV') == 'HML' )
        {
            $data = [
                "Documento"          => "99.999.999/9999-62" // ou 999.999.999-99
            ];
        }

        $soap_request =  '<?xml version="1.0" encoding="utf-8"?>';
        $soap_request .= '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://www.w3.org/2003/05/soap-envelope">';
            $soap_request .= '<soap:Body>';
                $soap_request .= '<PessoaJuridicaNFeEstendida xmlns="SOAWebServices">';
                    $soap_request .= '<Credenciais>';
                        $soap_request .= '<Email>'.$user.'</Email>';
                        $soap_request .= '<Senha>'.$pass.'</Senha>';
                    $soap_request .= '</Credenciais>';
                    $soap_request .= '<Documento>'.$data['Documento'].'</Documento>';
                $soap_request .= '</PessoaJuridicaNFeEstendida>';
            $soap_request .= '</soap:Body>';
        $soap_request .= '</soap:Envelope>';

        $header = array(
            "Content-type: text/xml; charset=utf-8",
            "Content-length: ".strlen($soap_request)
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soap_request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);

        libxml_use_internal_errors(true);
        $clean_xml = str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $result);

        $xml = simplexml_load_string($clean_xml);
        if ($xml === false) {
            echo "Failed loading XML\n";
            foreach(libxml_get_errors() as $error) {
                echo "\t", $error->message;
            }
        }

        $result = json_decode(json_encode($xml), true);
        $result = $result['Body']['PessoaJuridicaNFeEstendidaResponse']['PessoaJuridicaNFeEstendidaResult'];

        return $result;
    }

    public function cdc_rf_pessoa_juridica_simples_nacional($data)
    {
        $user = Configure::read('SERASA_EMAIL');
        $pass = Configure::read('SERASA_SENHA');

        $url = Configure::read('SERASA_URL_SOA')."/cdc/cdc.asmx?op=PessoaJuridicaSimplesNacional";

        $data = [
            "Documento"        => $data['Consult']['document']
        ];

        if ( Configure::read('SERASA_ENV') == 'HML' )
        {
            $data = [
                "Documento"          => "99.999.999/9999-62" // ou 999.999.999-99
            ];
        }

        $soap_request =  '<?xml version="1.0" encoding="utf-8"?>';
        $soap_request .= '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://www.w3.org/2003/05/soap-envelope">';
            $soap_request .= '<soap:Body>';
                $soap_request .= '<PessoaJuridicaSimplesNacional xmlns="SOAWebServices">';
                    $soap_request .= '<Credenciais>';
                        $soap_request .= '<Email>'.$user.'</Email>';
                        $soap_request .= '<Senha>'.$pass.'</Senha>';
                    $soap_request .= '</Credenciais>';
                    $soap_request .= '<Documento>'.$data['Documento'].'</Documento>';
                $soap_request .= '</PessoaJuridicaSimplesNacional>';
            $soap_request .= '</soap:Body>';
        $soap_request .= '</soap:Envelope>';

        $header = array(
            "Content-type: text/xml; charset=utf-8",
            "Content-length: ".strlen($soap_request)
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soap_request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);

        libxml_use_internal_errors(true);
        $clean_xml = str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $result);

        $xml = simplexml_load_string($clean_xml);
        if ($xml === false) {
            echo "Failed loading XML\n";
            foreach(libxml_get_errors() as $error) {
                echo "\t", $error->message;
            }
        }

        $result = json_decode(json_encode($xml), true);
        $result = $result['Body']['PessoaJuridicaSimplesNacionalResponse']['PessoaJuridicaSimplesNacionalResult'];

        return $result;
    }

    public function serasa_experian_pefin($data)
    {
        $user = Configure::read('SERASA_EMAIL');
        $pass = Configure::read('SERASA_SENHA');

        $url = Configure::read('SERASA_URL_REST')."/serasa/pefin.ashx";

        $credentials = [
            "Credenciais"    => [
                 "Email" => $user
                ,"Senha" => $pass
            ]
        ];

        $data = [
            "Documento"        => $data['Consult']['document']
        ];

        if ( Configure::read('SERASA_ENV') == 'HML' )
        {
            $data = [
                "Documento"          => "00007044/0001-43"
            ];
        }

        $data_request = array_merge($credentials,$data);

        $ch = curl_init();

        $data_string = json_encode($data_request);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;;charset=utf-8'));

        $result = curl_exec($ch);
        $result = json_decode($result);

        return $result;
    }

    public function serasa_experian_crednet($data)
    {
        $user = Configure::read('SERASA_EMAIL');
        $pass = Configure::read('SERASA_SENHA');

        $url = Configure::read('SERASA_URL_SOA') . "/serasa/crednet.asmx?op=CredNet";

        $data = [
             "Documento"        => $data['Consult']['document']
            ,"UF"               => $data['Consult']['UF']
        ];

        if ( Configure::read('SERASA_ENV') == 'HML' )
        {
            $data = [
                 "Documento"          => "00001500/0001-48"
                ,'UF'                 => 'SP'
            ];
        }

        $soap_request =  '<?xml version="1.0" encoding="utf-8"?>';
        $soap_request .= '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://www.w3.org/2003/05/soap-envelope">';
            $soap_request .= '<soap:Body>';
                $soap_request .= '<CredNet xmlns="SOAWebServices">';
                    $soap_request .= '<Credenciais>';
                        $soap_request .= '<Email>'.$user.'</Email>';
                        $soap_request .= '<Senha>'.$pass.'</Senha>';
                    $soap_request .= '</Credenciais>';
                    $soap_request .= '<Documento>'.$data['Documento'].'</Documento>';
                    $soap_request .= '<Estado>'.$data['UF'].'</Estado>';
                    $soap_request .= '<Adicionais>';
                        $soap_request .= '<ItemAdicional>QuadroDeSocios</ItemAdicional>';
                    $soap_request .= '</Adicionais>';
                $soap_request .= '</CredNet>';
            $soap_request .= '</soap:Body>';
        $soap_request .= '</soap:Envelope>';

        $header = array(
            "Content-type: text/xml; charset=utf-8",
            "Content-length: ".strlen($soap_request)
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soap_request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);

        libxml_use_internal_errors(true);
        $clean_xml = str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $result);

        $xml = simplexml_load_string($clean_xml);
        if ($xml === false) {
            echo "Failed loading XML\n";
            foreach(libxml_get_errors() as $error) {
                echo "\t", $error->message;
            }
        }

        $result = json_decode(json_encode($xml));
        $result = $result->Body->CredNetResponse->CredNetResult;

        return $result;
    }

    public function serasa_experian_crednet_estendida($data)
    {
        $user = Configure::read('SERASA_EMAIL');
        $pass = Configure::read('SERASA_SENHA');

        $url = Configure::read('SERASA_URL_SOA') . "/serasa/crednet.asmx?op=CredNetEstendida";

        if ( Configure::read('SERASA_ENV') == 'HML' )
        {
            $data['Consult']['document'] = "00001500/0001-48";
            $data['Consult']['UF']       = 'SP';
        }

        $soap_request =  '<?xml version="1.0" encoding="utf-8"?>';
        $soap_request .= '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">';
            $soap_request .= '<soap:Body>';
                $soap_request .= '<CredNetEstendida xmlns="SOAWebServices">';
                    $soap_request .= '<Credenciais>';
                        $soap_request .= '<Email>'.$user.'</Email>';
                        $soap_request .= '<Senha>'.$pass.'</Senha>';
                    $soap_request .= '</Credenciais>';
                    $soap_request .= '<Documento>'.$data['Consult']['document'].'</Documento>';
                    $soap_request .= '<Estado>'.$data['Consult']['UF'].'</Estado>';
                    $soap_request .= '<Adicionais>';

                        $soap_request .= '<ItemAdicional>QuadroDeSocios</ItemAdicional>';

                        if ( !empty($data['Consult']['is_participacoes']) && $data['Consult']['is_participacoes'] == 1 )
                        {
                            $soap_request .= '<ItemAdicional>Participacoes</ItemAdicional>';
                        }

                        if ( !empty($data['Consult']['is_risk_scoring']) && $data['Consult']['is_risk_scoring'] == 1 )
                        {
                            $soap_request .= '<ItemAdicional>RiskScoring</ItemAdicional>';
                        }

                        if ( !empty($data['Consult']['is_limite_credito']) && $data['Consult']['is_limite_credito'] == 1 )
                        {
                            $soap_request .= '<ItemAdicional>LimiteCredito</ItemAdicional>';
                        }

                    $soap_request .= '</Adicionais>';
                $soap_request .= '</CredNetEstendida>';
            $soap_request .= '</soap:Body>';
        $soap_request .= '</soap:Envelope>';

        $header = array(
            "Content-type: text/xml; charset=utf-8",
            "Content-length: ".strlen($soap_request)
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soap_request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);

        libxml_use_internal_errors(true);
        $clean_xml = str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $result);

        $xml = simplexml_load_string($clean_xml);
        if ($xml === false) {
            echo "Failed loading XML\n";
            foreach(libxml_get_errors() as $error) {
                echo "\t", $error->message;
            }
        }

        $result = json_decode(json_encode($xml));
        $result = $result->Body->CredNetEstendidaResponse->CredNetEstendidaResult;

        return $result;
    }

    public function serasa_experian_concentre($data)
    {
        $user = Configure::read('SERASA_EMAIL');
        $pass = Configure::read('SERASA_SENHA');

        $url = Configure::read('SERASA_URL_SOA') . "/serasa/concentre.asmx?op=Concentre";

        if ( Configure::read('SERASA_ENV') == 'HML' )
        {
            $data['Consult']['document'] = "00001502/0001-37";
            $data['Consult']['UF']       = 'SP';
        }

        $soap_request =  '<?xml version="1.0" encoding="utf-8"?>';
        $soap_request .= '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">';
            $soap_request .= '<soap:Body>';
                $soap_request .= '<Concentre xmlns="SOAWebServices">';
                    $soap_request .= '<Credenciais>';
                        $soap_request .= '<Email>'.$user.'</Email>';
                        $soap_request .= '<Senha>'.$pass.'</Senha>';
                    $soap_request .= '</Credenciais>';
                    $soap_request .= '<Documento>'.$data['Consult']['document'].'</Documento>';
                    $soap_request .= '<Adicionais>';

                    $soap_request .= '<ItemAdicional>QuadroDeSocios</ItemAdicional>';

                    if ( !empty($data['Consult']['is_participacoes']) && $data['Consult']['is_participacoes'] == 1 )
                    {
                        $soap_request .= '<ItemAdicional>Participacoes</ItemAdicional>';
                    }

                    if ( !empty($data['Consult']['is_risk_scoring']) && $data['Consult']['is_risk_scoring'] == 1 )
                    {
                        $soap_request .= '<ItemAdicional>RiskScoring</ItemAdicional>';
                    }

                    if ( !empty($data['Consult']['is_limite_credito']) && $data['Consult']['is_limite_credito'] == 1 )
                    {
                        $soap_request .= '<ItemAdicional>LimiteCredito</ItemAdicional>';
                    }

                    $soap_request .= '</Adicionais>';
                $soap_request .= '</Concentre>';
            $soap_request .= '</soap:Body>';
        $soap_request .= '</soap:Envelope>';

        $header = array(
            "Content-type: text/xml; charset=utf-8",
            "Content-length: ".strlen($soap_request)
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soap_request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);

        libxml_use_internal_errors(true);
        $clean_xml = str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $result);

        $xml = simplexml_load_string($clean_xml);
        if ($xml === false) {
            echo "Failed loading XML\n";
            foreach(libxml_get_errors() as $error) {
                echo "\t", $error->message;
            }
        }

        $result = json_decode(json_encode($xml));
        $result = $result->Body->ConcentreResponse->ConcentreResult;

        return $result;
    }

    public function serasa_experian_cheques($data)
    {
        $user = Configure::read('SERASA_EMAIL');
        $pass = Configure::read('SERASA_SENHA');

        $url = Configure::read('SERASA_URL_SOA') . "/serasa/cheques.asmx?op=Cheque";

        if ( Configure::read('SERASA_ENV') == 'HML' )
        {
            $data['Consult']['document'] = "00001502/0001-37";
            $data['Consult']['UF']       = 'SP';
        }

        $soap_request =  '<?xml version="1.0" encoding="utf-8"?>';
        $soap_request .= '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">';
            $soap_request .= '<soap:Body>';
                $soap_request .= '<Cheque xmlns="SOAWebServices">';
                    $soap_request .= '<Credenciais>';
                        $soap_request .= '<Email>'.$user.'</Email>';
                        $soap_request .= '<Senha>'.$pass.'</Senha>';
                    $soap_request .= '</Credenciais>';
                    $soap_request .= '<Documento>'.$data['Consult']['document'].'</Documento>';
                    $soap_request .= '<Banco>'.$data['Consult']['banco'].'</Banco>';
                    $soap_request .= '<Agencia>'.$data['Consult']['agencia'].'</Agencia>';
                    $soap_request .= '<ContaCorrente>'.$data['Consult']['conta_corrente'].'</ContaCorrente>';
                    $soap_request .= '<NumeroChequeInicial>'.$data['Consult']['numero_cheque_inicial'].'</NumeroChequeInicial>';
                    $soap_request .= '<NumeroChequeFinal>'.$data['Consult']['numero_cheque_final'].'</NumeroChequeFinal>';
                $soap_request .= '</Cheque>';
            $soap_request .= '</soap:Body>';
        $soap_request .= '</soap:Envelope>';

        $header = array(
            "Content-type: text/xml; charset=utf-8",
            "Content-length: ".strlen($soap_request)
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soap_request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1); // uncomment this line just for debug
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);

        libxml_use_internal_errors(true);
        $clean_xml = str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $result);

        $xml = simplexml_load_string($clean_xml);
        if ($xml === false) {
            echo "Failed loading XML\n";
            foreach(libxml_get_errors() as $error) {
                echo "\t", $error->message;
            }
        }

        $result = json_decode(json_encode($xml));
        $result = $result->Body->ChequeResponse->ChequeResult;

        return $result;
    }
}