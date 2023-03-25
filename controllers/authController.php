<?php

session_start();

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'user-verification');
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
  die('Database error:' . $conn->connect_error);
}


$errors = array();
$username = "";
$email = "";

// if user clicks on the sign up button
if (isset($_POST['signup-btn'])) {
   $username = $_POST['username'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $passwordConf = $_POST['passwordConf'];


  // validation
  if (empty($username)) {
    $errors['username'] = "Username required";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error['email'] = "Email address is invalid";

  }

  if (empty($email)) {
    $errors['email'] = "Email required";
  }
  if (empty($password)) {
    $errors['password'] = "Password required";
  }
  if ($password !== $passwordConf) {
      $errors['password'] = "The two passwords do not match";
  }

  $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
  $stmt = $conn->prepare($emailQuery);
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $userCount = $result->num_rows;
  $stmt->close();

  if ($userCount > 0) {
    $errors['email'] = "Email already exists";

  }

  if (count($errors) == 0) {

    $sql = "INSERT INTO users (username, email, password) VALUES ('". $username ."','". $email ."','". $password ."')";
    $result = $conn->query($sql);
    header('location: index.php');
    if  ($stmt->execute()) {
      // login user

      $user_id = $conn->insert_id;
      $_SESSION['id'] = $user_id;
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $email;
      //flash message
      $_SESSION['message'] = "You are now logged in!";
      $_SESSION['alert-class'] = "alert-success";
      header('location: index.php');
      exit();
    } else {
      $errors['db_error'] = "Database error: failed to register";
    }

  }

}

// if user clicks on the login button
if (isset($_POST['login-btn'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // validation
  if (empty($username)) {
    $errors['username'] = "Username required";
    }

  if (empty($password)) {
    $errors['password'] = "Password required";
  }

  if (count($errors) == 0) {
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        if(($row['username'] == $username || $row['email'] == $email) && $row['password'] == $password){

          $_SESSION['id'] = $user['id'];
          $_SESSION['username'] = $username;
          $_SESSION['email'] = $email;
          $_SESSION['message'] = "You are now logged in!";
          $_SESSION['alert-class'] = "alert-success";
          if($row['admin'] == 1){
            $_SESSION['admin'] = 1;
          }else{
            $_SERVER['admin'] = 0;
          }
          header('location: index.php');
          exit();
    
        }    
      }
    }
    } else {
      $errors['login_fail'] = "Wrong credentials";
    }

  }


// logout user

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['id']);
  unset($_SESSION['username']);
  unset($_SESSION['email']);
  header('location: login.php');
  exit();
}