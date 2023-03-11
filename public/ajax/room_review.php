<?php 

// Boot application
require_once __DIR__ .'/../../boot/boot.php';

use Hotel\User;
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

//Verify csrf
$csrf = $_REQUEST['csrf'];
if(empty($csrf) || !User::verifyCsrf($csrf)){
    echo 'This is an invalid request';

    return;
}

$review = new Review();
try{
    if(!$review->insert($roomId, User::getCurrentUserId(), $_REQUEST['rate'], $_REQUEST['comment'])){
        header('Location: ../assets/room_reveiw.php');
    }   
}catch (PDOException $ex){
    header('Location: ../assets/room_reveiw.php');
}

//Get all reviews
$roomReviews = $review->getReviewsByRoom($roomId);
$counter = count($roomReviews);

//Load user
$userId = User::getCurrentUserId();

$user = new User();
$userInfo = $user->getUserId($userId);

?>

<div class="room_reviews">
    <span class="font-weight-bold"><?php echo sprintf('%d. %s', $counter, $userInfo['name']); ?></span>
        <?php
            for($i = 1; $i <=5; $i++)
            {
                if($_REQUEST['rate'] >= $i)
                {
                    ?>
                        <span class="fa fa-star checked"></span>
                    <?php
                }else{
                    ?>
                        <span class="fa fa-star review_stars"></span>
                    <?php
                }
            }
        ?>
    <p>Created Time: <?php echo (new DateTime())->format('Y-m-d H:i:s'); ?></p>
    <p><?php echo $_REQUEST['comment']; ?></p>
</div>