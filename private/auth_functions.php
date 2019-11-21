<?php

  // Performs all actions necessary to log in user
  function log_in($client_auth)
  {
      // Renerating the ID protects the user from session fixation.
      session_regenerate_id();
      $_SESSION['person_id'] = $client_auth['person_id'];
      $_SESSION['last_login'] = time();
      return true;
  }
// is_logged_in() contains all the logic for determining if a
// request should be considered a "logged in" request or not.
// It is the core of require_login() but it can also be called
// on its own in other contexts (e.g. display one link if an admin
// is logged in and display another link if they are not)
function is_logged_in()
{
    // Having a person_id in the session serves a dual-purpose:
    // - Its presence indicates the user is logged in.
    // - Its value tells which account for looking up their data.
    return isset($_SESSION['person_id']);
}

// Call require_login() at the top of any page which needs to
// require a valid login before granting acccess to the page.
function require_login()
{
    if (!is_logged_in()) {
        redirect_to(url_for('/accounts/log/login.php'));
    } else {
        // Do nothing, let the rest of the page proceed
    }
}
// Performs all actions necessary to log out a user
function log_out()
{
    unset($_SESSION['person_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['iban_id']);
    // session_destroy(); // optional: destroys the whole session
    return true;
}
