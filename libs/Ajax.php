<?php



final class Ajax {

    public static $result = Array('data' => '', 'error' => false);
    public static $data = '';

    public static function init() {
        if (!Connection::connect()) {
            self::$result['error'] = true;
            echo json_encode(self::$result);
        } else {
            echo self::requestType();
        }
    }

    public static function selectGraphInfo($graph) {
        $sql = "SELECT 
                   g.*, go.*, g.isdeleted AS isdeleted
                FROM 
                    graph_options AS go
                JOIN
                    graph AS g
                ON
                    g.id = go.graph
                WHERE
                    graph = '" . $graph . "'";

        
        if ($result = Connection::$mysqli->query($sql)) {
            $options = '';
            while ($option = $result->fetch_assoc()) {
                $options = $option;
            }
            $result->free();
        }

        return $options ? json_encode($options) : '';
    }

    public static function requestType() {
        switch ($_POST['type']) {
            case 'new-serial':
                return Serial::createSerial();
                
            case 'serial-info':
                return Serial::selectSerial($_POST['id']);
                
            case 'update-serial':
                return Serial::updateSerial($_POST['id'], $_POST['distributor'],
                        $_POST['subdistributor'], $_POST['status'], $_POST['customer']);
                
            case 'graph-info':
                return self::selectGraphInfo($_POST['id']);

            case 'company-info':
                return self::selectCompanyInfo($_POST['id']);

            case 'category-info':
                return self::selectCategoryInfo($_POST['id']);

            case 'new-company':
                return self::insertNewCompany($_POST['name'], $_POST['login'], 
                        $_POST['pass'], 2, $_POST['creator']);
                
            case 'new-distributor':
                return self::insertNewCompany($_POST['name'], $_POST['login'], 
                        $_POST['pass'], 3, $_POST['creator']);
                
            case 'new-subdistributor':
                return self::insertNewCompany($_POST['name'], $_POST['login'], 
                        $_POST['pass'], 4, $_POST['creator']);

            case 'delete-company':
                return self::deleteCompany($_POST['id']);

            case 'activate-company':
                return self::activateCompany($_POST['id']);

            case 'update-company':
                return self::updateCompany($_POST['id'], $_POST['name'], 
                        $_POST['login'], $_POST['pass']);

            case 'delete-image':
                return self::deleteImage($_POST['id'], $_POST['name']);

            case 'update-com':
                return self::updateCom($_POST['id'], $_POST['name'], 
                        $_POST['login'], $_POST['pass'], $_POST['ip'], 
                        $_POST['db_login'], $_POST['db_pass'], $_POST['direct_connection']);

            case 'update-category':
                return self::updateCategory($_POST['id'], $_POST['name'], 
                        $_POST['picture']);
                
            case 'new-category':
                return self::insertNewCategory($_POST['name'], 
                        $_POST['picture'], $_POST['company']);
                
            case 'delete-category':
                return self::deleteCategory($_POST['id']);

            case 'activate-category':
                return self::activateCategory($_POST['id']);
                
            case 'update-graph':
                return Graph::updateGraph($_POST['data']);
                
            case 'create-graph':
                return Graph::createGraph($_POST['data']);
                
            case 'graph-filter-info':
                return self::selectFilterInfo($_POST['id']);

            case 'graph-fields-info':
                return self::selectFieldsInfo($_POST['id']);
                
            case 'new-filter':
                return self::createFilter($_POST['name'], $_POST['var_name'], 
                        $_POST['graph'], $_POST['filter_type']);

            case 'new-field':
                return self::createField($_POST['field_name'], $_POST['field_length'],
                    $_POST['graph'], $_POST['field_type'], $_POST['field_format'], $_POST['field_align']);
                
            case 'new-item':
                return self::createFilterItem($_POST['graph_filter'], 
                        $_POST['display_value'], $_POST['list_value']);
                
            case 'delete-graph':
                return Graph::deleteGraph($_POST['id']);

            case 'activate-graph':
                return Graph::activateGraph($_POST['id']);
                
            case 'filter-info':
                return self::selectFilter($_POST['id']);

            case 'field-info':
                return self::selectField($_POST['id']);
                
            case 'item-info':
                return self::selectItem($_POST['id']);
                
            case 'delete-filter':
                return self::deleteFilter($_POST['id']);

            case 'activate-filter':
                return self::activateFilter($_POST['id']);

            case 'delete-field':
                return self::deleteField($_POST['id']);

            case 'activate-field':
                return self::activateField($_POST['id']);
                
            case 'delete-item':
                return self::deleteItem($_POST['id']);

            case 'activate-item':
                return self::activateItem($_POST['id']);
                
            case 'update-item':
                return self::updateItem($_POST['id'], $_POST['list_value'], 
                        $_POST['display_value']);

            case 'update-filter':
                return self::updateFilter($_POST['id'], $_POST['filter_name'], 
                        $_POST['var_name'], $_POST['filter_type']);

            case 'update-field':
                return self::updateField($_POST['id'], $_POST['field_name'],
                    $_POST['field_length'], $_POST['field_type'], $_POST['field_format'], $_POST['field_align']);
                
            case 'notification-info':
                return Notification::selectInfo($_POST['id']);
                
            case 'new-notification':
                return Notification::create($_POST['name'], $_POST['message'], 
                        $_POST['db_name'], $_POST['sql'], $_POST['company']);
                
            case 'update-notification':
                return Notification::update($_POST['name'], $_POST['message'], 
                                            $_POST['db_name'], $_POST['sql'], 
                                            $_POST['company'], $_POST['id']);
                
            case 'delete-notification':
                return Notification::delete($_POST['id']);

            case 'activate-notification':
                return Notification::activate($_POST['id']);
            
            default:
                self::$result['error'] = true;
                return json_encode(self::$result);
        }
    }

    public static function selectCompanyInfo($company) {
        try {
            $sql = "SELECT 
                   id, comp_name, username
                FROM 
                    users
                WHERE
                    id = '" . $company . "'";
            //file_put_contents('data.txt', $sql . "\n", FILE_APPEND);
            if ($result = Connection::$mysqli->query($sql)) {
                $companies = '';
                while ($company = $result->fetch_assoc()) {
                    $companies = $company;
                }
                $result->free();
            }

            return $companies ? json_encode($companies) : '';
        } catch (Exception $e) {
            self::errorLog($e);
            return '';
        }
    }

    public static function selectCategoryInfo($category) {
        $sql = "SELECT 
                   *
                FROM 
                    graph_group AS go
                WHERE
                    id = '" . $category . "'";

        if ($result = Connection::$mysqli->query($sql)) {
            $categories = '';
            while ($category = $result->fetch_assoc()) {
                $categories = $category;
            }
            $result->free();
        }

        return $categories ? json_encode($categories) : '';
    }
    
    public static function loginExisits($login) {
        try {
            $count = 0;
            $sql = "SELECT id AS id FROM users WHERE username = '".$login."'";
            //file_put_contents('data.txt', $sql . "\n", FILE_APPEND);
            //echo $sql;
            if ($result = Connection::$mysqli->query($sql)) {
                while ($exists = $result->fetch_assoc()) {
                    $count++;
                }
                $result->free();
            }

            return $count;
        } catch (Exception $e) {
            self::errorLog($e);
            return 2;
        }
    }

    public static function insertNewCompany($name, $login, $pass, $type = 2, $creator=1) {
        try {
            if(self::loginExisits($login) > 0){
                self::$result['data'] = 'This Login is already in use!';
                throw new Exception();
            }
            
            if($creator != 1 && $type != 2) $type = 4;
            
            $sql = "INSERT INTO users(comp_name, username, password, type, creator) "
                    . "VALUES ('" . $name . "', '" . $login . "', '" . $pass . "', '" . $type . "', '".$creator."')";

            Connection::$mysqli->query($sql);
            self::$result['data'] = Connection::$mysqli->insert_id;
            Connection::$mysqli->insert_id ? '' : (self::$result['error'] = true);
            return json_encode(self::$result);
        } catch (Exception $e) {
            self::errorLog($e);
            self::$result['error'] = true;
            return json_encode(self::$result);
        }
    }

    public static function deleteCompany($company, $del=1) {
        try {
            $sql = "UPDATE users SET isdeleted = '".$del."' WHERE id = '" . $company . "'";

            Connection::$mysqli->query($sql);

            self::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows >= 0) ? '' : (self::$result['error'] = true);

            return json_encode(self::$result);
        } catch (Exception $e) {

            self::$result['error'] = true;

            return json_encode(self::$result);
        }
    }

    public static function activateCompany($company) {
        return self::deleteCompany($company, 0);
    }

    public static function updateCompany($id, $name, $login, $password) {
        try {
            $company = json_decode(self::selectCompanyInfo($id), true);
            
            if($company['username'] != $login && self::loginExisits($login) > 0){
                self::$result['data'] = 'This Login is already in use!';
                throw new Exception();
            }
            $sql = "UPDATE users SET "
                    . "comp_name = '" . $name . "', "
                    . "username = '" . $login . "'";

            $sql .= $password ? ", password = '" . $password . "'" : '';

            $sql .= " WHERE id = '" . $id . "'";
            //file_put_contents('data.txt', $sql . "\n", FILE_APPEND);
            Connection::$mysqli->query($sql);

            self::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows >= 0) ? '' : (self::$result['error'] = true);

            return json_encode(self::$result);
        } catch (Exception $e) {
            self::errorLog($e);
            
            self::$result['error'] = true;

            return json_encode(self::$result);
        }
    }
    
    public static function errorLog(Exception $err) {
        try {
            return file_put_contents('error.log', $err->getMessage() . "\n", FILE_APPEND);
        } catch (Exception $exc) {
            return;
        }
    }

    public static function deleteImage($id, $name) {
        try {
            $sql = "DELETE FROM graph_images WHERE id = '" . $id . "'";

            Connection::$mysqli->query($sql);

            self::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows > 0) ? '' : (self::$result['error'] = true);

            unlink('uploader' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . $name) & unlink('uploader' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'thumbnail' . DIRECTORY_SEPARATOR . $name);

            return json_encode(self::$result);
        } catch (Exception $e) {

            self::$result['error'] = true;

            return json_encode(self::$result);
        }
    }

    public static function updateCom($id, $name, $login, $password, $ip, $db_login, $db_pass, $direct_connection) {
        try {
            $company = json_decode(self::selectCompanyInfo($id), true);
            
            if($company['username'] != $login && self::loginExisits($login) > 0){
                self::$result['data'] = 'This Login is already in use!';
                throw new Exception();
            }
            $sql = "UPDATE users SET "
                    . "comp_name = '" . $name . "', "
                    . "username = '" . $login . "', "
                    . "ip_adress = '" . $ip . "', "
                    . "db_username = '" . $db_login . "', "
                    . "direct_connection = '" . $direct_connection . "'";

            $sql .= $password ? ", password = '" . $password . "'" : '';
            $sql .= $db_pass ? ", db_pass = '" . $db_pass . "'" : '';

            $sql .= " WHERE id = '" . $id . "'";
            //file_put_contents('data.txt', $sql . "\n", FILE_APPEND);
            Connection::$mysqli->query($sql);

            self::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows >= 0) ? '' : (self::$result['error'] = true);

            return json_encode(self::$result);
        } catch (Exception $e) {
            self::errorLog($e);
            
            self::$result['error'] = true;

            return json_encode(self::$result);
        }
    }

    public static function updateCategory($id, $name, $picture) {
        try {
            $version = self::selectMaxVersion('graph_group');
            $sql = "UPDATE graph_group SET "
                    . "group_name = '" . $name . "', "
                    . "image = '" . $picture . "', "
                    . "version = '".$version."'"
                    . " WHERE id = '" . $id . "'";

            Connection::$mysqli->query($sql);

            self::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows > 0) ? '' : (self::$result['error'] = true);

            return json_encode(self::$result);
        } catch (Exception $e) {

            self::$result['error'] = true;

            return json_encode(self::$result);
        }
    }

    public static function selectMaxVersion($table) {
        try {
            $sql = "SELECT MAX(version)+1 AS version FROM " . $table;

            if ($result = Connection::$mysqli->query($sql)) {
                $categories = '';
                while ($category = $result->fetch_assoc()) {
                    $categories = $category;
                }
                $result->free();
            }

            return $categories['version'] ? $categories['version'] : 1;
        } catch (Exception $e) {
            return 1;
        }
    }

    public static function insertNewCategory($name, $picture, $company) {
        try {
            $version = self::selectMaxVersion('graph_group');
            
            $sql = "INSERT INTO graph_group(group_name, comp_id, image, version) "
                    . "VALUES ('" . $name . "', '" . $company . "', '" . $picture . "', '" . $version . "')";

            Connection::$mysqli->query($sql);
            
            self::$result['data'] = Connection::$mysqli->insert_id;
            
            Connection::$mysqli->insert_id ? '' : (self::$result['error'] = true);
            
            return json_encode(self::$result);
        
            
        } catch (Exception $e) {
            
            self::$result['error'] = true;
            
            return json_encode(self::$result);
        }
    }
    
    public static function deleteCategory($category, $del=1) {
        try {
            $version = self::selectMaxVersion('graph_group');
            $sql = "UPDATE graph_group SET isdeleted = '".$del."', version = '"
                    . $version . "' WHERE id = '" . $category . "'";

            Connection::$mysqli->query($sql);

            self::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows > 0) ? '' : (self::$result['error'] = true);

            return json_encode(self::$result);
        } catch (Exception $e) {

            self::$result['error'] = true;

            return json_encode(self::$result);
        }
    }

    public static function activateCategory($category) {
        return self::deleteCategory($category, 0);
    }
    
    public static function selectFilterInfo($graph) {
        try {
            $sql = "SELECT * FROM `graph_filter` WHERE `graph` = '".$graph."'";

            $categories = Array();
            if ($result = Connection::$mysqli->query($sql)) {
                while ($category = $result->fetch_assoc()) {
                    $category['items'] = self::selectFilterItems($category['id']);
                    $categories[] = $category;
                    
                }
                $result->free();
            }
            
            
            self::$result['data'] = $categories;
            
            return json_encode(self::$result);
            
        } catch (Exception $e) {
            self::$result['error'] = true;
            return json_encode(self::$result);
        }
    }

    public static function selectFieldsInfo($graph) {
        try {
            $sql = "SELECT * FROM `graph_field` WHERE `graph` = '".$graph."'";

            $categories = Array();
            if ($result = Connection::$mysqli->query($sql)) {
                while ($category = $result->fetch_assoc()) {
                    $categories[] = $category;

                }
                $result->free();
            }


            self::$result['data'] = $categories;

            return json_encode(self::$result);

        } catch (Exception $e) {
            self::$result['error'] = true;
            return json_encode(self::$result);
        }
    }

    public static function selectFilterItems($filter) {
        try {
            $sql = "SELECT * FROM `graph_filter_items` WHERE `graph_filter` = '".$filter."'";

            $categories = Array();
            if ($result = Connection::$mysqli->query($sql)) {
                while ($category = $result->fetch_assoc()) {
                    $categories[] = $category;
                    
                }
                $result->free();
            }
            
            return $categories;
            
        } catch (Exception $e) {
            return '';
        }
    }

    public static function createFilter($name, $var_name, $graph, $filter_type = 4) {
        try {
            $version = self::selectMaxVersion('graph_filter');
            
            $sql = "INSERT INTO graph_filter(graph, filter_type, default_value, name, var_name, version, isdeleted) "
                    . "VALUES ('" . $graph . "', '". $filter_type ."', 0, '" . $name . "', '" . $var_name . "', '" . $version . "', 0)";

            Connection::$mysqli->query($sql);
            
            self::$result['data'] = Connection::$mysqli->insert_id;
            
            Connection::$mysqli->insert_id ? '' : (self::$result['error'] = true);
            
            return json_encode(self::$result);
        
            
        } catch (Exception $e) {
            
            self::$result['error'] = true;
            
            return json_encode(self::$result);
        }
    }

    public static function createField($field_name, $field_length,
                    $graph, $field_type, $field_format, $field_align){
        try {
            $version = self::selectMaxVersion('graph_field');

            $sql = "INSERT INTO graph_field(name, graph, length, data_type, mask, version, isdeleted, align) "
                . "VALUES ('" . $field_name . "', '". $graph ."', '". $field_length ."', '". $field_type ."'," .
                " '". $field_format ."', '" . $version . "', 0, '" . $field_align . "')";


            Connection::$mysqli->query($sql);

            self::$result['data'] = Connection::$mysqli->insert_id;

            Connection::$mysqli->insert_id ? '' : (self::$result['error'] = true);

            return json_encode(self::$result);


        } catch (Exception $e) {

            self::$result['error'] = true;

            return json_encode(self::$result);
        }
    }

    public static function createFilterItem($graph_filter, $display_value, $list_value) {
        try {
            $version = self::selectMaxVersion('graph_filter_items');
            
            $sql = "INSERT INTO graph_filter_items(graph_filter, list_value, display_value, version, isdeleted) "
                    . "VALUES ('" . $graph_filter . "', '" . $list_value . "', '" . $display_value . "', '" . $version . "', 0)";

            Connection::$mysqli->query($sql);
            
            $id = Connection::$mysqli->insert_id;
            
            self::$result['data'] = $id;
            
            $id ? (self::updateFilterDefault($graph_filter, $id)) : (self::$result['error'] = true);
            
            return json_encode(self::$result);
        
            
        } catch (Exception $e) {
            
            self::$result['error'] = true;
            
            return json_encode(self::$result);
        }
    }
    
    public static function updateFilterDefault($id, $default_value) {
        try {
            $version = self::selectMaxVersion('graph_filter');
            $sql = "UPDATE graph_filter SET "
                    . "default_value = '" . $default_value . "'"
                    . " WHERE id = '" . $id . "'";

            Connection::$mysqli->query($sql);
            
            return true;

        } catch (Exception $e) {
            return true;
        }
    }
    
    public static function selectFilter($filter) {
        try {
            $sql = "SELECT * FROM `graph_filter` WHERE `id` = '".$filter."'";

            $categories = Array();
            if ($result = Connection::$mysqli->query($sql)) {
                while ($category = $result->fetch_assoc()) {
                    $categories = $category;
                    
                }
                $result->free();
            }
            
            
            self::$result['data'] = $categories;
            
            return json_encode(self::$result);
            
        } catch (Exception $e) {
            self::$result['error'] = true;
            return json_encode(self::$result);
        }
    }

    public static function selectField($filter) {
        try {
            $sql = "SELECT * FROM `graph_field` WHERE `id` = '".$filter."'";

            $categories = Array();
            if ($result = Connection::$mysqli->query($sql)) {
                while ($category = $result->fetch_assoc()) {
                    $categories = $category;

                }
                $result->free();
            }


            self::$result['data'] = $categories;

            return json_encode(self::$result);

        } catch (Exception $e) {
            self::$result['error'] = true;
            return json_encode(self::$result);
        }
    }
    
    public static function selectItem($item) {
        try {
            $sql = "SELECT * FROM `graph_filter_items` WHERE `id` = '".$item."'";

            $categories = Array();
            if ($result = Connection::$mysqli->query($sql)) {
                while ($category = $result->fetch_assoc()) {
                    $categories = $category;
                    
                }
                $result->free();
            }
            
            
            self::$result['data'] = $categories;
            
            return json_encode(self::$result);
            
        } catch (Exception $e) {
            self::$result['error'] = true;
            return json_encode(self::$result);
        }
    }
    
    public static function deleteFilter($filter, $del=1) {
        try {
            $version = self::selectMaxVersion('graph_filter');
            
            $sql = "UPDATE graph_filter SET isdeleted = '".$del."', version = '"
                    . $version . "' WHERE id = '" . $filter . "'";

            Connection::$mysqli->query($sql);

            self::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows > 0) ? '' : (self::$result['error'] = true);

            return json_encode(self::$result);
        } catch (Exception $e) {

            self::$result['error'] = true;

            return json_encode(self::$result);
        }
    }

    public static function activateFilter($filter) {
        return self::deleteFilter($filter, 0);
    }

    public static function deleteField($field, $del=1) {
        try {
            $version = self::selectMaxVersion('graph_field');

            $sql = "UPDATE graph_field SET isdeleted = '".$del."', version = '"
                . $version . "' WHERE id = '" . $field . "'";

            Connection::$mysqli->query($sql);

            self::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows > 0) ? '' : (self::$result['error'] = true);

            return json_encode(self::$result);
        } catch (Exception $e) {

            self::$result['error'] = true;

            return json_encode(self::$result);
        }
    }

    public static function activateField($field) {
        return self::deleteField($field, 0);
    }
    
    public static function deleteItem($item, $del=1) {
        try {
            $version = self::selectMaxVersion('graph_filter_items');
            
            $sql = "UPDATE graph_filter_items SET isdeleted = '".$del."', version = '"
                    . $version . "' WHERE id = '" . $item . "'";

            Connection::$mysqli->query($sql);

            self::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows > 0) ? '' : (self::$result['error'] = true);

            return json_encode(self::$result);
        } catch (Exception $e) {

            self::$result['error'] = true;

            return json_encode(self::$result);
        }
    }

    public static function activateItem($item) {
        return self::deleteItem($item, 0);
    }
    
    public static function updateFilter($id, $name, $var_name, $filter_type = 4) {
        try {
            $version = self::selectMaxVersion('graph_filter');
            $sql = "UPDATE graph_filter SET "
                    . "name = '" . $name . "', "
                    . "var_name = '" . $var_name . "', "
                    . "version = '".$version."', "
                    . "filter_type = '".$filter_type."'"
                    . " WHERE id = '" . $id . "'";

            Connection::$mysqli->query($sql);

            self::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows > 0) ? '' : (self::$result['error'] = true);

            return json_encode(self::$result);
        } catch (Exception $e) {

            self::$result['error'] = true;

            return json_encode(self::$result);
        }
    }


    public static function updateField($id, $field_name,
                    $field_length, $field_type, $field_format, $field_align){
        try {

            $version = self::selectMaxVersion('graph_field');
            $sql = "UPDATE graph_field SET "
                . "name = '" . $field_name . "', "
                . "length = '" . $field_length . "', "
                . "data_type = '" . $field_type . "', "
                . "mask = '" . $field_format . "', "
                . "version = '".$version."', "
                . "align = '".$field_align."' "
                . " WHERE id = '" . $id . "'";

            Connection::$mysqli->query($sql);

            self::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows > 0) ? '' : (self::$result['error'] = true);

            return json_encode(self::$result);
        } catch (Exception $e) {

            self::$result['error'] = true;

            return json_encode(self::$result);
        }

    }
    
    public static function updateItem($id, $list_value, $display_value) {
        try {
            $version = self::selectMaxVersion('graph_filter_items');
            $sql = "UPDATE graph_filter_items SET "
                    . "list_value = '" . $list_value . "', "
                    . "display_value = '" . $display_value . "', "
                    . "version = '".$version."'"
                    . " WHERE id = '" . $id . "'";

            Connection::$mysqli->query($sql);

            self::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows > 0) ? '' : (self::$result['error'] = true);

            return json_encode(self::$result);
        } catch (Exception $e) {

            self::$result['error'] = true;

            return json_encode(self::$result);
        }
    }
}

final class Graph{

    public static function updateGraph($data) {
        try {
            $data = json_decode($data);
            $version = Ajax::selectMaxVersion('graph');
            $sql = "UPDATE graph SET "
                    . "graph_name = '" . $data->graph_name . "', "
                    . "image = '" . $data->image . "', "
                    . "type = '" . $data->type . "', "
                    . "version = '".$version."'"
                    . " WHERE id = '" . $data->id . "'";

            
            self::updateGraphOptions($data);
            
            Connection::$mysqli->query($sql);

            Ajax::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows > 0) ? '' : (Ajax::$result['error'] = true);

            return json_encode(Ajax::$result);
        } catch (Exception $e) {

            Ajax::$result['error'] = true;

            return json_encode(Ajax::$result);
        }
    }
    
    public static function updateGraphOptions($options) {
        try {
            $version = Ajax::selectMaxVersion('graph_options');
            $sql = "UPDATE graph_options SET "
                        ."comp_id = '".$options->comp_id."', "
                        ."version = '".$version."', "
                        ."graph = '".$options->id."', "
                        ."title = '".$options->title."', "
                        ."subtitle = '".$options->subtitle."', "
                        ."sql_command = '".str_replace("'","\'",$options->sql_command)."', "
                        ."colors = '".$options->colors."', "
                        ."background_color = '".$options->background_color."', "
                        ."border_color = '".$options->border_color."', "
                        ."border_radius = '".$options->border_radius."', "
                        ."border_width = '".$options->border_width."', "
                        ."margin_bottom = '".$options->margin_bottom."', "
                        ."margin_left = '".$options->margin_left."', "
                        ."margin_right = '".$options->margin_right."', "
                        ."margin_top = '".$options->margin_top."', "
                        ."plot_background_color = '".$options->plot_background_color."', "
                        ."plot_border_color = '".$options->plot_border_color."', "
                        ."plot_border_width = '".$options->plot_border_width."', "
                        ."show_axes = '".$options->show_axes."', "
                        ."spacing_bottom = '".$options->spacing_bottom."', "
                        ."spacing_left = '".$options->spacing_left."', "
                        ."spacing_right = '".$options->spacing_right."', "
                        ."spacing_top = '".$options->spacing_top."', "
                        ."legend_align = '".$options->legend_align."', "
                        ."legend_background_color = '".$options->legend_background_color."', "
                        ."legend_border_color = '".$options->legend_border_color."', "
                        ."legend_border_radius = '".$options->legend_border_radius."', "
                        ."legend_border_width = '".$options->legend_border_width."', "
                        ."legend_enabled = '".$options->legend_enabled."', "
                        ."legend_floating = '".$options->legend_floating."', "
                        ."legend_item_distance = '".$options->legend_item_distance."', "
                        ."legend_item_margin_bottom = '".$options->legend_item_margin_bottom."', "
                        ."legend_item_margin_top = '".$options->legend_item_margin_top."', "
                        ."legend_layout = '".$options->legend_layout."', "
                        ."legend_line_height = '".$options->legend_line_height."', "
                        ."legend_margin = '".$options->legend_margin."', "
                        ."legend_padding = '".$options->legend_padding."', "
                        ."legend_reversed = '".$options->legend_reversed."', "
                        ."legend_shadow = '".$options->legend_shadow."', "
                        ."legend_title = '".$options->legend_title."', "
                        ."legend_vertical_align = '".$options->legend_vertical_align."', "
                        ."legend_width = '".$options->legend_width."', "
                        ."legend_x = '".$options->legend_x."', "
                        ."legend_y = '".$options->legend_y."', "
                        ."title_align = '".$options->title_align."', "
                        ."title_color = '".$options->title_color."', "
                        ."xAxis_lineColor = '".$options->xAxis_lineColor."', "
                        ."xAxis_lineWidth = '".$options->xAxis_lineWidth."', "
                        ."xAxis_gridLineColor = '".$options->xAxis_gridLineColor."', "
                        ."xAxis_gridLineWidth = '".$options->xAxis_gridLineWidth."', "
                        ."xAxis_title_enabled = '".$options->xAxis_title_enabled."', "
                        ."xAxis_text = '".$options->xAxis_text."', "
                        ."xAxis_align = '".$options->xAxis_align."', "
                        ."yAxis_lineColor = '".$options->yAxis_lineColor."', "
                        ."yAxis_lineWidth = '".$options->yAxis_lineWidth."', "
                        ."yAxis_gridLineColor = '".$options->yAxis_gridLineColor."', "
                        ."yAxis_gridLineWidth = '".$options->yAxis_gridLineWidth."', "
                        ."yAxis_text = '".$options->yAxis_text."', "
                        ."yAxis_align = '".$options->yAxis_align."', "
                        ."enableMouseTracking = '".$options->enableMouseTracking."', "
                        ."markerEnabled = '".$options->markerEnabled."', "
                        ."pie_series_name = '".$options->pie_series_name."', "
                        ."table_name = '".$options->table_name."', "
                        ."yAxis_title_enabled = 1"
                    ." WHERE id = '".$options->id."'";


           
            Connection::$mysqli->query($sql);

            Ajax::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows > 0) ? '' : (Ajax::$result['error'] = true);

            return json_encode(Ajax::$result);
        } catch (Exception $e) {

            Ajax::$result['error'] = true;

            return json_encode(Ajax::$result);
        }
    }

    public static function createGraph($data) {
        try {
            $data = json_decode($data);
            $version = Ajax::selectMaxVersion('graph');
            
            $sql = "INSERT INTO graph(graph_name, comp_id, graph_group_id, image, type, version, isdeleted) "
                    . "VALUES ('" . $data->graph_name . "', '" . $data->comp_id . "', '" 
                    . $data->graph_group_id . "', '" . $data->image . "', '" 
                    . $data->type . "', '" . $version . "', 0)";

            Connection::$mysqli->query($sql);
            
            $id = Connection::$mysqli->insert_id;
            Ajax::$result['data'] = $id;
            
            Ajax::$result['error'] = $id ? self::createGraphOptions($data, $id) : true;
            
            return json_encode(Ajax::$result);
        
            
        } catch (Exception $e) {
            
            Ajax::$result['error'] = true;
            
            return json_encode(Ajax::$result);
        }
    }

    public static function createGraphOptions($data, $id) {
        try {
            $version = Ajax::selectMaxVersion('graph_options');
            
            $sql = "INSERT INTO graph_options(id, comp_id, version, isdeleted, ".
                    "graph, title, subtitle, sql_command, colors, background_color, ".
                    "border_color, border_radius, border_width, margin_bottom, ".
                    "margin_left, margin_right, margin_top, plot_background_color, ".
                    "plot_border_color, plot_border_width, show_axes, spacing_bottom, ".
                    "spacing_left, spacing_right, spacing_top, legend_align, ".
                    "legend_background_color, legend_border_color, legend_border_radius, ".
                    "legend_border_width, legend_enabled, legend_floating, ".
                    "legend_item_distance, legend_item_margin_bottom, ".
                    "legend_item_margin_top, legend_layout, legend_line_height, ".
                    "legend_margin, legend_padding, legend_reversed, legend_shadow, ".
                    "legend_title, legend_vertical_align, legend_width, legend_x, ".
                    "legend_y, title_align, title_color, xAxis_lineColor, ".
                    "xAxis_lineWidth, xAxis_gridLineColor, xAxis_gridLineWidth, ".
                    "xAxis_title_enabled, xAxis_text, xAxis_align, yAxis_lineColor, ".
                    "yAxis_lineWidth, yAxis_gridLineColor, yAxis_gridLineWidth, ".
                    "yAxis_text, yAxis_align, enableMouseTracking, markerEnabled, ".
                    "pie_series_name, yAxis_title_enabled, table_name) ".
                    
                    
                    "VALUES('".$id."', '".$data->comp_id."', '".$version."', 0, ".
                    "'".$id."', '".$data->title."', '".$data->subtitle."', '".str_replace("'","\'",$data->sql_command)."', '".$data->colors."', '".$data->background_color."', ".
                    "'".$data->border_color."', '".$data->border_radius."', '".$data->border_width."', '".$data->margin_bottom."', ".
                    "'".$data->margin_left."', '".$data->margin_right."', '".$data->margin_top."', '".$data->plot_background_color."', ".
                    "'".$data->plot_border_color."', '".$data->plot_border_width."', '".$data->show_axes."', '".$data->spacing_bottom."', ".
                    "'".$data->spacing_left."', '".$data->spacing_right."', '".$data->spacing_top."', '".$data->legend_align."', ".
                    "'".$data->legend_background_color."', '".$data->legend_border_color."', '".$data->legend_border_radius."', ".
                    "'".$data->legend_border_width."', '".$data->legend_enabled."', '".$data->legend_floating."', ".
                    "'".$data->legend_item_distance."', '".$data->legend_item_margin_bottom."', ".
                    "'".$data->legend_item_margin_top."', '".$data->legend_layout."', '".$data->legend_line_height."', ".
                    "'".$data->legend_margin."', '".$data->legend_padding."', '".$data->legend_reversed."', '".$data->legend_shadow."', ".
                    "'".$data->legend_title."', '".$data->legend_vertical_align."', '".$data->legend_width."', '".$data->legend_x."', ".
                    "'".$data->legend_y."', '".$data->title_align."', '".$data->title_color."', '".$data->xAxis_lineColor."', ".
                    "'".$data->xAxis_lineWidth."', '".$data->xAxis_gridLineColor."', '".$data->xAxis_gridLineWidth."', ".
                    "'".$data->xAxis_title_enabled."', '".$data->xAxis_text."', '".$data->xAxis_align."', '".$data->yAxis_lineColor."', ".
                    "'".$data->yAxis_lineWidth."', '".$data->yAxis_gridLineColor."', '".$data->yAxis_gridLineWidth."', ".
                    "'".$data->yAxis_text."', '".$data->yAxis_align."', '".$data->enableMouseTracking."', '".$data->markerEnabled."', ".
                    "'".$data->pie_series_name."', 1, '".$data->table_name."')";

            
            Connection::$mysqli->query($sql);
            
            $id = Connection::$mysqli->insert_id;
            
            return $id ? false : true;
            
        } catch (Exception $e) {
            
            return true;
        }
    }

    public static function deleteGraph($graph_id, $del=1) {
        try {
            $version = Ajax::selectMaxVersion('graph');
            
            $sql = "UPDATE graph SET isdeleted = '".$del."', version = '".$version."' WHERE id = '" . $graph_id . "'";

            Connection::$mysqli->query($sql);

            Ajax::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows > 0) ? '' : (Ajax::$result['error'] = true);

            return json_encode(Ajax::$result);
        } catch (Exception $e) {

            Ajax::$result['error'] = true;

            return json_encode(Ajax::$result);
        }
    }

    public static function activateGraph($graph_id) {
        return self::deleteGraph($graph_id, 0);
    }

}

final class Notification{

    public static function selectInfo($id) {
        try {
            $sql = "SELECT * FROM `graph_notifications` WHERE `id` = '".$id."'";

            $notification = '';
            if ($result = Connection::$mysqli->query($sql)) {
                $notification = $result->fetch_assoc();
                $result->free();
            }
            
            
            Ajax::$result['data'] = $notification;
            
            return json_encode(Ajax::$result);
            
        } catch (Exception $e) {
            Ajax::$result['error'] = true;
            return json_encode(Ajax::$result);
        }
    }

    public static function create($name, $message, $db_name, $sql_command, $company) {
        try {
            $sql = "INSERT INTO graph_notifications(name, message, db_name, sql_command, company, isdeleted) "
                    . "VALUES ('" . $name . "', '" . $message . "', '" . $db_name . "', '" . str_replace("'","\'",$sql_command) . "', '" . $company . "', 0)";

            
            Connection::$mysqli->query($sql);
            
            Ajax::$result['data'] = Connection::$mysqli->insert_id;
            
            Connection::$mysqli->insert_id ? '' : (Ajax::$result['error'] = true);
            
            return json_encode(Ajax::$result);
        
            
        } catch (Exception $e) {
            
            Ajax::$result['error'] = true;
            
            return json_encode(Ajax::$result);
        }
    }

    public static function update($name, $message, $db_name, $sql_command, $company, $id) {
        try {
            $sql = "UPDATE graph_notifications SET "
                    . "name = '" . $name . "', "
                    . "message = '" . $message . "', "
                    . "db_name = '" . $db_name . "', "
                    . "sql_command = '" . str_replace("'","\'",$sql_command) . "', "
                    . "company = '".$company."'"
                    . " WHERE id = '" . $id . "'";

            Connection::$mysqli->query($sql);

            Ajax::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows > 0) ? '' : (Ajax::$result['error'] = true);

            return json_encode(Ajax::$result);
        } catch (Exception $e) {

            Ajax::$result['error'] = true;

            return json_encode(Ajax::$result);
        }
    }
    
    public static function delete($id, $del=1) {
        try {
            
            
            $sql = "UPDATE graph_notifications SET isdeleted = '".$del."' WHERE id = '" . $id . "'";

            Connection::$mysqli->query($sql);

            Ajax::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows > 0) ? '' : (Ajax::$result['error'] = true);

            return json_encode(Ajax::$result);
        } catch (Exception $e) {

            Ajax::$result['error'] = true;

            return json_encode(Ajax::$result);
        }
    }

    public static function activate($id) {
        return self::delete($id, 0);
    }
    
}

class Serial{
    public static function createSerial(){
        $serials = self::selectAllSerials();
        do {
            $serial = rand(1000, 9999) . rand(100, 999) . rand(100, 999);
        }while(in_array($serial, $serials));
        
        return Serial::insertNewSerial($serial);
    }
    
    private static function selectAllSerials(){
        try {
             $sql = "SELECT serial FROM serials";

            $serials = Array();
            if ($result = Connection::$mysqli->query($sql)) {
                while ($serial = $result->fetch_assoc()) {
                    $serials[] = $serial['serial'];
                }
                $result->free();
            }
            
            return $serials;
            
        } catch (Exception $e) {
            self::$result['error'] = true;
            return Array();
        }
    }
    
    private static function insertNewSerial($serial) {
        try {
            
            $sql = "INSERT INTO serials(serial, creation_date) "
                    . "VALUES ('" . $serial . "', CURDATE())";
            //echo $sql;
            Connection::$mysqli->query($sql);
            Ajax::$result['data'] = Connection::$mysqli->insert_id;
            Ajax::$result['serial'] = $serial;
            Connection::$mysqli->insert_id ? '' : (Ajax::$result['error'] = true);
            return json_encode(Ajax::$result);
        } catch (Exception $e) {
            Ajax::errorLog($e);
            Ajax::$result['error'] = true;
            return json_encode(Ajax::$result);
        }
    }

    public static function selectSerial($id) {
        try {
            $sql = "SELECT * FROM `serials` WHERE `id` = '".$id."'";
            //echo $sql;
            $serials = '';
            if ($result = Connection::$mysqli->query($sql)) {
                $serials = $result->fetch_assoc();
                $result->free();
            }
            
            
            Ajax::$result['data'] = $serials;
            
            return json_encode(Ajax::$result);
            
        } catch (Exception $e) {
            Ajax::$result['error'] = true;
            return json_encode(Ajax::$result);
        }
    }
    
    public static function updateSerial($id, $distributor, $subdistributor, $status, $customer=0){
        try {
            $sql = "UPDATE serials SET "
                    . "distributor = '" . $distributor . "', "
                    . "subdistributor = '" . $subdistributor . "', "
                    . "status = '".$status."', "
                    . "customer = '".$customer."'"
                    . " WHERE id = '" . $id . "'";

            Connection::$mysqli->query($sql);

            Ajax::$result['data'] = Connection::$mysqli->affected_rows;

            (Connection::$mysqli->affected_rows > 0) ? '' : (Ajax::$result['error'] = true);

            return json_encode(Ajax::$result);
        } catch (Exception $e) {

            Ajax::$result['error'] = true;

            return json_encode(Ajax::$result);
        }
    }

}