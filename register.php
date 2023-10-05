<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registration Page</title>
</head>
<body>
    <div class="container">
        <form action="index.php" method="post">
            <h2>Register</h2>
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="username">mobile number:</label>
                <input type="number" id="number" name="number" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit" class="btn">Register</button>
        </form>
    </div>
</body>
</html>

<?php
    $conn = new mysqli('localhost','root','','todo');
if(isset($_POST['submit'])){
    $username = $_POST["username"];
    $number = $_POST["number"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "INSERT INTO list(`name`, `number`, `email`, `password`) VALUES ('$username','$number','$email','$password')";
    $result = mysqli_query($conn,$sql);

    if($result){
        header('location:login.php');
    }else{
        echo "connection fail!";
    }
}
?>