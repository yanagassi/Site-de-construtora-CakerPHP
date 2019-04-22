<?php
App::uses('AppModel', 'Model');
class Post extends AppModel
{
    public $validate = array
    (
        'title' => array(
            'rule' => 'notBlank',
            'required' => true
        ),
        'body' => array(
            'rule' => 'notBlank',
            'required' => true
        )
    );

    public function isOwnedBy($post, $user)
    {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }
}