<?php

class User implements ActiveRecordInterface{

    public $id = 0;
    
    public $company;
    
    public $db_username;
    
    public $db_password;
    
    public $login;
    
    public $password;
    
    public $ip;
    
    public $db_type; //mysql, pgsql etc.
    
    public $logo_path;
    
    public $isdeleted;
    
    public $type; //admin
    
    public $direct_connection;
    
    public $creator;
    
    function __construct(mysqli_result $result) {
        if($result){
           if($user = $result->fetch_assoc()){
               $this->id = $user['id'];
               $this->company = $user['comp_name'];
               $this->db_username = $user['db_username'];
               $this->db_password = $user['db_pass'];
               $this->login = $user['username'];
               $this->password = $user['password'];
               $this->ip = $user['ip_adress'];
               $this->db_type = $user['db_type'];
               $this->logo_path = $user['logo_path'];
               $this->isdeleted = $user['isdeleted'];
               $this->type = $user['type'];
               $this->direct_connection = $user['direct_connection'];
               $this->creator = $user['creator'];
            }
            $result->free();
        }
    }
    
    public function update() {
        
    }    
}