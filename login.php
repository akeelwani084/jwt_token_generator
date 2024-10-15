<!-- <?php
$conn=mysqli_connect('localhost','root','','register_db');
if($conn->connect_error) {
    echo "Not Connected\n";
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email=$_POST['email'];
    $password=$_POST['password'];
}

$sql="select * from users where email='$email' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['password']==$password) 
    {
        echo "<p>Login successful! .</p>";
    } 
    else 
    {
        echo "<p>Login failed. Invalid username or password.</p>";
    }
} else {
    echo "<p>Login failed. Invalid username or password.</p>";
     }

// Close connection
$conn->close();

?> -->








<?php
require 'vendor/autoload.php';

use Firebase\JWT\JWT;

$conn = mysqli_connect('localhost', 'root', '', 'register_db');
if ($conn->connect_error) {
    echo "Not Connected\n";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
}

$sql = "select * from users where email='$email' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['password'] == $password) {
        // Generate JWT token
        $token = [
            "email" => $email,
            // You can add more claims as needed
        ];
        $jwt = JWT::encode($token, 'abcdef', 'HS256'); // Specify the algorithm as the third argument

        // Redirect user to a success page
        header("Location: success.php?token=" . $jwt);
        exit;
    } else {
        echo "<p>Login failed. Invalid username or password.</p>";
    }
} else {
    echo "<p>Login failed. Invalid username or password.</p>";
}

// Close connection
$conn->close();
?>









