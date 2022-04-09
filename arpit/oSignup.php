<?php
$insert = false;
$showError = false;
session_start();
if (!isset($_SESSION['ownerloggedin']) || $_SESSION['ownerloggedin'] != true) {
    header("location: oLogin.php");
    exit();
}
else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require 'partials/_dbconnect.php';
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $mobile = $_POST['mobile'];



        $existSql = "SELECT * FROM `owner` where `ownername`='$username'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if ($numExistRows > 0) {
            $showError = "username Already Exist";
        }
        else {
            if ($password == $cpassword) {
                $sql = "INSERT INTO `owner` ( `ownername`, `pass`, `mobile`) VALUES ( '$username', '$password', '$mobile')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $insert = true;
                }

            }
            else {
                $showError = "password do not match";
            }
        }
    }
}
?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Owner-SignUp</title>
</head>

<body>
    <?php
require 'partials/_nav.php';

if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>signup successful!</strong> Now you can login our site.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";

}
if ($showError) {
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Error! </strong> $showError
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";

}
?>

    <div class="container">
        <h2 class="text-center my-4">Register A New Admin </h2>
        <form action="/arpit/logsys/oSignup.php" method="post">
            <div class="mb-3 col-md-6">
                <label for="username" class="form-label">UserName</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">

            </div>
            <div class="mb-3 col-md-6 ">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 col-md-6 ">
                <label for="cpassword" class="form-label">confirm the password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
            </div>
            <div class="mb-3 col-md-6 ">
                <label for="mobile" class="form-label">ENTER THE MOBILE NUMBER</label>
                <input type="tel" class="form-control" id="mobile" name="mobile">
            </div>

            <button type="submit" class="btn btn-primary col-md-6">SignUp</button>
        </form>
    </div>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
</body>

</html>