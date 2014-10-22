<?php

final class CategoryPage {
    public static $categories = Array();
    
    public static $categoriesLayout;

    public static function init() {
        self::setCategoriesList();
        self::setGraphList();
        self::setCategoriesLayout();
    }
    
    public static function setCategoriesList(){
        $company = Main::$user->id;

        $sql = "SELECT 
                   *
                FROM 
                    graph_group
                WHERE
                    comp_id = '" . $company . "'";

        
        if ($result = Connection::$mysqli->query($sql)) {

            while ($category = $result->fetch_assoc()) {
                self::$categories[] = $category;
            }
            $result->free();
        }
    }
    
    public static function getGraphList($category) {
        
        $sql = "SELECT 
                   *
                FROM 
                    graph
                WHERE
                    comp_id = '".Main::$user->id."'
                AND
                    graph_group_id = '".$category."'";
       
       if($result = Connection::$mysqli->query($sql)){
            $graphs = array();
            while($graph = $result->fetch_assoc()){
                $graphs[] = $graph;
            }
            $result->free();
       }

        return $graphs ? $graphs : false; 
    }

    public static function setGraphList() {
        foreach (self::$categories as $key => $category) {
            self::$categories[$key]['graph'] = self::getGraphList($category['id']);
        }
    }

    public static function setCategoriesLayout() {
        foreach (self::$categories as $key => $category) {
            $icon = ($category['isdeleted'] == 0) ? 'img/accept.png' : 'img/cancel.png';
            self::$categoriesLayout .= '<li class="category" data-online="'.$category['isdeleted'].'" data-id="'.$category['id'].'">' .
                '<div class="content-page-title">' .
                    '<img src="'.$icon.'" class="is-online" align="right">' .
                    '<img src="http://d3mls36nlzebui.cloudfront.net/img/text_area.png" alt="icon" align="absbottom">' .
                    '<span class="page-title-span"> '.$category['group_name'].'</span>' .
                '</div>' .
                '<ol>' .
                self::setGraphLayout($category['graph']) .
                '</ol>' .
            '</li>';
            self::$categories[$key]['graph'] = self::getGraphList($category['id']);
        }
    }
    
    public static function setGraphLayout($graph){
        if(!$graph)
            return '';
        $res = '';
        foreach ($graph as $key => $value) {
            $icon = ($value['isdeleted'] == 0) ? 'img/accept.png' : 'img/cancel.png';
            $res .= '<li class="graph" data-online="'.$value['isdeleted'].'" data-id="'.$value['id'].'">' .
                        '<div class="content-page-title">' .
                            '<img src="'.$icon.'" class="is-online" align="right">' .
                            '<img src="http://d3mls36nlzebui.cloudfront.net/img/text_area.png" alt="icon" align="absbottom">' .
                            '<span class="page-title-span"> '.$value['graph_name'].'</span>' .
                        '</div>' .
                        '<ol>' .
                        '</ol>' .
                    '</li>';
        }
        return $res;
    }
}