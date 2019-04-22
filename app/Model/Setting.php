<?php

App::uses('AppModel', 'Model');

class Setting extends AppModel
{
    public $useTable = 'settings'; // This model uses a database table 'exmp'
    public $recursive = -1;
    public $belongsTo = array
    (
        'User' =>
        [
            'className'     => 'User',
            'foreignKey'    => 'user_id',
            'dependent'     => false
        ]

    );

    public function isOwnedBy($user)
    {
        return $this->field('id', ['user_id' => $user]) !== false;
    }
}