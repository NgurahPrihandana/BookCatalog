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
            var_dump('Invalid Email');die;
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
                            var_dump('username is already being used');
                        } elseif($this->getUserBy('username',$username,ADMIN)) {
                            var_dump('username is already being used');
                        }elseif($this->getUserBy('email',$email,AUTHOR)) {
                            var_dump('email is already being used');
                        }else {
                            if($password !== $conf_password) {
                                var_dump('Password and confirm password did not match');
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
                                    echo 'Data is not inserted';
                                }
                                return $this->db->rowCount();
                            }
                        }
                    } else {
                        var_dump('Password is not being set');
                    }
                } else {
                    var_dump('Email is not being set');
                }
            } else {
                var_dump('Username is not being set');
            }
        } else {
            var_dump('Fullname is not being set');
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
                if(isset($_COOKIE['id']) && isset($_COOKIE['verificator']) && isset($_COOKIE['role'])) {
                    $cookie_id = $_COOKIE['id'];
                    $cookie_verificator = $_COOKIE['verificator'];
                    $cookie_role = $_COOKIE['role'];

                    if($cookie_role == AUTHOR) {
                        $remember_query = "SELECT * FROM '$this->tb_author' WHERE id_author=:id";
                        $this->db->query($remember_query);
                        $this->db->bind('id',$cookie_id);
                        $this->db->execute();
                        if($this->db->rowCount() > 0) {
                            $remember_user = $this->db->single();
                            if(hash('sha256',$cookie_verificator) == $remember_user['username']) {
                                $_SESSION['id_user'] = $remember_user['id_author'];
                                $_SESSION['status'] = 'login';
                                $_SESSION['role'] = AUTHOR;
                                header('Location: '.BASEURL.'/index');
                            }
                        } else {
                            var_dump('cookie data is incorrect');
                        }
                    } else {
                        $remember_query = "SELECT * FROM '$this->tb_admin' WHERE id_admin=:id";
                        $this->db->query($remember_query);
                        $this->db->bind('id',$cookie_id);
                        $this->db->execute();
                        if($this->db->rowCount() > 0) {
                            $remember_user = $this->db->single();
                            if(hash('sha256',$cookie_verificator) == $remember_user['username']) {
                                $_SESSION['id_user'] = $remember_user['id_author'];
                                $_SESSION['status'] = 'login';
                                $_SESSION['role'] = ADMIN;
                                header('Location: '.BASEURL.'/index');
                            }
                        }
                    }
                }
                // if users doesn't have cookie yet
                $current_user_query = "SELECT id_author,username,password,email FROM $this->tb_author WHERE username=:verificator OR email=:verificator UNION SELECT id_admin,username,password,fullname FROM $this->tb_admin WHERE username=:verificator";
                $this->db->query($current_user_query);
                $this->db->bind('verificator',$verificator);
                $this->db->execute();
                if($this->db->rowCount() > 0) {
                    $current_user = $this->db->single();
                    // if the user has an email, it MUST be an author
                    if(isset($current_user['email'])) {
                        $password_user = $current_user['password'];
                        if (password_verify($password,$password_user)) {
                            session_start();
                            $_SESSION['id_user'] = $current_user['id_author'];
                            $_SESSION['status'] = 'login';
                            $_SESSION['role'] = AUTHOR;
                            if(isset($data['remember'])) {
                                // buat cookie
                                setcookie('id', $current_user['id_author'], time()+60 * 5);
                                setcookie('verificator',hash('sha256',$current_user['verificator']), time()+60 * 5);
                                setcookie('role',AUTHOR,time()+60 * 5);
                            }
                            header('Location: '.BASEURL.'/index');
                        }
                    } else {
                        $password_user = $current_user['password'];
                        if (password_verify($password,$password_user)) {
                            session_start();
                            $_SESSION['id_user'] = $current_user['id_admin'];
                            $_SESSION['status'] = 'login';
                            $_SESSION['role'] = ADMIN;
                            if(isset($data['remember'])) {
                                // buat cookie
                                setcookie('id', $current_user['id_admin'], time()+60 * 5);
                                setcookie('verificator',hash('sha256',$current_user['verificator']), time()+60 * 5);
                                setcookie('role',ADMIN,time()+60 * 5);
                            }
                            header('Location: '.BASEURL.'/index');
                        }
                    }
                } else {
                    var_dump('user tidak tersedia');
                }
            } else {
                var_dump('password is not being set');
            }
        } else {
            var_dump('username is not being set');
        }
    }
}