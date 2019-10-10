<?php

    $person = $_SESSION['person'];
    $address = $_SESSION['address'];
    $auth_client = $_SESSION['client_auth'];
    $account = $_SESSION['account'];
?>
<section class="open-account-summarize">
    <form action="<?php echo url_for('/accounts/open-individual-account.php?step=6'); ?>" method="post">
        
        <header>
            <div class="row">
                <h2>Individual account details</h2>
            </div>
        </header>

        <div class="main-content">
            <!-- About me -->
            <article>
                <div class="head">
                    <div class="row">
                        <div class="col-1 flex">
                            <div class="title-img">
                                <img src="<?php echo url_for('/images/landingpage_assets/icons8-contact-details-128.png'); ?>">
                            </div>
                            <div class="title-text">
                                <h3>About me</h3>
                            </div>
                        </div>
                        <div class="col-2">
                            <a href="<?php echo url_for('/accounts/open-individual-account.php?step=2'); ?>" class="link-update">
                                <img src="<?php echo url_for('/images/landingpage_assets/icons8-edit-file-96.png'); ?>">
                                <span>Update</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="data-list">
                    <!--Title-->
                    <div class="row">
                        <div class="col-1">
                            <span>Title</span>
                        </div>
                        <div class="col-2">
                            <span><?php echo $person['sex'] == 'M' ? 'Mr' : 'Ms'; ?></span>
                        </div>
                    </div>
                    <!--First-name-->
                    <div class="row">
                        <div class="col-1">
                            <span>First name</span>
                        </div>
                        <div class="col-2">
                            <span><?php echo $person['first_name']; ?></span>
                        </div>
                    </div>
                    <!--Last-name-->
                    <div class="row">
                        <div class="col-1">
                            <span>Last name</span>
                        </div>
                        <div class="col-2">
                            <span><?php echo $person['last_name']; ?></span>
                        </div>
                    </div>
                    <!--Birthdate-->
                    <div class="row">
                        <div class="col-1">
                            <span>Birthdate</span>
                        </div>
                        <div class="col-2">
                            <span><?php echo $person['birthdate']; ?></span>
                        </div>
                    </div>
                    <!--Nationality-->
                    <div class="row">
                        <div class="col-1">
                            <span>Nationality</span>
                        </div>
                        <div class="col-2">
                            <span><?php echo $person['nationality']; ?></span>
                        </div>
                    </div>
                    <!-- Phone number -->
                    <div class="row">
                        <div class="col-1">
                            <span>Phone number</span>
                        </div>
                        <div class="col-2">
                            <span><?php echo $person['phone_number']; ?></span>
                        </div>
                    </div>
                    <!-- Email  -->
                    <div class="row">
                        <div class="col-1">
                            <span>Email</span>
                        </div>
                        <div class="col-2">
                            <span><?php echo $person['email']; ?></span>
                        </div>
                    </div>
                    
                </div>
            </article>

             <!-- My address -->
             <article>
                <div class="head">
                    <div class="row">
                        <div class="col-1 flex">
                            <div class="title-img">
                                <img src="<?php echo url_for('/images/landingpage_assets/icons8-location-30.png'); ?>">
                            </div>
                            <div class="title-text">
                                <h3>My address</h3>
                            </div>
                        </div>
                        <div class="col-2">
                            <a href="<?php echo url_for('/accounts/open-individual-account.php?step=3'); ?>" class="link-update">
                                <img src="<?php echo url_for('/images/landingpage_assets/icons8-edit-file-96.png'); ?>">
                                <span>Update</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="data-list">
                    <!--Street-->
                    <div class="row">
                        <div class="col-1">
                            <span>Street</span>
                        </div>
                        <div class="col-2">
                            <span><?php echo $address['street']; ?></span>
                        </div>
                    </div>
                    <!--NPA / City-->
                    <div class="row">
                        <div class="col-1">
                            <span>Postcode/City</span>
                        </div>
                        <div class="col-2">
                            <span><?php echo $address['npa'] . '  ' . $address['city']; ?></span>
                        </div>
                    </div>
                    <!--Country-->
                    <div class="row">
                        <div class="col-1">
                            <span>Country</span>
                        </div>
                        <div class="col-2">
                            <span><?php echo $address['country']; ?></span>
                        </div>
                    </div>
                    
                </div>
            </article>

             <!-- Auth client -->
             <article>
                <div class="head">
                    <div class="row">
                        <div class="col-1 flex">
                            <div class="title-img">
                                <img src="<?php echo url_for('/images/landingpage_assets/icons8-forgot-password-64.png'); ?>">
                            </div>
                            <div class="title-text">
                                <h3>My password</h3>
                            </div>
                        </div>
                        <div class="col-2">
                            <a href="<?php echo url_for('/accounts/open-individual-account.php?step=4'); ?>" class="link-update">
                                <img src="<?php echo url_for('/images/landingpage_assets/icons8-edit-file-96.png'); ?>">
                                <span>Update</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="data-list">
                    <!--Password-->
                    <div class="row">
                        <div class="col-1">
                            <span>Password</span>
                        </div>
                        <div class="col-2">
                            <span>
                                <?php for ($i = 0; $i<strlen($auth_client['password']); $i++) {?>
                                <?php echo "*" ; ?>
                                <?php }?>
                            </span>
                        </div>
                    </div>
            
                </div>
            </article>

             <!-- Account -->
             <article>
                <div class="head">
                    <div class="row">
                        <div class="col-1 flex">
                            <div class="title-img">
                                <img src="<?php echo url_for('/images/landingpage_assets/icons8-bank-card-missing-30.png'); ?>">
                            </div>
                            <div class="title-text">
                                <h3>My account</h3>
                            </div>
                        </div>
                        <div class="col-2">
                            <a href="<?php echo url_for('/accounts/open-individual-account.php?step=5'); ?>" class="link-update">
                                <img src="<?php echo url_for('/images/landingpage_assets/icons8-edit-file-96.png'); ?>">
                                <span>Update</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="data-list">
                    <!-- Overdraft-->
                    <div class="row">
                        <div class="col-1">
                            <span>Overdraft</span>
                        </div>
                        <div class="col-2">
                            <span><?php echo $account['overdraft'] . '    ' . 'CHF '; ?></span>
                        </div>
                    </div>
                    <!-- Account type-->
                    <div class="row">
                        <div class="col-1">
                            <span>Account type</span>
                        </div>
                        <div class="col-2">
                            <?php $result = Account_type_Repository::get_by_id(($account['account_type_id']));?>
                            <span><?php echo $result['type_name'] ; ?></span>
                        </div>
                    </div>
            
                </div>
            </article>

            <div class="general-terms-conditions">
                <div class="row">
                    <div class="col-1">
                        <input type="checkbox" name="terms_conditions" value="Yes">
                    </div>
                    <div class="col-2">
                        <span>I have read and accept the General Terms and Conditions*</span>
                    </div>
                </div>
               
                <div class="row-error">
                    <div class="col-1">
                    </div>
                    <div class="col-2">
                        <span class="input_error"><?php echo $general_term_error; ?></span>
                    </div>
                </div>
               
            </div>

        </div>
        
        <footer>
            <a href="<?php echo url_for('/accounts/open-individual-account.php?step=5'); ?>" class="btn-back">Previous</a>
            <input class="btn-next" type="submit" value="Confirm">
        </footer>
    </form>
</section>
