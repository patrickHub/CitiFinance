<!-- Introduction -->
<?php
    $client_auth = $_SESSION['client_auth'] ?? [];
?>
<section class="open-account">
        <header>
            <div class="row-1">
                <div class="col-1">
                    <img src="<?php echo url_for('/images/landingpage_assets/icons8-forgot-password-64.png'); ?>">
                </div>
                <div class="col-2">
                    <h3>My Password</h3>
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
       <form action="<?php echo url_for('/accounts/open-individual-account.php?step=4'); ?>" method="post">
            <div class="main-content">
                
                <!-- password -->
                <div class="row">
                    <div class="col-1">
                        <span>Password*</span>
                    </div>
                    <div class="col-2">
                        <div class="col-2-row">
                            <div class="form-input">
                                <input class="input" type="password" name="password" value="<?php echo isset($client_auth['password']) ? h($client_auth['password']) : ''; ?>">
                                <span class="input-focus-border"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-error">
                    <div class="col-1">
                    </div>
                    <div class="col-2">
                        <span class="input_error"><?php echo isset($errors['password']) ? h($errors['password']) : ''; ?></span>
                    </div>
                </div>

                <!-- confirm password -->
                <div class="row">
                    <div class="col-1">
                        <span>Confirm password*</span>
                    </div>
                    <div class="col-2">
                        <div class="col-2-row">
                            <div class="form-input">
                                <input class="input" type="password" name="confirm_password" value="">
                                <span class="input-focus-border"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-error">
                    <div class="col-1">
                    </div>
                    <div class="col-2">
                        <span class="input_error"><?php echo isset($errors['confirm_password']) ? h($errors['confirm_password']) : ''; ?></span>
                    </div>
                </div>

                
                
            </div>
            <footer>
                <a href="<?php echo url_for('/accounts/open-individual-account.php?step=3'); ?>" class="btn-back">Previous</a>
                <input class="btn-next" type="submit" value="Next">
            </footer>
        </form>
</section>
