<?php require_once('../../private/initialize.php'); ?>
<?php $page_title = 'Open account'; ?>

<?php
    $step = $_GET['step'] ?? 1;
    $new_customer_error = false;
    $person = [];
    $person['person_id'] = '';
    $person['first_name'] = '';
    $person['last_name'] = '';
    $person['birthdate'] = '';
    $person['nationality'] = '';
    $person['sex'] = '';
    $person['phone_number'] = '';
    $person['email'] = '';

    $address = [];
    $address['person_id'] = '';
    $address['street'] = '';
    $address['npa'] = '';
    $address['city'] = '';
    $address['country'] = '';
    $address['address_status'] = '';

    $client_auth = [];
    $client_auth['password'] = '';
    $client_auth['confirm_password'] = '';
    $client_auth['nip'] = '';
    $client_auth['person_id'] = '';

    $account  = [];
    $account['iban_id'] = '';
    $account['iban_number'] = '';
    $account['account_number'] = '';
    $account['interest_rate'] = '';
    $account['overdraft'] = '';
    $account['balance'] = '';
    $account['owner_type'] = '';


    $errors = [];
    $general_term_error = '';
    if (is_post_request()) {

        // first step process
        if (isset($_POST['new_customer'])) {
            $new_customer = $_POST['new_customer'];
            if ($new_customer == 'Yes') {
                $_SESSION['new_customer'] = $new_customer;
                $_SESSION['step'] = 2;
                $step = 2;
            } else {
                // redirect_to('login.php');
            }
        } elseif (isset($_SESSION['step']) && $_SESSION['step'] == 2 || isset($_POST['first_name'])) {

            // process informations on the identity of the person
            $person['first_name'] = $_POST['first_name'] ?? '';
            $person['last_name'] = $_POST['last_name'] ?? '';
            $person['birthdate'] = $_POST['birthdate'] ?? '';
            $person['nationality'] = $_POST['nationality'] ?? '';
            $person['sex'] = $_POST['sex'] ?? '';
            $person['phone_number'] = $_POST['phone_number'] ?? '';
            $person['email'] = $_POST['email'] ?? '';

            // check person validity
            $errors = validate_person($person);
            $_SESSION['person'] = $person;
    
            if (empty($errors)) { // no validity errors
                $_SESSION['step'] = 3;
                $step = 3;
            } else { //
                $step = 2;
            }
        } elseif (isset($_SESSION['step']) && $_SESSION['step'] == 3 || isset($_POST['street'])) {
            
            // process informations on the address of the person
            $address['street'] = $_POST['street'] ?? '';
            $address['npa'] = $_POST['npa'] ?? '';
            $address['city'] = $_POST['city'] ?? '';
            $address['country'] = $_POST['country'] ?? '';

            $errors = validate_address($address);
            $_SESSION['address'] = $address;

            if (empty($errors)) {
                $_SESSION['step'] = 4;
                $step = 4;
            } else {
                $step = 3;
            }
        } elseif (isset($_SESSION['step']) && $_SESSION['step'] == 4 || isset($_POST['password'])) {
            
            // process informations on the password of the account
            $client_auth['password'] = $_POST['password'];
            $client_auth['confirm_password'] = $_POST['confirm_password'];

            $errors = validate_client_auth($client_auth);
            $_SESSION['client_auth'] = $client_auth;

            if (empty($errors)) {
                $_SESSION['step'] = 5;
                $step = 5;
            } else {
                $step = 4;
            }
        } elseif (isset($_SESSION['step']) && $_SESSION['step'] == 5 || isset($_POST['overdraft'])) {
            
            // process informations on the individual account
            $account['overdraft'] = $_POST['overdraft'];

            $errors = validate_account($account);
            $_SESSION['account'] = $account;

            if (empty($errors)) {
                $_SESSION['step'] = 6;
                $step = 6;
            } else {
                $step = 5;
            }
        } elseif (isset($_SESSION['step']) && $_SESSION['step'] == 6 || isset($_POST['terms_conditions'])) {
            
            // sommarize information on individual account
            $terms_conditions = $_POST['terms_conditions'] ?? '';

            if ($terms_conditions == 'Yes') {
                $_SESSION['terms_conditions'] = 'Yes';
                redirect_to(url_for('/accounts/open-individual-account-confirmation.php'));
            } else {
                $general_term_error = 'Please you need to accept the generals terms and conditions';
                $step = 6;
            }
        } else {
            $new_customer_error = true;
            $step = 1;
        }
    } else {
        // it is a get request
        if ($step > 1 && !isset($_SESSION['step'])) {
            redirect_to(url_for('/accounts/open-individual-account.php?step=1'));
        }
    }

    
?>


<!-- header -->
<?php include_once(SHARED_PATH . '/public_header.php');?>
<main>

    <!-- Title -->
   <?php  include_once('open-individual-account-title.php'); ?>
    
    <?php
        if ($step == 1) {
            include_once('open-individual-account-step-1.php');
        } elseif ($step == 2 && isset($_SESSION['new_customer'])) {
            include_once('open-individual-account-step-2.php');
        } elseif ($step == 3 && isset($_SESSION['person'])) {
            include_once('open-individual-account-step-3.php');
        } elseif ($step == 4 && isset($_SESSION['address'])) {
            include_once('open-individual-account-step-4.php');
        } elseif ($step == 5 && isset($_SESSION['client_auth'])) {
            include_once('open-individual-account-step-5.php');
        } elseif ($step == 6 && isset($_SESSION['account'])) {
            include_once('open-individual-account-step-6.php');
        }
    ?>
</main>




<!-- footer -->
<?php include_once(SHARED_PATH . '/public_footer.php');?>


