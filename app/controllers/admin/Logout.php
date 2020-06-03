<?php 

class Logout extends Controller {

    public function index() {
        unset($_SESSION['petugas']);
        session_destroy();
        header('Location: '.BASE_URL.'admin/');
    }
}