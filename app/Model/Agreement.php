<?php

class Agreement extends AppModel {
    public $belongsTo   = array('TypeAgreement');

    public function beforeSave($options = array()) {
        if(!empty($this->data['Agreement']['file_name']))
        {
            if ( empty($this->data['Agreement']['file_name']["name"]) )
                return $this->data['Agreement']['file_name'] = null;

            $user         = ClassRegistry::init('User');
            $result       = $user->findById( AuthComponent::user('id') );

            if ( !empty($result) && empty($result["User"]['full_path_files']) ) {
                $dir_customer = md5(AuthComponent::user('id'));
                $user->id = AuthComponent::user('id');
                $user->saveField('full_path_files',$dir_customer);
            }else{
                $dir_customer = $result["User"]['full_path_files'];
            }

            $this->data['Agreement']['file_name'] = $this->upload($this->data['Agreement']['file_name'], "uploads/customers/" . $dir_customer);

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
        $image_info = pathinfo($dir.$image['name']); // * Verifica se o nome do arquivo já existe, se existir adiciona um numero ao nome e verifica novamente
        $image_name = $this->format_name($image_info['filename']).'.'.$image_info['extension'];
        $account = 2;
        while (file_exists($dir.$image_name)) {
            $image_name  = $this->format_name($image_info['filename']).'-'.$account;
            $image_name .= '.'.$image_info['extension'];
            $account++;
        }
        $image['name'] = $image_name;
        return $image;
    }

    public function format_name($image_name)
    {
        $str = preg_replace("/[^A-Za-z0-9?!\s]/","",$image_name);
        $image_name = strtolower(Inflector::slug($str,'-')); // Trata o nome removendo espaços, acentos e caracteres em maiúsculo.
        return $image_name .'-'. time();
    }

    public function move_files($file, $dir)
    {
        App::uses('File', 'Utility');
        $data = new File($file['tmp_name']);
        $data->copy($dir.$file['name']);
        $data->close();
    }
}