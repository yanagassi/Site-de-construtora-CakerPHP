<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('Security', 'Utility');

class User extends AppModel
{
    public $useTable    = 'clientes';
    //public $belongsTo   = array('Group');
    //public $actsAs      = array('Acl' => array('type' => 'requester', 'enabled' => false));
    public $validate    = array
    (
//        'email' => array
//        (
//            'required' => array(
//                'rule' => 'notBlank'
//            ),
//            'unique' => array(
//                'rule' => 'isUnique',
//                'required' => 'create'
//            ),
//        ),
//        'senha' => array(
//            'required' => array(
//                'rule' => 'notBlank'
//            )
//        )
    );

    public function parentNode() {
//        if (!$this->id && empty($this->data)) {
//            return null;
//        }
//        if (isset($this->data['User']['group_id'])) {
//            $groupId = $this->data['User']['group_id'];
//        } else {
//            $groupId = $this->field('group_id');
//        }
//        if (!$groupId) {
//            return null;
//        }
//        return array('Group' => array('id' => $groupId));
    }

    public function bindNode($user) {
        //return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
    }

    public function beforeSave($options = array())
    {
        if (isset($this->data[$this->alias]['senha']))
        {
            $this->data[$this->alias]['senha'] = sha1( Configure::read('Security.salt') . $this->data[$this->alias]['senha'] ); // saving with old method cake2 => 123456 => 5ba4a3f23c63690a437acac538ca4c04cd984b4c
        }
        return true;
    }

    public function isOwnedBy($user)
    {
        return $this->field('id', array('id' => $user));
    }

}