<?php

if (ini_get('display_errors')) {
    ini_set('display_errors', '0');
}

//MSSQL
//phpinfo();
//header('Content-type: text/html; charset=UTF8');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    Fetch::init();
    /*
    if(isset($_POST['info'])){
        try{
            $info = json_decode($_POST['info'], true);
            
            file_put_contents('data.txt', $_POST['info'] . "\n" . json_encode($_POST['sql'])
                    . "\n" . json_encode($_POST['db']) . "\n" , FILE_APPEND);
            
            
            $server = $info['ip_adress'];
            $link = mssql_connect($server, $info['db_username'], $info['db_pass']);
        } catch (Exception $e){
            $server = '94.158.70.196';
            $link = mssql_connect($server, 'user', '1');
        }
        
    } else {
        $server = '94.158.70.196';
        $link = mssql_connect($server, 'user', '1');
    }
    
    
    if (!$link) {
        die();
    }

    $db_name = isset($_POST['db']) ? $_POST['db'] : '';
    mssql_select_db($db_name);
    $sql = isset($_POST['sql']) ? $_POST['sql'] : '';
    
    
    $all = MSSQL_Query($sql);
    $flag = 0;
    $num_cols = 0;
    $j = 0;
    $names = Array();
    while ($fet_tbl = mssql_fetch_assoc($all)) { // PUSH ALL TABLES AND COLUMNS INTO THE ARRAY
        if ($flag === 0) {
            while (current($fet_tbl)) {
                $names[] = key($fet_tbl);
                ${key($fet_tbl)} = Array();
                next($fet_tbl);
            }
            $flag = 1;
        }

        foreach ($names as $value) {
            ${$value}[] = $fet_tbl[$value];
        }


    }
    $data = array();

    foreach ($names as $value) {
        $data[$value] = ${$value};
    }

    
    
    file_put_contents('data.txt', json_encode($data) . "\n", FILE_APPEND);
    
    echo json_encode($data);
    */
} else {
    phpinfo();
}

final class Fetch{
    /*
     * @user - database login
     * @pass - database password
     * @db_name - database name
     * @sql - sql command
     */
    public static $user = null;
    public static $pass = null;
    public static $db_name = null;
    public static $sql = null;
    /*
     * @server - addres of SQL server
     */
    public static $server = null;
    /*
     * @link - connection to the server
     */
    public static $link = null;
    
    public static $result = Array('data' => null, 'error' => true);
    /*
     * @db_type - type of the DB:
     * 1 - MySQL
     * 2 - MsSQL
     * ...
     */
    public static $db_type = 2;


    public static function init() {
        try {
            self::setInfo();
            echo self::$result['data'];
        } catch (Exception $err) {
            self::$result['error'] = true;
            file_put_contents('error.log', $err->getTraceAsString() . "\n", FILE_APPEND);
            echo '';
        }
    }

    public static function setInfo() {
        try {
            if (isset($_POST['info']) && isset($_POST['sql']) && isset($_POST['db'])) {
                $info = json_decode($_POST['info'], true);

//                file_put_contents('data.txt', $_POST['info'] . "\n" . json_encode($_POST['sql'])
//                        . "\n" . json_encode($_POST['db']) . "\n", FILE_APPEND);


                self::$server = $info['ip_adress'];
                self::$user = $info['db_username'];
                self::$pass = $info['db_pass'];
                self::$sql = $_POST['sql'];
                self::$db_name = $_POST['db'];
                /*
                 * here must be a setting of db type
                 */
                self::connect();
                
            } else {
                throw new Exception('Empty POST array');
            }
        } catch (Exception $exc) {
            self::$result['error'] = true;
            file_put_contents('error.log', $exc->getTraceAsString() . "\n", FILE_APPEND);
            return;
        }
    }

    public static function connect() {
        try {
            switch (self::$db_type) {
                case 1://MySQL
                    break;
                case 2://MsSQL
                    self::initMSSQL();
                    break;
                default:
                    break;
            }
        } catch (Exception $exc) {
            self::$result['error'] = true;
            file_put_contents('error.log', $exc->getTraceAsString() . "\n", FILE_APPEND);
            return;
        }
            
    }

    public static function initMSSQL() {
        try {
            self::$link = mssql_connect(self::$server, self::$user, self::$pass);
            if(!self::$link)
                throw new Exception ('Cant connect to server');
            else
                self::selectMSSQL();
        } catch (Exception $exc) {
            self::$result['error'] = true;
            file_put_contents('error.log', $exc->getTraceAsString() . "\n", FILE_APPEND);
            return;
        }
    }

    public static function selectMSSQL() {
        try {
            mssql_select_db(self::$db_name);
            $all = MSSQL_Query(self::$sql);

            $flag = 0;
            $num_cols = 0;
            $j = 0;

            $names = Array();

            while ($fet_tbl = mssql_fetch_assoc($all)) { // PUSH ALL TABLES AND COLUMNS INTO THE ARRAY
                if ($flag === 0) {
                    while (current($fet_tbl)) {
                        $names[] = key($fet_tbl);
                        ${key($fet_tbl)} = Array();
                        next($fet_tbl);
                    }
                    $flag = 1;
                }

                foreach ($names as $value) {
                    ${$value}[] = mb_convert_encoding($fet_tbl[$value], "UTF-8");
                }
            }
            $data = array();

            foreach ($names as $value) {
                $data[$value] = ${$value};
            }
        
//            file_put_contents('data.txt', json_encode($data) . "\n;)", FILE_APPEND);
    
            self::$result['data'] = json_encode($data);
            self::$result['error'] = false;
            self::$result['data'] = self::convert(self::$result['data']);
            return;
            
        } catch (Exception $exc) {
            self::$result['error'] = true;
            file_put_contents('error.log', $exc->getTraceAsString() . "\n", FILE_APPEND);
            return;
        }
    }

    private static function convert($str){
        $search = array("u00f0", "u00d0", "u00dd", "u00de", "u00fe", "u00fd");
        $replace = array("u011f", "u011e", "u0130", "u015e", "u015f", "u0131");
        $res = str_replace($search, $replace, $str);
        //file_put_contents('replace.log', $res . "\n", FILE_APPEND);
        return $res;
    }
}