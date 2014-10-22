<div id="new-distributor" style="">
    
        <a id="closeNewDistributor" class="declineButton" href="javascript:none();"><?php echo $btn['close']; ?></a>&nbsp;
        <a id="saveNewDistributor" class="primaryButton" href="javascript:none();"><?php echo $btn['save']; ?></a>&nbsp;
        <a id="updateDistributor" class="primaryButton" href="javascript:none();"><?php echo $btn['update']; ?></a>&nbsp;
        <div>
            <div>
                <label for="distributor-name"><?php echo $companies['subdistributorName']; ?></label>
                <input type="text" required name="distributor-name" id="distributor-name">
                <input type="text" hidden name="distributor-id" id="distributor-id">
            </div>

            <div>
                <label for="distributor-login"><?php echo $companies['login']; ?></label>
                <input type="text" required name="distributor-login" id="distributor-login">
            </div>

            <div>
                <label for="distributor-password"><?php echo $companies['password']; ?></label>
                <input type="password" required name="distributor-password" id="distributor-password">
            </div>
        </div>
    
</div>

<p>
    <a id="createNewDistributor" class="primaryButton" href="javascript:none();"><?php echo $companies['createNewSubdistributor']; ?></a>
</p>

<table id="distributors-list" class="content-table">
    <thead>
        <tr>
            <th><?php echo $companies['subdistributorName']; ?></th>
            <th><?php echo $companies['action']; ?></th>
            <th><?php echo $companies['status']; ?></th>
        </tr>
    </thead>
    <tbody>
        <?php echo DistributorsPage::$distributorsLayout; ?>
    </tbody>
</table>

<script src="js/distributors.js"></script>