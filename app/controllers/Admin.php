<?php 

class Admin extends Controller {
    // index function
    public function index() {
        // view
        $this->view('Admin/templates/header');
        $this->view('Admin/index');
        $this->view('Admin/templates/footer');
    }
}


?>