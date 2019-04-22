<?php

class UserPlan extends AppModel {

    public $useTable = 'user_plans';

    public $belongsTo = array
    (
        'Advertisement' =>
            [
                'className'     => 'Advertisement',
                'foreignKey'    => 'advertisement_id',
                'dependent'     => true
            ]
        ,'Plan' =>
            [
                'className'     => 'Plan',
                'foreignKey'    => 'plan_id',
                'dependent'     => true
            ]

    );

}