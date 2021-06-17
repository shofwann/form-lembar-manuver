<?php
$conn=mysqli_connect("localhost","root","","db_lemver");

function query($query){
    global $conn;
    $result = mysqli_query($conn,$query); //kotaknya
    $rows = []; //siapkan wadah kosong
    while($row = mysqli_fetch_assoc($result)){
        $rows [] = $row;
    }
    return $rows; //mengembalikan kotaknya yg dipilih
}

function tambah($post){
    //print_r($_POST); die();
    global $conn;
    $idTask =$post["idTask"];
    $create_date = $post["create_date"];
    $user = $post["user"];
    $pekerjaan = htmlspecialchars($post["pekerjaan"]);
    $start_date = $post["start_date"];
    $end_date = $post["end_date"];
    $report_date = htmlspecialchars($post["report_date"]);
    $lokasi = htmlspecialchars($post["lokasi"]);
    $waktu = htmlspecialchars($post["waktu"]);
    $instal = htmlspecialchars($post["instal"]);

    //upload gambar
    $foto = upload(); 
     if( !$foto ){
         return false;
     }

    $foto2 = upload2(); 
    if( !$foto2 ){
        return false;
    }
    //print_r($_POST);exit;
    $query = "INSERT INTO db_form 
              VALUE
              ('$idTask','$create_date','$user','$pekerjaan','$start_date','$end_date','$report_date','$lokasi','$waktu','$instal','$foto','$foto2')
             ";
    mysqli_query($conn,$query);

    // cara-1
    $jumlah_baris = count($_POST["lokasiPembebasan"]);
    // print_r($jumlah_baris);exit;
    for ($i=0; $i<$jumlah_baris; $i++) {
        $lokasiManuverBebas = $_POST["lokasiPembebasan"][$i];
        $query = "INSERT INTO db_table_1 (id_form,lokasi) VALUES ('$idTask','$lokasiManuverBebas')";
        mysqli_query($conn,$query); 
     }

    // cara-2
    // foreach ($_POST["lokasiPembebasan"] as $lokasi ) {
    //     $query = "INSERT INTO `db_sub_form1` ( `id_form_main`, `lokasiPembebasan`) VALUES ('$idTask','$lokasi')";
    //     mysqli_query($conn,$query); 
    //   }

    // foreach ($_POST["lokasiManuverBebas"] as $lokasiManuverBebas) {
    //     $query = "INSERT INTO `db_manuver1` (`id_form_main`,`lokasiManuverBebas`) VALUES ('$idTask','$lokasiManuverBebas')";
    //     mysqli_query($conn,$query);
    // }

    // foreach ($_POST["installManuverBebas"] as $installManuverBebas) {
    //     $query = "INSERT INTO `db_manuver1` (`installManuverBebas`) VALUES ('$installManuverBebas') WHERE db_manuver1.id_form_main = `$idTask`";
    //     mysqli_query($conn,$query);
    // }

    // cara-3

    //$keys = array_keys($_POST["lokasiPembebasan"]);
    
    // for ($i=0; $i<3; $i++) {
       
    //     $lokasiManuverBebas = $_POST["lokasiPembebasan"][$i];
    //     $query = "INSERT INTO db_sub_form1
    //               VALUE
    //               ('','$idTask','$lokasiManuverBebas','','','','','','')
    //              ";
    //      mysqli_query($conn,$query); 

    // };
    
    

    return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile = $_FILES["foto"]["name"];
    $ukuranFile = $_FILES["foto"]["size"];
    $error = $_FILES["foto"]["error"];
    $tmpNama = $_FILES["foto"]["tmp_name"];

    //cek apakah tidak ada gambar yg diupload
    if( $error === 4) {     //angka 4 indikasi error tidak ada gambar yg diupload baku
        echo "<script>
                alert ('Anda belum upload gambar!');
                </script>";
        return false;
    }
    //cek yang diupload gambar atau bukan
    $ekstensiGambarValid = ['jpg','jpeg','png']; //menentukan format
    $ekstensiGambar = explode('.',$namaFile); //explode untuk delimiter nama file menjadi array contoh shofwan.jpg menjadi ['shofwan'.'jpg']
    $ekstensiGambar = strtolower(end($ekstensiGambar)); // end untuk mengambil array paling belakang dimana paling belakang jpg/png/jpeg strtolower untuk mengecilkan huruf jika format kapital
    if( !in_array($ekstensiGambar,$ekstensiGambarValid)){
        echo "<script>
                alert ('Anda tidak mengupload gambar format jpg, jpeg dan png!');
                </script>";
        return false;

    } 

    //cek ukuran gambar
    if( $ukuranFile > 1000000){
        echo "<script>
                alert ('Anda mengupload gambar ukuran diatas 1MW');
                </script>";
        return false;
    }

    //lolos upload
    //generate nama gambar agar tidak ada yg sama
    $namaFileBaru = uniqid();                               //membuat nama file random
    $namaFileBaru .= '.';                                   //menggabungkan nama file baru dengan ekstensu eksisting
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpNama, 'img/' . $namaFileBaru);
    return  $namaFileBaru;


}

function upload2(){
    $namaFile = $_FILES["foto2"]["name"];
    $ukuranFile = $_FILES["foto2"]["size"];
    $error = $_FILES["foto2"]["error"];
    $tmpNama = $_FILES["foto2"]["tmp_name"]; 

    //cek apakah tidak ada gambar yg diupload
    if( $error === 4) {     //angka 4 indikasi error tidak ada gambar yg diupload baku
        echo "<script>
                alert ('Anda belum upload gambar!');
                </script>";
        return false;
    }

    //cek yang diupload gambar atau bukan
    $ekstensiGambarValid = ['jpg','jpeg','png']; //menentukan format
    $ekstensiGambar = explode('.',$namaFile); //explode untuk delimiter nama file menjadi array contoh shofwan.jpg menjadi ['shofwan'.'jpg']
    $ekstensiGambar = strtolower(end($ekstensiGambar)); // end untuk mengambil array paling belakang dimana paling belakang jpg/png/jpeg strtolower untuk mengecilkan huruf jika format kapital
    if( !in_array($ekstensiGambar,$ekstensiGambarValid)){
        echo "<script>
                alert ('Anda tidak mengupload gambar format jpg, jpeg dan png!');
                </script>";
        return false;

    } 

    //cek ukuran gambar
    if( $ukuranFile > 1000000){
        echo "<script>
                alert ('Anda mengupload gambar ukuran diatas 1MW');
                </script>";
        return false;
    }

    //lolos upload
    //generate nama gambar agar tidak ada yg sama
    $namaFileBaru = uniqid();                               //membuat nama file random
    $namaFileBaru .= '.';                                   //menggabungkan nama file baru dengan ekstensi eksisting
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpNama, 'img/' . $namaFileBaru);
    return  $namaFileBaru;
}


function ubah($post){
    global $conn;
    $id = $post["id_form"];
    $pekerjaan = htmlspecialchars($post["pekerjaan"]);
    $s_date = $post["s_date"];
    $e_date = $post["e_date"];
    $r_date = htmlspecialchars($post["r_date"]);
    $lokasi = htmlspecialchars($post["lokasi"]);
    $waktu = htmlspecialchars($post["waktu"]);
    $instal = htmlspecialchars($post["instal"]);
    $fotoLama = $post["fotoLama"];
    //cek apakah user ganti foto
    if( $_FILES['foto']['error'] === 4){
        $foto = $fotoLama;
    } else {
        $foto = upload();
    }

    

    $query = "UPDATE db_form SET
             pekerjaan = '$pekerjaan',
             s_date = '$s_date',
             e_date = '$e_date',
             r_date = '$r_date',
             lokasi = '$lokasi',
             waktu = '$waktu',
             instal = '$instal',
             foto = '$foto'   
             WHERE id_form= $id   
            ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);

}

function hapus(){

}


?>