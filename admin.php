<?php $title = "Bus Lists";
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
<!-- php shorthands for displaying buslist -->
<?php
$_ac_slep =  '<div class="p-0 m-2 rounded border border-2 border-success col-sm-6 " style="width: 13rem;">';
$_ac_sit =  '<div class="p-0 m-2 rounded border border-2 border-info col-sm-6 " style="width: 13rem;">';
$_nonac =  '<div class="p-0 m-2 rounded border border-2 border-warning col-sm-6 " style="width: 13rem;">';
?>

<!-- php shorthands for displaying buslist -->

<!-- navbar code begins -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand">
            <img src="images/logoad.png" alt="" width="75" height="45">

        </a>
        <a class="nav-link navbar-brand active " href="admin.php">Bus List</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link " href="adminbookings.php">Bookings</a>
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
<!-- edit sql -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    switch ($_POST['qtype']) {
        case 1:
            $sql = "INSERT INTO `bus` (`Busname`, `Bustype`, `Route`, `Price`,`Drivername`) VALUES ('" . $_POST['bname'] . " ', '" . $_POST['btype'] . "', '" . $_POST['route'] . "', '" . $_POST['price'] . "', '" . $_POST['driver'] . "')";
            $result = mysqli_query($conn, $sql);
            if ($result) {

                echo '<div class=" text-success alert alert-Success alert-dismissible fade show" role="alert">
                        <strong>Bus ' . $_POST["bname"] . ' added to db.</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            } else {
                echo '<div class=" text-danger alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Bus ' . $_POST["bname"] . ' is already present.</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
            break;
        case 2:
            $sql = "DELETE FROM `bus` WHERE `bus`.`Busname` = '" . $_POST['bname'] . "'";
            $result = mysqli_query($conn, $sql);
            $aff = mysqli_affected_rows($conn);
            if (!$aff) {
                echo '<div class=" text-danger alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Bus ' . $_POST["bname"] . ' is not present.</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            } elseif ($result) {

                echo '<div class=" text-success alert alert-Success alert-dismissible fade show" role="alert">
                        <strong>Bus ' . $_POST["bname"] . ' removed.</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            } else {
                echo '<div class=" text-danger alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Bus ' . $_POST["bname"] . ' is not present.</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
            break;
        case 3:
            $sql = "UPDATE `bus` SET `Price` = '" . $_POST['nprice'] . "' WHERE `bus`.`Busname` = '" . $_POST['bname'] . "'";
            $result = mysqli_query($conn, $sql);
            $aff = mysqli_affected_rows($conn);
            if (!$aff) {
                echo '<div class=" text-danger alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Bus ' . $_POST["bname"] . ' is not present.</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            } elseif ($result) {

                echo '<div class=" text-success alert alert-Success alert-dismissible fade show" role="alert">
                        <strong>Bus Price of ' . $_POST["bname"] . ' updated.</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            } else {
                echo '<div class=" text-danger alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Bus ' . $_POST["bname"] . ' is not present.</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }

            break;
        case 4:
            $sql = "UPDATE `bus` SET `Drivername` = '" . $_POST['ndriver'] . "' WHERE `bus`.`Busname` = '" . $_POST['bname'] . "'";
            $result = mysqli_query($conn, $sql);
            $aff = mysqli_affected_rows($conn);
            if (!$aff) {
                echo '<div class=" text-danger alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Bus ' . $_POST["bname"] . ' is not present.</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            } elseif ($result) {

                echo '<div class=" text-success alert alert-Success alert-dismissible fade show" role="alert">
                        <strong>Driver Name of Bus ' . $_POST["bname"] . ' updated.</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            } else {
                echo '<div class=" text-danger alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Bus ' . $_POST["bname"] . ' is not present.</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }

            break;
    }
}
?>
<!-- edit sql ends -->
<!-- Bus editing Frontend -->
<div class="container mt-2">
    <nav class="navbar navbar-light ">
        <form class="container-fluid justify-content-start">
            <button class="btn btn-sm btn-dark m-1" type="button" data-bs-toggle="modal" data-bs-target="#addbus">Add Bus</button>
            <button class="btn btn-sm btn-dark m-1" type="button" data-bs-toggle="modal" data-bs-target="#removebus">Remove Bus</button>
            <button class="btn btn-sm btn-dark m-1" type="button" data-bs-toggle="modal" data-bs-target="#updatebus">Update Bus Price</button>
            <button class="btn btn-sm btn-dark m-1" type="button" data-bs-toggle="modal" data-bs-target="#updatedriver">Update Bus Driver</button>
            <!-- <button class="btn btn-sm btn-dark m-1" type="button" data-bs-toggle="modal" data-bs-target="#removeroute">Remove Route</button> -->
        </form>
    </nav>
</div>
<!-- Bus editing Frontend ends  -->
<!-- Modal of adding bus-->

<div class="modal fade" id="addbus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">Add Bus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dbmsproj/admin.php" method="post" class="needs-validation">
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">Bus name</label>
                        <input type="text" name="bname" class="form-control" id="validationDefault01" required>

                    </div>
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">Price</label>
                        <input type="text" name="price" class="form-control" id="validationDefault01" required>

                    </div>
                    <div class="mb-3">

                        <span>Bus Type</span>
                        <select class="form-control my-2 " name="btype">
                            <option value="A/C-Sleeper">A/C-Sleeper</option>
                            <option value="A/C-Seating">A/C-Seating</option>
                            <option value="NonA/C">NonA/C</option>
                        </select>
                        <span>Bus Route</span>
                        <select class="form-control my-2 " name="route">
                            <option value="Karkala-Banglore">Karkala-Banglore</option>
                            <option value="Banglore-Karkala">Banglore-Karkala</option>
                            <option value="Banglore-Mysore">Banglore-Mysore</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">Drivername</label>
                        <input type="text" name="driver" class="form-control" id="validationDefault01" required>

                    </div>

                    <button type="submit" name="qtype" value="1" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal of remove bus -->
<div class="modal fade" id="removebus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">Remove Bus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dbmsproj/admin.php" method="post" class="needs-validation">
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">Bus name</label>
                        <input type="text" name="bname" class="form-control" id="validationDefault01" required>

                    </div><button type="submit" name="qtype" value="2" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal of remove bus -->
<div class="modal fade" id="removebus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">Remove Bus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dbmsproj/admin.php" method="post" class="needs-validation">
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">Bus name</label>
                        <input type="text" name="bname" class="form-control" id="validationDefault01" required>

                    </div><button type="submit" name="qtype" value="2" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal of update bus price -->
<div class="modal fade" id="updatebus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">Update Price</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dbmsproj/admin.php" method="post" class="needs-validation">
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">Bus name</label>
                        <input type="text" class="form-control" name="bname" id="validationDefault01" required>

                    </div>
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">New Price</label>
                        <input type="text" class="form-control" name="nprice" id="validationDefault01" required>

                    </div>


                    <button type="submit" name="qtype" value="3" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal of update bus drivername -->
<div class="modal fade" id="updatedriver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">Update Price</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dbmsproj/admin.php" method="post" class="needs-validation">
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">Bus name</label>
                        <input type="text" class="form-control" name="bname" id="validationDefault01" required>

                    </div>
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">New Drivername</label>
                        <input type="text" class="form-control" name="ndriver" id="validationDefault01" required>

                    </div>


                    <button type="submit" name="qtype" value="4" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modals of editing ends-->


<!-- Buslist code Starts -->
<div class="container mt-3">
    <div class="row">
        <?php {
            $sql = "SELECT * FROM `bus` WHERE `Route` = 'Karkala-Banglore'  ORDER BY `bus`.`Price` DESC";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num) {
                echo "<h1>Karkala-Banglore</h1>";
                while ($row = mysqli_fetch_assoc($result)) {
                    switch ($row['Bustype']) {
                        case 'A/C-Sleeper':
                            echo $_ac_slep . '<div class="card"><div class="card-body"><h5 class="card-title">' . $row['Busname'] . '</h5><p class="card-text"> ₹ ' . $row['Price'] . '</p><p class="card-text">Type: A/C-Sleeper</p><p class="card-text"> Dname:' . $row['Drivername'] . '</p></div></div></div>';
                            break;
                        case 'A/C-Seating':
                            echo $_ac_sit . '<div class="card"><div class="card-body"><h5 class="card-title">' . $row['Busname'] . '</h5><p class="card-text"> ₹ ' . $row['Price'] . '</p><p class="card-text">Type:A/C-Seating</p><p class="card-text"> Dname:' . $row['Drivername'] . '</p></div></div></div>';
                            break;
                        case 'NonA/C':
                            echo $_nonac . '<div class="card"><div class="card-body"><h5 class="card-title">' . $row['Busname'] . '</h5><p class="card-text"> ₹ ' . $row['Price'] . '</p><p class="card-text">Type: NonA/C</p><p class="card-text"> Dname:' . $row['Drivername'] . '</p></div></div></div>';
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
                            echo $_ac_slep . '<div class="card"><div class="card-body"><h5 class="card-title">' . $row['Busname'] . '</h5><p class="card-text"> ₹ ' . $row['Price'] . '</p><p class="card-text">Type: A/C-Sleeper</p><p class="card-text"> Dname:' . $row['Drivername'] . '</p></div></div></div>';
                            break;
                        case 'A/C-Seating':
                            echo $_ac_sit . '<div class="card"><div class="card-body"><h5 class="card-title">' . $row['Busname'] . '</h5><p class="card-text"> ₹ ' . $row['Price'] . '</p><p class="card-text">Type:A/C-Seating</p><p class="card-text"> Dname:' . $row['Drivername'] . '</p></div></div></div>';
                            break;
                        case 'NonA/C':
                            echo $_nonac . '<div class="card"><div class="card-body"><h5 class="card-title">' . $row['Busname'] . '</h5><p class="card-text"> ₹ ' . $row['Price'] . '</p><p class="card-text">Type: NonA/C</p><p class="card-text"> Dname:' . $row['Drivername'] . '</p></div></div></div>';
                            break;
                    }
                }
            }
        } {
            $sql = "SELECT * FROM `bus` WHERE `Route` = 'Banglore-Mysore'  ORDER BY `bus`.`Price` DESC";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num) {
                echo "<h1>Banglore-Mysore</h1>";
                while ($row = mysqli_fetch_assoc($result)) {
                    switch ($row['Bustype']) {
                        case 'A/C-Sleeper':
                            echo $_ac_slep . '<div class="card"><div class="card-body"><h5 class="card-title">' . $row['Busname'] . '</h5><p class="card-text"> ₹ ' . $row['Price'] . '</p><p class="card-text">Type: A/C-Sleeper</p><p class="card-text"> Dname:' . $row['Drivername'] . '</p></div></div></div>';
                            break;
                        case 'A/C-Seating':
                            echo $_ac_sit . '<div class="card"><div class="card-body"><h5 class="card-title">' . $row['Busname'] . '</h5><p class="card-text"> ₹ ' . $row['Price'] . '</p><p class="card-text">Type:A/C-Seating</p><p class="card-text"> Dname:' . $row['Drivername'] . '</p></div></div></div>';
                            break;
                        case 'NonA/C':
                            echo $_nonac . '<div class="card"><div class="card-body"><h5 class="card-title">' . $row['Busname'] . '</h5><p class="card-text"> ₹ ' . $row['Price'] . '</p><p class="card-text">Type: NonA/C</p><p class="card-text"> Dname:' . $row['Drivername'] . '</p></div></div></div>';
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