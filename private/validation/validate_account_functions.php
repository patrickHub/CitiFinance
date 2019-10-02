<?php
    require_once('validations_functions.php');
    function validate_person($person)
    {
        $errors = [];

        // sex
        if (is_blank($person['sex'])) {
            $errors['sex'] = "Title is mandatory!";
        } elseif (!has_length($person['sex'], ['min' => 1, 'max' => 1])) {
            $errors['sex'] = "Title must be between 1 caractere!";
        }
        // first_name
        if (is_blank($person['first_name'])) {
            $errors['first_name'] = "First name can not be blank!";
        } elseif (!has_length($person['first_name'], ['min' => 2, 'max' => 255])) {
            $errors['first_name'] = "First name must be between 2 and 255 caracteres!";
        }

        // last_name
        if (is_blank($person['last_name'])) {
            $errors['last_name'] = "Last name can not be blank!";
        } elseif (!has_length($person['last_name'], ['min' => 2, 'max' => 255])) {
            $errors['last_name'] = "Last name must be between 2 and 255 caracteres!";
        }

        // birthdate
        if (is_blank($person['birthdate'])) {
            $errors['birthdate'] = "Birth date is mandatory!";
        } elseif (!has_valid_date_format($person['birthdate'])) {
            $errors['birthdate'] = "Birth date format must be 'YYYY-MM-DD'!";
        } elseif (!has_age_over($person['birthdate'])) {
            $errors['birthdate'] = "Sorry you should be more than 18 years old.";
        }


        // nationality
        if (is_blank($person['nationality'])) {
            $errors['nationality'] = "Nationality is mandatory!";
        } elseif (!has_length($person['nationality'], ['min' => 2, 'max' => 255])) {
            $errors['nationality'] = "Nationality must be between 2 and 255 caracteres!";
        }

        // phone_number
        if (is_blank($person['phone_number'])) {
            $errors['phone_number'] = "Phone number can not be blank!";
        } elseif (!has_length_exactly($person['phone_number'], 10)) {
            $errors['phone_number'] = "Phone number must be 10 caracteres!";
        } elseif (!has_valid_phone_format($person['phone_number'])) {
            $errors['phone_number'] = "Phone number must be valid.";
        }

        // email
        if (is_blank($person['email'])) {
            $errors['email'] = "Email can not be blank!";
        } elseif (!has_length_less_than($person['email'], 255)) {
            $errors['email'] = "Email must be less than 255 caracteres!";
        } elseif (!has_valid_email_format($person['email'])) {
            $errors['email'] = "Email must be valid!";
        }
        return $errors;
    }


    function validate_address($address)
    {
        $errors = [];
        
        // country
        if (is_blank($address['country'])) {
            $errors['country'] = "Country is mandatory!";
        } elseif (!has_length_less_than($address['country'], 255)) {
            $errors['country'] = "Country must be less than 255 caracteres!";
        }

        // city
        if (is_blank($address['city'])) {
            $errors['city'] = "City is mandatory!";
        } elseif (!has_length_less_than($address['city'], 255)) {
            $errors['city'] = "City must be less than 255 caracteres!";
        }

        // npa
        $npa = (int)$address['npa'];
        if (is_blank($address['npa'])) {
            $errors['npa'] = "Post code is mandatory!";
        } elseif ($npa > 99999) {
            $errors['npa'] = "Post code must be less than 100 000!";
        } elseif (!ctype_digit($address['npa'])) {
            $errors['npa'] = "Post code must be valid!";
        }

        // street
        if (is_blank($address['street'])) {
            $errors['street'] = "Street can not be blank!";
        } elseif (!has_length_less_than($address['street'], 255)) {
            $errors['street'] = "Street must be less than 255 caracteres!";
        }
        return $errors;
    }
    function validate_client_auth($client_auth)
    {
        $errors = [];

        // password
        if (is_blank($client_auth['password'])) {
            $errors['password'] = "Password is mandatory!";
        } elseif (!has_length($client_auth['password'], ['min'=>9, 'max'=>255])) {
            $errors['password'] = "Password must be between 9 and 255 caracteres!";
        } elseif (!has_valid_password_format($client_auth['password'])) {
            $errors['password'] = "Password must have a least 1 uppercase, 1 lowercase, 1 number and 1 symbol.";
        }

        // confirm_password
        if (is_blank($client_auth['confirm_password'])) {
            $errors['confirm_password'] = "Confirm password is mandaotory!";
        } elseif (($client_auth['confirm_password'] !== $client_auth['password'])) {
            $errors['confirm_password'] = "Password and Confirm Password must match.";
        }

       
        return $errors;
    }

    function validate_account($account)
    {
        $errors = [];
        
        // overdraft
        $overdraft = (double)$account['overdraft'];
        if (is_blank($account['overdraft'])) {
            $errors['overdraft'] = "Overdraft can not be blank!";
        } elseif ($overdraft > 1000000.00) {
            $errors['overdraft'] = "Overdraft must be less than or egal to 1 000 000!";
        } elseif (!ctype_digit($account['overdraft'])) {
            $errors['overdraft'] = "Overdraft must be valid!";
        }
        return $errors;
    }
