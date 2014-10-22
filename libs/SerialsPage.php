<?php
/**
 * Description of DistributorsPage
 *
 * @author Matrix
 */
class SerialsPage {
    
    /**
     * <b>Description:</b> 
     *  Array of serials for current user taken from the database
     * @var Array
     */
    public static $serials = Array();
    /**
     *
     * @var type 
     */
    public static $serialsLayout;
    public static $statusesSelectList = "";

    public static function init() {
        self::setSerialsList();
        self::setStatusesSelectList();
        self::setSerialsLayout();
    }

    public static function setSerialsList() {
        $sql = "SELECT 
                  s.id, 
                  s.serial, 
                  s.distributor AS dist,
                  s.subdistributor AS subdist,
                  s.status AS st,
                  s.customer AS cust,
                  u.comp_name AS subdistributor, 
                  us.comp_name AS distributor, 
                  st.name AS status,
                  users.comp_name AS customer
                FROM 
                    serials AS s
                LEFT JOIN
                    users AS u
                ON 
                    s.subdistributor = u.id
                LEFT JOIN
                    users AS us
                ON
                    s.distributor = us.id
                LEFT JOIN
                    status AS st
                ON
                    s.status = st.id
                LEFT JOIN
                    users AS users
                ON
                    s.customer = users.id";
        
        switch (Main::$user->type) {
            case 3:
                $sql .= " WHERE distributor = '".Main::$user->id."'";
                break;
            case 4:
                $sql .= " WHERE subdistributor = '".Main::$user->id."'";
                break;
            default:
                break;
        }
        
        if ($result = Connection::$mysqli->query($sql)) {

            while ($serial = $result->fetch_assoc()) {
                self::$serials[] = $serial;
            }
            $result->free();
        }
    }

    public static function setSerialsLayout() {
        foreach (self::$serials as $key => $serial) {
            self::$serialsLayout .= '<tr class="serial" data-id="'.$serial['id'].'">' .
                            '<td>' .
                                '<strong>'.$serial['serial'].'</strong>' .
                            '</td>' .
                            '<td class="sdistributor" data-id="'.$serial['dist'].'">' .
                                '<strong>'.$serial['distributor'].'</strong>' .
                            '</td>' .
                            '<td class="ssubdistributor" data-id="'.$serial['subdist'].'">' .
                                '<strong>'.$serial['subdistributor'].'</strong>' .
                            '</td>' .
                            '<td class="scustomer" data-id="'.$serial['cust'].'">' .
                                '<strong>'.$serial['customer'].'</strong>' .
                            '</td>' .
                            '<td class="sstatus" data-id="'.$serial['st'].'">' .
                                '<strong>'.$serial['status'].'</strong>' .
                            '</td>' .
                        '</tr>';
        }
    }
    
    public static function setStatusesSelectList() {
        $sql = "SELECT 
                    id,
                  name
                FROM 
                    status";
        
        if ($result = Connection::$mysqli->query($sql)) {
            $statuses = Array();
            while ($status = $result->fetch_assoc()) {
                $stuses[] = $status;
            }
            $result->free();
            self::setStatusesLayout($stuses);
        }
    }

    public static function setStatusesLayout($stuses) {
        foreach ($stuses as $key => $value) {
            self::$statusesSelectList .= "<option value='".$value['id']."'>".$value['name']."</option>";
        }
        
    }

}
