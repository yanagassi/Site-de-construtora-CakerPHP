<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class CustomHelper extends Helper {

    public $helpers = array();

    /**
     * Some validateDate description.
     *
     * @param string $date The model to use.
     * @param string $format
     * @return bool
     */

    public function formatDate($date = null) {
        if (is_null($date)) {
            return false;
        } else {
            $date = new DateTime($date);
            return $date->format('d/m/Y');
        }
    }

    /**
     * Some validateDate description.
     *
     * @param string $date The model to use.
     * @param string $format
     * @return bool
     */

    public function formatDateWithHours($date = null) {
        if (is_null($date)) {
            return false;
        } else {
            $date = new DateTime($date);
            return $date->format('d/m/Y H:i:s');
        }
    }

    public function dateComparison($date) {

        if ( empty($date) )
            return false;

        $date = date_create($date);
        $date = date_format($date, 'Y-m-d H:i:s');

        $current_date = date_create("TODAY");
        $current_date = date_format($current_date, 'Y-m-d H:i:s');

        if ( strtotime($date) < strtotime($current_date) ) {
            return false;
        } else {
            return true;
        }

    }

    public function getUserAge( $birthday = string )
    {
        // Verifica se uma data foi informada
        if (empty($birthday)) {
            return false;
        }

        $birthday = new DateTime($birthday);
        $data = $birthday->format("d/m/Y");

        // Separa em dia, mês e ano
        list($dia, $mes, $ano) = explode('/', $data);

        // Descobre que dia é hoje e retorna a unix timestamp
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        // Descobre a unix timestamp da data de nascimento do fulano
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

        // Depois apenas fazemos o cálculo já citado :)
        $age = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25); // 365.25 => 1/4 de dia que fica sobrando do ano bisexto

        return $age;
    }

    public function formatTextToParagraphs($text)
    {
        $text = str_replace("\r\n","\n",$text);

        $paragraphs = preg_split("/[\n]{2,}/",$text);
        foreach ($paragraphs as $key => $p) {
            $paragraphs[$key] = "<p>".str_replace("\n","<br />",$paragraphs[$key])."</p>";
        }

        $text = implode("", $paragraphs);

        return $text;
    }

    public function limitText($texto, $limite = 100){
        $contador = strlen($texto);
        if ( $contador >= $limite ) {
            $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
            return $texto;
        }
        else{
            return $texto;
        }
    }

    public function numberFormatToBR($num = null)
    {
        return number_format($num, 2, ',', '.');
    }

    public function mask_cpf_cnpj($cnpj)
    {
        if (! $cnpj) return '';

        if (strlen($cnpj) == 14)
        {

            return substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);

        }

        if (strlen($cnpj) == 11) {

            return substr($cnpj, 0, 3) . '.' . substr($cnpj, 3, 3) . '.' . substr($cnpj, 6, 3) . '-' . substr($cnpj, 9);

        }

        //return $cnpj;

    }

    function phoneMask($phone = null)
    {
        if ($phone == null) return '';

        if (strlen($phone) == 10)
            return '(' . substr($phone, 0, 2) . ') ' . substr($phone, 2, 4) . '-' . substr($phone, 6);

        if (strlen($phone) == 11)
            return '(' . substr($phone, 0, 2) . ') ' . substr($phone, 2, 5) . '-' . substr($phone, 7);

        return $phone;
    }

    function cepMask($cep = null)
    {
        if ($cep == null) return '';

        if (strlen($cep) == 8)
            return substr($cep, 0, 2) . '.' . substr($cep, 2, 3) . '-' . substr($cep, 5);

        return $cep;
    }

    public function clearAllToNumber($string)
    {
        return preg_replace('/[^0-9]/', '', $string);
    }
}