<article class="block-article">
    <form action="" method="post">
        <header>
            <div class="row">
                <span>Order product</span>
            </div>

        </header>
        <div class="main-content"> 
            
            <div class="row-transfer">
                <div>
                    <ul class="ul-list-inline">
                        <li class="li-item-inline">
                            <a id="add-money-account" class="btn-article link-order-article btn-left" href="javascript:void(0)">Account add money</a>
                        </li>
                        <li class="li-item-inline">
                            <a class="btn-article link-order-article btn-right" href="#";>Card add money</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <ul class="ul-list-inline">
                        <li class="li-item-inline">
                            <a class="btn-article link-order-article btn-left" href="#">New account</a>
                        </li>
                        <li class="li-item-inline">
                            <a class="btn-article link-order-article btn-right" href="#">New card</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <footer>
        </footer>
    </form>
</article>
<div id="modal-backdrop">
</div>
<article class="block-article modal-dialog" id="add-money-account-dialog-form">
    <form id="form-add-money-account" action="<?php echo url_for('/accounts/order-product/feed-account.php'); ?>" method="post">
        <header>
            <div class="row"><span>Add money to Account</span></div>
        </header>
        <div class="main-content">
            <div class="row-item">
                <label for="account">Select an account to add money</label>
            </div>
            <div class="row-item form-select">
                <select name="account" class="input-select" style="padding: 11px 8px 8px 15px;" >
                <?php $accounts_set = Account_Repository::find_accounts_by_iban_id($_SESSION['iban_id']);?>
                    <?php while ($account = $accounts_set->fetch_assoc()) { ?>
                        <option  value="<?php echo $account['account_id']; ?>">
                            <?php $account_type = Account_type_Repository::get_by_id($account['account_type_id']); ?>
                            <?php echo $account_type['type_name'] . " " . "CHF " . $account['balance'] ?>
                        </option>
                    <?php  }?>
                </select>
            </div>
            <div class="row-item form-amount-currency">
                <input type="number" name="amount" id="input-amount-add-money-account" class="input input-article" placeholder="Amount">
                <span class="input-focus-border"></span>
            </div>
            <div class="row-item row-error">
                <span id="error-input-amount-add-money-account"></span>
            </div>
        </div>
        <footer>
            <input id="cancel" class="btn-article btn-cancel-article" type="submit" value="Cancel">
            <input id="btn-add-money-account" class="btn-article" type="submit" value="Submit">
        </footer>
    </form>
</article>
