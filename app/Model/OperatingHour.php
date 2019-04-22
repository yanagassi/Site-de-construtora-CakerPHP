<?php

App::uses('AppModel', 'Model');

class OperatingHour extends AppModel
{
    public $useTable    = 'expedientes';

    public function beforeSave($options = array())
    {
        if (isset($this->data[$this->alias]['dia_semana']) && $this->data[$this->alias]['dia_semana'] == 'Segunda-Feira' )
            $this->data[$this->alias]['order'] = 1;

        if (isset($this->data[$this->alias]['dia_semana']) && $this->data[$this->alias]['dia_semana'] == 'Terça-Feira')
            $this->data[$this->alias]['order'] = 2;

        if (isset($this->data[$this->alias]['dia_semana']) && $this->data[$this->alias]['dia_semana'] == 'Quarta-Feira')
            $this->data[$this->alias]['order'] = 3;

        if (isset($this->data[$this->alias]['dia_semana']) && $this->data[$this->alias]['dia_semana'] == 'Quinta-Feira')
            $this->data[$this->alias]['order'] = 4;

        if (isset($this->data[$this->alias]['dia_semana']) && $this->data[$this->alias]['dia_semana'] == 'Sexta-Feira')
            $this->data[$this->alias]['order'] = 5;

        if (isset($this->data[$this->alias]['dia_semana']) && $this->data[$this->alias]['dia_semana'] == 'Sábado')
            $this->data[$this->alias]['order'] = 6;

        if (isset($this->data[$this->alias]['dia_semana']) && $this->data[$this->alias]['dia_semana'] == 'Domingo')
            $this->data[$this->alias]['order'] = 7;

        if (isset($this->data[$this->alias]['dia_semana']) && $this->data[$this->alias]['dia_semana'] == 'Feriados')
            $this->data[$this->alias]['order'] = 8;

        if (isset($this->data[$this->alias]['dia_semana']) && $this->data[$this->alias]['dia_semana'] == 'Almoço')
            $this->data[$this->alias]['order'] = 9;

        return true;
    }

}