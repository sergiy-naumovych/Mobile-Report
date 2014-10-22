<?php

final class NotificationsPage {

    public static $notifications = Array();
    public static $notificationsLayout;

    public static function init() {
        self::setNotificationsList();
        self::setNotificationsLayout();
    }

    public static function setNotificationsList() {
        $sql = "SELECT 
                   *
                FROM 
                    graph_notifications
                WHERE
                    company = '".Main::$user->id."'";


        if ($result = Connection::$mysqli->query($sql)) {

            while ($notification = $result->fetch_assoc()) {
                self::$notifications[] = $notification;
            }
            $result->free();
        }
    }

    public static function setNotificationsLayout() {
        foreach (self::$notifications as $notification) {
            $img = $notification['isdeleted'] == 1 ? 'img/cancel.png' : 'img/accept.png';
            self::$notificationsLayout .= '<tr class="notification" data-id="'.$notification['id'].'">' .
                            '<td>' .
                                '<strong>'.$notification['name'].'</strong>' .
                            '</td>' .
                            '<td>' .
                                '<img class="is-online" src="'.$img.'">' .
                            '</td>' .
                        '</tr>';
        }
    }
}