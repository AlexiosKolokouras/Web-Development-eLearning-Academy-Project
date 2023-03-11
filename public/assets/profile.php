<?php

require __DIR__. '/../../boot/boot.php';

use Hotel\User;
use Hotel\Review;
use Hotel\Booking;
use Hotel\Favorite;

// Get current user id
$userId = User::getCurrentUserId();

// Get logged in user name
$user = new User();
$userName = $user->getUserId($userId);

// Check for logged in user
if (empty($userId)){
    header('Location: index.php');

    return;
}

// Get all favorites
$favorite = new Favorite();
$userFavorites = $favorite->getListByUser($userId);

// Get all reviews
$review = new Review();
$userReviews = $review->getListByUser($userId);

// Get all user booking
$booking = new Booking();
$userBooking = $booking->getListByUser($userId);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="storage/favicon.png" class="rounded" sizes="16x16 32x32" type="image/png">
        <title>Profile page</title>
        <style>
            aside.media i {
                font-size: 50px;         
                line-height: 80px;
                width: 80px;
                height: 80px;
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
                                <a class="nav-link" style="color:#f50;" href="profile.php"><span class="primary_menu_user pl-3"><i class="fa-solid fa-user"></i></span><span><?php echo $userName['name'] ; ?></span></a>
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
            <div class="container mt-4 mb-2">
                <div class="row">
                    <!-- --------------------------------------------------FAVORITES_VOTE--------------------------------------------------  -->
                    <div class="col-lg-3 mt-5">
                        <section class="hotel_filters">
                            <p class="h2 fs-6 text-uppercase font-weight-bold">Favorites</p>
                            <?php
                                if(count($userFavorites) > 0){
                            ?>
                            <ol>
                                <?php
                                    foreach($userFavorites as $favorite){
                                ?>
                                <h6>
                                    <li class="w-75 text-body">
                                        <a class="text-decoration-none text-body" href="room.php?room_id=<?php echo $favorite['room_id']; ?>"><?php echo $favorite['name']; ?></a>
                                    </li>
                                </h6>
                                <?php
                                    }
                                ?> 
                            </ol>
                            <?php 
                                }else{
                            ?>
                                <div class="alert text-danger text-center">
                                    <strong>You don't have any favorite hotel!!</strong> 
                                </div>
                            <?php 
                                }
                            ?>
                            <p class="h2 fs-6 text-uppercase font-weight-bold mt-4">Reviews</p>
                            <?php
                                if(count($userReviews) > 0){
                            ?>
                            <ol>
                                <?php
                                    foreach($userReviews as $review){
                                ?>
                                    <h6>
                                        <li class="w-75 text-body">
                                            <a class="text-decoration-none text-body" href="room.php?room_id=<?php echo $review['room_id']; ?>"><?php echo $review['name']; ?></a>
                                        </li>
                                    </h6>
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
                                <?php
                                    }
                                ?>
                            </ol>
                            <?php 
                                }else{
                                ?>  
                                <div class="alert text-danger text-center">
                                    <strong>You haven't made any review yet!!</strong>
                                </div>
                            <?php 
                                }
                            ?>
                        </section>
                    </div>
                    <!-- --------------------------------------------------HOTEL_LIST-------------------------------------------------- -->
                    <div class="col-lg-9 mt-5">
                        <section class="page-title">
                            <p class="h2 fs-4">My Booking</p>
                        </section>
                        <?php
                            if(count($userBooking) > 0){
                        ?>
                         <section class="rooms">
                            <?php
                                foreach($userBooking as $booking){
                            ?>
                            <div class="row">
                                <div class="col-lg-2 room_info_profile">
                                    <aside class="media mt-2">
                                        <button type="button" class="border-0 p-0" data-toggle="modal" data-target="#imageId<?php echo $booking['room_id'] ?>">
                                            <img src="../assets/storage/<?php echo $booking['photo_url']; ?>" class="rounded border-0" alt="<?php echo $booking['name']; ?>" width="100%" height="50%">
                                            <i class="fa-solid fa-expand"></i>
                                        </button>
                                        <div class="modal fade" id="imageId<?php echo $booking['room_id'] ?>">
                                            <div class="modal-dialog modal-dialog-centered p-0">
                                                <div class="modal-content">
                                                    <div class="modal-body p-0">
                                                        <div class="d-flex justify-content-end">
                                                            <button type="button" class="close mr-2" data-dismiss="modal">&times;</button>
                                                            <img src="../assets/storage/<?php echo $booking['photo_url']; ?>" class="rounded" alt="<?php echo $booking['name']; ?>" width="100%" height="auto">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </aside>
                                </div>
                                <div class="col-lg-10 mt-2">
                                    <section class="info">
                                        <p class="h3 text-uppercase"><?php echo $booking['name']; ?></p>
                                        <small  class="text-secondary"><?php echo sprintf('%s, %s', $booking['city'], $booking['area'] ); ?></small>
                                        <p class="text-break text-secondary"><?php echo $booking['description_short']; ?></p>
                                        <div class="text-right">
                                            <a class="btn btn-primary" href="room.php?room_id=<?php echo $booking['room_id']; ?>" role="button">Go to room page</a>
                                        </div>
                                    </section>
                                </div>
                                <div class="row no-gutter room_info_profile text-center">
                                    <div class="col-xl-2 pt-2 pb-2 room_price mt-2 mr-2 bg-secondary rounded text-white">
                                        <section class="pr-2">
                                            <span class="fw-bold">Total cost: <?php echo $booking['total_price']; ?>€</span>
                                        </section>
                                    </div>
                                    <div class="col-xl pt-2 pb-2 mt-2 rounded-start check_in_out_date">
                                        <section class="room_info_right_line">
                                            <span>Check-in date: <?php echo $booking['check_in_date']; ?></span>
                                        </section>
                                    </div>
                                    <div class="col-xl pt-2 pb-2 mt-2 check_in_out_date">
                                        <section class="room_info_right_line">
                                            <span>Check-out date: <?php echo $booking['check_out_date']; ?></span>
                                        </section>
                                    </div>
                                    <div class="col-xl pt-2 pb-2 mt-2 rounded-end type_of_room">
                                        <section>
                                            <span>Type of Room: <?php echo $booking['room_type']; ?></span>
                                        </section>
                                    </div>
                                    <span class="bottom_line mt-2"></span>
                                </div>
                            </div>
                            <?php 
                                }
                            ?>
                        </section>
                        <?php 
                        }else{
                        ?> 
                            <div class="alert alert-danger text-center">
                                <strong>You don't have booking!!</strong>
                            </div>
                        <?php 
                            }
                        ?> 
                    </div>
                </div>
            </div>
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
    </body>
</html>