<?php
  $username = $email = $password = '';
  $usernameErr = $emailErr = $passwordErr = '';

  // validate
  if (isset($_POST['submit'])) {
    // sanitize inputs
    $username = strtolower(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $email = strtolower(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$username) {
      $usernameErr = 'Username is required. </br>';
    }
    if (strlen($username) < 6) {
      $usernameErr = $usernameErr . 'Username characters minimum is 6. </br>';
    }

    if (!$password) {
      $passwordErr = 'Password is required. </br>';
    }
    if (strlen($password) < 6) {
      $passwordErr = $passwordErr . 'Minimum is 6 character';
    }

    if (!$email) {
      $emailErr = 'Email is required. </br>';
    }
    if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
      $emailErr = $emailErr . 'Invalid Email';
    }
    
    if (!($usernameErr && $passwordErr && $emailErr)) {
      echo 'Registration Successful';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
</head>
<body>
  <h1>Register User</h1>
  <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <label for="username">Username:</label>
    <br>
    <input type="text" name="username" id="username">
    <p style="color: red;"><?= $usernameErr ?></p>
    <br>
    <label for="password">Password</label>
    <br>
    <input type="password" name="password" id="password">
    <p style="color: red;"><?= $passwordErr ?></p>
    <br>
    <label for="email">Email:</label>
    <br>
    <input type="email" name="email" id="email">
    <p style="color: red;"><?= $emailErr ?></p>
    <input type="submit" name="submit" value="Register">
  </form>
</body>
</html>