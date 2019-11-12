<article class="block-article">
    <form action="" method="post">
        <header>
            <div class="row">
                <span>One-time transfer</span>
            </div>

        </header>
        <div class="main-content"> 
            
            <div class="row-item row-transfer">
                <div class="form-select">
                    <div class="inside-select-label">
                        from
                    </div>
                    <select name="from" class="input-select" id="select-from-immediate-transfer" onchange="javascript:changeFromToSelectInImmediateTransfer()">
                        <?php $accounts_set = Account_Repository::find_accounts_by_iban_id($_SESSION['iban_id']);?>
                        <?php while ($account = $accounts_set->fetch_assoc()) { ?>
                            <option class="option-list"  value="<?php echo $account['account_id']; ?>">
                                <?php $account_type = Account_type_Repository::get_by_id($account['account_type_id']); ?>
                                <?php echo $account_type['type_name'] . " " . "CHF " . $account['balance'] ?>
                            </option>
                        <?php  }?>
                    </select>
                </div>
                    
            </div>
            <div class="row-item row-transfer">
                <div class="form-select">
                    <div class="inside-select-label">
                        to
                    </div>
                    <select name="to" class="input-select" id="select-to-immediate-transfer" onchange="javascript:changeFromToSelectInImmediateTransfer()">
                        <?php $accounts_set = Account_Repository::find_accounts_by_iban_id($_SESSION['iban_id']);?>
                        <?php while ($account = $accounts_set->fetch_assoc()) { ?>
                            <option class="option-list"  value="<?php echo $account['account_id']; ?>">
                                <?php $account_type = Account_type_Repository::get_by_id($account['account_type_id']); ?>
                                <?php echo $account_type['type_name'] . " " . "CHF " . $account['balance'] ?>
                            </option>
                        <?php  }?>
                    </select>
                </div>
                    
            </div>
            <div class="row-item row-transfer form-amount-currency">
                    <input type="number" class="input input-article" placeholder="Amount">
                    <span class="input-focus-border"></span>
            </div>

        </div>
        <footer>
            <a class="btn-article" href="#">Transfer now</a>
        </footer>
    </form>
</article>