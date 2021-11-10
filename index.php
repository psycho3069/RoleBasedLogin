<?php
    session_start();
if (isset($_POST['submit'])){
    $con = mysqli_connect("localhost","root","","kmpi");

    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
 
    $username =$_POST['username'];
    $password =$_POST['password'];
    
    $sql = "SELECT * from users WHERE username='$username' AND password='$password'";
    if ($result = mysqli_query($con,$sql)) {
        
    
    $rowcount=mysqli_num_rows($result);
    if ($rowcount < 1){
        echo "<p>Invalid username/password combination</p>";
    } else {
        $row=mysqli_fetch_assoc($result);
       
        $_SESSION['sess_username'] = $row['username'];
        $_SESSION['sess_userrole'] = $row['role'];

        if ($_SESSION['sess_userrole'] == "admin") {
            header('Location: admin.php');
        } elseif ($_SESSION['sess_userrole'] == "teacher") {
            header('Location: teacher.php');
        } else {
            header('Location: user.php');
        }
    }
    }
    else{
        echo "error in sql";
    }
    
}
?>
<html>
<head>
    <title>PHP MySQLi Login System</title>
</head>
<body>
<h1>PHP MySQLi Login System</h1>
<!-- The HTML login form -->
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        Username: <input type="text" name="username" /><br />
        Password: <input type="password" name="password" /><br />
 
        <input type="submit" name="submit" value="Login" />
    </form>       
</body>
</html>