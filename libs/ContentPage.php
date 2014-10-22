<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContentPage
 *
 * @author SERGE
 */
final class ContentPage {

    public static $images = Array();
    public static $contentLayout;

    public static function init() {
        self::setImagesList();
        self::setContentLayout();
    }

    public static function setImagesList() {
        $sql = "SELECT 
                   *
                FROM 
                    graph_images";


        if ($result = Connection::$mysqli->query($sql)) {

            while ($image = $result->fetch_assoc()) {
                self::$images[] = $image;
            }
            $result->free();
        }
    }

    public static function setContentLayout() {
        foreach (self::$images as $key => $image) {
            self::$contentLayout .= '<div class="addiconContainer" data-id="' . $image['id'] . '">' .
                        '<div class="addicon filebox">' .
                            '<img src="http://'.$_SERVER['SERVER_NAME'].URL.'/uploader/files/thumbnail/' . $image['name'] . '">' .
                        '</div>' .
                        '<div data-picturetype="LogoImage512x512" data-name="' . $image['name'] . '" data-id="' . $image['id'] . '" class="addiconTrash"></div>' .
                    '</div>';
        }
    }

}
