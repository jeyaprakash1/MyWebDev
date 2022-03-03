<?php

$uname = $_POST['uname'];
$email  = $_POST['email'];
$gender = $_POST['gender'];
$mobile = $_POST['mobile'];




if (!empty($uname) || !empty($email) || !empty($gender) || !empty($mobile) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "webtest";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From user_details Where email = ? Limit 1";
  $INSERT = "INSERT Into user_details (uname , email ,gender, mobile )values(?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssi", $uname,$email,$gender,$mobile);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
