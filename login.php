<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <form action="login.php" method="post">
            <h2>Login</h2>
            <?php
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger">';
    echo '<h6>' . $_SESSION["error"] . '</h6>';
    echo '</div>';
}
?>

            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>

<?php
$conn = new mysqli('localhost','root','','todo');
if(isset($_POST['submit'])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT name, email, `number`, password FROM list WHERE name='$username' AND password='$password'";
    $result = mysqli_query($conn,$sql);

    $name;
    $email;
    $number;

    if($result && mysqli_num_rows($result)>0){
       while ($row=mysqli_fetch_assoc($result)) {
           $email = $row['email'];
           $number = $row['number'];
       }
       session_start();
       $_SESSION['name'] = $username;
       $_SESSION['email'] = $email;
       $_SESSION['number'] = $number;

       header('location:home.php');
    }else{
        echo "fail";
    }

}
?>