<?php

//define('URL', '/service');
define('URL', '/mobilerpt');
//display_errors(0);
header('Content-Type: text/html; charset=utf-8');

include_once './controllers/main.php';


function __autoload($class_name) {
    if(file_exists('./libs/' . $class_name . '.php')){
        include_once './libs/' . $class_name . '.php';
    } elseif(file_exists('./controllers/' . $class_name . '.php')){
        include_once './controllers/' . $class_name . '.php';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
    //ajax query
    Ajax::init();
} else {
    session_start();
    
    $lang = setLang();
    
    $controller = new Main($lang);
    $controller->index();
    
    
    //розбиваємо адресу запиту
    if (isset($_GET['url'])) {
        try {
            $url = explode('/', $_GET['url']);
            //var_dump($url);
            //підключаємо необхіний файл контроллера
            //include_once 'controllers/' . $url[0] . '.php';
            //створюємо об'єкт контроллера


            if (class_exists($url[0])) {
                $controller = new $url[0];
            } else {
                throw new Exception("class does not exists");
            }
            //визначаємо метод
            if (isset($url[1]) && method_exists($controller, $url[1])) {
                //запускаємо метод контролера на виконання
                if (method_exists($controller,$url[1])) {
                    $controller->{$url[1]}();
                } else {
                    throw new Exception("method does not exists");
                }
            }
        } catch (Exception $e) {
            $controller = new Main($lang);
            $controller->index();
        }
    } else {
        //require 'controllers/index.php';
        $controller = new Main($lang);
        $controller->index();
    }
     
     
}

function setLang(){
    $lang = 'lang/eng/library.php';
    if (!isset($_COOKIE['lang'])) {
        setcookie("lang", "english");
    } else if (isset($_GET['l'])) {
        switch ($_GET['l']) {
            case "tur":
                setcookie("lang", "turkish");
                $lang = 'lang/tur/library.php';
                break;
            default :
                setcookie("lang", "english");
                break;
        }
    } else {
        switch ($_COOKIE['lang']) {
            case "turkish":
                $lang = 'lang/tur/library.php';
                break;
            default :
                break;
        }
    }
    
    return $lang;

    
}