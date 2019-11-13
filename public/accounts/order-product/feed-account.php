<?php require_once('../../../private/initialize.php');  ?>
<?php

    
    $failure_message = null;

    if (is_post_request()) {
        $account_id= $_POST['account'] ?? '';
        $amount = (double)$_POST['amount'] ?? '';
    
        /* account_id, person_id, ";
            $sql .= "amount, issued_date) ";*/
        if (!is_blank($account_id) && !is_blank($amount)) {
            $transaction = [];
            $transaction['account_id'] = $account_id;
            $transaction['amount'] = $amount;
            $transaction['bank_card_id'] = null;
            $transaction['issued_date'] = date("Y-m-d");
            $transaction['description'] = "ADD MOMEY";
            $transaction['transaction_type'] = "ADD MONEY ACCOUNT";
    
            $supply_account = [];
            $supply_account['account_id'] = $account_id;
            $supply_account['person_id'] = $_SESSION['person_id'];
            $supply_account['amount'] = $amount;
            $supply_account['issued_date'] = date("Y-m-d");
    
            $result1 = Account_Repository::add_money_to_account($account_id, $amount);
            $result2 = Transaction_Repository::insert($transaction);
            $result3 = Supply_Account_Repository::insert($supply_account);

            if (($result1 && $result2) && $result3) {
                $_SESSION['succeed_message'] = "The money has been added to your account succeessffuly.";
                redirect_to(url_for('/accounts/home/index.php'));
            } else {
                $_SESSION['failure_message'] = "You can add money to your account Please try again.";
                redirect_to(url_for('/accounts/home/index.php'));
            }
        } else {
            $_SESSION['failure_message'] = "You can add money to your account Please try again.";
            redirect_to(url_for('/accounts/home/index.php'));
        }
    } else {
        redirect_to(url_for('/accounts/home/index.php'));
    }


?>