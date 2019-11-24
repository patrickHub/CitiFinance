<article class="block-article">
    <form action="" method="post">
        <header>
            <div class="row">
                <span>Transactions</span>
            </div>

        </header>
        <div class="main-content"> 
            
            <div class="row-item row-transaction">
                <?php
                    $account_set = Account_Repository::find_accounts_by_iban_id($_SESSION['iban_id']);
                    $iban = Iban_Repository::get_by_id($_SESSION['iban_id']);
                    $checking_account = null;
                ?>
                <?php while ($account = $account_set->fetch_assoc()) {
                    $account_type = Account_type_Repository::get_by_id($account['account_type_id']);
                    if ($account_type['type_name'] == "Checking account") {
                        $checking_account = $account;
                        break;
                    }
                }?>
                <span><strong>Checking Accounts</strong></span>
                <span><strong><?php echo $checking_account['account_number']; ?></strong></span>
            </div>
            <div class="row-item row-transaction border-bottom">
                <span><strong><?php echo $iban['iban_number']; ?></strong></span>
            </div>
            <?php
                $transaction_set = Transaction_Repository::find_transaction_by_account_id($checking_account['account_id']);
                $transaction_types = ['TRANSFER-CREDIT', 'ADD MONEY ACCOUNT'];
            ?>
            <?php
                if ($transaction_set->num_rows === 0) { ?>
                
                <div class="row-item row-transaction row-empty-message flex">
                    <span>Not available transaction</span>
                </div>  
                <?php
                } else {
                    while ($transaction = $transaction_set->fetch_assoc()) { ?>
                        <div class="row-item row-transaction border-bottom">
                            <a href="#">
                                <span><?php  echo $transaction['description']; ?> OF <?php  echo $transaction['issued_date']; ?>  </span>
                                <span> <?php  echo "CHF " . $transaction['amount']; ?> <?php echo in_array($transaction['transaction_type'], $transaction_types)? '+':'-'; ?></span>
                            </a>
                        </div>
            <?php
                        }
                }
            ?>


        </div>
        <footer>
            <?php
                if ($transaction_set->num_rows !== 0) { ?>
                    <a class="item-link" href="#">And more</a>
            <?php
                }
            ?>
        </footer>
    </form>
</article>