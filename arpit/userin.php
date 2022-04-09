<?php 

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
    header("location: login.php");
    exit();
}else{

 


    // connecting to database
    require'partials/_dbconnect.php';


        // for fetch the se.no from db
        $username=$_SESSION['username'];
        $sql="SELECT * FROM `users` where username='$username'";
        $result= mysqli_query($conn, $sql);
        $num=mysqli_fetch_assoc($result);
        // echo var_dump($num);
        $n=$num['sno'];
        // echo($n);

        
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

    <title>Welcome - <?php echo $_SESSION['username'] ?></title>

</head>

<body>
    <?php
    require'partials/_nav.php';?>

    <div class="container my-4">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Welcome-<?php echo $_SESSION['username'] ?> </h4>
            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit
                longer
                so that you can see how spacing within an alert works with this kind of content.</p>
            <hr>
            <p class="mb-0">Whenever you need, you can logout <a href="/arpit/logout.php">using this link</a>
                .</p>
        </div>

    </div>








    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
        Edit Modal
    </button> -->

    <!-- Modal -->
































    <div class="container my-4">




        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date&Time</th>

                </tr>
            </thead>
            <tbody>

                <?php

           // here you write code to fetch the data from db a partical user

           

                
        $sql="SELECT * FROM `note` WHERE `note`.`user_id` = $n";
        $result=mysqli_query($conn,$sql);
        $sno=0;

        while($row= mysqli_fetch_assoc($result)){
            $sno = $sno +1;

          echo"<tr>
          <th scope='row'>". $sno."</th>
          <td>". $row['title']."</td>
          <td>". $row['description']."</td>
          <td>". $row['tstamp']."</td>";
      }
      ?>








    </div>
    <hr>




























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
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>

    <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit", );
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[0].innerText;
            description = tr.getElementsByTagName("td")[1].innerText;
            console.log(title, description);
            titleEdit.value = title;
            descriptionEdit.value = description;
            snoEdit.value = e.target.id;
            console.log(e.target.id)
            $('#editModal').modal('toggle');

        })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit", );
            sno = e.target.id.substr(1, );

            if (confirm("Are you sure you want to delete this note!")) {
                console.log("yes")
                window.location = `/arpit/logsys/welcome.php?delete=${sno}`;
            } else {
                console.log("no")
            }
        })
    })
    </script>





</body>

</html>