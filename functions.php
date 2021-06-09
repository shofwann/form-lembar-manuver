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
    $c_date = $post["c_date"];
    $user = $post["user"];
    $pekerjaan = htmlspecialchars($post["pekerjaan"]);
    $s_date = $post["s_date"];
    $e_date = $post["e_date"];
    $r_date = htmlspecialchars($post["r_date"]);
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


    $query = "INSERT INTO db_form 
                VALUE
            ('$idTask','$c_date','$user','$pekerjaan','$s_date','$e_date','$r_date','$lokasi','$waktu','$instal','$foto','$foto2','')
            ";          
    mysqli_query($conn,$query);

    $jumlah_baris = count($_POST["lokasiPembebasan"]);
    for ($indexke=0; $indexke < $jumlah_baris; $indexke++){
        $lokasiManuverBebas = $_POST["lokasiPembebasan"][$indexke];
        $query = "INSERT INTO db_sub_form1 
                    VALUE
                 ('','$idTask','$lokasiManuverBebas','','','','','')
                 ";
        mysqli_query($conn,$query);              
    }

    $jumlah_baris_manuver_manuver = count($_POST["lokasiManuverBebas"]);
    for ($indexke=0; $indexke<$jumlah_baris_manuver_manuver; $indexke++){
        $lokasiManuver1 = $_POST["lokasiManuverBebas"][$indexke];
        $installasiManuver1 = $_POST["installManuverBebas"][$indexke];
        
    }

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


?>








