<?php 

class Admin extends Controller {
    // index function
    public function index() {
        // data
        $data['index'] = 'active';
        // view
        
        $this->view('Admin/templates/header');
        $this->view('Admin/templates/sidebar',$data);
        $this->view('Admin/index');
        $this->view('Admin/templates/footer');
    }
}


?>