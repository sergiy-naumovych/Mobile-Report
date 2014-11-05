<?php
class Main implements ControllerInterface {
    static public $user;
    static public $library;

    function __construct($library = array()) {
        //echo 'index->construct<br />';
        self::$library = $library;
    }

    function index(){

        //echo 'index->index<br />';
        if(isset($_POST['login']) && isset($_POST['password'])){
            $this->logining($_POST['login'], $_POST['password']);
        } elseif(isset($_SESSION['user'])) {
            if(!Connection::connect()){
                $this->showLayout();
            } else {
                Main::$user = unserialize($_SESSION['user']);
                $this->logining(Main::$user->login, Main::$user->password);
                // MainPage::init();
            }
        } else {
            $this->showLayout();
        }
    }

    function logining($login, $password){
        //echo $login . ' ' . $password;
        if(!Connection::connect()){
            $this->showLayout();
        } else {
            $logining = new Login($login, $password);

            if(Main::$user = $logining->logining()){
                MainPage::init();
                $_SESSION['user'] = serialize(Main::$user);
            } else {
                $this->showLayout();
            }
        }
    }

    function showLayout(){
        include_once self::$library;
        include_once 'views/login.php';
    }

    function logout(){
        session_destroy();
        header('Location: http://' . $_SERVER['SERVER_NAME'] . URL);
        exit;
    }

    public function __destruct() {

    }

}