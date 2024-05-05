<?php
include("connect.php");

$name = $_POST['name'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$address = $_POST['address'];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];

if ($password == $cpassword) {
    move_uploaded_file($tmp_name, "../uploads/$image");
    $insert = mysqli_query($connect, "INSERT INTO user (name, mobile, address, password, photo, role, status, votes) 
                                      VALUES ('$name', '$mobile', '$address', '$password', '$image', '$role', 'active', 0)");
    if ($insert) {
        echo  '<script>
                   alert("Registration Successful!");
                   window.location = "../";
               </script>';
    } else {
        echo  '<script>
                   alert("Some error occurred!");
                   window.location = "../routes/register.html";
               </script>';
    }
} else {
    echo  '<script>
               alert("Password and confirm password do not match!");
               window.location = "../routes/register.html";
           </script>';
}
?>
Connected!
