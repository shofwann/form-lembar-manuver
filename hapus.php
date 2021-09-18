<?php

require "functions.php";
$id = $_GET["id"];

if ( hapusUser($id) > 0) {
    echo "<script>
            alert ('data berhasil dihapus');
            document.location.href ='admin-dashboard.php?url=users';
         </script>";
} else {
    echo "<script>
    alert ('data berhasil dihapus');
    document.location.href ='admin-dashboard.php?url=users';
 </script>";

}

?>