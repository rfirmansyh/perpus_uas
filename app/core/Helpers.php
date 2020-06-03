<?php 

class Helpers {
    public static function getIndoDate($date){
        $month = array (
            1 =>   'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        );
        $result = explode('-', $date);
        
        return $result[2] . ' ' . $month[ (int)$result[1] ] . ' ' . $result[0];
    }
}