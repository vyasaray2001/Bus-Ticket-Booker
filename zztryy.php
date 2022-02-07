$sql1= "SELECT * FROM `booking` WHERE `bookingno` ='".$_POST['con']."' AND `status` = 'confirmed'";
            $result1= mysqli_query($conn,$sql1);
            while($row = mysqli_fetch_assoc($result1))
            {
                    $nseat=$row['nseats'];
                    $bname=$row['bname'];
                   // $sql="UPDATE `bus` SET `Seatsused` = '".$row["nseats"]."' WHERE `booking`.`bookingno` = '".$_POST['con']."'";
                    $sql2="UPDATE `bus` SET  `bus`.`Seatsused` = '.$nseat.' WHERE `Busname`='.$bname.'";
                    $result2= mysqli_query($conn,$sql2);
            }