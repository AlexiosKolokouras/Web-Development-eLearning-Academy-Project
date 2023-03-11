<?php

require __DIR__. '/../../boot/boot.php';

use Hotel\User;

//Check for existing logged in user
if (!empty(User::getCurrentUserId())){
    header('Location: ../assets/index.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="storage/favicon.png" class="rounded" sizes="16x16 32x32" type="image/png">
        <title>Login</title>
        <style>
            .text-danger{
                font-size: 14px;
            }
                .form-control.is-invalid.pswd {
                background-position: center right calc(30px) !important;
            }
        </style>
    </head>
    <body class="d-flex flex-column min-vh-100">
            <header></header>
        <main>
            <div class="container-fluid">
                <div class="row no-gutter mt-4">
                    <section class="background_image_login_register rounded">
                        <div class="col-xl">
                            <div class="card room_login mx-auto" style="max-width: 540px;">
                                <form method="post" id="login_form" class="needs-validation" novalidate action="../actions/login.php">
                                    <div class="card-header">Sign in</div>
                                    <div class="card-body">
                                         <?php if(!empty($_GET['error'])) { ?>
                                            <div class="alert alert-danger">Incorrect email or password!</div>
                                        <?php } ?>
                                        <div class="floating-label">
                                            <input type="text" class="form-control" id="email" placeholder=" " name="email">
                                            <label for="email">Email</label>
                                            <div class="text-danger email_error_valid">Please insert a valid email address!</div>
                                        </div>
                                        <div class="floating-label right_eye_password mt-3">
                                            <input type="password" class="form-control pswd" id="password" placeholder=" " name="password">
                                            <label for="password">Password</label>
                                            <i class="fa-regular fa-eye toggle_password"></i>
                                            <div class="text-danger password-error">Please insert password!</div>
                                        </div>
                                        <div class="form-check ml-2 mt-1">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="remember"> Remember me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary loginBtn">Sign in</button>
                                        <p class="pt-2 text-center flex-fill">Don't have an account yet? <a href="register.php" class="font-weight-bold">Create one</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>
        <div class="container-fluid mt-auto mb-1">
            <div class="row">
                <div>
                    <footer class=" rounded">
                        &copy; CollegeLink 2022
                    </footer>
                </div>
            </div>      
        </div>

        <link href="css/wda_style.css" type="text/css" rel="stylesheet">
        <script src="./js/login_validation.js"></script>
        <script src="./js/password_toggle.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- ------------------------Bootstrap_5------------------------ -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- ------------------------Bootstrap_4------------------------ -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>