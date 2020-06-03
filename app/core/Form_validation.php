<?php 

class Form_validation {

    public static function validate($field, $target, $rules) {
        $message = $target.' Harus';
        $collect_message = '';
        $rules = explode('|', $rules);
        if ( in_array('required', $rules) ) {
            if ( strlen($field) === 0 || $field === 0 ) {
                $collect_message .= 'diisi, ';
            }
        }
        if ( in_array('min_0', $rules) ) {
            if ( intval($field) < 0 ) {
                $collect_message .= 'tidak boleh Negatif, ';
            }
        }
        if ( in_array('min_length_6', $rules) ) {
            if ( strlen($field) < 6 ) {
                $collect_message .= 'minimal Input 6 Karakter, ';
            }
        }
        if ( in_array('no_space', $rules) ) {
            if ( preg_match('/\s/',$field) ) {
                $collect_message .= 'tidak boleh mengandung karakter spasi, ';
            }
        }
        $collect_message = rtrim($collect_message, ', ');
        
        if ( strlen($collect_message) !== 0 ) {
            return $message .' '. $collect_message;
        } else {
            return true;
        }
    }

    public static function validatePassword($field_password, $field_password2) {
        $message = "$field_password tidak sesuai dengan $field_password2";
        if ( $field_password !== $field_password2) {
            return $message;
        } else {
            return true;
        }

    }

}