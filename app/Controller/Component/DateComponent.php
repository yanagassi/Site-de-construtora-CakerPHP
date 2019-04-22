<?php

class DateComponent extends Component {

    function formatDate($date = null) {

        // Verifica se uma data foi informada
        if (empty($date) || strlen($date) < 10) {
            return false;
        }

        $get_date = explode("/", $date);
        $date_formated = $get_date[2] . "-" . $get_date[1] . "-" . $get_date[0] . " " . date('H:i:s');
        $date_created = date_create($date_formated);
        $created = date_format($date_created, "Y-m-d H:i:s");
        return $created;
    }

    function formatDateToFind($dt_start = null, $dt_end = null, $model = null, $field = 'date')
    {
        if (empty($dt_start) || empty($dt_end) || empty($model)) return false; // Verifica se datas e model foram informadas

        if(count(explode("/",$dt_start)) > 1 && count(explode("/",$dt_end)) > 1)
        {
            $dt_start = implode("-",array_reverse(explode("/",$dt_start)));
            $dt_end   = implode("-",array_reverse(explode("/",$dt_end)));

            $dt_start = $dt_start ." ". "00:00:00";
            $dt_end   = $dt_end   ." ". "23:59:59";

            return array
            (
                'and' => array
                (
                    array
                    (
                        $model.'.'.$field.' BETWEEN ? AND ?' => array($dt_start,$dt_end)
                    )
                )
            );
        }
    }

}