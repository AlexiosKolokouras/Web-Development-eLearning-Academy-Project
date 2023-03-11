<?php 

// Boot application
require_once __DIR__ .'/../../boot/boot.php';

use Hotel\User;

// Return to home page if not a post request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
    header('Location: ../assets/index.php');

    return;
}

$user = new User(); 
try{
    if(!$user->verify($_REQUEST['email'], $_REQUEST['password'])){
        header('Location: ../assets/login.php?error=Could not verify user');

        return;
    }
}catch (InvalidArgumentException $ex){
    header('Location: ../assets/login.php?error=No user exists with the given email');

    return;
}
//Retrieve user
$userInfo = $user->getByEmail($_REQUEST['email']);

//Generate token
$token = $user->generateToken($userInfo['user_id']);

//Set cookie
setcookie('user_token', $token, time() + (30 * 24 * 60 * 60), '/');

//Redirect to home page
header('Location: ../assets/index.php');


