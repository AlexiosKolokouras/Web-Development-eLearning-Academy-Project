<?php

// Boot application
require_once __DIR__ .'/../../boot/boot.php';

//logout
setcookie('user_token', $token, time() - (30 * 24 * 60 * 60), '/');

header('Location: ../assets/login.php');
