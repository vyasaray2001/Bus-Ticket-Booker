<?php $title = "Index"; require_once 'include\header.php';?>

<nav class="navbar navbar-dark bg-dark ">
    <div class="container-fluid">


      <a class="navbar-brand">
        <img src="images/logo.png" alt="" width="75" height="45">
      </a>
      <a class="nav-link navbar-brand active" href="index.php">Bus Ticket Booker</a>


      <form class="d-flex">

        <button class="btn btn-sm btn-danger me-2" type="button" data-bs-toggle="modal"
          data-bs-target="#signupstaticBackdrop">SignUp</button>
        <button class="btn btn-sm btn-success" type="button" data-bs-toggle="modal"
          data-bs-target="#loginstaticBackdrop">Login</button>
      </form>

    </div>
</nav>

<!-- Login Signup Logic -->
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
    switch($_POST['qtype'])
    {
        case 1: $fullname=$_POST["fullname"];
                $mobileno=$_POST["mobileno"];
                $useremail=$_POST["useremail"];
                $password=$_POST["pass"];
                $cpassword=$_POST["cpass"];
                $sql="SELECT * FROM `user` WHERE `Email`='$useremail'";
                $result=mysqli_query($conn,$sql);
                $num=mysqli_num_rows($result);
                if(!$num){
                if($password==$cpassword)
                {
                $sql="INSERT INTO `user` (`Fullname`, `Mobileno`, `Email`, `Password`,`type`) VALUES ('$fullname ', '$mobileno', '$useremail', '$password', 'user')";
                $result=mysqli_query($conn,$sql);
                if($result)
                {
                    echo'<div class=" text-success alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Signed up successfully!.</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            }
            else{
              echo'<div class=" text-danger alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Passwords do not match !!.</strong> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
            }
            else{
              echo'<div class=" text-danger alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Username already registered !!</strong> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
            break;
    case 2: $useremail=$_POST["useremail"];
            $password=$_POST["pass"];
            $num=0;
            $sql="SELECT * FROM `user` WHERE `Email`='$useremail'";
            $result=mysqli_query($conn,$sql);
            $num=mysqli_num_rows($result);
            if($num)
            {
              
              $row = mysqli_fetch_assoc($result);
              if($password==$row['Password'])
              {
                session_start();
                $_SESSION['loggedin']= true;
                $_SESSION['useremail']= $useremail;
                $_SESSION['type']=$row['type'];
                if($row['type']=="user"){
                //   header("location: c-menu-page.php");
                header("location: user.php");
                }
                else{
                //   header("location: a-menu-page.php");
                header("location: admin.php");
                }

              }
              else{
                echo'<div class=" text-danger alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Wrong Password !!</strong> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              }
            }
            else{
              echo'<div class=" text-danger alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Username not registered !!</strong> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
            break;
  
  }}

?>

<!--modals for signup and login begins-->
  <!--signup modal -->
  <div class="modal fade" id="signupstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Hi there !! </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="/dbmsproj/index.php" method="POST" class="needs-validation">
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">Fullname</label>
                        <input type="text" maxlength="20" class="form-control" name="fullname" id="validationDefault01" required>
                        
                    </div>
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">Mobileno</label>
                        <input type="text" maxlength="20" class="form-control" name="mobileno" id="validationDefault01" required>
                        
                    </div>
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">Useremail</label>
                        <input type="text" maxlength="20" class="form-control" name="useremail" id="validationDefault01" required>
                        
                    </div>
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">Password</label>
                        <input type="password" class="form-control" name="pass" id="validationDefault01" required>
                        
                    </div>
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="cpass" id="validationDefault01" required>
                        
                    </div>
                        
                    
                    <button type="submit" name="qtype" value="1" class="btn btn-primary">Submit</button>
                </form>
        </div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
  <!--login modal -->
  <div class="modal fade" id="loginstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Login to proceed !!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="/dbmsproj/index.php" method="post" class="needs-validation">
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">Useremail</label>
                        <input type="text" class="form-control" name="useremail" id="validationDefault01" required>
                        
                    </div>
                    <div class="mb-3">
                        <label for="validationDefault01" class="form-label">Password</label>
                        <input type="password" class="form-control" name="pass" id="validationDefault01" required>
                        
                    </div>
                        
                    
                    <button type="submit" name="qtype" value="2" class="btn btn-primary">Submit</button>
                </form>
        </div>
        
      </div>
    </div>
  </div>









<?php 
require_once 'include\footer.php';
?>