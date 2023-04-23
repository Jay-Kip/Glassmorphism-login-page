<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];



$errors = array();

$conn = new mysqli('localhost', 'root', 'kali', 'sign');

$checkmail = mysqli_query($conn, "SELECT * FROM sign WHERE email = 'email'");


if ($conn->connect_error){
    die("Connection Error!! : " .connect_error);
}
if(empty($email)){
    $errors['u'] = "Email required";
    echo "Email is required";
}
if (mysqli_num_rows($checkmail) > 0){
echo "User Exists";

}


if ($pass1 != $pass2 && $pass1 != "" && $pass2 != ""){
    echo "<script>alert('Error Password should be similar')</script>";
}

else{
    $stmt = $conn->prepare("insert into sign(fname, lname, email, pass1, pass2)
    values(?, ?, ?, ?, ?)");

    $stmt->bind_param("sssss",$fname, $lname, $email, $pass1, $pass2);
    $stmt->execute();
    
    $stmt->close();
    $conn->close();
}


?>