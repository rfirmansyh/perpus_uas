<?php 

class Flasher {

    public static function setFlash($field, $message, $type) {
        $_SESSION['flash'] = [
            'field' => $field,
            'message' => $message,
            'type' => $type
        ];
    }

    public static function flash() {
        if ( isset($_SESSION['flash']) ) {
            echo '<div class="alert alert-'.$_SESSION['flash']['type'].' alert-dismissible fade show" role="alert">
                        <strong>'.$_SESSION['flash']['field'].'</strong> 
                        '.$_SESSION['flash']['message'].'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            unset($_SESSION['flash']);
        }
    }

}