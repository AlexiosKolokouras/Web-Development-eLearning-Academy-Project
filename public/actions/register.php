<?php 

// Boot application
require_once __DIR__ .'/../../boot/boot.php';

use Hotel\User;

// Return to home page if not a post request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
    header('Location: ../assets/index.php');

    return;
}

//Create new user
$user = new User();

try{
  if($user->getByEmail($_REQUEST['email'])){
      header('Location: ../assets/register.php?error=Email already exist');

      return;
  }
}catch (InvalidArgumentException $ex){
  header('Location: ../assets/register.php?error=Exists user with the given email');

  return;
}
  
$user->insert($_REQUEST['name'], $_REQUEST['email'], $_REQUEST['password']);
  //Retrieve user
$userInfo = $user->getByEmail($_REQUEST['email']);

//Generate token
$token = $user->generateToken($userInfo['user_id']);

//Set cookie
setcookie('user_token', $token, time() + (30 * 24 * 60 * 60), '/');

//Return to home page
header('Location: ../assets/index.php');
