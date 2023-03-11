<?php

require __DIR__. '/../../boot/boot.php';

header('Access-Control-Allow-Origin: https://www.collegelink.gr');

use Hotel\Room;
use Hotel\User;
use Hotel\Review;
use Hotel\Booking;
use Hotel\Favorite;

$room = new Room();
$favorite = new Favorite();

//Check for room id
$roomId = $_REQUEST['room_id'];
if (empty($roomId)){
    header('Location: index.php');

    return;
}

//Load room info
$roomInfo = $room->get($roomId);
if (empty($roomInfo)){
    header('Location: index.php');

    return;
}

// Get current user id
$userId = User::getCurrentUserId();

// Get logged in user name
$user = new User();
$userName = $user->getUserId($userId);

// Chech if room is favorite for current user
$isFavorite = $favorite->isFavorite($roomId, $userId);

//Load all room reviews
$review = new Review();
$allReviews = $review->getReviewsByRoom($roomId);

// Check for booking room
$checkInDate = $_REQUEST['check_in_date'];
$checkOutDate = $_REQUEST['check_out_date'];
$alreadyBooked =  empty($checkInDate) || empty($checkOutDate);
if(!$alreadyBooked){
    //Look for bookings
    $booking = new Booking();
    $alreadyBooked = $booking->isBooked($roomId, $checkInDate, $checkOutDate);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="storage/favicon.png" class="rounded" sizes="16x16 32x32" type="image/png">
        <title>Room Details</title> 
        <style>
            .selected{
                color: #b30000;
            }
            #map {
                height: 300px;
                width: 100%;
            }
            #map p{
                font-size: 13px;
            }
            #map h6{
                font-size: 14px;
            }
            aside.media{
            min-width: 220px;
            max-width: 310px;
            }
            aside.media i{
                font-size: 50px;         
                line-height: 80px;
                width: 80px;
                height: 80px;
            }
            .heart.btn:focus{
                box-shadow:none !important;
            }
        </style>
    </head>
    <body class="d-flex flex-column min-vh-100">
    <header>
        <div class="container mt-4">
            <nav class="navbar navbar-expand-md bg-light navbar-light ml-5 mr-5">
                <a class="navbar-brand" href="index.php"><span>Hotels</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item ml-auto">
                            <a class="nav-link" href="index.php"><span><i class="fa-solid fa-house"></i></span>Home</a>
                        </li>
                        <li class="nav-item ml-auto">
                            <a class="nav-link" href="profile.php"><span class="primary_menu_user pl-3"><i class="fa-solid fa-user"></i></span><span><?php echo $userName['name'] ; ?></span></a>
                        </li>
                        <li class="nav-item ml-auto">
                            <a class="nav-link" href="../actions/logout.php"><span class="primary_menu_logout pl-2"><i class="fa-solid fa-arrow-right-from-bracket ml-2"></i></span><span class="pl-1">Log out</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_line ml-auto mr-auto w-75"></div>
    </header>
        <main>
            <section class="room_info">
                <div class="container d-flex justify-content-center">
                    <div class="col-xl-7 mt-3">
                        <div class="row mt-4">
                            <div class="col rooms d-flex">
                                <span class="h3 pr-1 pt-1 pb-1 text-center fw-bold"><?php echo sprintf('%s - %s, %s', $roomInfo['name'], $roomInfo['city'], $roomInfo['area']) ?></span>
                                <span class="left_line mr-1 h-75 align-self-center"></span>
                                <div class="title_review pr-1 pt-1 pb-1 text-center fw-bold">
                                    <span>Review:</span>
                                    <div id="title_reviews" class="d-inline">
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
                                    </div>   
                                </div>
                                <span class="left_line mr-1 h-75 align-self-center"></span>
                                <div class="title_reviews text-center fw-bold" id="favorite">
                                    <form name="favoriteForm" method="post" id="favoriteForm" class="favoriteForm" action="../actions/favorite.php">
                                        <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
                                        <input type="hidden" name="csrf" value="<?php echo User::getCsrf(); ?>">
                                        <input type="hidden" name="is_favorite" id="heart" value="<?php echo $isFavorite ? '1' : '0'; ?>">
                                        <div class="search_stars_div">
                                            <button type="submit" class="btn p-0 text-white mt-1 border-0 heart"><i class="fa-solid fa-heart heart <?php echo $isFavorite ? 'selected' : ''; ?>"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div  class="ml-auto pt-1 pb-1 text-center fw-bold">
                                    <span>Per Night: <?php echo $roomInfo['price'] ?>€</span>
                                </div>
                            </div>
                        </div> 
                        <aside class="media mt-2">
                            <button type="button" class="border-0 p-0" data-toggle="modal" data-target="#imageId<?php echo $roomInfo['room_id'] ?>">
                                <img src="../assets/storage/<?php echo $roomInfo['photo_url']; ?>" class="rounded" alt="<?php echo $roomInfo['name']; ?>" width="100%" height="50%">
                                <i class="fa-solid fa-expand"></i>
                            </button>
                            <div class="modal fade" id="imageId<?php echo $roomInfo['room_id'] ?>">
                                <div class="modal-dialog modal-dialog-centered p-0">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="close mr-2" data-dismiss="modal">&times;</button>
                                                <img src="../assets/storage/<?php echo $roomInfo['photo_url']; ?>" class="rounded" alt="<?php echo $roomInfo['name']; ?>" width="100%" height="auto">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
                        <div class="row room_info rooms mt-3">
                            <div class="row no-gutter">
                                <div class="col-md-3 pt-2 pb-2 text-center">
                                    <section class="room_info_line pr-2">
                                        <span><i class="fa-solid fa-user pr-2"></i><?php echo $roomInfo['count_of_guests']; ?></span></br>
                                        <span>Count of Guests</span>
                                    </section>
                                </div>
                                <div class="col-md-3 pt-2 pb-2 text-center">
                                    <section class="room_info_line">
                                        <span><i class="fa-solid fa-bed pr-2"></i><?php echo $roomInfo['title']; ?></span></br>
                                        <span>Type of room</span>
                                    </section>
                                </div>
                                <div class="col-md-2 pt-2 pb-2 text-center">
                                    <section class="room_info_line">
                                        <span><i class="fa-solid fa-square-parking pr-2"></i><?php echo $roomInfo['parking'] == 1 ? 'YES' : 'NO';  ?></span></br>
                                        <span>Parking</span>
                                    </section>
                                </div>
                                <div class="col-md-2 pt-2 pb-2 text-center">
                                    <section class="room_info_line">
                                        <span><i class="fa-solid fa-wifi pr-2"></i><?php echo $roomInfo['wifi'] == 1 ? 'YES' : 'NO'; ?> </span></br>
                                        <span>WIFI</span>
                                    </section>
                                </div>
                                <div class="col-md-2 pt-2 pb-2 text-center pl-2">
                                    <section>
                                        <span><i class="fa-solid fa-dog pr-2"></i><?php echo $roomInfo['pet_friendly'] == 1 ? 'YES' : 'NO'; ?></span></br>
                                        <span>Pet friendly</span>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 room_details mt-3">
                            <h5 class="pl-3">Room Description</h5>
                            <p class="pl-3 mt-3 text-justify"><?php echo $roomInfo['description_long']; ?></p>
                            <?php 
                                if($alreadyBooked)
                                {
                            ?>
                                <button class="btn btn-danger float-right pe-none mb-4">Already Booked</button>
                            <?php
                                }else{
                            ?>
                                <form name="bookingForm" method="post" action="../actions/book.php">
                                    <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
                                    <input type="hidden" name="check_in_date" value="<?php echo $checkInDate; ?>">
                                    <input type="hidden" name="check_out_date" value="<?php echo $checkOutDate; ?>">
                                    <input type="hidden" name="csrf" value="<?php echo User::getCsrf(); ?>">
                                    <button type="submit" class="btn btn-primary float-right mb-4">Book now</button>
                                </form>
                            <?php 
                                }
                            ?>
                        </div>
                        <div id="map" class="rounded mb-4"></div>
                        <div class="col-sm-12 room_review mt-3 mb-3">
                            <h5 class="font-weight-bold">Reviews</h5>
                            <div id="room-reviews-container">
                                <?php
                                    foreach($allReviews as $counter => $review){
                                ?>
                                <div class="room_reviews">
                                    <span class="font-weight-bold"><?php echo sprintf('%d. %s', $counter + 1, $review['user_name']); ?></span>
                                        <?php
                                            for($i = 1; $i <=5; $i++)
                                            {
                                                if($review['rate'] >= $i)
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
                                    <p>Created Time: <?php echo $review['created_time']; ?></p>
                                    <p class="text-justify text-break"><?php echo htmlentities($review['comment']); ?></p>
                                </div>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="reviews_line mb-2"></div>
                        <div class="col-sm-12 room_review mt-2 mb-5">
                            <h5 class="font-weight-bold">Add Reviews</h5>
                            <form name="reviewForm" class="reviewForm" id="reviewForm" method="post" action="../actions/review.php">
                                <div class="form-group">
                                    <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
                                    <input type="hidden" name="csrf" value="<?php echo User::getCsrf(); ?>">
                                    <div class="text-danger rate_error">Please insert rate</div>
                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="rate" value="5"/><label for="star5" class="full" title="Awesome"></label>
                                        <input type="radio" id="star4" name="rate" value="4"/><label for="star4" class="full"></label>
                                        <input type="radio" id="star3" name="rate" value="3"/><label for="star3" class="full"></label>
                                        <input type="radio" id="star2" name="rate" value="2"/><label for="star2" class="full"></label>
                                        <input type="radio" id="star1" name="rate" value="1"/><label for="star1" class="full"></label>
                                    </fieldset>
                                    <textarea class="form-control" rows="1" id="comment" name="comment" placeholder="Review"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary p-2 registerBtn">Submit</button>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <div class="container-fluid mt-auto mb-1">
            <div class="row">
                <div class="col-lg-12">
                    <footer class=" rounded">
                        &copy; CollegeLink 2022
                    </footer>
                </div>
            </div>      
        </div>

        <!---------------------google_position_mark--------------------->
        <script>

            function initMap() {
            const rooms = { lat: <?php echo $roomInfo['location_lat']; ?>, lng: <?php echo $roomInfo['location_long']; ?> };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 18,
                center: rooms,
            });
            const contentString =
                '<div id="content">' +
                '<h6 class="text-center fw-bold"> <?php echo sprintf('%s - %s, %s', $roomInfo['name'], $roomInfo['city'], $roomInfo['area']) ?></h6>' +
                '<p class="text-center fw-bold"><a class="text-decoration-none" href="https://www.google.com/maps/search/?api=1&query=<?php echo sprintf('%s, %s, %s', $roomInfo['name'], $roomInfo['city'], $roomInfo['area'])  ?>" target="_blank">View on map</a></p>' +
                "</div>";
            const infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 200,
            });
            
            const marker = new google.maps.Marker({
                position: rooms,
                map,
                title: "<?php echo $roomInfo['name']; ?>",
            });

            marker.addListener("click", () => {
                infowindow.open({
                anchor: marker,
                map,
                shouldFocus: false,
                });
            });
            }
        </script>
        
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCioJ2VuurIXpPwS6FZL9ALc7_ZlIup554&callback=initMap&libraries=places&v=weekly"  defer>
        </script>
    
        <!---------------------end_google_position_mark--------------------->

        <!---------------------room_rate_review--------------------->

        <script>
            const $form = document.querySelector("#reviewForm");
            const $roomRateValue = document.querySelectorAll('input[name="rate"]');
            const $rateError = document.querySelector(".rate_error");

            $rateError.classList.add("d-none"); 

            $form.addEventListener("submit", (e) => {
                e.preventDefault();
                const $roomRateCheckedValue = document.querySelector('input[name="rate"]:checked');
                if($roomRateCheckedValue === null) {
                    $rateError.classList.remove("d-none"); 
                }else{
                    $rateError.classList.add("d-none");
                }
            });

            $roomRateValue.forEach((option) => {
                option.addEventListener("change", (e) => {
                        if(e.target.checked !== 0){
                            $rateError.classList.add("d-none");
                        }
                    });
                }); 
        </script> 
        
        <link href="css/wda_style.css" type="text/css" rel="stylesheet">
        <link href="css/star_rate.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
         
        <!-- ------------------------Bootstrap_5------------------------ -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        
        <!-- ------------------------Bootstrap_4------------------------ -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

         <!-- ------------------------Jquery------------------------ -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <script src="./pages/room.js"></script>

    </body>
</html>