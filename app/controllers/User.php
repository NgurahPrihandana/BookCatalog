<?php 

class User extends Controller {
    public function index() {
        // place view
        $this->view('User/templates/header');
        $this->view('User/index');
        $this->view('User/templates/footer');
    }
}