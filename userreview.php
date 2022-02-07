<?php $title = "My Profile";
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
        <a class="nav-link navbar-brand active" href="userreview.php">Reviews</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link " href="user.php">Bus Lists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="userbookings.php">My Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="logout.php">Logout</a>
                </li>


            </ul>

        </div>
    </div>
</nav>
<!-- navbar code ends -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $sql = "INSERT INTO `comments`(`topic`,`comment`,`time`,`user`) VALUES ('" . $_POST['topic'] . "','" . $_POST['comment'] . "',current_timestamp(),'" . $userlogin . "')";
    $result = mysqli_query($conn, $sql);
    if ($result) 
    {
        echo '<div class=" text-success alert alert-Success alert-dismissible fade show" role="alert">
                        <strong>Comment added</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
    }
}
?>

<!-- review display part -->

<div class="container my-3 mx-10 col-9 mx-auto">
    <?php
    $sql = "SELECT * FROM `comments` ";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="card my-1 bg-transparent  border-dark border-2  rounded-3">
    
    <div class="card-body">
        <h6>' . $row["topic"] . '</h6>
        
            <blockquote class="blockquote mb-0">
            <h6>' . $row["comment"] . '</h6>
      
            </blockquote>
            <h7>' . $row["time"] . '</h7>
            </div>
    </div>';
    }
    ?>
</div>
<!-- review entry part -->

<div class="container my-3  col-6 mx-auto">
    <form action="/dbmsproj/userreview.php" method="post">
        <div class="my-3 ">
            <input type="text" maxlength="20" placeholder="Topic" class="form-control" name="topic" id="validationDefault01" required>
        </div>
        <div class="mb-3 input-group">

            <textarea name="comment" placeholder="Comment"class="form-control" aria-label="With textarea" required></textarea>
            <button type="submit" class="btn btn-success">Post</button>
        </div>
    </form>
</div>
<!-- review part ends-->


<?php require_once 'include\footer.php'; ?>