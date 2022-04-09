<?php 

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
    header("location: login.php");
    exit();
}else{

 

    $insert= false;
    $update=false;
    $delete=false;

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

        
    if(isset($_GET['delete'])){
        $sno= $_GET['delete'];
        $delete= true;
        $sql = "DELETE FROM `note` WHERE `note`.`sno` = $sno";
        $result= mysqli_query($conn, $sql);
        
        
    }



    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        if(isset($_POST['snoEdit'])){
            $sno=$_POST['snoEdit'] ;
            $title=$_POST['titleEdit'] ;
            $description=$_POST['descriptionEdit'];
      
           
      
            $sql="UPDATE `note` SET `title` = '$title' , `description` = '$description' WHERE `note`.`sno` = $sno";
            $result= mysqli_query($conn, $sql);
            if($result){
                $update=true;
                
            }
            else{
                echo("WE could not update record !");
            }
            
        }
    
        
        else{
            $title=$_POST['title'] ;
            $description=$_POST['description'];

     

            $sql="INSERT INTO `note` (`title`, `description`, `tstamp`, `user_id`) VALUES ('$title', '$description', current_timestamp(), '$n')";
            $result= mysqli_query($conn, $sql);

            if ($result) {
                 $insert= true;

                } 
                else {
                    echo("fail reeor---->" .mysqli_error($conn));
                }
       } 
    }else if(isset($_GET['delete'])){
        $sno= $_GET['delete'];
        $delete= true;;
        $sql = "DELETE FROM `note` WHERE `note`.`sno` = $sno";
        $result= mysqli_query($conn, $sql);
        
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

    <title>Welcome - <?php echo $_SESSION['username'] ?></title>

</head>

<body>
    <?php
    require'partials/_nav.php';?>
    <?php
    if($insert){
      echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> Your note has been inserted sucessfully
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    
    }
    if($delete){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note has been deleted sucessfully
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      
      
      }    
      if($update){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note has been updated sucessfully
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
    
  
    ?>
    <div class="container my-4">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Welcome-<?php echo $_SESSION['username'] ?> </h4>
            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit
                longer
                so that you can see how spacing within an alert works with this kind of content.</p>
            <hr>
            <p class="mb-0">Whenever you need, you can logout <a href="/arpit/logsys/logout.php">using this link</a>
                .</p>
        </div>

    </div>








    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
        Edit Modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit this Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/arpit/logsys/welcome.php" method="post">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="title" class="form-label">Note Title</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit"
                                aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3">
                            <label for="description">Note Description</label>
                            <div class="form-floating">
                                <textarea class="form-control" id="descriptionEdit" name="descriptionEdit"
                                    class="form-label" rows="5"></textarea>

                            </div>


                        </div>


                </div>
                <div class="modal-footer d-block mr-auto">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

















    <div class="container my-4">
        <h2>Add A Note</h2>
        <form action="/arpit/logsys/welcome.php" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="description">Note Description</label>
                <div class="form-floating">
                    <textarea class="form-control" id="description" name="description" class="form-label"
                        rows="5"></textarea>

                </div>

            </div>
            <button type="submit" class="btn btn-primary">Add Notes</button>
        </form>
    </div>






















    <div class="container my-4">




        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date&Time</th>
                    <th scope="col">Actions</th>
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
          <td>". $row['tstamp']."</td>
          <td>  <button class='edit btn btn-sm btn-primary mb-2' id =".$row['sno'].">Edit</button> 
          <button class='delete btn btn-sm btn-primary mb-2' id =d".$row['sno'].">Delete</button> </td>
      </tr>";
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