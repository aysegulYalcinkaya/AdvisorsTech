<?php
include_once 'include/dbconfig.php';
require_once 'include/db_operations.php';
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $user = $_POST["username"];
    $passwd = $_POST["password"];


    if (login($user, $passwd)) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $user;
        header("location: index.php");
        exit;
    } else {
        $msg = "Wrong username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>New Client Onboarding</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="AdvisorsTech - New Client Onboarding" name="description"/>

    <!-- App favicon -->
    <link rel="shortcut icon" href="include/images/favicon.ico">

    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="include/css/daterangepicker.css">

    <!-- Vector Map css -->
    <link rel="stylesheet" href="include/css/jquery-jvectormap-1.2.2.css">

    <!-- Theme Config Js -->
    <script src="include/js/config.js"></script>

    <!-- App css -->
    <link href="include/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>

    <!-- Icons css -->
    <link href="include/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>

<body>
<div class="container" style="margin-top:30px">
    <div class="row justify-content-center">
        <aside class="col-sm-4">
            <div class="card">
                <article class="card-body">
                    <h4 class="card-title text-center mb-4 mt-1">Sign in</h4>
                    <hr>
                    <p class="text-success text-center"></p>
                    <form method="post" action="login.php">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
										<span class="input-group-text"> <i class="fa fa-user"></i>
										</span>
                                </div>
                                <input name="username" class="form-control"
                                       placeholder="Username" required>
                            </div>
                            <!-- input-group.// -->
                        </div>
                        <!-- form-group// -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
										<span class="input-group-text"> <i class="fa fa-lock"></i>
										</span>
                                </div>
                                <input class="form-control" placeholder="******"
                                       type="password" name="password" required>
                            </div>
                            <!-- input-group.// -->
                        </div>
                        <!-- form-group// -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- form-group// -->

                    </form>
                </article>
            </div>
        </aside>
    </div>
</div>
</body>
</html>