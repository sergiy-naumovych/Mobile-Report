<?php

final class MainPage{
    static function init() {
        self::setCategoryPage();
        self::setCompanyPage();
        self::setContentPage();
        self::setDistributorsPage();
        self::setSerialsPage();
        self::setNotificationsPage();
        self::showLayout();
    }
    /*
     *initialization of creating company form 
     **/
    function setCopanyPage(){
        
    }
    
    static function setCategoryPage() {
        CategoryPage::init();
    }
    
    public static function setCompanyPage() {
        CompanyPage::init();
    }
    
    public static function setDistributorsPage() {
        DistributorsPage::init();
    }
    public static function setSerialsPage() {
        SerialsPage::init();
    }
    
    static function showLayout(){
        include_once Main::$library;
        include_once 'views/settings.php';
    }

    public static function setContentPage() {
        ContentPage::init();
    }

    public static function setNotificationsPage() {
        NotificationsPage::init();
    }

}