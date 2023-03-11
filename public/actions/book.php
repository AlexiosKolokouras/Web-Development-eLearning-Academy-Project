<?php 

// Boot application
require_once __DIR__ .'/../../boot/boot.php';

use Hotel\User;
use Hotel\Booking;

// Return to home page if not a post request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
    header('Location: ../assets/index.php');

    return;
}

// If no user is logged in, return to main page
if(empty(User::getCurrentUserId())){
    header('Location: ../assets/index.php');

    return;
}

//Check if room id is given
$roomId = $_REQUEST['room_id'];
if(empty($roomId)) {
    header('Location: ../assets/index.php');

    return;
}

//Verify csrf
$csrf = $_REQUEST['csrf'];
if(empty($csrf) || !User::verifyCsrf($csrf)){
    echo 'This is an invalid request';

    return;
}

// Create booking
$booking = new Booking();
$CheckInDate = $_REQUEST['check_in_date'];
$CheckOutDate = $_REQUEST['check_out_date'];
$booking->insert($roomId, User::getCurrentUserId(), $CheckInDate, $CheckOutDate);

// Return to room page
header(sprintf('Location: ../assets/room.php?room_id=%s', $roomId));