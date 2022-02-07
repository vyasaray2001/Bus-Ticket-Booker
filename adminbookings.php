<?php $title = "Bookings";
require_once 'include\header.php';
?>
<?php
session_start();
if (!(isset($_SESSION['loggedin'])) || $_SESSION['loggedin'] != true) {
    header("location: index.php");
    exit;
} elseif ($_SESSION['type'] != "admin") {
    session_unset();
    session_destroy();
    header("location: index.php");
}
?>

<!-- navbar code begins -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand">
            <img src="images/logoad.png" alt="" width="75" height="45">

        </a>
        <a class="nav-link navbar-brand active " href="adminbookings.php">Bookings</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link " href="admin.php">Bus List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="adminuser.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="adminreview.php">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="logout.php">Logout</a>
                </li>


            </ul>

        </div>
    </div>
</nav>
<!-- navbar code ends -->


<!-- Sql For Condirming and Removing Tickets-->
<?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {   
            // Sql For Condirming Tickets
            
            if ($_POST['con']) 
            {
            $n=0;
            $sql="UPDATE `booking` SET `status` = 'confirmed' WHERE `booking`.`bookingno` = '".$_POST['con']."'";
            $result= mysqli_query($conn,$sql);
            $sql1= "SELECT * FROM `booking` WHERE `booking`.`bookingno` ='".$_POST['con']."' ";
            $result1= mysqli_query($conn,$sql1);
            while($row = mysqli_fetch_assoc($result1))
            {
                $sql2="UPDATE `bus` SET  `bus`.`Seatsused` = `Seatsused`+'".$row['nseats']."' WHERE `Busname`='".$row['bname']."'";
                $result2= mysqli_query($conn,$sql2);
                $n=$n+1;
            }
            if($n!=0)
            {   
                
                echo'<div class=" text-success alert alert-Success alert-dismissible fade show" role="alert">
                        <strong>Booking no '.$_POST["con"].' Confirmed.</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
            }
            // Sql For Removing Tickets
            elseif ($_POST['rem']) 
            {
                $sql="DELETE FROM `booking` WHERE `booking`.`bookingno` ='".$_POST['rem']."'";
                $result= mysqli_query($conn,$sql);
                if($result){
                    echo'<div class=" text-danger alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Booking no '.$_POST["rem"].' Removed.</strong> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
            }
            }

        }
?>

<!-- Sql For Condirming and Removing Tickets ends-->

<!-- body begins -->


<!--Current Bookings table starts here-->
<div class="container mt-2">
    <h2>Current Bookings</h2>
     <div class="container my-3 mx-10">
        <table class=" table table-borderless table-success table-striped">
            <thead>
                <tr>
                    <th scope="col">Bookingno</th>
                    <th scope="col">User</th>
                    <th scope="col">Bus</th>
                    <th scope="col">No of Seats</th>
                    <th scope="col">Booking Date</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                $num=1;
                $sql= "SELECT * FROM `booking` WHERE `status`= 'pending' AND `ustatus`= 'uconfirm'";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    echo '<tr>
                    <th >'.$row["bookingno"].'</th>
                    <th >'.$row["useremail"].'</th>
                    <td>'.$row["bname"].'</td>
                    <td>'.$row["nseats"].'</td>
                    <td>'.$row["date"].'</td>
                    <td>'.$row["totalprice"].'</td>
                    <td><form action="/dbmsproj/adminbookings.php" method="post"><button name="con" value="'.$row["bookingno"].'"class="btn btn-sm btn-success">Confirm</button></form></td>
                    <td><form action="/dbmsproj/adminbookings.php" method="post"><button name="rem" value="'.$row["bookingno"].'"class="btn btn-sm btn-danger">Delete</button></form></td>
                    
                    </tr>';
                    $num=0;
                    
                }
                
                if($num)
                {
                        echo '<tr>
                        <th ></th>
                        <th >No New Bookings</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>';
                    
                }
                
                
                
                
   
            ?>
            </tbody>
            </table>
        </div>
    
</div>

<div class="container mt-2">
<h2>Completed Bookings</h2>
    <div class="container my-3 mx-10">
    <table class=" table table-borderless table-success table-striped">
    <thead>
        <tr>
            <th scope="col">Bookingno</th>
            <th scope="col">User</th>
            <th scope="col">Bus</th>
            <th scope="col">Nof Seats</th>
            <th scope="col">Booking Date</th>
            <th scope="col">Total Price</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $num=1;
            $sql="SELECT * FROM `booking` WHERE `status`= 'confirmed'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result))
            {
                echo '<tr>
                <th >'.$row["bookingno"].'</th>
                <th >'.$row["useremail"].'</th>
                <td>'.$row["bname"].'</td>
                <td>'.$row["nseats"].'</td>
                <td>'.$row["date"].'</td>
                <td>'.$row["totalprice"].'</td>
                <td></td>
                </tr>';
                $num=0;
                
            }
                
            if($num)
            {
                    echo '<tr>
                    <th ></th>
                    <th >No Bokking History</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>';
                }
        ?>
    </tbody>   
    </table>         
    </div>
</div>



<?php require_once 'include\footer.php' ?>