<?php $title = "My Bookings";
require_once 'include\header.php';
?>

<?php
session_start();
if (!(isset($_SESSION['loggedin'])) || $_SESSION['loggedin'] != true) {
    header("location: index.php");
    exit;
} else {
    if ($_SESSION['type'] != "user") {
        session_unset();
        session_destroy();
        header("location: index.php");
    }
    $userlogin = $_SESSION['useremail'];
}
?>
<!-- navbar code begins -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand">
            <img src="images/logo.png" alt="" width="75" height="45">

        </a>
        <a class="nav-link navbar-brand active" href="userbookings.php">My Bookings</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link " href="user.php">Bus Lists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="userreview.php">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="logout.php">Logout</a>
                </li>


            </ul>

        </div>
    </div>
</nav>
<!-- navbar code ends -->
<!-- Book reset begins -->
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['qtype']) {
        case 1: // to be showed to vishalll
            $sql = "SELECT * FROM `booking` WHERE `useremail` = '$userlogin' AND `ustatus` = 'cart'";
            $result = mysqli_query($conn, $sql);
            $sum = 0;
            $num = 0;
            $tdish = " ";
            while ($row = mysqli_fetch_assoc($result)) 
            {
                $temp = $row['bname'];
                $sum = ($row['bprice'] * $row['nseats']);
                $sql1 = "UPDATE `booking` SET `totalprice` = '" . $sum . "' WHERE `booking`.`bname` = '" . $temp . "' AND `booking`.`useremail`='" . $userlogin . "'";
                $result1 = mysqli_query($conn, $sql1);
                $sql2 = "UPDATE `booking` SET `ustatus` = 'uconfirm' WHERE `booking`.`bname` = '" . $temp . "' AND `booking`.`useremail`='" . $userlogin . "'";
                $result2 = mysqli_query($conn, $sql2);
                $num +=1;
            }


            if ($num) {

                if ($result2) {
                    echo '<div class=" text-success alert alert-Success alert-dismissible fade show" role="alert">
                            <strong>Ticket Booked Successfully!!</strong> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                }
            } 
            else 
            {
                echo '<div class=" text-danger alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Booking List is Empty !!.</strong> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
            }
            break;
        case 2:
            $sql = "DELETE FROM `booking` WHERE  `useremail` = '$userlogin' AND `ustatus` = 'cart'";
            $result = mysqli_query($conn, $sql);
            break;
        default:
            $xyz = $_POST['qtype'];
            $sql = "DELETE FROM `booking` WHERE  `useremail` = '$userlogin' AND `ustatus` = 'cart' AND `booking`.`bname`='" . $xyz . "'";
            $result = mysqli_query($conn, $sql);
            break;
    }
}
?>
<!-- book rest ends  -->
<!-- body begins -->
<div class="container mt-2">
    <h2>Curretnt Bookings</h2>
    <!--Curretnt Bookings table starts here-->
    <div class="container my-3 mx-10">
        <table class=" table table-borderless table-success table-striped">
            <thead>
                <tr>
                    <th scope="col">Srno</th>
                    <th scope="col">Busname</th>
                    <th scope="col">No Of Seats</th>
                    <th scope="col">Date</th>
                    <th scope="col">Price</th>

                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `booking` WHERE `useremail` = '$userlogin' AND `ustatus` = 'cart'";
                $result = mysqli_query($conn, $sql);
                $sum = 0;
                $num = 0;
                //$tdish = " ";
                $srno = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                <th scope= "row">' . $srno++ . '</th>
                <td>' . $row['bname'] . '</td>
                <td>' . $row['nseats'] . '</td>
                <td>' . $row['date'] . '</td>
                <td>' . $row['nseats'] * $row['bprice'] . '</td>
                <td><form action="/dbmsproj/userbookings.php" method="post"><button name="qtype" value="' . $row['bname'] . '"class="btn btn-sm btn-outline-danger"> Remove </button>
                </form></td>
                </tr>';
                    $sum += ($row['bprice'] * $row['nseats']);
                    $num += $row['nseats'];
                }

                echo
                "<th scope='row'></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Total Price=₹$sum</th>
            <th></th>
            </tr>";

                ?>
            </tbody>

        </table>
        <div class="columns">
            <form action="/dbmsproj/userbookings.php" method="post"><button type="submit" name="qtype" value="1" class="btn  btn-outline-dark">Book</button>
                <form action="/dbmsproj/userbookings.php" method="post"><button type="submit" name="qtype" value="2" class="btn  btn-outline-dark">Cancel</button>
        </div>
    </div>

</div>
<!--Curretnt Bookings table ends here-->
<!-- history starts here -->
<div class="container mt-2">
    <h2>Ticket Booking History</h2>
    <div class="container my-3 mx-10">
        <table class=" table table-borderless table-success table-striped">
            <thead>
                <tr>
                    <th scope="col">BookingNo</th>
                    <th scope="col">Bus Name</th>
                    <th scope="col">No Of Seats</th>
                    <th scope="col">Date</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $num = 1;
                $sql = "SELECT * FROM `booking` WHERE `status`= 'confirmed' AND `useremail`= '$userlogin'";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                <th >' . $row["bookingno"] . '</th>
                <td>' . $row["bname"] . '</td>
                <td>' . $row["nseats"] . '</td>
                <td>' . $row["date"] . '</td>
                <td>' . $row["totalprice"] . '</td>
                <td></td>
                </tr>';
                    $num = 0;
                }
                if ($num) {
                    echo '<tr>
                    <th ></th>
                    <td></td>
                    <th >No Booking History :(</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>';
                }





                ?>
            </tbody>
    </div>
</div>
<!-- history ends here -->
<!-- Body ends here -->




<?php require_once 'include\footer.php'; ?>