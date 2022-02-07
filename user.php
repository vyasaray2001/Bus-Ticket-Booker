
<?php
$title = "Buslist";
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
<!-- php shorthands for displaying buslist -->
<?php
$_ac_slep =  '<div class="p-0 m-2 rounded border border-2 border-success col-sm-6 " style="width: 13rem;"><form class=" text-dark" action="/dbmsproj/user.php" method="post">';
$_ac_sit =  '<div class="p-0 m-2 rounded border border-2 border-info col-sm-6 " style="width: 13rem;"><form class=" text-dark" action="/dbmsproj/user.php" method="post">';
$_nonac =  '<div class="p-0 m-2 rounded border border-2 border-warning col-sm-6 " style="width: 13rem;"><form class=" text-dark" action="/dbmsproj/user.php" method="post">';
?>
<!-- php shorthands for displaying buslist -->
<!-- navrbar code start -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand">
            <img src="images/logo.png" alt="" width="75" height="45">

        </a>
        <a class="nav-link navbar-brand active" href="user.php">Bus Lists</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link " href="userbookings.php">My Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="userreview.php">Reviews</a>
                </li>
                <li class="nav-item">
                <li class="nav-item">
                    <a class="nav-link " href="logout.php">Logout</a>
                </li>


            </ul>

        </div>
    </div>
</nav>
<!-- navrbar code ends -->

<!-- Add Ticket Starts Here -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_bname = $_POST['add']; 
    $sql = "SELECT * FROM `bus`  WHERE `Busname` = '$_bname'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $_price = $row['Price'];
    if ($result) 
    {
        $done = 0;
       // $sql = "SELECT * FROM `cart` WHERE `user` = '$userlogin'";
        $sql = "SELECT * FROM `booking` WHERE `useremail` = '$userlogin' AND `ustatus` = 'cart'";
        $result1 = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result1);
        if (!$num) 
        {
            $sql = "INSERT INTO `booking` (`useremail`, `bprice`, `bname`, `nseats`) VALUES ('" . $userlogin . " ', '" . $_price . "', '" . $_bname . "', '1')";
            $result2 = mysqli_query($conn, $sql);
            $done = 1;
        } else {
            while ($row = mysqli_fetch_assoc($result1)) {
                if ($_bname == $row['bname']) {

                    $_up = $row['nseats'] + 1;
                    $sql = "UPDATE `booking` SET `nseats` = '" . $_up . "' WHERE `booking`.`bname` = '" . $_bname . "' AND `booking`.`useremail`='" . $userlogin . "'";
                    $result2 = mysqli_query($conn, $sql);
                    $num = 0;
                    $done = 1;
                    break;
                }
            }
            if ($num) {
                $sql =  "INSERT INTO `booking` (`useremail`, `bprice`, `bname`, `nseats`) VALUES ('" . $userlogin . " ', '" . $_price . "', '" . $_bname . "', '1')";
                $result3 = mysqli_query($conn, $sql);
                $done = 1;
            }
        }
        if ($done) {
            echo '<div class=" text-success alert alert-Success alert-dismissible fade show" role="alert">
                            <strong>' . $_bname . ' Added To Booking List</strong> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
        } else {
            echo '<div class=" text-danger alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Could not add ' . $_bname . ' To Booking List</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }
}
?>
<!-- Add Ticket Ends Here -->

<!-- Buslist code Starts -->
<div class="container mt-3">
    <div class="row">
        <?php {
            $sql = "SELECT * FROM `bus` WHERE `Route` = 'Karkala-Banglore' ORDER BY `bus`.`Price` DESC";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num) {
                echo "<h1>Karkala-Banglore</h1>";
                while ($row = mysqli_fetch_assoc($result)) {
                    switch ($row['Bustype']) {
                        case 'A/C-Sleeper':
                            echo $_ac_slep . '<div class="card "><div class="card-body"><h5 class="card-title">' . $row["Busname"] . '</h5><p class="card-text"> ₹ ' . $row["Price"] . '<p class="card-text">Type:A/C-Sleeper</p>' . '<p class="card-text">SeatsLeft=' . $row["Seats"]-$row["Seatsused"] . '</p>' . '</p><button type="submit" name="add" value="' . $row["Busname"] . '"  class="btn btn-outline-info">Add Ticket</button></div></div></form></div>';
                            break;
                        case 'A/C-Seating':
                            echo $_ac_sit . '<div class="card "><div class="card-body"><h5 class="card-title">' . $row["Busname"] . '</h5><p class="card-text"> ₹ ' . $row["Price"] . '<p class="card-text">Type:A/C-Seating</p>' . '<p class="card-text">SeatsLeft=' . $row["Seats"]-$row["Seatsused"] . '</p>' . '</p><button type="submit" name="add" value="' . $row["Busname"] . ' " class="btn btn-outline-info">Add Ticket</button></div></div></form></div>';
                            break;
                        case 'NonA/C':
                            echo $_nonac . '<div class="card "><div class="card-body"><h5 class="card-title">' . $row["Busname"] . '</h5><p class="card-text"> ₹ ' . $row["Price"] . '<p class="card-text">Type:NonA/C</p>' . '<p class="card-text">SeatsLeft=' . $row["Seats"]-$row["Seatsused"] . '</p>' . '</p><button type="submit" name="add" value="' . $row["Busname"] . ' " class="btn btn-outline-info">Add Ticket</button></div></div></form></div>';
                            break;
                    }
                }
            }
            
        } {
            $sql = "SELECT * FROM `bus` WHERE `Route` = 'Banglore-Karkala'  ORDER BY `bus`.`Price` DESC";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num) {
                echo "<h1>Banglore-Karkala</h1>";
                while ($row = mysqli_fetch_assoc($result)) {
                    
                    switch ($row['Bustype']) {
                        case 'A/C-Sleeper':
                            echo $_ac_slep . '<div class="card "><div class="card-body"><h5 class="card-title">' . $row["Busname"] . '</h5><p class="card-text"> ₹ ' . $row["Price"] . '<p class="card-text">Type:A/C-Sleeper</p>' . '<p class="card-text">SeatsLeft=' . $row["Seats"]-$row["Seatsused"] . '</p>' . '</p><button type="submit" name="add" value="' . $row["Busname"] . '"  class="btn btn-outline-info">Add Ticket</button></div></div></form></div>';
                            break;
                        case 'A/C-Seating':
                            echo $_ac_sit . '<div class="card "><div class="card-body"><h5 class="card-title">' . $row["Busname"] . '</h5><p class="card-text"> ₹ ' . $row["Price"] . '<p class="card-text">Type:A/C-Seating</p>' . '<p class="card-text">SeatsLeft=' . $row["Seats"]-$row["Seatsused"] . '</p>' . '</p><button type="submit" name="add" value="' . $row["Busname"] . ' " class="btn btn-outline-info">Add Ticket</button></div></div></form></div>';
                            break;
                        case 'NonA/C':
                            echo $_nonac . '<div class="card "><div class="card-body"><h5 class="card-title">' . $row["Busname"] . '</h5><p class="card-text"> ₹ ' . $row["Price"] . '<p class="card-text">Type:NonA/C</p>' . '<p class="card-text">SeatsLeft=' . $row["Seats"]-$row["Seatsused"] . '</p>' . '</p><button type="submit" name="add" value="' . $row["Busname"] . ' " class="btn btn-outline-info">Add Ticket</button></div></div></form></div>';
                            break;
                    }
                }
            }
        } {
            $sql = "SELECT * FROM `bus` WHERE `Route` = 'Banglore-Mysore' ORDER BY `bus`.`Price` DESC";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num) {
                echo "<h1>Banglore-Mysore</h1>";
                while ($row = mysqli_fetch_assoc($result)) {
                    switch ($row['Bustype']) {
                        case 'A/C-Sleeper':
                            echo $_ac_slep . '<div class="card "><div class="card-body"><h5 class="card-title">' . $row["Busname"] . '</h5><p class="card-text"> ₹ ' . $row["Price"] . '<p class="card-text">Type:A/C-Sleeper</p>' . '<p class="card-text">SeatsLeft=' . $row["Seats"]-$row["Seatsused"] . '</p>' . '</p><button type="submit" name="add" value="' . $row["Busname"] . '"  class="btn btn-outline-info">Add Ticket</button></div></div></form></div>';
                            break;
                        case 'A/C-Seating':
                            echo $_ac_sit . '<div class="card "><div class="card-body"><h5 class="card-title">' . $row["Busname"] . '</h5><p class="card-text"> ₹ ' . $row["Price"] . '<p class="card-text">Type:A/C-Seating</p>' . '<p class="card-text">SeatsLeft=' . $row["Seats"]-$row["Seatsused"] . '</p>' . '</p><button type="submit" name="add" value="' . $row["Busname"] . ' " class="btn btn-outline-info">Add Ticket</button></div></div></form></div>';
                            break;
                        case 'NonA/C':
                            echo $_nonac . '<div class="card "><div class="card-body"><h5 class="card-title">' . $row["Busname"] . '</h5><p class="card-text"> ₹ ' . $row["Price"] . '<p class="card-text">Type:NonA/C</p>' . '<p class="card-text">SeatsLeft=' . $row["Seats"]-$row["Seatsused"] . '</p>' . '</p><button type="submit" name="add" value="' . $row["Busname"] . ' " class="btn btn-outline-info">Add Ticket</button></div></div></form></div>';
                            break;
                    }
                }
            }
        }
        ?>

    </div>
</div>
<!-- BusList code ends  -->


<?php require_once 'include\footer.php'; ?>
