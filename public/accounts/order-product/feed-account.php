<?php require_once('../../../private/initialize.php');  ?>
<?php

    
    $failure_message = null;

    if (is_post_request()) {
        $account_id = $_POST['account'] ?? '';
        $amount = (double)$_POST['amount'] ?? '';
        if (!is_blank($account_id) && !is_blank($amount)) {
            $result = Account_Repository::add_money_to_account($account_id, $amount);
            if ($result) {
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