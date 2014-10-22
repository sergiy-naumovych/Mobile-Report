<?php

if (ini_get('display_errors')) {
    ini_set('display_errors', '0');
}

//MSSQL
//phpinfo();
//header('Content-type: text/html; charset=UTF8');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if(isset($_POST['info'])){
        try{
            $info = (array)json_decode($_POST['info']);
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

    mssql_select_db('IVMEDB');
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


        /*
          for($i = 0; $i < $num_cols; $i++){
          echo $num_cols;
          while (current($fet_tbl)) {
          ${key($fet_tbl)}[] = $fet_tbl[i];
          next($fet_tbl);
          }
          }

          for($i = 0; $i < $num_cols; $i++){
          while (current($fet_tbl)) {
          var_dump(${key($fet_tbl)});
          echo '<br />';
          next($fet_tbl);
          }
          }
         */
    }
    $data = array();

    foreach ($names as $value) {
        $data[$value] = ${$value};
    }
//$data[] = $_POST['sql'];
    echo json_encode($data);





//PDO_DBLIB
    /*
      try {
      $hostname = "94.158.70.196";            //host
      $dbname = "IVMEDB";            //db name
      $username = "user";            // username like 'sa'
      $pw = "1";                // password for the user

      $dbh = new PDO ("mssql:host=$hostname;dbname=$dbname","$username","$pw");
      } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
      }
      echo $dbh;
     */

//$cnx = new PDO("odbc:Driver={SQL Native Client};Server=94.158.70.196;Database=IVMEDB; Uid=user;Pwd=1;");
    /*
      $serverName = '94.158.70.196'; //serverName\instanceName
      $connectionInfo = array( "Database"=>"IVMEDB", "UID"=>"user", "PWD"=>"1");
      $conn = sqlsrv_connect( $serverName, $connectionInfo);

      if( $conn ) {
      echo "Connection established.<br />";
      echo  get_resource_type($conn) . "<br />";
      }else{
      echo "Connection could not be established.<br />";
      die( print_r( sqlsrv_errors(), true));
      }
     */
    /*
      try{
      $dbh = new PDO("mssql:host=94.158.70.196;dbname=IVMEDB", 'user', '1');
      } catch (PDOException $e) {
      echo $e->getMessage();
      }
     */
}