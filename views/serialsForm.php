<?php 
    $hidden = (Main::$user->type == 4) ? " style='display: none' " : "";
?>

<div id="new-serial" style="">
    
        <a id="closeNewSerial" class="declineButton" href="javascript:none();"><?php echo $btn['close']; ?></a>&nbsp;
        <a id="saveNewSerial" class="primaryButton" href="javascript:none();"><?php echo $btn['save']; ?></a>&nbsp;
        <!--<a id="updateSerial" class="primaryButton" href="javascript:none();">UPDATE</a>&nbsp;-->
        <div>
            <div <?php echo $hidden; ?>>
                <label for="distributors-select"><?php echo $licence['distributor']; ?></label>
                <select name="distributors-select" id="distributors-select">
                    <?php echo DistributorsPage::$distributorsSelectList; ?>
                </select>
                <input type="text" hidden name="serial-id" id="serial-id">
            </div>
            
            <div>
                <label for="distributors-select"><?php echo $licence['subdistributor']; ?></label>
                <select name="subdistributors-select" id="subdistributors-select">
                    <?php echo DistributorsPage::$subdistributorsSelectList; ?>
                </select>
            </div>
            
            <div>
                <label for="customers-select"><?php echo $licence['customer']; ?></label>
                <select name="customers-select" id="customers-select">
                    <?php echo CompanyPage::$customersSelectList; ?>
                </select>
            </div>


            <div>
                <label for="statuses-select"><?php echo $licence['status']; ?></label>
                <select name="statuses-select" id="statuses-select">
                    <?php echo SerialsPage::$statusesSelectList; ?>
                </select>
            </div>
        </div>
    
</div>
<?php if(Main::$user->type == 1){ ?>

<p>
    <a id="createNewSerial" class="primaryButton" href="javascript:none();"><?php echo $licence['createNewLicense']; ?></a>
</p>

<?php } ?>

<table id="serials-list" class="content-table">
    <thead>
        <tr>
            <th><?php echo $licence['license']; ?></th>
            <th><?php echo $licence['distributor']; ?></th>
            <th><?php echo $licence['subdistributor']; ?></th>
            <th><?php echo $licence['customer']; ?></th>
            <th><?php echo $licence['status']; ?></th>
        </tr>
    </thead>
    <tbody>
        <?php echo SerialsPage::$serialsLayout; ?>
    </tbody>
</table>

<script src="js/serials.js"></script>