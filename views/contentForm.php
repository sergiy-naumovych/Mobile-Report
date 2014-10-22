<div id="pictures">
    <table>
        <tbody>
            
            <tr>
                <td>
                    <div class="pictures-form">
                        <label class="primaryButton">
                            <?php echo $btn['add']; ?>
                            <input id="fileupload" type="file" name="files[]" data-url="uploader/" multiple>
                        </label>
                        
                        <div id="progress">
                            <div class="bar" style="width: 0%;"></div>
                        </div>

                        <script src="js/vendor/jquery.ui.widget.js"></script>
                        <script src="js/jquery.iframe-transport.js"></script>
                        <script src="js/jquery.fileupload.js"></script>
                        <script src="js/content.js"></script>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="pictures-list">
                        <?php echo ContentPage::$contentLayout; ?>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>