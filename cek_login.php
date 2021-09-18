<?php
session_start();
require "functions.php";
$user=$_POST['username'];
$pass=$_POST['password'];

$sql=mysqli_query($conn, "SELECT * FROM db_user WHERE username='$user'");
$data = mysqli_fetch_assoc($sql);

if (mysqli_num_rows($sql)>0) {
    if (password_verify($pass, $data["password"])) {

        session_start();
        if($data["level"]=="admin"){
            $_SESSION['username'] = $user;
            $_SESSION["level"] = "admin";
            header("location:admin-dashboard.php");
            exit;
        }

        elseif ($data["level"]=="initiator") {
            $_SESSION["username"] = $user;
            $_SESSION["level"] = "initiator";
            header("location:initiator-dashboard.php");
            exit;
        }

        elseif ($data["level"]=="amn"){
            $_SESSION['username'] = $user;
            $_SESSION["level"] = "amn";
            header("location:amn-dashboard.php");
            exit;
        }

        elseif ($data["level"]=="msb"){
            $_SESSION['username'] = $user;
            $_SESSION["level"] = "msb";
            header("location:msb-dashboard.php");
        }

        elseif ($data["level"]=="dispa"){
            $_SESSION['username'] = $user;
            $_SESSION["level"] = "dispa";
            header("location:dispa-dashboard.php");
        }

        elseif ($data["level"]=="amn_dispa"){
            $_SESSION['username'] = $user;
            $_SESSION["level"] = "amn_dispa";
            header("location:dispa-amn-dashboard.php");
        }

        elseif ($data["level"]=="plh_amn"){
            $_SESSION['username'] = $user;
            $_SESSION["level"] = "plh_amn";
            header("location:plh-amn-dashboard.php");
        }

        elseif ($data["level"]=="plh_msb"){
            $_SESSION['username'] = $user;
            $_SESSION["level"] = "plh_msb";
            header("location:plh-msb-dashboard.php");
        }

        elseif ($data["level"]=="plh_amn_dispa"){
            $_SESSION['username'] = $user;
            $_SESSION["level"] = "plh_amn_dispa";
            header("location:plh-amn-dispa-dashboard.php");
        }

    }
    else{
        ?>
        <script type="text/javascript">
        alert ('belum terdaftar');
        window.location="index.php";
        </script>    
        <?php
    }
    }


   

?>