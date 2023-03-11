<?php 

// Boot application
require_once __DIR__ .'/../../boot/boot.php';

use Hotel\User;
use Hotel\Room;
use Hotel\Review;

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

//Get all reviews
$review = new Review();
$roomReviews = $review->getReviewsByRoom($roomId);
$counter = count($roomReviews);

//Load room info
$room = new Room();
$roomInfo = $room->get($roomId);

?>

<span class="title_review">
    <?php
        $roomAvgReview = $roomInfo['avg_reviews'];
        for($i = 1; $i <=5; $i++)
        {
            if($roomAvgReview >= $i)
            {
                ?>
                    <span class="fa fa-star checked"></span>
                <?php
            }else{
                ?>
                    <span class="fa fa-star"></span>
                <?php
            }
        }
    ?>
</span>