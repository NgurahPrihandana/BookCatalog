<?php 

class Auth extends Controller {

    public function index()
    {
        if ( !isset($_POST['login']) ) {
            $this->view('Auth/templates/header');
            $this->view('Auth/index');
            $this->view('Auth/templates/footer');
        } else {
            if($this->model('Auth_model')->login($_POST) > 0)    {
                var_dump('login success');die;
            }
        }
    }

    public function register()
    {
        if ( !isset($_POST['register']) ) {
            $this->view('Auth/templates/header');
            $this->view('Auth/register');
            $this->view('Auth/templates/footer');
        } else {
            if($this->model('Auth_model')->register($_POST) > 0)    {
                header('Location: ' . BASEURL . '/auth/index');
            }
        }
    }
}