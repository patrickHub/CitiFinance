<?php require_once('../../../private/initialize.php');  ?>
<?php $page_title = 'Login';  ?>
<?php

    $client_auth = [];
    $client_auth['nip'] = '';
    $client_auth['password'] = '';
    $errors = [];
    $errors['nip'] = '';
    $errors['password'] = '';
    $login_failure_message = null;

    if (is_post_request()) {
        $client_auth['nip'] = $_POST['nip'] ?? '';
        $client_auth['password'] = $_POST['password'] ?? '';

        if (is_blank($client_auth['nip'])) {
            $errors['nip'] = 'NIP is mandatory!';
        }
        if (is_blank($client_auth['password'])) {
            $errors['password'] = 'Password is mandatory!';
        }
        // if there is not errors try to login
        if (empty($errors['nip']) && empty($errors['password'])) {
            $result = Client_Auth_Repository::find_client_auth_by_nip($client_auth['nip']);
            if ($result) {
                if (password_verify($client_auth['password'], $result['hashed_password'])) {

                    // password matched
                    log_in($result);
                    redirect_to(url_for('/accounts/home/index.php'));
                } else {

                    // nip was found but password don't matched
                    $login_failure_message = 'Your login data are not correct <br> Please enter the security data again.';
                }
            } else {
                // not nip was found
                $login_failure_message = 'Your login data are not correct <br> Please enter the security data again.';
            }
        } else {
        }
    }


?>


<!-- header -->
<?php include_once(SHARED_PATH . '/public_header.php'); ?>


<section class="login">
    <form action="<?php echo url_for('/accounts/log/login.php'); ?>" method="post">
        <header>
            <div class="row">
                <div class="col-1">
                    <img src="<?php echo url_for('/images/landingpage_assets/icons8-lock-50.png'); ?>" >
                </div>
                <div class="col-2">
                    <span>Login</span>
                </div>
            </div>
        </header>
        <div class="main-content">
            <div class="row" style="display: <?php echo isset($login_failure_message) ? 'block;' : 'none;'; ?>">
                <div class="bloc-error-msg">
                    <div class="msg">
                        <p>
                           <?php echo $login_failure_message; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <span>Identification number (NIP)</span>
                </div>
                <div class="col-2">
                    <input type="text" class="input" name="nip" placeholder="NIP"> 
                    <span class="input-focus-border"></span>
                </div>
            </div>
            <div class="row-error">
                    <div class="col-1">
                    </div>
                    <div class="col-2">
                        <span class="input_error"><?php echo isset($errors['nip']) ? h($errors['nip']) : '';?></span>
                    </div>
                </div>
            <div class="row">
                <div class="col-1">
                    <span>Password</span>
                </div>
                <div class="col-2">
                    <input type="password" class="input" name="password" placeholder="Password"> 
                    <span class="input-focus-border"></span>
                </div>
            </div>
            <div class="row-error">
                    <div class="col-1">
                    </div>
                    <div class="col-2">
                        <span class="input_error"><?php echo isset($errors['password']) ? h($errors['password']) : '';?></span>
                    </div>
                </div>
            <div class="row">
                <div class="forget-pw">
                    <a href="#" class="item-link">Password forgotten / change</a>
                </div>
            </div>

        </div>
        <footer>
            <input type="submit" class="btn-next" value="Login">
        </footer>
    </form>

</section>