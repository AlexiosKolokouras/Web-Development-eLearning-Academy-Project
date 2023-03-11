<?php 

// Boot application
require_once __DIR__. '/../../boot/boot.php';

use Hotel\User;
use Hotel\Favorite;

// Return to home page if not a post request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
    echo 'This is a post script';
    return;
}

// If no user is logged in, return to main page
if(empty(User::getCurrentUserId())){
    echo 'No current user for this operation';
    return;
}

//Check if room id is given
$roomId = $_REQUEST['room_id'];
if(empty($roomId)) {
    echo 'No room given for this operation';
    return;
}

//Verify csrf
$csrf = $_REQUEST['csrf'];
if(empty($csrf) || !User::verifyCsrf($csrf)){
    echo 'This is an invalid request';

    return;
}

// Set room to favorite
$favorite = new Favorite();

// Add or remove roomfrom favorites
$isFavorite = $_REQUEST['is_favorite'];
if(!$isFavorite){
    $status =  $favorite->addFavorite($roomId, User::getCurrentUserId());
}else{
    $status = $favorite->removeFavorite($roomId, User::getCurrentUserId());
}

// Return oparetion status
header('Content-Type: application/json');
echo json_encode([
    'status' => $status,
    'is_favorite' => !$isFavorite,
]);