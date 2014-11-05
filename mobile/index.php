<?php
//
//if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['type'])){
//    include_once 'settings.php';
//    include_once 'Database.php';
//   //starting or resuming session
//    session_start();
//    
//    //connection to the database
//    $mysqli = new DatabaseClass();
//    if($mysqli){
//        
//        switch($_POST['type']){
//           /*
//            case 'get-graph-types':
//                $_SESSION['company']['graph-types'] 
//                    = $mysqli->selectGraphTypes($_POST['company'],
//                                                $_POST['category']);
//                echo json_encode($_SESSION['company']['graph-types']);
//                break;
//            case 'get-graph-options':
//                $_SESSION['company']['graph-options'] 
//                    = $mysqli->selectGraphOptions($_POST['graph_id']);
//                echo json_encode($_SESSION['company']['graph-options']);
//                break;
//            
//            */
//            
//           
//            
//            
//            
//            case 'login':
//                $_SESSION['company']['info'] = $mysqli->authUser($_POST['login'], $_POST['pass']);
//            
//            case '33':
//                $_SESSION['company']['graph_groups'] 
//                    = $mysqli->selectGraphGroups($_SESSION['company']['info']['id'], $_POST['gg_version']);
//            
//            case '00':
//                $_SESSION['company']['graphs'] 
//                    = $mysqli->selectGraphs($_SESSION['company']['info']['id'], $_POST['g_version']);
//            
//            case '11':
//                $_SESSION['company']['graph_options'] 
//                    = $mysqli->selectGraphOptions($_SESSION['company']['info']['id'], $_POST['go_version']);
//                
//            case '11':
//                $_SESSION['company']['graph_filter'] 
//                    = $mysqli->selectGraphFilter($_SESSION['company']['info']['id'], $_POST['gf_version']);
//                
//            case '11':
//                $_SESSION['company']['graph_filter_type'] 
//                    = $mysqli->selectGraphFilterType($_SESSION['company']['info']['id'], $_POST['gft_version']);
//                
//            case '11':
//                $_SESSION['company']['graph_filter_items'] 
//                    = $mysqli->selectGraphFilterItems($_SESSION['company']['info']['id'], $_POST['gfi_version']);
//               
//                echo json_encode($_SESSION['company']);
//        }
//
//        
//    
//        
//        
//    } else {
//        //error
//    }
//}
//



function __autoload($class_name) {
    if(file_exists('./lib/' . $class_name . '.php')){
        include_once './lib/' . $class_name . '.php';
    } elseif(file_exists('../libs/' . $class_name . '.php')){
        include_once '../libs/' . $class_name . '.php';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['type'])) {
    Ajax::init();
}