<?php

require __DIR__. '/../../boot/boot.php';

use Hotel\Room;
use Hotel\User;
use Hotel\RoomType;
use Hotel\CountOfGuest;

//Get cities
$room = new Room();
$cities = $room->getCities();

//Get guests
$guests = new CountOfGuest();
$getAllguests = $guests->getCountOfGuest();

// Get current user id
$userId = User::getCurrentUserId();

// Get logged in user name
$user = new User();
$userName = $user->getUserId($userId);

//Get all room types
$type = new RoomType();
$allTypes = $type->getAllTypes();

//Initialize Room service
$room = new Room();

// Get page parameters
$selectedCity = $_REQUEST['city'];
$selectedTypeId = $_REQUEST['room_type'];
$checkInDate = $_REQUEST['check_in_date'];
$checkOutDate = $_REQUEST['check_out_date'];
$selectedGuests = $_REQUEST['count_of_guests'];
$minPrice = $_REQUEST['minPrice'];
$maxPrice = $_REQUEST['maxPrice'];

//Search for rooms and Room data
$allAvailableRooms = $room->search(new DateTime($checkInDate), new DateTime($checkOutDate), $selectedCity, $selectedGuests, $selectedTypeId, $minPrice, $maxPrice);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="storage/favicon.png" class="rounded" sizes="16x16 32x32" type="image/png">
        <title>List page</title>
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
            <div class="container mt-4">
                <form name="searchForm" class="searchForm" action="list.php">
                    <div class="row">
                        <div class="col-lg-3 mt-5">
                            <section class="hotel_filters">
                                <p class="h2 fs-5 text-center text-uppercase">Find the perfect Hotel</p>
                                <select class="form-select form-select-lg mb-2 text-center text-secondary text-sm guests" id="count_of_guests" name="count_of_guests">
                                    <option value="">Count of Guests</option>
                                        <?php
                                            foreach($getAllguests as $guestsCount){
                                        ?>
                                    <option  <?php echo $selectedGuests == $guestsCount['count_of_guests'] ? 'selected' : ''; ?>  value="<?php echo $guestsCount['count_of_guests']; ?>"><?php echo $guestsCount['count_of_guests']; ?></option>
                                        <?php
                                            }
                                        ?>
                                </select>
                                <select class="form-select form-select-lg mb-2 text-center text-secondary room_type" id="room_type" name="room_type">
                                    <option value="">Select Room Type</option>
                                        <?php
                                            foreach($allTypes as $roomType){
                                        ?>
                                    <option <?php echo $selectedTypeId == $roomType['type_id'] ? 'selected' : ''; ?>  value="<?php echo $roomType['type_id']; ?>"><?php echo $roomType['title']; ?></option>
                                        <?php
                                            }
                                        ?>
                                </select>
                                <select class="form-select form-select-lg text-center text-secondary city" id="city" name="city">
                                    <option value="">Select City</option> 
                                        <?php
                                            foreach($cities as $city){
                                        ?>
                                    <option <?php echo $selectedCity == $city ? 'selected' : ''; ?> value="<?php echo $city; ?>"><?php echo $city; ?></option>
                                        <?php
                                            }
                                        ?>
                                </select>
                                <div class="price_input d-flex mt-2">
                                    <section class=" flex-fill mr-2">
                                        <input type="text" class="form-control input_min h-75 text-center minPrice" value="<?php echo $minPrice == true ? $minPrice : '0€' ?>" id="minPrice" name="minPrice">
                                    </section>
                                    <section class=" flex-fill">
                                        <input type="text" class="form-control input_max h-75 text-center maxPrice" value="<?php echo $maxPrice == true ? $maxPrice : '1000€'  ?>" id="maxPrice" name="maxPrice">
                                    </section>
                                </div>
                                <div class="slider">
                                    <div class="progress"></div>
                                </div>
                                <div class="range_input">
                                    <input type="range" class="range_min" min="0" max="1000" value="0" step="10">
                                    <input type="range" class="range_max" min="0" max="1000" value="1000" step="10">
                                </div>
                                <div class=" mt-3">
                                    <input type="text" class="form-control checkInDate text-center" value="<?php echo $checkInDate ?>" id="check_in_date"  placeholder="Check-in date" name="check_in_date">
                                </div>
                                <div class="mt-3">
                                    <input type="text" class="form-control checkOutDate  text-center" value="<?php echo $checkOutDate ?>" id="check_out_date"  placeholder="Check-out date" name="check_out_date">
                                </div>
                                <div class="find_hotel">
                                    <button type="submit" class="btn btn-primary w-100 mt-2 text-uppercase">Find Hotel</button>
                                </div>
                            </section>
                        </div>
                         <!-- --------------------------------------------------HOTEL_LIST-------------------------------------------------- -->
                         <div id="search-result-container"  class="col-lg-9 mt-5">
                            <section class="page-title">
                                    <p class="h2 fs-4">Search Results</p>
                            </section>
                            <section class="rooms">
                                <?php
                                    foreach($allAvailableRooms as $availableRoom){
                                ?>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <aside class="info media mt-2">
                                            <button type="button" class="border-0 p-0" data-toggle="modal" data-target="#imageId<?php echo $availableRoom['room_id'] ?>">
                                                <img src="../assets/storage/<?php echo $availableRoom['photo_url']; ?>" class="rounded" alt="<?php echo $availableRoom['name']; ?>" width="150px" height="100px">
                                                <i class="fa-solid fa-expand"></i>
                                            </button>
                                            <div class="modal fade" id="imageId<?php echo $availableRoom['room_id'] ?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-0">
                                                            <div class="d-flex justify-content-end">
                                                                <button type="button" class="close mr-2" data-dismiss="modal">&times;</button>
                                                                <img src="../assets/storage/<?php echo $availableRoom['photo_url']; ?>" class="rounded" alt="<?php echo $availableRoom['name']; ?>" width="100%" height="auto">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </aside>
                                    </div>
                                    <div class="col-md-12">
                                        <section class="info mt-2">
                                            <p class="h3"><?php echo $availableRoom['name']; ?></p>
                                            <small class="text-secondary"><?php echo $availableRoom['area']; ?>, <?php echo $availableRoom['city']; ?></small>
                                            <p class="text-break text-secondary text-justify"><?php echo $availableRoom['description_short']; ?></p>
                                            <div class="text-right">
                                                <a class="btn btn-primary" <?php echo "href=room.php?room_id=$availableRoom[room_id]&check_in_date=$checkInDate&check_out_date=$checkOutDate"?> role="button">Go to room page</a>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="row no-gutter room_info text-center">
                                        <div class="col-md-2 pt-2 pb-2 room_price mt-2 mr-2 bg-secondary rounded text-white">
                                            <section class="pr-2">
                                                <span class="fw-bold">Price: <?php echo $availableRoom['price']; ?>€</span>
                                            </section>
                                        </div>
                                        <div class="col-md pt-2 pb-2 mt-2 rounded-start check_in_out_date">
                                            <section class="room_info_right_line">
                                                <span>Count of Guests: <?php echo $availableRoom['count_of_guests']; ?></span>
                                            </section>
                                        </div>
                                        <div class="col-md pt-2 pb-2 mt-2 check_in_out_date rounded-end">
                                            <section>
                                                <span>Type of Room: <?php echo $availableRoom['title']; ?></span>
                                            </section>
                                        </div>
                                        <span class="bottom_line mt-2"></span>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>

                                <?php 
                                if (count($allAvailableRooms) == 0){
                                ?>
                                    <div class="alert alert-danger text-center">
                                        <strong>There are no available rooms!!</strong>
                                    </div>
                                <?php
                                }
                                ?>
                            </section>
                         </div>
                    </div>
                </form>
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
        <link href="css/price_range.css" type="text/css" rel="stylesheet">
        <script src="js/price_range.js"></script>
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
        <script src="./pages/search.js"></script>
        <script src="./js/datepicker.js"></script>
    </body>
</html>