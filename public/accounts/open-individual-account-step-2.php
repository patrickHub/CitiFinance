<!-- Introduction -->
<?php
    $person = $_SESSION['person'] ?? [];
?>
<section class="open-account">
        <header>
            <div class="row-1">
                <div class="col-1">
                    <img src="<?php echo url_for('/images/landingpage_assets/icons8-contact-details-128.png'); ?>">
                </div>
                <div class="col-2">
                    <h3>About me</h3>
                </div>
            </div>
            <div class="row-2">
               <span>We need the following information in order
                    to process your order. Your details will be 
                    treated confidentially. All data is sent in 
                    encrypted form
               </span>
           </div>
       </header>
       <form action="<?php echo url_for('/accounts/open-individual-account.php?step=3'); ?>" method="post">
            <div class="main-content">
                <!-- Title -->
                <div class="row">
                    <div class="col-1">
                        <span>Title*</span>
                    </div>
                    <div class="col-2">
                        <div class="col-2-row flex">
                            <div>
                                <input type="radio" name="sex" value="M" <?php echo isset($person['sex']) && $person['sex'] === 'M' ? 'checked' : ''; ?> >
                            </div>
                            <div>
                                <span>Mr</span>
                            </div>    
                            <div>
                                <input type="radio" name="sex" value="F" <?php echo isset($person['sex']) && $person['sex'] === 'F' ? 'checked' : ''; ?> >
                            </div>
                            <div>
                                <span>Ms</span>
                            </div>   
                        </div>
                    </div>
                </div>
                <div class="row-error">
                    <div class="col-1">
                    </div>
                    <div class="col-2">
                        <span class="input_error"><?php echo isset($errors['sex']) ? h($errors['sex']) : ''; ?></span>
                    </div>
                </div>

                <!-- First name -->
                <div class="row">
                    <div class="col-1">
                        <span>First name*</span>
                    </div>
                    <div class="col-2">
                        <div class="col-2-row">
                            <div class="form-input">
                                <input class="input" type="text" name="first_name" value="<?php echo isset($person['first_name']) ? h($person['first_name']) : ''; ?>">
                                <span class="input-focus-border"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-error">
                    <div class="col-1">
                    </div>
                    <div class="col-2">
                        <span class="input_error"><?php echo isset($errors['first_name']) ? h($errors['first_name']) : ''; ?></span>
                    </div>
                </div>

                <!-- First name -->
                <div class="row">
                    <div class="col-1">
                        <span>Last name*</span>
                    </div>
                    <div class="col-2">
                        <div class="col-2-row">
                            <div>
                                <div class="form-input">
                                    <input class="input" type="text" name="last_name" value="<?php echo isset($person['last_name']) ? h($person['last_name']): ''; ?>">
                                    <span class="input-focus-border"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-error">
                    <div class="col-1">
                    </div>
                    <div class="col-2">
                        <span class="input_error"><?php echo isset($errors['last_name']) ? h($errors['last_name']) : ''; ?></span>
                    </div>
                </div>

                <!-- Birthdate -->
                <div class="row">
                    <div class="col-1">
                        <span>Birth date*</span>
                    </div>
                    <div class="col-2">
                        <div class="col-2-row">
                            <div>
                                <div class="form-input form-date">
                                    <input class="input" type="date" name="birthdate" value="<?php echo isset($person['birthdate']) ? h($person['birthdate']) : '';?>" data-date-inline-picker="true" data-date-open-on-focus="true" />
                                    <span class="input-focus-border"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-error">
                    <div class="col-1">
                    </div>
                    <div class="col-2">
                        <span class="input_error"><?php echo isset($errors['birthdate']) ? h($errors['birthdate']) : ''; ?></span>
                    </div>
                </div>

                <!-- Nationality -->
                <div class="row">
                    <div class="col-1">
                        <span>Nationality*</span>
                    </div>
                    <div class="col-2">
                        <div class="col-2-row">
                            <div>
                                <div class="form-input form-select">
                                    <select class="input-select" name="nationality">
                                        <option value="">Please select</option>
                                        <?php foreach ($countries as $key => $value) { ?>
                                        <option value="<?php echo $key; ?>"  <?php echo isset($person['nationality']) && $person['nationality'] == $key ? 'selected' : ''; ?> ><?php echo h($value); ?></option>
                                        <?php } ?>
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
                        <span class="input_error"><?php echo isset($errors['nationality']) ? h($errors['nationality']) : ''; ?></span>
                    </div>
                </div>
                
                <!-- Phone number -->
                <div class="row">
                    <div class="col-1">
                        <span>Phone number*</span>
                    </div>
                    <div class="col-2">
                        <div class="col-2-row">
                            <div>
                                <div class="form-input form-phone">
                                    <input class="input" type="tel" name="phone_number" value="<?php echo isset($person['phone_number']) ? h($person['phone_number']) : ''; ?>" placeholder="078 945 52 48">
                                    <span class="input-focus-border"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-error">
                    <div class="col-1">
                    </div>
                    <div class="col-2">
                        <span class="input_error"><?php echo isset($errors['phone_number']) ? h($errors['phone_number']) : ''; ?></span>
                    </div>
                </div>

                <!-- Email -->
                <div class="row">
                    <div class="col-1">
                        <span>Phone number*</span>
                    </div>
                    <div class="col-2">
                        <div class="col-2-row">
                            <div>
                                <div class="form-input">
                                    <input class="input" type="email" name="email" value="<?php echo isset($person['email']) ? h($person['email']) : ''; ?>" placeholder="nobody@nowhere.com">
                                    <span class="input-focus-border"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-error">
                    <div class="col-1">
                    </div>
                    <div class="col-2">
                        <span class="input_error"><?php echo isset($errors['email']) ? ($errors['email']) : ''; ?></span>
                    </div>
                </div>
            </div>
            <footer>
                <a href="<?php echo url_for('/accounts/open-individual-account.php?step=1'); ?>" class="btn-back">Previous</a>
                <input class="btn-next" type="submit" value="Next">
            </footer>
        </form>
</section>
