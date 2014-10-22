<div id="new-company" style="">
    
        <a id="closeNewCompany" class="declineButton" href="javascript:none();"><?php echo $btn['close']; ?></a>&nbsp;
        <a id="saveNewCompany" class="primaryButton" href="javascript:none();"><?php echo $btn['save']; ?></a>&nbsp;
        <a id="updateCompany" class="primaryButton" href="javascript:none();"><?php echo $btn['update']; ?></a>&nbsp;
        <div>
            <div>
                <label for="company-name"><?php echo $companies['companyName']; ?></label>
                <input type="text" required name="company-name" id="company-name">
                <input type="text" hidden name="company-id" id="company-id">
            </div>

            <div>
                <label for="company-login"><?php echo $companies['login']; ?></label>
                <input type="text" required name="company-login" id="company-login">
            </div>

            <div>
                <label for="company-password"><?php echo $companies['password']; ?></label>
                <input type="password" required name="company-password" id="company-password">
            </div>
        </div>
    
</div>

<p>
    <a id="createNewCompany" class="primaryButton" href="javascript:none();">CREATE NEW COMPANY</a>
</p>

<table id="companies-list" class="content-table">
    <thead>
        <tr>
            <th><?php echo $companies['companyName']; ?></th>
            <th><?php echo $companies['action']; ?></th>
            <th><?php echo $companies['status']; ?></th>
        </tr>
    </thead>
    <tbody>
        <?php echo CompanyPage::$companiesLayout; ?>
    </tbody>
</table>