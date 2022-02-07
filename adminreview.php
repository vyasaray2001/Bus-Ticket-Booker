<?php $title = "Reviews";
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
        <a class="nav-link navbar-brand active " href="adminreview.php">Reviews</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link " href="admin.php">Bus List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="adminbookings.php">Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="adminuser.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="logout.php">Logout</a>
                </li>


            </ul>

        </div>
    </div>
</nav>
<!-- navbar code ends -->


<!-- review display part -->

<div class="container my-3 mx-10 col-9 mx-auto">
    <?php
    $num = 1;
    $sql = "SELECT * FROM `comments` ";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="card my-1 bg-transparent border-dark border-2  rounded-3">
    
    <div class="card-body">
        <h6>' . $row["topic"] . '</h6>
        
            <blockquote class="blockquote mb-0">
            <h6>' . $row["comment"] . '</h6>
      
            </blockquote>
            <h7>' . $row["time"] . '</h7>
            </div>
    </div>';
        $num = 0;
    }
    if ($num) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
       <strong>No Comments To Display.</strong> 
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
    }
    ?>
</div>