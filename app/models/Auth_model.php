<?php 

class Auth_model {
    private $tb_author = "tb_author";
    private $tb_admin = "tb_admin";
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUserBy($verificator,$value,$role) {
        if(isset($verificator) && isset($value) && isset($role) && $role==AUTHOR) {
            $query = "SELECT * FROM $this->tb_author WHERE $verificator = :$verificator";
        } elseif(isset($verificator) && isset($value) && isset($role) && $role==ADMIN){
            $query = "SELECT * FROM $this->tb_admin WHERE $verificator = :$verificator";
        } else {
            var_dump('No role is given');die;
        }
        $this->db->query($query);
        $this->db->bind($verificator, $value);
        return $this->db->single();
    }

    public function uuid() {
        $permitted_chars = '0123456789bcdefghijklmnopqrstuvwxyz';
        $id_user = substr(str_shuffle($permitted_chars), 0, 5);
        return $id_user;
    }

    public function register($data) {
        $fullname = htmlspecialchars($data['fullname']);
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            Flasher::setToast('Error','Invalid Email','error');
            header('Location: ' . BASEURL . '/auth/register');
        } else {
            $email = $data['email'];
        }
        $username = htmlspecialchars($data['username']);
        $password = htmlspecialchars($data['password']);
        $conf_password = htmlspecialchars($data['conf-password']);

        if(isset($fullname) && $fullname !== '') {
            if(isset($username) && $username !== '') {
                if(isset($email) && $email !== '') {
                    if(isset($password) && $password !== '') {
                        if($this->getUserBy('username',$username,AUTHOR)) {
                            Flasher::setToast('Error','Username is already being used','error');
                            header('Location: ' . BASEURL . '/auth/register');
                        } elseif($this->getUserBy('username',$username,ADMIN)) {
                            Flasher::setToast('Error','Username is already being used','error');
                            header('Location: ' . BASEURL . '/auth/register');
                        }elseif($this->getUserBy('email',$email,AUTHOR)) {
                            Flasher::setToast('Error','Email is already being used','error');
                            header('Location: ' . BASEURL . '/auth/register');
                        }else {
                            if($password !== $conf_password) {
                                Flasher::setToast('Error','Password and confirm password did not match','error');
                                header('Location: ' . BASEURL . '/auth/register');
                            } else {
                                $register_query = "INSERT INTO `$this->tb_author`(fullname,username,email,password) VALUES(:fullname,:username,:email,:password)";
                                $this->db->query($register_query);
                                // bind
                                $this->db->bind('fullname',$fullname);
                                $this->db->bind('username',$username);
                                $this->db->bind('email',$email);
                                $this->db->bind('password',password_hash($password,PASSWORD_DEFAULT));
                                // execute query
                                if(!($this->db->execute())) {
                                    Flasher::setToast('Error','User is not created','error');
                                    header('Location: ' . BASEURL . '/auth/register');
                                }
                                Flasher::setToast('User Created','Hello ' . $username,'success');
                                return $this->db->rowCount();
                            }
                        }
                    } else {
                        Flasher::setToast('Warning','Password is not being set','warning');
                        header('Location: ' . BASEURL . '/auth/register');
                    }
                } else {
                    Flasher::setToast('Warning','Email is not being set','warning');
                    header('Location: ' . BASEURL . '/auth/register');
                }
            } else {
                Flasher::setToast('Warning','Username is not being set','warning');
                header('Location: ' . BASEURL . '/auth/register');
            }
        } else {
            Flasher::setToast('Warning','Fullname is not being set','warning');
            header('Location: ' . BASEURL . '/auth/register');
        }
    }

    public function loginByCookie($data) {
        if(isset($data['id']) && isset($data['verificator']) && isset($data['role'])) {
            $cookie_id = $data['id'];
            $cookie_verificator = $data['verificator'];
            $cookie_role = $data['role'];

            // var_dump($cookie_id);die;
            // var_dump($cookie_verificator);die;
            // var_dump($cookie_role);die;

            if($cookie_role == AUTHOR) {
                $remember_query = "SELECT * FROM $this->tb_author WHERE id_author=:id";
                $this->db->query($remember_query);
                $this->db->bind('id',$cookie_id);
                $this->db->execute();
                if($this->db->rowCount() > 0) {
                    $remember_user = $this->db->single();
                    if(hash('sha256',$remember_user['username']) === $cookie_verificator) {
                        $_SESSION['id_user'] = $remember_user['id_author'];
                        $_SESSION['status'] = 'login';
                        $_SESSION['role'] = AUTHOR;
                        Flasher::setFlash("Login Successful","Welcome " . $remember_user['username'],"success");
                        header('Location: '.BASEURL.'/Author/index');
                    }
                } else {
                    var_dump('cookie data is incorrect');die;
                }
            } else {
                $remember_query = "SELECT * FROM $this->tb_admin WHERE id_admin=:id";
                // var_dump($remember_query);die;
                $this->db->query($remember_query);
                $this->db->bind('id',$cookie_id);
                $this->db->execute();
                if($this->db->rowCount() > 0) {
                    $remember_user = $this->db->single();
                    // var_dump($remember_user);die;
                    if(hash('sha256',$remember_user['username']) === $cookie_verificator) {
                        // var_dump('benar');die;
                        $_SESSION['id_user'] = $remember_user['id_author'];
                        $_SESSION['status'] = 'login';
                        $_SESSION['role'] = ADMIN;
                        Flasher::setFlash("Login Successful","Welcome " . $remember_user['username'],"success");
                        header('Location: '.BASEURL.'/Admin/index');
                    } else {
                        var_dump('wrong');die;
                    }
                } else {
                    var_dump('cookie data is incorrect');die;
                }
            }
        }
    }

    public function login($data) {
        

        $verificator = htmlspecialchars($data['verificator']);
        $password = htmlspecialchars($data['password']);

        if(isset($verificator) && $verificator !== '') {
            if(isset($password) && $password !== 0) {
                // if($datauser = $this->getUserBy('username',$verificator,AUTHOR) || $datauser = $this->getUserBy('email',$verificator,AUTHOR)) {
                //     $password_user = $datauser['password'];
                //     if (password_verify($password,$password_user)) {
                //         session_start();
                //         $_SESSION['id_user'] = $datauser['id_user'];
                //         $_SESSION['status'] = 'login';
                //         header('Location: '.BASEURL.'/admin');
                //     }
                // }
                // if($datauser = $this->getUserBy('username',$verificator,ADMIN)) {
                //     $password_user = $datauser['password'];
                //     if (password_verify($password,$password_user)) {
                //         session_start();
                //         $_SESSION['id_user'] = $datauser['id_user'];
                //         $_SESSION['status'] = 'login';
                //         header('Location: '.BASEURL.'/admin');
                //     }
                // }
                
                // if users doesn't have cookie yet
                $current_user_query = "SELECT id_author as id_user,username,password,email FROM $this->tb_author WHERE username=:verificator OR email=:verificator UNION SELECT id_admin,username,password,fullname FROM $this->tb_admin WHERE username=:verificator";
                $this->db->query($current_user_query);
                $this->db->bind('verificator',$verificator);
                $this->db->execute();
                if($this->db->rowCount() > 0) {
                    $current_user = $this->db->single();
                    // if the user has an email and it is a correct email, it MUST be an author
                    if(isset($current_user['email']) && filter_var($current_user['email'], FILTER_VALIDATE_EMAIL)) {
                        $password_user = $current_user['password'];
                        if (password_verify($password,$password_user)) {
                            $_SESSION['id_user'] = $current_user['id_user'];
                            $_SESSION['status'] = 'login';
                            $_SESSION['role'] = AUTHOR;
                            Flasher::setFlash("Login Successful","Welcome " . $current_user['username'],"success");
                            if(isset($data['remember'])) {
                                // buat cookie
                                setcookie('id', $current_user['id_user'], time()+60 * 5,'/');
                                setcookie('verificator',hash('sha256',$verificator), time()+60 * 5,'/');
                                setcookie('role',AUTHOR,time()+60 * 5,'/');
                            }
                            header('Location: '.BASEURL.'/Author/index');
                        }
                    } else {
                        $password_user = $current_user['password'];
                        if (password_verify($password,$password_user)) {
                            $_SESSION['id_user'] = $current_user['id_user'];
                            $_SESSION['status'] = 'login';
                            $_SESSION['role'] = ADMIN;
                            Flasher::setFlash("Login Successful","Welcome " . $current_user['username'],"success");
                            if(isset($data['remember'])) {
                                var_dump('HEllo');
                                // buat cookie
                                setcookie('id', $current_user['id_user'], time()+60 * 5,'/');
                                setcookie('verificator',hash('sha256',$verificator), time()+60 * 5,'/');
                                setcookie('role',ADMIN,time()+60 * 5,'/');
                            }
                            header('Location: '.BASEURL.'/Admin/index');
                        } else {
                            var_dump('wrong password');
                        }
                    }
                } else {
                    Flasher::setToast('Error','There is no user with username or email = ' . $verificator,'error');
                    header('Location: ' . BASEURL . '/auth/index');
                }
            } else {
                Flasher::setToast('Warning','Password is not being set','warning');
                header('Location: ' . BASEURL . '/auth/index');
            }
        } else {
            Flasher::setToast('Warning','Verificator is not being set','warning');
            header('Location: ' . BASEURL . '/auth/index');
        }
    }
}