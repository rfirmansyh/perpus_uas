<?php 

class Home extends Controller {
    private $title = 'Home';

    public function index() {
        $data['title'] = $this->title;
        $this->view('frontpage/templates/header', $data);
        $this->view('frontpage/index', $data);
        $this->view('frontpage/templates/footer');
    }
    public function about() {
        
    }
}