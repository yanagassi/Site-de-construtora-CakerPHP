<?php

App::uses('AppModel', 'Model');

class Service extends AppModel
{
    public $useTable    = 'servicos';

    public function check_limit_plan( $data_advertisement = array() )
    {
        if ( $data_advertisement['UserPlan']['plan_id'] == 8 && count($data_advertisement['Service']) >= 6 ) // Grátis = até 6 produtos
            return true;

        return false;
    }

}