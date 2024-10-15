<?php
$conn=mysqli_connect('localhost','root','','register_db');
if($conn->connect_error) 
    {
    echo "Not Connected\n";
    }
    
if($_SERVER["REQUEST_METHOD"]=="POST")
    {
    $email=$_POST['email'];
    $password=$_POST['password'];  
    }

$check_id="select * from users where email='$email'";
$result = $conn->query($check_id);
if ($result->num_rows > 0) {
    echo "This email address is already registered.Please use a different email id";
    exit;
}

$sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

if ($conn->query($sql) === TRUE) 
{           
echo "<p>Registration successful!</p>";
} else 
{
echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
}
$conn->close();
?>