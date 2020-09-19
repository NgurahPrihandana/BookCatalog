<?php

class Database {

    // Masukkan constant yang berisi data database ke dalam variabel
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    // database handler
    private $dbh;
    // variabel untuk menyimpan statement
    private $stmt;

    // Konstruktor untuk menyimpan koneksi ke database menggunakan PDO
    public function __construct()
    {
        // Data source name, hanya digunakan di function ini saja
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        // Option untuk optimasi koneksi ke database [dalam bentuk array]
        $option = [
            PDO::ATTR_PERSISTENT=>true,
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn,$this->user,$this->pass,$option);
        } catch(PDOException $e) {
            die ($e->getMessage());
        }


    }

    public function query($query)
    {
        // prepare querynya kedalam database handler kemudian masukkan ke dalam statement
        $this->stmt = $this->dbh->prepare($query);
    }

    // Binding untuk menghindari mysql injection
    public function bind($param,$value,$type = null)
    {
        // type awalnya pasti null sesuai default
        if(is_null($type)){
            // agar casenya jalan maka switchnya true
            switch(true) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                break;

                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                break;

                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                break;

                default :
                    $type= PDO::PARAM_STR;
            }
        }
        // Binding dengan function bindValue
        $this->stmt->bindValue($param,$value,$type);
    }
    // Untuk melakukan execute dari query yang sudah di prepare
    public function execute()
    {
        $this->stmt->execute();
    }
    // Untuk melakukan fetch semua data
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Untuk melakukan fetch hanya satu data
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Untuk menghitung banyaknya row yang teraffected
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }





}
