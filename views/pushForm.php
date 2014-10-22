<div style="display: none;" id="push-msg-help">
    <p>Message that will be sended to the users if sql command returns positive result (not null)</p>
    <p>You may use result of the sql inside this massage. For this you must define {val} in position where you want to put result in message</p>
    <p><i>Example</i> Message = "Todays sales = {val}"</p>
    <p>Sql = SELECT COUNT(sales) AS val FROM sales WHERE date = CURDATE()</p>
    <p>If result(val) = 5,- message = "Todays sales = 5"</p>
</div>

<div style="display: none;" id="push-sql-help">
    <p>In this sql must be define column with name 'val'. If 'val' will be not null - means result is true and message will be sended to users.
        You may also use the result as a part of a massage. This sql will run every 10 minutes.</p>
    <p>In result set must be only one line!</p>
    <p><i>Example</i>Sql = SELECT COUNT(sales) AS val FROM sales WHERE date = CURDATE()</p>
</div>

<div class="content-left"> 
    <p>
        <a href="javascript:none();" class="primaryButton" id="new-notification"><?php echo $push['createNotification']; ?></a>
    </p>
    <table id="push-list" class="content-table">
        <thead>
            <tr>
                <th><?php echo $push['notificationName']; ?></th>
                <th><?php echo $companies['status']; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php echo NotificationsPage::$notificationsLayout; ?>
        </tbody>
    </table>
</div>   

<div class="content-right">    
    <fieldset>
        <div id="notification-form">
            <p>
                <a href="javascript:none();" class="declineButton" id="close-notification"><?php echo $btn['close']; ?></a>
                <a href="javascript:none();" class="primaryButton" id="create-notification"><?php echo $btn['create']; ?></a>
                <a href="javascript:none();" class="primaryButton" id="update-notification"><?php echo $btn['update']; ?></a>
                <a href="javascript:none();" class="primaryButton" id="activate-notification"><?php echo $btn['activate']; ?></a>
                <a href="javascript:none();" class="declineButton" id="delete-notification"><?php echo $btn['delete']; ?></a>
            </p>
            
            <input hidden type="text" name="push-id" id="push-id">
            
            <label for="push-name"><?php echo $push['notificationName']; ?></label>
            <input required type="text" name="push-name" id="push-name">

            <label for="push-message"><?php echo $push['message']; ?><span class="push-msg-help"><img src="img/info.png" width="18" height="18" /></span></label>
            <input required type="text" name="push-message" id="push-message">
            
            <label for="push-db"><?php echo $push['dbName']; ?></label>
            <input required type="text" name="push-db" id="push-db">

            <label for="push-sql"><?php echo $push['sql']; ?><span class="push-sql-help"><img src="img/info.png" width="18" height="18" /></span></label>
            <textarea required type="text" name="push-sql" id="push-sql"></textarea>
            
        </div>
    </fieldset>
</div>   
<script src="js/notifications.js"></script>  