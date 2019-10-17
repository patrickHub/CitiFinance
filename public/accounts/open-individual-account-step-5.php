<?php

    $account = $_SESSION['account'] ?? [];
?>
<section class="open-account">
        <header>
            <div class="row-1">
                <div class="col-1">
                    <img src="<?php echo url_for('/images/landingpage_assets/icons8-bank-card-missing-30.png'); ?>">
                </div>
                <div class="col-2">
                    <h3>My account</h3>
                </div>
            </div>
            <div class="row-2">
               <span>Please fill in the password that you will used
                     to connect to your account. In order to prevent
                     others from accessing your account, You should 
                     choose a strong password.
               </span>
           </div>
       </header>
       <form action="<?php echo url_for('/accounts/open-individual-account.php?step=6'); ?>" method="post">
            <div class="main-content">
                
                <!-- overdraft-->
                <div class="row">
                    <div class="col-1">
                        <span>Overdraft*</span>
                    </div>
                    <div class="col-2">
                        <div class="col-2-row">
                            <div class="form-input">
                                <input class="input" type="text" name="overdraft" value="<?php echo isset($account['overdraft']) ? h($account['overdraft']) : ''; ?>">
                                <span class="input-focus-border"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-error">
                    <div class="col-1">
                    </div>
                    <div class="col-2">
                        <span class="input_error"><?php echo isset($errors['overdraft']) ? h($errors['overdraft']) : ''; ?></span>
                    </div>
                </div>
            </div>
            <footer>
                <a href="<?php echo url_for('/accounts/open-individual-account.php?step=4'); ?>" class="btn-back">Previous</a>
                <input class="btn-next" type="submit" value="Next">
            </footer>
        </form>
</section>
