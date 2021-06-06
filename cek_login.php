<?php
session_start();
require "functions.php";
$user=$_POST['username'];
$pass=$_POST['password'];

$sql=mysqli_query($conn, "SELECT * FROM db_user WHERE username='$user' AND password='$pass'");
$cek=mysqli_num_rows($sql);

    if ($cek>0)
    {
        $data = mysqli_fetch_assoc($sql);
        
        session_start();
        if($data["level"]=="admin"){
            $_SESSION['username'] = $user;
            $_SESSION["level"] = "admin";
            header("location:blank.html");
        }

        elseif ($data["level"]=="initiator") {
            $_SESSION["username"] = $user;
            $_SESSION["level"] = "initiator";
            header("location:initiator-dashboard.php");
        }

        elseif ($data["level"]=="dispa"){
            $_SESSION['username'] = $user;
            $_SESSION["level"] = "dispa";
            header("location:dispa-dashboard.php");
        }
    }
    else
    {
        ?>
        <script type="text/javascript">
        alert ('belum terdaftar');
        window.location="index.php";
        </script>    
        <?php
    }

?>