<?php

class Consult extends AppModel {
    public $belongsTo   = array('ConsultCategory','User');
    //public $belongsTo      = array('User');
}