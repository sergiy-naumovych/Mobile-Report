<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ajax
 *
 * @author SERGE
 */
final class Ajax {

    public static $result = Array('data' => '', 'error' => false);
    public static $data = '';

    public static function init() {
        if (!Connection::connect()) {
            self::$result['error'] = true;
            echo '';//json_encode(self::$result);
        } else {
            echo self::requestType();
        }
    }

    public static function checkData($data, $type='s', $days='')
    {
        switch($type){
            case 's':
                return strip_tags(trim($data));
            case 'i':
                return $data*1;
            case 'f':
                return $data*1.0;
            case 'd':
                return date_format(new DateTime($data), 'Ymd');
            case 't':
                //сьогоднішня дата
                $date = new DateTime();
                //додаємо визначену кількість днів
                $days ? $date->modify('+' . (int)$days . ' day') : '' ;
                return $date->format('Ymd');
            default:
                return $data;
        }
        
    }

    public static function requestType() {
        $res = Array();
        switch ($_POST['type']) {
            case 'logout':
                return PushNotifications::logout($_POST['uuid']);
            case 'login':
                $res['company']['info'] = self::authUser($_POST['login'], $_POST['pass'], $_POST['company'], $_POST['uuid']);

            case '33':
                $res['company']['graph_groups'] = self::selectGraphGroups($res['company']['info']['id'], $_POST['gg_version']);

            case '00':
                $res['company']['graphs'] = self::selectGraphs($res['company']['info']['id'], $_POST['g_version']);

            case '11':
                $res['company']['graph_options'] = self::selectGraphOptions($res['company']['info']['id'], $_POST['go_version']);

            case '11':
                $res['company']['graph_filter'] = self::selectGraphFilter($res['company']['info']['id'], $_POST['gf_version']);

            case '11':
                $res['company']['graph_filter_type'] = self::selectGraphFilterType($res['company']['info']['id'], $_POST['gft_version']);

            case '11':
                $res['company']['graph_filter_items'] = self::selectGraphFilterItems($res['company']['info']['id'], $_POST['gfi_version']);

            return json_encode($res['company']);
        }
    }
    
    public static function authUser($login, $pass, $company, $uuid)
    {
        $login = self::checkData($login);
        $pass  = self::checkData($pass);
        $company  = self::checkData($company, 'i');
        $uuid = self::checkData($uuid);
        
        $sql = "SELECT 
                   *
                FROM 
                    users
                WHERE
                    username = '".$login."'
                AND
                    type = 2
                AND
                    isdeleted = 0
                AND
                    password = '".$pass."'";
        //$sql .= ($company > 0) ? " AND id = '".$company."'" : '';
       
       if($result = Connection::$mysqli->query($sql)){
            if($user = $result->fetch_assoc()){
                $result->free();
                $user['notif'] = PushNotifications::createNewUser($uuid, $user['id']);
                if($user['id'] != $company){
                    self::setVersions();
                }
                return $user;
            }
        } 
        return false;             
    }
    
    public static function setVersions(){
        $_POST['gg_version'] = 0;
        $_POST['g_version'] = 0;
        $_POST['go_version'] = 0;
        $_POST['gf_version'] = 0;
        $_POST['gft_version'] = 0;
        $_POST['gfi_version'] = 0;
    }

    public static function selectGraphGroups($company, $version){
        $company = self::checkData($company, 'i');
        $version = self::checkData($version, 'i');
        
        $sql = "SELECT  gg.*, gi.name AS logo_path  
                FROM 
                    graph_group AS gg 
                LEFT JOIN 
                    graph_images AS gi 
                ON 
                    gg.image = gi.id
                WHERE
                    gg.comp_id = '".$company."'
                AND
                    gg.version > '".$version."'";
       
       if($result = Connection::$mysqli->query($sql)){
            $groups = array();
            while($group = $result->fetch_assoc()){
                $groups[] = $group;
            }
            $result->free();
       }

        return $groups ? $groups : false;   
    }
    
    public static function selectGraphs($company, $version){
        $company = self::checkData($company, 'i');
        $version = self::checkData($version, 'i');
        
        $sql = "SELECT 
                   g.*, gi.name AS logo_path
                FROM 
                    graph AS g
                LEFT JOIN 
                    graph_images AS gi 
                ON 
                    g.image = gi.id
                WHERE
                    g.comp_id = '".$company."'
                AND
                    g.version > '".$version."'";
      
       if($result = Connection::$mysqli->query($sql)){
            $graphs = array();
            while($graph = $result->fetch_assoc()){
                $graphs[] = $graph;
            }
            $result->free();
       }

        return $graphs ? $graphs : false;   
    }
    
    public static function selectGraphOptions($company, $version){
        $company = self::checkData($company, 'i');
        $version = self::checkData($version, 'i');
        
        $sql = "SELECT 
                   *
                FROM 
                    graph_options
                WHERE
                    comp_id = '".$company."'
                AND
                    version > '".$version."'";
       
       if($result = Connection::$mysqli->query($sql)){
            $options = array();
            while($option = $result->fetch_assoc()){
                $options[] = $option;
            }
            $result->free();
       }

        return $options ? $options : false;  
    }
    
    public static function selectGraphFilter($company, $version){
        $company = self::checkData($company, 'i');
        $version = self::checkData($version, 'i');
        
        $sql = "SELECT 
                   gf.*
                FROM 
                    graph_filter AS gf
                JOIN
                    graph AS g
                ON
                    gf.graph = g.id
                WHERE
                    g.comp_id = '".$company."'
                AND
                    gf.version > '".$version."'";
      
       if($result = Connection::$mysqli->query($sql)){
            $graph_filter = array();
            while($graph = $result->fetch_assoc()){
                $graph_filter[] = $graph;
            }
            $result->free();
       }

        return $graph_filter ? $graph_filter : false;   
    }
    
    public static function selectGraphFilterType($company, $version){
        $company = self::checkData($company, 'i');
        $version = self::checkData($version, 'i');
        
        $sql = "SELECT DISTINCT
                   gft.*
                FROM 
                    graph_filter_type AS gft
                JOIN 
                    graph_filter AS gf
                ON
                    gft.id = gf.filter_type
                JOIN
                    graph AS g
                ON
                    gf.graph = g.id
                WHERE
                    g.comp_id = '".$company."'
                AND
                    gft.version > '".$version."'";
      
       if($result = Connection::$mysqli->query($sql)){
            $graph_filter_type = array();
            while($graph = $result->fetch_assoc()){
                $graph_filter_type[] = $graph;
            }
            $result->free();
       }

        return $graph_filter_type ? $graph_filter_type : false;   
    }
    
    public static function selectGraphFilterItems($company, $version){
        $company = self::checkData($company, 'i');
        $version = self::checkData($version, 'i');
        
        $sql = "SELECT DISTINCT
                   gfi.*
                FROM 
                    graph_filter_items AS gfi
                JOIN 
                    graph_filter AS gf
                ON
                    gfi.graph_filter = gf.id
                JOIN
                    graph AS g
                ON
                    gf.graph = g.id
                WHERE
                    g.comp_id = '".$company."'
                AND
                    gfi.version > '".$version."'";
      
       if($result = Connection::$mysqli->query($sql)){
            $graph_filter_items = array();
            while($graph = $result->fetch_assoc()){
                $graph_filter_items[] = $graph;
            }
            $result->free();
       }

        return $graph_filter_items ? $graph_filter_items : false;   
    }
    
}

final class PushNotifications {
    public static $result = Array('data' => '', 'error' => false);
    
    public static function userExists($uuid, $company) {
        try {
            $sql = "SELECT * FROM graph_users WHERE UUID = '".$uuid."' AND company = '".$company."'";

            Connection::$mysqli->query($sql);

            return Connection::$mysqli->affected_rows;

        } catch (Exception $e) {

            return 0;
        }
    }
    
    public static function loggin($uuid, $login = 1, $company) {
        try {
            
            $sql = "UPDATE graph_users SET logged_in = '".$login."', waiting = 0 WHERE UUID = '".$uuid."'";
            
            if($company != null)
                $sql .= " AND company = '".$company."'";

            Connection::$mysqli->query($sql);

            return Connection::$mysqli->affected_rows;

        } catch (Exception $e) {

            return 0;
        }
    }

    public static function createNewUser($uuid, $company) {
        try {
            self::logout($uuid);
            
            if(self::userExists($uuid, $company) > 0){
                return self::loggin($uuid, 1, $company);
            }
            $sql = "INSERT INTO graph_users(UUID, company, total, waiting, logged_in) "
                    . "VALUES ('" . $uuid . "', '" . $company . "', 0, 0, 1)";

            Connection::$mysqli->query($sql);
            self::$result['data'] = Connection::$mysqli->insert_id;
            Connection::$mysqli->insert_id ? '' : (self::$result['error'] = true);
            return json_encode(self::$result);
        } catch (Exception $e) {
            self::$result['error'] = true;
            return json_encode(self::$result);
        }
    }

    public static function logout($uuid) {
        $uuid = Ajax::checkData($uuid);
        return self::loggin($uuid, 0, null);
    }
}