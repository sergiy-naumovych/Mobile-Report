<?php
/**
 * Description of DistributorsPage
 *
 * @author Matrix
 */
class DistributorsPage {
    
    public static $distributors = Array();
    public static $distributorsSelectList;
    public static $subdistributorsSelectList;
    public static $distributorsLayout;

    public static function init() {
        self::setDistributorsList();
        self::setDistributorsSelectList();
        if(Main::$user->type == 3) {
             self::setDistLayout();
        } else {
            self::setDistributorsLayout();
        }
        
    }

    public static function setDistributorsList() {
        $sql = "SELECT 
                   *
                FROM 
                    users
                WHERE
                    (type = 3
                OR 
                    type = 4)";

        if(Main::$user->type != 1) {
            $sql .= " AND creator ='".Main::$user->id."'";
        }
        
        if(Main::$user->type == 4) {
            $sql .= " OR id ='".Main::$user->creator."'";
        }
        
        if ($result = Connection::$mysqli->query($sql)) {

            while ($company = $result->fetch_assoc()) {
                self::$distributors[] = $company;
            }
            $result->free();
        }
    }

    public static function setDistributorsLayout() {
        $layout = Array();
        foreach (self::$distributors as $key => $company) {
            if($company['type'] == 3) {
                $del = $company['isdeleted'] == 1 ? 'activate' : 'delete';
                $del = ($company['id'] == Main::$user->id) ? "" : $del;
                $img = $company['isdeleted'] == 1 ? 'img/cancel.png' : 'img/accept.png';
                $layout[$company['id']] = '<tr class="distributor" data-id="'.$company['id'].'">' .
                                '<td>' .
                                    '<strong>'.$company['comp_name'].'</strong>' .
                                '</td>' .
                                '<td>' .
                                    '<a href="javascript:none();" class="'.$del.'">'.$del.'</a>' .
                                '</td>' .
                                '<td>' .
                                    '<img class="is-online" src="'.$img.'">' .
                                '</td>' .
                            '</tr>';
            }
        }
        
       
        foreach(self::$distributors as $key => $company) {
            if($company['type'] == 4) {
                $del = $company['isdeleted'] == 1 ? 'activate' : 'delete';
                $del = ($company['id'] == Main::$user->id) ? "" : $del;
                $img = $company['isdeleted'] == 1 ? 'img/cancel.png' : 'img/accept.png';
                $layout[$company['creator']] .= '<tr class="distributor sub-dist" data-id="'.$company['id'].'">' .
                                '<td>' .
                                    '<strong>'.$company['comp_name'].'</strong>' .
                                '</td>' .
                                '<td>' .
                                    '<a href="javascript:none();" class="'.$del.'">'.$del.'</a>' .
                                '</td>' .
                                '<td>' .
                                    '<img class="is-online" src="'.$img.'">' .
                                '</td>' .
                            '</tr>';
            }
        }
        
         foreach($layout as $value) {
             self::$distributorsLayout .= $value;
         }
        
    }

    public static function setDistributorsSelectList() {
        self::$distributorsSelectList .= "<option value='0'> </option>";
        self::$subdistributorsSelectList .= "<option value='0'> </option>";
        $self = "<option value='".Main::$user->id."'>".Main::$user->company."</option>";
        switch(Main::$user->type) {
            case 3:
                self::$distributorsSelectList .= $self;
                break;
            case 4:
                self::$subdistributorsSelectList .= $self;
                break;
            default:
                break;
        }
        foreach (self::$distributors as $key => $dist) {
            if($dist['isdeleted'] == 0 && $dist['type'] == 3){
                self::$distributorsSelectList .= "<option value='".$dist['id']."'>".$dist['comp_name']."</option>";
            } elseif($dist['isdeleted'] == 0 && $dist['type'] == 4){
                self::$subdistributorsSelectList .= "<option value='".$dist['id']."'>".$dist['comp_name']."</option>";
            }
        }
    }

    public static function setDistLayout() {
        foreach (self::$distributors as $key => $company) {
            
            $del = $company['isdeleted'] == 1 ? 'activate' : 'delete';
            $del = ($company['id'] == Main::$user->id) ? "" : $del;
            $img = $company['isdeleted'] == 1 ? 'img/cancel.png' : 'img/accept.png';
            self::$distributorsLayout .= '<tr class="distributor" data-id="'.$company['id'].'">' .
                            '<td>' .
                                '<strong>'.$company['comp_name'].'</strong>' .
                            '</td>' .
                            '<td>' .
                                '<a href="javascript:none();" class="'.$del.'">'.$del.'</a>' .
                            '</td>' .
                            '<td>' .
                                '<img class="is-online" src="'.$img.'">' .
                            '</td>' .
                        '</tr>';
        }
        
    }

}
