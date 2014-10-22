<div style="display: none;" id="dc-help-dialog">
    <p>Please check if direct connection will be used and put direct link below!</p>
    <p><i>Example: </i>230.240.56.22/fetching.php</p>
    <p>Other way - put server ip address.<p/>
    <p><i>Example: </i>230.240.56.22</p>
    
    <p>Installing "direct connection":</p>
    <div class="accordion">
        <h3>1. Download .rar</h3>
        <div><a style="text-decoration: underline;" href="http://mobilerpt.com/service/files/mobile.rar">Download</a></div>
    </div>
    <div class="accordion">
        <h3>2. Unpack this archive in some temporary folder on your computer</h3>
    </div>
    
    <div class="accordion">
        <h3>3. Install "wampserver2.2d-x32.exe"</h3>
        <div>
            <div>3.1  launch it to start the installation process</div>
            <br />
            <div>
                <img src="img/install/wamp1.jpg" width="500" />
            </div>
            <br />
            <div>3.2 When you click next you will be asked to accept the license agreement. Since it is a GPL license you are free to do just about anything with it so you can go ahead and accept.
                The next step requires you to select the folder where you would like to install your WAMP server. The default will be c:\wamp however you can change this to install the server into any directory or partition you choose.</div>
            <br />
            <div>
                <img src="img/install/wamp2.png" width="500" />
            </div>
            <br />
            <div>
                3.3 Once the installation runs its course you will be asked to choose your default browser. Internet Explorer is the default choice but you can navigate your way to any other browser of your choosing.
            </div>
            <br />
            <div>3.4 if your Windows firewall pops up at this point make sure to grant Apache access</div>
            <br />
            <div>
                <img src="img/install/wamp3.png"  width="500"/>
            </div>
            <br />
            <div>3.5 The next decision you will have to make is to set the PHP mail parameters. Many people leave this set to the defaults when setting up a testing server on their local computer. If you wish to configure it to connect to your SMTP server you may do so here but unless you plan on testing email capabilities the default entries can be left and all you need to do is click Next</div>
            <br />
            <div>
                <img src="img/install/wamp4.png" width="500" />
            </div>
            <br />
            <div>
                3.6 Using one of the icons you created, or Start –> All Programs –> WampServer –> start WampServer, you can launch the management console. Once opened, it will appear in the lower right hand corner of your screen.
            </div>
            <br />
            <div>
                <img src="img/install/wamp5.png" />
            </div>
            <br />
            <div>
                f WAMP is not started go ahead and click Start All Services. If you are not sure whether or not WAMP is running, look for the small green W icon in your toolbar. If it is red, WAMP services are stopped, green means everything is running while orange means some services are running.

Now we want to test to see if everything was installed correctly. Open browser and type http://localhost - you must see "Wamp Server Page". If you see the following screen pop up in your browser then everything is working!
            </div>
            <br />
            <div>
                <img src="img/install/wamp6.png" width="500" />
            </div>
            
        </div>
    </div> 
    <div class="accordion">
        <h3>4. Installing "db_lib.dll"</h3>
        <div>
            <p>
                4.1 Open instalation_path/bin/php/php5.3.10/ext ("C:/wamp/bin/php/php5.3.10/ext")
            </p>
            <p>
                4.2 Copy "php_dblib.dll" into that folder
            </p>
            <p>
                4.3 Click on server tray icon -> PHP -> php.ini
            </p>
            <p>
                4.4 Find "extension" part and uncoment ";extension=php_curl.dll" => "extension=php_curl.dll"
            </p>
            <p>
                4.5 Add line "extension=php_dblib.dll" after "extension part" and close with saving
            </p>
            <p>
                4.6 Click on server tray icon and "restart all services"
            </p>
            <p>
                4.7 After tray icon became green click -> "Put Online"(server will restart again)
            </p>
            <p>
                4.8 Open browser and type http://98.132.15.21 where "98.132.15.21" => your external ip address, if everything is correct you will see "Wamp Server Page"
            </p>
        </div>
    </div>
    <div class="accordion">
        <h3>5. Installing "direct connection scripts"</h3>
        <div>
            <p>
                5.1 Go to instalation_path/www ("C:/wamp/www") and create some folder(ex. "mobile") 
            </p>
            <p>
                5.2 Copy "index.php" and "lib" folder into created folder ("C:/wamp/www/mobile")
            </p>
            <p>
                5.3 Open lib/settings.php in notepad ("C:/wamp/www/mobile/lib/settings.php") and change host, login and password
            </p>
            <p>
                5.4 Connection string will look like 98.132.15.21/mobile/index.php without "http://"
            </p>
            <p>
                5.5 If everything is correct you will see "Connection established"
            </p>
            <p>
                5.6 If you see "Cant connect to server" - it means you have incorrect login or password in settings.php file
            </p>
       </div>
    </div>
</div>

<form method="post" action="#">    
    <fieldset>
        <legend>Company information</legend>
        <div class="admin-create">
            <p>
                <a id="saveCompany" href="javascript:none();" class="primaryButton">SAVE</a>
            </p>
            <input type="text" hidden id="com-id" value="<?php echo Main::$user->id; ?>">
            <div class="editor-field">
                <div class="editor-label">
                    <?php echo $companies['companyName']; ?>
                </div>
                <input required type="text" id="com-name" class="text-box single-line" value="<?php echo Main::$user->company; ?>">
            </div>

            <div class="editor-field">
                <div class="editor-label" style='width: 70%'>
                    IP ADDRESS
                    <span class="dc-help"><img src="img/info.png" width="18" height="18" /></span>
                    <?php
                        $check =  (Main::$user->direct_connection != 0) ? 'checked="checked"' : '';
                    ?>
                    <input id='direct-connection' type='checkbox' <?php echo $check; ?> class="text-box" />
                </div>
                
                
                <input required type="text" id="com-ipaddress" class="text-box single-line" value="<?php echo Main::$user->ip; ?>">
                
                
            </div>
            
            <div class="editor-field">
                <div class="editor-label">
                    <?php echo $companies['dbUserName']; ?>
                </div>
                <input required type="text" id="com-dbusername" class="text-box single-line" value="<?php echo Main::$user->db_username; ?>">
            </div>
            
            <div class="editor-field">
                <div class="editor-label">
                    <?php echo $companies['dbPassword']; ?>
                </div>
                <input type="password" id="com-dbpassword" class="text-box single-line" value="">
            </div>
            
            <div class="editor-field">
                <div class="editor-label">
                    <?php echo $companies['login']; ?>
                </div>
                <input required type="text" id="com-login" class="text-box single-line" value="<?php echo Main::$user->login; ?>">
            </div>
            
            <div class="editor-field">
                <div class="editor-label">
                    <?php echo $companies['password']; ?>
                </div>
                <input type="password" id="com-password" class="text-box single-line" value="">
            </div>

            
         <script src="js/company.js"></script>   
        </div>
    </fieldset>
</form>