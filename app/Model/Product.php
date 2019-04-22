<?php

App::uses('AppModel', 'Model');

class Product extends AppModel
{
    public $useTable    = 'produtos';

    public function check_limit_plan( $data_advertisement = array() )
    {
        if ( $data_advertisement['UserPlan']['plan_id'] == 8 && count($data_advertisement['Product']) >= 6 ) // Grátis = até 6 produtos
            return true;

        if ( $data_advertisement['UserPlan']['plan_id'] == 9 && count($data_advertisement['Product']) >= 10 ) // Prata = até 10 produtos
            return true;

        return false;
    }

}