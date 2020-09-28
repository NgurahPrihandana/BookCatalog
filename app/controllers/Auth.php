<?php 

class Auth extends Controller {

    public function index()
    {
        if ( isset($_COOKIE['id']) && isset($_COOKIE['verificator']) && isset($_COOKIE['role']) ) {
            if($this->model('Auth_model')->loginByCookie($_COOKIE) > 0)    {

            }
        } else if(!isset($_POST['login']) || !isset($_COOKIE['id']) && isset($_COOKIE['verificator']) && isset($_COOKIE['role'])) {
            $this->view('Auth/templates/header');
            $this->view('Auth/index');
            $this->view('Auth/templates/footer');
        } else if(isset($_POST['login']) || !isset($_COOKIE['id']) && isset($_COOKIE['verificator']) && isset($_COOKIE['role'])){
            if($this->model('Auth_model')->login($_POST) > 0)    {
                
            }
        } else {
            var_dump($_COOKIE);die;
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

    public function logout() {
        session_start();
        $_SESSION = [];
        session_unset();
        session_destroy();

        setcookie('id','',time()-3600);
        setcookie('key','',time()-3600);
    }
}