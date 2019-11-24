<article class="block-article">
    <header>
        <div class="row">
            <span>Overview of your wealth</span>
        </div>

    </header>
    <div class="main-content"> 
        <?php
            $accounts_set = Account_Repository::find_accounts_by_iban_id($_SESSION['iban_id']);
            $total = 0.0;
        ?>
        <?php while ($account = $accounts_set->fetch_assoc()) { ?>
            <?php
                $account_type = Account_type_Repository::get_by_id($account['account_type_id']);
                $total = $account['balance'] + $total;
            ?>
           <div class="row-item border-top">
                <div class="col-1">
                    <span><?php echo $account_type['type_name'];?></span>
                </div>
                <div class="col-2">
                    <span>CHF <?php echo get_formatted_balance($account['balance']);?></span>
                </div>
            </div>
        <?php  }?>
        <div class="row-item border-top">
            <div class="col-1">
                <span>Total</span>
            </div>
            <div class="col-2">
                <span>CHF <?php echo get_formatted_balance(number_format($total, 2));?></span>
            </div>
        </div>
    </div>
    <footer>
        <a class="btn-article" href="#">Wealth detail</a>
    </footer>
</article>