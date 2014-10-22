<?php

class Login {

    public $login;
    public $pass;
    public $table = 'users';//'general_para';

    function __construct($login, $pass) {
        $this->login = $this->validate($login);
        $this->pass = $this->validate($pass);
        
    }
    
    function validate($value){
        return strip_tags(trim($value));
    }
    
    function logining(){
        $sql = 'SELECT * FROM ' . $this->table .
                ' WHERE username = "' . $this->login .
                '" AND password = "' . $this->pass .
                '" AND isdeleted = 0' .
                ' LIMIT 1';
        
        
        if($result = Connection::$mysqli->query($sql)){
            return $result->num_rows === 1 ? new User($result) : false;
        }
        return false;   
    }
}