<?php require_once('../../../private/initialize.php');  ?>
<?php

    
    $failure_message = null;

    if (is_post_request()) {
        $from_account_id = $_POST['from'] ?? '';
        $to_account_id = $_POST['to'] ?? '';
        $amount = (double)$_POST['amount'] ?? '';
    
        if (is_blank($from_account_id) || is_blank($to_account_id)) {
            $_SESSION['failure_message'] = "You can not transfer money to your account Please try again.";
            redirect_to(url_for('/accounts/home/index.php'));
        } elseif (round($amount) < 1) {
            $_SESSION['failure_message'] = "You can not transfer less than CHF 1.00 Please try again.";
            redirect_to(url_for('/accounts/home/index.php'));
        } elseif (!has_valid_amount_format(round($amount))) {
            $_SESSION['failure_message'] = "You can transfer money to your account Please try again.";
            redirect_to(url_for('/accounts/home/index.php'));
        } elseif (!has_enough_balance_for_transaction($from_account_id, $amount, ['oper_type'=>'immediate-transfer'])) {
            $_SESSION['failure_message'] = "You don't have enough money to your account to support this transfer Please add money to your account.";
            redirect_to(url_for('/accounts/home/index.php'));
        } else {
            $transaction_from = [];
            $transaction_from['account_id'] = $from_account_id;
            $transaction_from['amount'] = $amount;
            $transaction_from['bank_card_id'] = null;
            $transaction_from['issued_date'] = date("Y-m-d");
            $transaction_from['transaction_type'] = "TRANSFER TO ACCOUNT";

            $transaction_to = [];
            $transaction_to['account_id'] = $to_account_id;
            $transaction_to['amount'] = $amount;
            $transaction_to['bank_card_id'] = null;
            $transaction_to['issued_date'] = date("Y-m-d");
            $transaction_to['transaction_type'] = "ADD MONEY ACCOUNT";

            $messages = get_desc_for_imm_transfer($from_account_id, $to_account_id);

            $transaction_from['description'] = $messages['from'];
            $transaction_to['description'] = $messages['to'];

            Account_Repository::remove_money_from_account($from_account_id, $amount);
            Account_Repository::add_money_to_account($to_account_id, $amount);

            Transaction_Repository::insert($transaction_from);
            Transaction_Repository::insert($transaction_to);
    
            $_SESSION['succeed_message'] = "The money has been transfer to your account succeessffuly.";
            redirect_to(url_for('/accounts/home/index.php'));
        }
    } else {
        redirect_to(url_for('/accounts/home/index.php'));
    }


?>