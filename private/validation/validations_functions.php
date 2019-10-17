<?php

  // is_blank('abcd')
  // * validate data presence
  // * uses trim() so empty spaces don't count
  // * uses === to avoid false positives
  // * better than empty() which considers "0" to be empty
  function is_blank($value)
  {
      return !isset($value) || trim($value) === '';
  }

  // has_presence('abcd')
  // * validate data presence
  // * reverse of is_blank()
  // * I prefer validation names with "has_"
  function has_presence($value)
  {
      return !is_blank($value);
  }

  // has_length_greater_than('abcd', 3)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_greater_than($value, $min)
  {
      $length = strlen($value);
      return $length > $min;
  }

  // has_length_less_than('abcd', 5)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_less_than($value, $max)
  {
      $length = strlen($value);
      return $length < $max;
  }

  // has_length_exactly('abcd', 4)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_exactly($value, $exact)
  {
      $length = strlen($value);
      return $length == $exact;
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  // * validate string length
  // * combines functions_greater_than, _less_than, _exactly
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length($value, $options)
  {
      if (isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
          return false;
      } elseif (isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
          return false;
      } elseif (isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
          return false;
      } else {
          return true;
      }
  }

  // has_inclusion_of( 5, [1,3,5,7,9] )
  // * validate inclusion in a set
  function has_inclusion_of($value, $set)
  {
      return in_array($value, $set);
  }

  // has_exclusion_of( 5, [1,3,5,7,9] )
  // * validate exclusion from a set
  function has_exclusion_of($value, $set)
  {
      return !in_array($value, $set);
  }

  // has_string('nobody@nowhere.com', '.com')
  // * validate inclusion of character(s)
  // * strpos returns string start position or false
  // * uses !== to prevent position 0 from being considered false
  // * strpos is faster than preg_match()
  function has_string($value, $required_string)
  {
      return strpos($value, $required_string) !== false;
  }

  // has_valid_email_format('nobody@nowhere.com')
  // * validate correct format for email addresses
  // * format: [chars]@[chars].[2+ letters]
  // * preg_match is helpful, uses a regular expression
  //    returns 1 for a match, 0 for no match
  //    http://php.net/manual/en/function.preg-match.php
  function has_valid_email_format($value)
  {
      $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
      if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
          return false;
      }
      return true;
  }
  function has_valid_date_format($value)
  {
      $date_regex = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
      if (preg_match($date_regex, $value)) {
          return true;
      }
      return false;
  }
  function has_valid_phone_format($value)
  {
      $phone_regex = '/^0[2-9]{1}[0-9]{8}/';
      if (preg_match($phone_regex, $value)) {
          return true;
      }
      return false;
  }
  // check that a person age is over 18 by default
  function has_age_over($brithdate, $age=18)
  {
      $brithdate = strtotime($brithdate);
      // 31536000 is number of second in one year
      if (time() - $brithdate < $age * 31536000) {
          return false;
      }
      return true;
  }

  function has_unique_nip($nip)
  {
      $client_auth = Client_Auth_Repository::find_client_auth_by_nip($nip);
      return !isset($client_auth);
  }
  function has_unique_iban_number($iban_number)
  {
      $iban = Iban_Repository::find_iban_by_iban_number($iban_number);
      return !isset($iban);
  }
  function has_unique_account_number($account_number)
  {
      $account = Account_Repository::find_account_by_account_number($account_number);
      return !isset($account);
  }
  function has_valid_password_format($value)
  {
      $uppercase = preg_match('@[A-Z]@', $value);
      $lowercase = preg_match('@[a-z]@', $value);
      $number    = preg_match('@[0-9]@', $value);
      $specialChars = preg_match('@[^\w]@', $value);
      if (!$uppercase || !$lowercase || !$number || !$specialChars) {
          return false;
      }
      return true;
  }
