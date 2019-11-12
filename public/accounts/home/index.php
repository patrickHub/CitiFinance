<?php require_once('../../../private/initialize.php');  ?>
<?php $page_title = 'Home';  ?>
<?php

    /* Todo :  refactoring this in separate file */
    // get current person_id from session
    $person_id = $_SESSION['person_id'] ?? null;
    // find current iban from db
    $invidivual = Individual_Repository::find_individual_by_person_id($person_id);
    $_SESSION['iban_id'] = $invidivual['iban_id'];

    // get error/succeed message to show to user and distroy it from session
    $failure_message = $_SESSION['failure_message'] ?? null;
    unset($_SESSION['failure_message']);
    $succeed_message = $_SESSION['succeed_message'] ?? null;
    unset($_SESSION['succeed_message'])

?>


<!-- header -->
<?php include_once(SHARED_PATH . '/home_header.php'); ?>



<section class="main-site">
    <div class="main-content">
        <div class="bloc-msg" style="display: <?php echo isset($failure_message) ? 'block;' : 'none;';?>">
            <div class="row">
                <div class="bloc-error-msg">
                    <div class="msg">
                        <p> 
                            <?php echo $failure_message;?>
                        </p>
                    </div>
                    <div>
                        <button class="btn-close-main-msg" onclick="closeMainMsg()">x</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bloc-msg" style="display: <?php echo isset($succeed_message) ? 'block;' : 'none;';?>">
            <div class="row">
                <div class="bloc-success-msg">
                    <div class="msg">
                        <p> 
                            <?php echo $succeed_message;?>
                        </p>
                    </div>
                    <div>
                        <button class="btn-close-main-msg" onclick="closeMainMsg()">x</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- One time transfert -->
        <?php  include_once(SHARED_PATH . '/account/immediate_transfert.php'); ?>

        <!-- Wealth overview -->
        <?php  include_once(SHARED_PATH . '/account/wealth_overview.php'); ?>

        <!-- External transfert -->
        <?php  include_once(SHARED_PATH . '/account/external_transfert.php'); ?>

        <!-- Domestic payment -->
        <?php  include_once(SHARED_PATH . '/account/domestic_payment.php'); ?>

        <!-- Transactions -->
        <?php  include_once(SHARED_PATH . '/account/transactions.php'); ?>

        <!-- Order product -->
        <?php  include_once(SHARED_PATH . '/account/order_product.php'); ?>

    </div>
</section>


<!-- footer -->
<?php include_once(SHARED_PATH . '/home_footer.php'); ?>