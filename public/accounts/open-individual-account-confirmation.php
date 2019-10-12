<?php require_once('../../private/initialize.php'); ?>
<?php $page_title = "Open account"; ?>

<?php
   if (isset($_SESSION['terms_conditions']) && isset($_SESSION['person'])) {
       $step = 7;

       // get input data from session
       $person = $_SESSION['person'];
       $address = $_SESSION['address'];
       $client_auth = $_SESSION['client_auth'];
       $account = $_SESSION['account'];
       $iban = [];
       $individual = [];

       // generate data
       $client_auth['nip'] = generate_nip();
       $iban['iban_number'] = generate_iban_number();
       $account['account_number'] = generate_account_number();
       $account['interest_rate'] = generate_interest_rate($account['overdraft']);

       // save objects to db
       Person_Repository::insert($person);
       $person['person_id'] = $db->insert_id;

       $address['person_id'] = $person['person_id'] ;
       $address['address_status'] = 'Principal';
       Address_Repository::insert($address);

       $client_auth['person_id'] = $person['person_id'];
       Client_Auth_Repository::insert($client_auth);

       Iban_Repository::insert($iban['iban_number']);
       ;
       $iban['iban_id'] = $db->insert_id;

       $account['iban_id'] = $iban['iban_id'];
       $account['iban_number'] = $iban['iban_number'];
       $account['owner_type'] = 'Individual';
       $account['balance'] = 0.00;
       Account_Repository::insert($account);

       $individual['person_id'] = $person['person_id'];
       $individual['iban_id'] = $iban['iban_id'];
       Individual_Repository::insert($individual);

       // remove object from session
       unset($_SESSION['step']);
       unset($_SESSION['new_customer']);
       unset($_SESSION['person']);
       unset($_SESSION['address']);
       unset($_SESSION['client_auth']);
       unset($_SESSION['account']);
       unset($_SESSION['terms_conditions']);

       generate_pdf_individual_account_summary($person, $address, $client_auth, $account);
   } else {
       redirect_to('/accounts/open-individual-account.php?step=1');
   }


?>


<!-- header -->
<?php include_once(SHARED_PATH . '/public_header.php'); ?>

<!-- title -->
<?php include_once('open-individual-account-title.php');  ?>

<section class="open-account-confirmation">
    <header>
        <div class="row">
            <h2>Individual account confirmation</h2>
        </div>
    </header>
    <div class="main-content">
        <div class="row">
            <p>Thank you for openning your account, <?php echo $person['sex'] == 'M' ? 'Mr ' : 'Ms ';  echo  $person['first_name'] . ' ' . $person['last_name']; ?> </p>
        </div>
        <div class="row">
            <p>Informations on your account are the following. </p>
        </div>
        <div class="row">
            <ul>
                <li><span>Your Personal Identification Number (NIP) : <strong><?php echo $client_auth['nip']; ?></strong></span></li>
                <li><span>Your Iban Number : <strong><?php echo $iban['iban_number']; ?></strong></span></li>
                <li><span>Your Account Number : <strong><?php echo $account['account_number']; ?></strong></span></li>
                <li><span>Your Interest rate : <strong><?php echo $account['interest_rate']; ?></strong></span></li>
                
            </ul>
        </div>
        <div class="row">
            <p>Please keep those informations safelly in oder to avoid any tier person from get in to your account.</p>
        </div>

    </div>
    <footer>
        <div class="row">
            <p>You can download the document containing those informations 
                <a href="<?php echo url_for('/accounts/accounts_pdf_summary/account_' . $account['account_number'] . '.pdf') ?>" download target="_blank">here</a> </p>
            <p>Your CitiFinance</p>
        </div>
    </footer>

</section>


<!-- footer -->
<?php include_once(SHARED_PATH . '/public_footer.php'); ?>