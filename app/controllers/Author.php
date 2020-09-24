<?php 

class Author extends Controller {
    // index function
    public function index() {
        // view
        $this->view('Author/templates/header');
        $this->view('Author/index');
        $this->view('Author/templates/footer');
    }
}


?>