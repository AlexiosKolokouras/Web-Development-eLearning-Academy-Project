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
        <title>Register</title>
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
                            <div class="card mx-auto" style="max-width: 540px;">
                                <form method="post" name="registerForm" id="registerForm" action="../actions/register.php">
                                    <div class="card-header">Register</div>
                                    <div class="card-body">
                                        <div class="floating-label">
                                            <input type="text" class="form-control name" placeholder=" " id="name" name="name">
                                            <label for="name">Full Name<sup>*</sup></label>
                                            <div class="text-danger name_error">Please inseart a name!</div>
                                        </div>
                                        <div class="floating-label mt-3">
                                            <input type="text" class="form-control email" id="email" placeholder=" " name="email">
                                            <label for="email">Email<sup>*</sup></label>
                                            <div class="text-danger email_error">Must be a valid email address!</div>
                                        </div>
                                        <?php if(!empty($_GET['error'])) { ?>
                                            <div class="text-danger email_check_error">Email already exists!!</div>
                                        <?php } ?>
                                        <div class="floating-label mt-3">
                                            <input type="text" class="form-control cfm_email " id="cfm_email" placeholder=" " name="cfm_email">
                                            <label for="cfm_email">Confirm Email<sup>*</sup></label>
                                            <div class="text-danger cfm_email_error">Emails don't match</div>
                                        </div>
                                        <div class="floating-label right_eye_password mt-3">
                                            <input type="password" class="form-control pswd" id="password" placeholder=" " name="password">
                                            <label for="password">Password<sup>*</sup></label>
                                            <i class="fa-regular fa-eye  toggle_password"></i>
                                            <div class="text-danger password_error">Password must be at least 8 characters!</div>
                                        </div>
                                        <div class="form-check ml-2 mt-1">
                                            <label class="form-check-label">
                                                <input class="form-check-input remember" type="checkbox" name="remember"> Remember me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary registerBtn">Register</button>
                                        <p class="pt-2 text-center flex-fill">Already have account? <a href="login.php" class="font-weight-bold">Log in</a></p>
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
                    <footer class="rounded">
                        &copy; CollegeLink 2022
                    </footer>
                </div>
            </div>      
        </div>

        <link href="css/wda_style.css" type="text/css" rel="stylesheet">
        <script src="./js/validation_form.js"></script>
        <script src="./js/password_toggle.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- ------------------------Bootstrap_5------------------------ -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- ------------------------input_animation------------------------ -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- ------------------------Bootstrap_4------------------------ -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>