<?php $title = "Users";
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
        <a class="nav-link navbar-brand active " href="adminuser.php">Users</a>

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
<div class="container mt-2">
    <h2>User Details</h2>
    <div class="container my-3 mx-10">
        <table class=" table table-borderless table-success table-striped">
            <thead>
                <tr>
                    <th scope="col">Fullname</th>
                    <th scope="col">User Email</th>
                    <th scope="col">Mobile No</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $num = 1;
                
                $sql = "SELECT * FROM `user` WHERE `type`= 'user'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                    <td>' . $row["Fullname"] . '</td>
                    <td>' . $row["Email"] . '</td>
                    <td>' . $row["Mobileno"] . '</td>
                    <td></td>
                    <td></td>
                    </tr>';
                    $num = 0;
                }

                if ($num) 
                {
                    echo '<tr>
                        <th ></th>
                        <th >No Users</th>
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