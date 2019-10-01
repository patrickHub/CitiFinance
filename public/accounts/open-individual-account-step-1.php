<!-- Introduction -->
<section class="open-account">
        <header>
            <div class="row-1">
                <div class="col-1">
                    <img src="<?php echo url_for('/images/landingpage_assets/icons8-alarm-clock-96.png'); ?>">
                </div>
                <div class="col-2">
                    <span>Complete in five minutes</span>
                </div>  
            </div>
        </header>
       <form action="<?php echo url_for('/accounts/open-individual-account.php?step=2'); ?>" method="post">
            <div class="main-content">
                <div class="row">
                    <div class="col-1">
                        <span style="<?php echo $new_customer_error === true ? 'color: #A9101D;' : ''; ?>">Are you already a citiFinance customer ?</span>
                    </div>
                    <div class="col-2">
                        <div class="col-2-row flex">
                            <div>
                                <input type="radio"  id="radio-new-customer" name="new_customer" <?php echo isset($_SESSION['new_customer']) && $_SESSION['new_customer'] === 'Yes' ?  'checked' : ''; ?> value="Yes"  onclick="javascript:showOnRadioCheck('radio-new-customer')">
                            </div>
                            <div>
                                <span> No I would like to become a customer</span>
                                <p id="info-new-customer">
                                    Open individual account now. 
                                    You will be ask to feel relevent
                                    forms for signing and informations
                                    on the next steps.
                                </p>
                            </div>
                        </div>
                        <div class="col-2-row flex">
                            <div>
                                <input type="radio"  id="radio-not-new-customer" name="new_customer" <?php echo isset($_SESSION['new_customer']) && $_SESSION['new_customer'] === 'No' ? 'checked' : ''; ?> value="No"  onclick="javascript:showOnRadioCheck('radio-not-new-customer')">
                            </div>
                            <div>
                                <span>Yes I am a CitiFinance customer and I have login account</span>
                                <p id="info-redirect-login-page">
                                    You are being forwarded to the login page. As soon as you have 
                                    logged in to citiFinance you can order your products conveniently online.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer>
                <input class="btn-next" type="submit" value="Next">
            </footer>
        </form>
</section>
