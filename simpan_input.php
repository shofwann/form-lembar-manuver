<?php

require 'koneksi.php';
$user=$_POST['user'];
$pekerjaan=$_POST['pekerjaan'];
$lokasi=$_POST['lokasi'];
$waktu=$_POST['waktu'];
$req=$_POST['req'];
$ft=$_FILES['foto']['name'];
$file=$_FILES['foto']['tmp_name'];
$st=0;

$sql=mysqli_query ($conn,"INSERT INTO inputroh (user,pekerjaan,lokasi,waktu,req,foto,statu) VALUES('$user','$pekerjaan','$lokasi','$waktu','$req','$ft','$st')");

move_uploaded_file($file,"foto/".$ft);

if ($sql)
{
    ?>
    <script type="text/javascript">
        alert ('data berhasil dibuat');
        window.location="input.php";
    </script>
    <?php
}
else {

    ?>
    <script>
    alert ('gagal');
    </script>
<?php
}




?>