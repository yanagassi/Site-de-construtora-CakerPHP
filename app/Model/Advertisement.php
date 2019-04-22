<?php

App::uses('AppModel', 'Model');

class Advertisement extends AppModel
{
    public $useTable    = 'anuncios';
    public $name        = 'Advertisement';
    public $components  = array("RequestHandler");

    public $hasMany = array(
        'Phone'    => array(
            'className'     => 'Phone',
            'foreignKey'    => 'anuncio_id',
            'dependent'     => true
        )
        ,'OperatingHour'    => array(
            'className'     => 'OperatingHour',
            'foreignKey'    => 'anuncio_id',
            'dependent'     => true,
            'order'         => 'OperatingHour.order ASC'
        )
        ,'PaymentMethod'    => array(
            'className'     => 'PaymentMethod',
            'foreignKey'    => 'anuncio_id',
            'dependent'     => true
        )
        ,'AboutEstablishment'    => array(
            'className'     => 'AboutEstablishment',
            'foreignKey'    => 'anuncio_id',
            'dependent'     => true
        )
        ,'Service'          => array(
            'className'     => 'Service',
            'foreignKey'    => 'anuncio_id',
            'dependent'     => true
        )
        ,'Product'          => array(
            'className'     => 'Product',
            'foreignKey'    => 'anuncio_id',
            'dependent'     => true
        )
        ,'Photo'    => array(
            'className'     => 'Photo',
            'foreignKey'    => 'anuncio_id',
            'dependent'     => true
        )
        ,'Rating'    => array(
            'className'     => 'Rating',
            'foreignKey'    => 'anuncio_id',
            'dependent'     => true
        )
    );

    public $hasOne = array(
        'Address'    => array(
            'className'     => 'Address',
            'foreignKey'    => 'anuncio_id',
            'dependent'     => true
        )
        ,'SocialNetwork'    => array(
            'className'     => 'SocialNetwork',
            'foreignKey'    => 'anuncio_id',
            'dependent'     => true
        ),
        'UserPlan'    => array(
            'className'     => 'UserPlan',
            'foreignKey'    => 'advertisement_id',
            'dependent'     => false
        )
    );

    public $belongsTo = array(
        'Plan'    => array(
            'className'     => 'Plan',
            'foreignKey'    => 'plano_id',
            'dependent'     => false
        )
    );

    public function beforeSave($options = array())
    {
        if(!empty($this->data[$this->name]['logo']))
        {
            if ( empty($this->data[$this->name]['logo']["name"]) )
                return $this->data[$this->name]['logo'] = null;

            $this->data[$this->name]['logo'] = $this->upload($this->data[$this->name]['logo'], "uploads/anuncio/logo/" . $this->id);
        }

        if(!empty($this->data[$this->name]['foto_capa']))
        {
            if ( empty($this->data[$this->name]['foto_capa']["name"]) )
                return $this->data[$this->name]['foto_capa'] = null;

            $this->data[$this->name]['foto_capa'] = $this->upload($this->data[$this->name]['foto_capa'], "uploads/anuncio/foto_capa/" . $this->id);
        }
    }

    public function upload($file = array(), $relative_dir = 'img')
    {
        $dir = WWW_ROOT.$relative_dir.DS;

        if(($file['error']!=0) and ($file['size']==0)) {
            throw new NotImplementedException('Alguma coisa deu errado, o upload retornou erro '.$file['error'].' e tamanho '.$file['size']);
        }

        $this->check_dir($dir);
        $file = $this->check_name($file, $dir);
        $this->move_files($file, $dir);

        return $file['name'];
    }

    public function check_dir($dir)
    {
        App::uses('Folder', 'Utility');
        $folder = new Folder();
        if (!is_dir($dir)){
            $folder->create($dir);
        }
    }

    public function check_name($image, $dir)
    {
        $image_info = pathinfo($dir.$image['name']);
        $image_name = $this->format_name($image_info['filename']).'.'.$image_info['extension'];
        $account = 2;
        while (file_exists($dir.$image_name)) {
            $image_name  = $this->format_name($image_info['filename']).'_'.$account;
            $image_name .= '.'.$image_info['extension'];
            $account++;
        }
        $image['name'] = $image_name;
        return $image;
    }

    public function format_name($image_name)
    {
        $image_name = strtolower(Inflector::slug($image_name,'_'));
        return $image_name;
    }

    public function move_files($file, $dir)
    {
        App::uses('File', 'Utility');
        $data = new File($file['tmp_name']);
        $data->copy($dir.$file['name']);
        $data->close();
    }

    public function isOwnedBy($object, $user)
    {
        return $this->field('id', array('id' => $object, 'cliente_id' => $user)) !== false;
    }

    public function getLatAndLongByAddress($address = null)
    {
        if ( ! $address ) return false;

        $endereco = str_replace(' ', '+', $address['endereco']) . '+' . $address['numero'] . '+' . str_replace(' ', '+', $address['bairro']);
        $geocode  = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $endereco . '&sensor=false&=key=AIzaBcDeFgHiJkLmNoPqRsTuVwXyZ');
        $output   = json_decode($geocode);

        if ( $output->status != 'OK' ) return false;

        $lat = $output->results[0]->geometry->location->lat;
        $long = $output->results[0]->geometry->location->lng;
        $lat = str_replace(',', '.', $lat);
        $long = str_replace(',', '.', $long);

        return ['lat' => $lat, 'long' => $long];

    }

    public function getLatAndLongByZipCode($zipcode = null)
    {
        if ( ! $zipcode ) return false;

        $zipcode = str_replace('.', '', $zipcode); // Format ZipCode Expected = 38400-110
        $geocode = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=$zipcode&AIzaBcDeFgHiJkLmNoPqRsTuVwXyZ&callback=initialize"); // sqD_E3OvyqTkW86HJ5UfsYFP
        $output  = json_decode($geocode);

        if ( $output->status != 'OK' )
            return false;

        $lat    = $output->results[0]->geometry->location->lat;
        $long   = $output->results[0]->geometry->location->lng;
        $lat    = str_replace(',', '.', $lat);
        $long   = str_replace(',', '.', $long);

        $result =
        [
            'lat'   => $lat
           ,'long'  => $long
        ];

        return $result;
    }

    public function registerReport($query)
    {
        $Report     = ClassRegistry::init('Report');
        $Service    = ClassRegistry::init('Service');
        $Product    = ClassRegistry::init('Product');

        $ip_address = CakeRequest::clientIp();
        $term       = Router::getRequest();
        $term       = $term->query['termo'];
        $data       = array();

        $i = 0;
        $j = 0;
        $k = 0;
        foreach ($query as $key => $val)
        {
            if ( !empty($val['Advertisement']['id']) )
            {
                $find_service = $Service->find('all', ['conditions' => ['AND' => ['Service.anuncio_id' => $val['Advertisement']['id'], ['Service.nome LIKE'  => "%$term%"]]]]);


                $conditions['AND'] =
                    [
                        'Product.anuncio_id' => $val['Advertisement']['id']
                    ];

                $conditions['OR'] =
                    [
                        ['Product.nome LIKE'            => "%$term%"],
                        ['Product.nome_popular LIKE'    => "%$term%"]
                    ];

                $find_product = $Product->find('all', ['conditions' => $conditions]);

                $j = $i;

                $data[$i]['Report']['ip_address']                           = $ip_address;
                $data[$i]['Report']['advertisement_id'] 				    = $val['Advertisement']['id'];
                $data[$i]['Report']['advertisement_view'] 			        = 1;

                if ( $find_service )
                {
                    foreach ( $find_service as $s_key => $service_item )
                    {
                        $data[$j]['Report']['ip_address']                   = $ip_address;
                        $data[$j]['Report']['advertisement_id'] 			= $val['Advertisement']['id'];
                        $data[$j]['Report']['advertisement_view'] 		    = 1;
                        $data[$j]['Report']['service_view']                 = 1;
                        $data[$j]['Report']['service_view_word']            = $service_item['Service']['nome'];
                        $j++;
                    }
                }

                if ( $find_product )
                {
                    foreach ( $find_product as $p_key => $product_item )
                    {
                        $data[$j]['Report']['ip_address']                   = $ip_address;
                        $data[$j]['Report']['advertisement_id'] 			= $val['Advertisement']['id'];
                        $data[$j]['Report']['advertisement_view'] 		    = 1;
                        $data[$j]['Report']['product_view']                 = 1;
                        $data[$j]['Report']['product_view_word']            = (!empty($product_item['Product']['nome']) ? $product_item['Product']['nome'] : $product_item['Product']['nome_popular']);
                        $j++;
                    }
                }
            }

            ( $j > $i ? $i = $j : $i++);

        }

        if ( $data )
        {
            $Report->create();
            if ($Report->saveMany($data))
                $result =json_encode(['status' => true, 'msg' => 'Dados salvos com sucesso!']);
        }

        return $query;
    }
}