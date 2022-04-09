<?php 
$show=false;
$alert=false;

session_start();
if (!isset($_SESSION['ownerloggedin']) || $_SESSION['ownerloggedin']!=true) {
    header("location: oLogin.php");
    exit();
}else{

 


    // connecting to database
    require'partials/_dbconnect.php';









    // to displaY the user sno from db
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $srno = $_POST['srno'];
        $sql = "SELECT * FROM `users` where `sno`=$srno";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
    
        if ($num > 0) {
            $show=true;
        }
        else {
            $alert = true;
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

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">


    <title>Welcome - <?php echo $_SESSION['ownername'] ?></title>

</head>

<body>
    <?php
    require'partials/_nav.php';
    if($alert){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Sorry!</strong> The Given Data is not found in Database
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";}?>





    <div class="container my-4">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Welcome Owner-<?php echo $_SESSION['ownername'] ?> </h4>
            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit
                longer
                so that you can see how spacing within an alert works with this kind of content.</p>
            <hr>
            <p class="mb-0">Whenever you need, you can logout <a href="/arpit/logout.php">using this link</a>
                .</p>
        </div>

    </div>
















    <div class="container text-center">
        <a class="btn btn-primary btn-lg mb-4 col-md-5  " href="/arpit/signup.php" role="button">REGISTER
            AN USER</a>
        <a class="btn btn-primary btn-lg mb-4 col-md-5 " href="/arpit/oSignup.php" role="button">REGISTER NEW
            OWNER </a>









        <form action="/arpit/admin.php" method="post">
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label ">Enter the User Id</label>
                <input type="text" class="form-control " id="srno" name="srno" ia-describedby=" emailHelp">
                <div id="textHelp" class="form-text ">Enter Unque User Id to Search</div>

                <button type="submit" class="btn btn-primary col">Search</button>
        </form>

    </div>




    <div class="container my-4">




        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Uder Id</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">No of Data</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>



                <?php

   // here you write code to fetch the data from db a partical user


if($show){
    $sql="SELECT * FROM `users` where `sno`=$srno ";
    $result=mysqli_query($conn,$sql);
    $sno=0;
    
    while($row= mysqli_fetch_assoc($result)){
        $sno = $sno +1;
        $id=$row['sno'];
        

        echo"<tr>
        <th scope='row'>". $sno."</th>
        <td>". $row['sno']."</td>
        <td><a href='opened.php?UserId=". $id."' class='card-title'>". $row['username']."</a></td>
        <td>". $row['password']."</td>
        
        
        
        <td><a href='opened.php?UserId=". $id."' class='open btn btn-sm btn-primary mb-1'>OPEN</a></td>
      </tr>";
    }
}else{
    $sql="SELECT * FROM `users` ";
$result=mysqli_query($conn,$sql);
$sno=0;




while($row= mysqli_fetch_assoc($result)){
    $sno = $sno +1;
    $id=$row['sno'];




  echo"<tr>
  <th scope='row'>". $sno."</th>
  <td>". $row['sno']."</td>
  <td><a href='opened.php?UserId=". $id."' class='card-title'>". $row['username']."</a></td>
  <td>". $row['password']."</td>
  <td><span class='badge bg-danger rounded-pill'>14</span></td>
  
  <td><a href='opened.php?UserId=". $id."' class='open btn btn-sm btn-primary mb-1'>OPEN</a></td>
</tr>";
}

}

        

?>









    </div>
    <hr>
























    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
        Edit Modal
    </button> -->

    <!-- Modal -->













    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>



    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"
        integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js">

    </script>

    </script>








</body>

</html>