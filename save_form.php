<?php

require 'koneksi.php';
$cdate=$_POST['c_date'];
$user=$_POST['user'];
$pekerjaan=$_POST['pekerjaan'];
$sdate=$_POST['s_date'];
$edate=$_POST['e_date'];
$lokasi=$_POST['lokasi'];
$waktu=$_POST['waktu'];
$req=$_POST['req'];
$ft=$_FILES['foto']['name'];
$file=$_FILES['foto']['tmp_name'];
$st=0;

$sql=mysqli_query ($conn,"INSERT INTO db_form (c_date,user,pekerjaan,lokasi,waktu,req,foto) VALUES('$cdate','$user','$pekerjaan','$lokasi','$waktu','$req','$ft')");

move_uploaded_file($file,"foto/".$ft);

if ($sql)
{
    ?>
    <script type="text/javascript">
        alert ('data berhasil dibuat');
        window.location="initiator-dasboard2.php";
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
