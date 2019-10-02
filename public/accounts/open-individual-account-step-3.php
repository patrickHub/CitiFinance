<!-- Introduction -->
<?php
    $address = $_SESSION['address'] ?? [];
?>
<section class="open-account">
        <header>
            <div class="row-1">
                <div class="col-1">
                    <img src="<?php echo url_for('/images/landingpage_assets/icons8-location-30.png'); ?>">
                </div>
                <div class="col-2">
                    <h3>My address</h3>
                </div>
            </div>
            <div class="row-2">
               <span>We need the following information in order
                    to process your order. Your details will be 
                    treated confidentially. All data is sent in 
                    encrypted forme
               </span>
           </div>
       </header>
       <form action="<?php echo url_for('/accounts/open-individual-account.php?step=4'); ?>" method="post">
            <div class="main-content">
                
                <!-- street -->
                <div class="row">
                    <div class="col-1">
                        <span>Street*</span>
                    </div>
                    <div class="col-2">
                        <div class="col-2-row">
                            <div class="form-input">
                                <input class="input" type="text" name="street" value="<?php echo isset($address['street']) ? h($address['street']) : ''; ?>">
                                <span class="input-focus-border"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-error">
                    <div class="col-1">
                    </div>
                    <div class="col-2">
                        <span class="input_error"><?php echo isset($errors['street']) ? h($errors['street']) : ''; ?></span>
                    </div>
                </div>

                <!-- npa / city -->
                <div class="row">
                    <div class="col-1">
                        <span>Post code* / City*</span>
                    </div>
                    <div class="col-2">
                        <div class="col-2-row">
                            <div>
                                <div class="form-input grid-npa-city ">
                                    <div>
                                        <input class="input-npa" type="text" name="npa" value="<?php echo isset($address['npa']) ? h($address['npa']): ''; ?>">
                                        <span class="input-npa-focus-border" style="width:30%;"></span>
                                    </div>
                                    <div>
                                        <input class="input" type="text" name="city" value="<?php echo isset($address['city']) ? h($address['city']): ''; ?>">
                                        <span class="input-focus-border" style="width:70%; left:30%;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-error">
                    <div class="col-1">
                    </div>
                    <div class="col-2 grid-npa-city">
                        <span class="input_error inline-block"><?php echo isset($errors['npa']) ? h($errors['npa']) : '';?></span>
                        <span class="input_error"><?php echo isset($errors['city']) ? h($errors['city']) : '';?></span>
                    </div>
                </div>

                
                <!-- country -->
                <div class="row">
                    <div class="col-1">
                        <span>Country*</span>
                    </div>
                    <div class="col-2">
                        <div class="col-2-row">
                            <div>
                                <div class="form-input form-select">
                                    <select class="input-select" name="country">
                                        <option value="">Please select</option>
                                        <option value="<?php echo $countries['Switzerland']; ?>"  <?php echo isset($address['country']) && $address['country'] == $countries['Switzerland'] ? 'selected' : ''; ?> ><?php echo h($countries['Switzerland']); ?></option>
                                       </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-error">
                    <div class="col-1">
                    </div>
                    <div class="col-2">
                        <span class="input_error"><?php echo isset($errors['country']) ? h($errors['country']) : ''; ?></span>
                    </div>
                </div>
                
            </div>
            <footer>
                <a href="<?php echo url_for('/accounts/open-individual-account.php?step=2'); ?>" class="btn-back">Previous</a>
                <input class="btn-next" type="submit" value="Next">
            </footer>
        </form>
</section>
