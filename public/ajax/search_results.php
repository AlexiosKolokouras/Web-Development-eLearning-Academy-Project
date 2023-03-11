<?php

require_once __DIR__. '/../../boot/boot.php';

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