<?php require_once('../../private/initialize.php'); ?>
<?php $page_title = 'Open account'; ?>

<?php
    $step = $_GET['step'] ?? 1;
    $new_customer_error = false;
    $person = [];
    $person['first_name'] = '';
    $person['last_name'] = '';
    $person['birthdate'] = '';
    $person['nationality'] = '';
    $person['sex'] = '';
    $person['phone_number'] = '';
    $person['email'] = '';

    $address = [];
    $address['street'] = '';
    $address['npa'] = '';
    $address['city'] = '';
    $address['country'] = '';

    $errors = [];
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
        } else {
            $new_customer_error = true;
            $step = 1;
        }
    }

    
?>


<!-- header -->
<?php include_once(SHARED_PATH . '/public_header.php');?>
<main>

    <!-- Title -->
    <section class="open-account-title">
        <h1>Openning Individual account</h1>
        <div class="step">
            <a href="<?php echo url_for('/accounts/open-individual-account.php?step=1'); ?>" class="link-step-1"><p>1 - Introduction</p> <span>1</span></a>
            <a href="<?php echo url_for('/accounts/open-individual-account.php?step=2'); ?>" class="link-step-2"><p>2 - Personal details</p><span>2</span></a>
            <a href="<?php echo url_for('/accounts/open-individual-account.php?step=4'); ?>" class="link-step-3"><p>3 - security details</p><span>3</span></a>
            <a href="<?php echo url_for('/accounts/open-individual-account.php?step=5'); ?>" class="link-step-4"><p>4 - summary</p><span>4</span></a>

        </div>
    </section>
    
    <?php
        if ($step == 1) {
            include_once('open-individual-account-step-1.php');
        } elseif ($step == 2 && isset($_SESSION['new_customer'])) {
            include_once('open-individual-account-step-2.php');
        } elseif ($step == 3 && isset($_SESSION['person'])) {
            include_once('open-individual-account-step-3.php');
        } elseif ($step == 4 && isset($_SESSION['address'])) {
            // include_once('open-individual-account-step-3.php');
        }
    ?>
</main>




<!-- footer -->
<?php include_once(SHARED_PATH . '/public_footer.php');?>


