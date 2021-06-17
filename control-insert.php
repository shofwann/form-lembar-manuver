<?php 

$conn=mysqli_connect("localhost","root","","db_lemver");

$idTask = $_POST['idTask'];





    $jumlah_baris = count($_POST["lokasiPembebasan"]);
    
    for ($i=0; $i<$jumlah_baris; $i++) {
        $lokasiManuverBebas = $_POST["lokasiPembebasan"][$i];
        $query = "INSERT INTO db_sub_form1
                  VALUE
                  ('','$idTask','$lokasiManuverBebas','','','','','','')
                 ";
         mysqli_query($conn,$query); 
    }






?>