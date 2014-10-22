<?php

class CompanyPage {

    public static $companies = Array();
    public static $companiesLayout;
    public static $customersSelectList;

    public static function init() {
        self::setCompaniesList();
        self::setCompaniesLayout();
        self::setCustomersSelectList();
    }

    public static function setCompaniesList() {
        $sql = "SELECT 
                   *
                FROM 
                    users
                WHERE
                    (type = 1
                OR 
                    type = 2)";
        
        if(Main::$user->type != 1) {
            $sql .= " AND (creator ='".Main::$user->id."')  OR id = '".Main::$user->id."' ";
        }


        if ($result = Connection::$mysqli->query($sql)) {

            while ($company = $result->fetch_assoc()) {
                self::$companies[] = $company;
            }
            $result->free();
        }
    }

    public static function setCompaniesLayout() {
        foreach (self::$companies as $key => $company) {
            $del = $company['isdeleted'] == 1 ? 'activate' : 'delete';
            $del = ($company['id'] == Main::$user->id) ? "" : $del;
            $img = $company['isdeleted'] == 1 ? 'img/cancel.png' : 'img/accept.png';
            self::$companiesLayout .= '<tr class="company" data-id="'.$company['id'].'">' .
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
    
    public static function setCustomersSelectList() {
        self::$customersSelectList .= "<option value='0'> </option>";
       
        
        foreach (self::$companies as $key => $dist) {
            if($dist['id'] != Main::$user->id)
                self::$customersSelectList .= "<option value='".$dist['id']."'>".$dist['comp_name']."</option>";
       }
    }

 }