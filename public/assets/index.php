<?php

require __DIR__. '/../../boot/boot.php';

use Hotel\Room;
use Hotel\User;
use Hotel\RoomType;

//Get cities
$room = new Room();
$cities = $room->getCities();

//Get all room types
$type = new RoomType();
$allTypes = $type->getAllTypes();

// Get current user id
$userId = User::getCurrentUserId();

// Get logged in user name
$user = new User();
$userName = $user->getUserId($userId);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="storage/favicon.png" class="rounded" sizes="16x16 32x32" type="image/png">
        <title>Room Search</title>
        <style>
            .background_image{
                background: url("storage/index_img.jpg") no-repeat;
                height: calc(96vh - 100px);
                display: flex;
                padding-top: 8%;
                text-align: center;
                background-size:100% 100%;
                width: auto;  
            }

            select{
                font-size: 15px;
            }
        </style>
    </head>
    <body class="d-flex flex-column min-vh-100">
        <div class="container">
        <header>
            <div class="container">
                <nav class="navbar navbar-expand-md bg-light navbar-light ml-5 mr-5">
                        <a class="navbar-brand" href="index.php"><span>Hotels</span></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item ml-auto">
                                <a class="nav-link" style="color:#f50;" href="index.php"><span><i class="fa-solid fa-house"></i></span>Home</a>
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
        </header>
        </div>
        <main>
            <div class="container-fluid">
                <section class="background_image rounded mb-1">
                    <div class="col-lg">
                        <form name="searchForm" action="list.php" onsubmit="return validateForm()">
                            <div class="card mx-auto" style="max-width: 540px;">
                                <div class="card-body">
                                    <div class="row no-gutter">
                                        <div class="form-floating col-xl-5 pr-1 mt-3 ml-auto">
                                            <select class="form-select" id="city" name="city">
                                                <option value="">Select City</option> 
                                                <?php
                                                    foreach($cities as $city){
                                                ?>
                                                    <option value="<?php echo $city?>"><?php echo $city?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <label for="city" class="form-label">City</label>
                                        </div>
                                        <div class="form-floating col-xl-5 pr-1 mt-3 mr-auto">
                                            <select class="form-select" id="room_type" name="room_type">
                                                <option value="">Select Room Type</option>
                                                <?php
                                                    foreach($allTypes as $roomType){
                                                ?>
                                                    <option value="<?php echo $roomType['type_id']; ?>"><?php echo $roomType['title']; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <label for="room_type" class="form-label">Room Type</label>
                                        </div>
                                    </div>
                                    <div class="row no-gutter">
                                        <div class="floating-label col-xl-5 pr-1 mt-3 ml-auto">
                                            <input type="text" class="form-control form-control-lg checkInDate" id="check_in_date"  placeholder=" " name="check_in_date">
                                            <label for="checkInDate">Check-in date</label>
                                        </div>
                                        <div class="floating-label col-xl-5 pr-1 mt-3 mr-auto">
                                            <input type="text" class="form-control form-control-lg checkOutDate" id="check_out_date"  placeholder=" " name="check_out_date">
                                            <label for="checkOutDate">Check-out date</label>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-xl-12">
                                            <button type="submit" class="btn btn-primary searchBtn p-3 ml-auto mr-auto">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- ------------------------Bootstrap_5------------------------ -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        
        <!-- ------------------------input_animation------------------------ -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- ------------------------Bootstrap_4------------------------ -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

           <!-- ------------------------Jquery------------------------ -->
           <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
            <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
           <script src="./js/datepicker.js"></script>
    </body>
</html>