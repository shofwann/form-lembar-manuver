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
    $query = "INSERT INTO db_form (id,create_date,user,pekerjaan,start_date,end_date,report_date,lokasi,waktu,installasi,foto,foto2,ae) VALUES ('$idTask','$create_date','$user','$pekerjaan','$start_date','$end_date','$report_date','$lokasi','$waktu','$instal','$foto','$foto2','approve')";
    mysqli_query($conn,$query);
    // cara-1
    $jumlah_baris = count($_POST["lokasiPembebasan"]);
    // print_r($jumlah_baris);exit;
    for ($i=0; $i<$jumlah_baris; $i++) {
        $lokasiManuverBebas = $_POST["lokasiPembebasan"][$i];
        $query = "INSERT INTO db_table_1 (id_form,lokasi) VALUES ('$idTask','$lokasiManuverBebas')";
        mysqli_query($conn,$query); 
     }

     $rows_tabel_3 = count($_POST["lokasiManuverBebas"]);
     for ($i=0; $i<$rows_tabel_3; $i++) {
         $lokasiManuverBebas = $_POST["lokasiManuverBebas"][$i];
         $installManuverBebas = $_POST["installManuverBebas"][$i];
         $query = "INSERT INTO db_table_3 (id_form,lokasi,installasi) VALUES ('$idTask','$lokasiManuverBebas','$installManuverBebas')";
         mysqli_query($conn,$query);
     }

     $rows_tabel_4 = count($_POST["lokasiManuverNormal"]);
     for ($i=0; $i<$rows_tabel_4; $i++) {
         $lokasiManuverNormal = $_POST["lokasiManuverNormal"][$i];
         $installManuverNormal = $_POST["installManuverNormal"][$i];
         $query = "INSERT INTO db_table_4 (id_form,lokasi,installasi) VALUES ('$idTask','$lokasiManuverNormal','$installManuverNormal')";
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
    $idTask =$post["idTask"];
    $fotolama1 = $post["fotoLama1"];
    $fotolama2 = $post["fotoLama2"];
    $pekerjaan = htmlspecialchars($post["pekerjaan"]);
    $start_date = $post["start_date"];
    $end_date = $post["end_date"];
    $report_date = htmlspecialchars($post["report_date"]);
    $lokasi = htmlspecialchars($post["lokasi"]);
    $waktu = htmlspecialchars($post["waktu"]);
    $instal = htmlspecialchars($post["instal"]);

    //cek apakah user ganti foto1
    if( $_FILES['foto']['error'] === 4){
        $foto = $fotolama1;
    } else {
        $foto = upload();
    }

    //
    if( $_FILES['foto2']['error'] === 4){
        $foto2 = $fotolama2;
    } else {
        $foto2 = upload2();
    }



    $query = "UPDATE db_form SET
             pekerjaan = '$pekerjaan',
             start_date = '$start_date',
             end_date = '$end_date',
             report_date = '$report_date',
             lokasi = '$lokasi',
             waktu = '$waktu',
             installasi = '$instal',
             foto = '$foto', 
             foto2 = '$foto2',
             ae = 'approve',
             amn = 'waiting',
             msb = 'waiting'
             WHERE id= '$idTask'   
            ";
    mysqli_query($conn,$query);

    $jumlah_baris_pelaksana = count($_POST["lokasiPembebasan"]);
    for($i=0; $i<$jumlah_baris_pelaksana; $i++) {
        $lokasiManuverBebas = $_POST["lokasiPembebasan"][$i];
        $idUpdate = $_POST["id_bebas_update"][$i];
        if ($idUpdate == '0'){
            $query = "INSERT INTO db_table_1 (id_form,lokasi) VALUES ('$idTask','$lokasiManuverBebas')";
        } else {
            $query = "UPDATE db_table_1 SET lokasi = '$lokasiManuverBebas' WHERE id=$idUpdate"; //id_form = '$idTask',
        }
        mysqli_query($conn,$query);
    }

    if (isset($_POST["id_hapus0"])){
        $jumlah_hapus = count($_POST["id_hapus0"]);
        for ($i=0; $i<$jumlah_hapus; $i++) {
            $id_hapus = $_POST["id_hapus0"][$i];
            $query = "DELETE FROM db_table_1 WHERE id='$id_hapus'";
            mysqli_query($conn,$query);
        }
    }

    $jumlah_baris_bebas = count($_POST["lokasiManuverBebas"]);
    for($i=0; $i<$jumlah_baris_bebas; $i++){
        $lokasiPembebasanManuver = $_POST["lokasiManuverBebas"][$i];
        $intallasiPembebasan = $_POST["installManuverBebas"][$i];
        $idUpdateBebas = $_POST["id_bebas_update2"][$i];
        if ($idUpdateBebas == '0') {
            $query = "INSERT INTO db_table_3 (id_form,lokasi,installasi) VALUES ('$idTask','$lokasiPembebasanManuver','$intallasiPembebasan')";
        } else {
            $query = "UPDATE db_table_3 SET lokasi = '$lokasiPembebasanManuver', installasi = '$intallasiPembebasan' WHERE id = $idUpdateBebas ";
        }
        mysqli_query($conn,$query);
    }

    if (isset($_POST["id_hapus1"])){
        $jumlah_hapus = count($_POST["id_hapus1"]);
        for ($i=0; $i<$jumlah_hapus; $i++) {
            $id_hapus = $_POST["id_hapus1"][$i];
            $query = "DELETE FROM db_table_3 WHERE id='$id_hapus'";
            mysqli_query($conn,$query);
        }

    }

    $jumlah_baris_normal = count($_POST["lokasiManuverNormal"]);
    for($i=0; $i<$jumlah_baris_normal; $i++){
        $lokasiPenormalanManuver = $_POST["lokasiManuverNormal"][$i];
        $installasiPenormalan = $_POST["instalManuverNormal"][$i];
        $idUpdateNormal = $_POST["id_normal_update3"][$i];
        if ($idUpdateNormal == '0') {
            $query = "INSERT INTO db_table_4 (id_form,lokasi,installasi) VALUE ('$idTask','$lokasiPenormalanManuver','$installasiPenormalan')";
        } else {
            $query = "UPDATE db_table_4 SET lokasi = '$lokasiPenormalanManuver', installasi = '$installasiPenormalan' WHERE id = $idUpdateNormal ";
        }
        mysqli_query($conn,$query);
    }

    if (isset($_POST["id_hapus2"])){
        $jumlah_hapus = count($_POST["id_hapus2"]);
        for ($i=0; $i<$jumlah_hapus; $i++) {
            $id_hapus = $_POST["id_hapus2"][$i];
            $query = "DELETE FROM db_table_4 WHERE id='$id_hapus'";
            mysqli_query($conn,$query);
        }

    }


    return mysqli_affected_rows($conn);
    
}

function aprovalAmn($post){
    global $conn;
    $idTask =$post["idTask"];
    $userAmn = $post["userAmn"];
    $aproval = $post["aproval"];

    $query = "UPDATE db_form SET 
             user_amn = '$userAmn',
             ae = 'waiting',
             amn = '$aproval'
             WHERE id = '$idTask'
             ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);

}

function aprovalMsb($post){
    global $conn;
    $idTask =$post["idTask"];
    $userMsb = $post["userMsb"];
    $aproval = $post["aproval"];

    $query = "UPDATE db_form SET 
             user_msb = '$userMsb',
             amn = 'waiting',
             msb = '$aproval'
             WHERE id = '$idTask'
             ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);

}

function hapus(){

}

function inputDispaAwal($post) {
    global $conn;
    $idTask = $post["idTask"]; 
    $jumlah_baris_nama = count($_POST["peng_pekerjaan"]);
    for ($i=0; $i<$jumlah_baris_nama; $i++) {
        $nama_pekerja = $_POST["peng_pekerjaan"][$i];
        $nama_manuver = $_POST["peng_manuver"][$i];
        $nama_k3 = $_POST["peng_k3"][$i];
        $nama_spv = $_POST["spv"][$i];
        $nama_opr = $_POST["opr"][$i];
        $id_isi = $_POST["sampel"][$i];
        $query = "UPDATE db_table_1 SET
                 pengawas_pekerjaan = '$nama_pekerja',
                 pengawas_manuver = '$nama_manuver',
                 pengawas_k3 = '$nama_k3',
                 spv_gitet = '$nama_spv',
                 opr_gitet = '$nama_opr'
                 WHERE id = $id_isi
                 ";
                 mysqli_query($conn,$query);
    }

    $document = implode(",", $_POST["dokumen"]);
    $scada_awal_before = htmlspecialchars($post["scada_awal_before"]);
    $scada_awal_after = htmlspecialchars($post["scada_awal_after"]);
    $dpf_awal = htmlspecialchars($post["dpf_awal"]);
    $catatan = htmlspecialchars($post["catatan_pasca_pembebasan"]);
    $userDispa = $post["userdispa"];

     $foto = upload3();
    //  if ( !$foto ) {
    //      return false;
    //  }

    $query = "UPDATE db_form SET
              user_dispa_awal = '$userDispa',
              document = '$document',
              scada_awal_before = '$scada_awal_before',
              scada_awal_after = '$scada_awal_after',
              dpf_awal = '$dpf_awal',
              catatan_pasca_pembebasan = '$catatan',
              dispa = 'penormalan',
              foto_dpf1 = '$foto'
              WHERE id = '$idTask'
              ";
    mysqli_query($conn,$query);
    
    $jumlah_manuver_bebas = count($_POST["remote_bebas"]);
    for ($i=0; $i<$jumlah_manuver_bebas; $i++) {
        $remote_bebas = $_POST["remote_bebas"][$i];
        $real_bebas = $_POST["real_bebas"][$i];
        $ads_bebas = $_POST["ads_bebas"][$i];
        $id_isi2 = $_POST["sampel_manuver"][$i];
        $query = "UPDATE db_table_3 SET 
                 remote_bebas = '$remote_bebas',
                 real_bebas = '$real_bebas',
                 ads_bebas = '$ads_bebas'
                 WHERE id = $id_isi2
                 ";
        mysqli_query($conn,$query);
    }

    return mysqli_affected_rows($conn);
}

function upload3() {
    $namaFile = $_FILES["dpfFile_awal"]["name"];
    $ukuranFile = $_FILES["dpfFile_awal"]["size"];
    $error = $_FILES["dpfFile_awal"]["error"];
    $tmpNama = $_FILES["dpfFile_awal"]["tmp_name"];

    //cek apakah tidak ada gambar yg diupload
    // if ($error === 4) {
    //     echo "<script>
    //             alert ('Anda belum upload gambar!');
    //           </script>";
    //     return false;
    // }
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
    move_uploaded_file($tmpNama, 'dpf/' . $namaFileBaru);
    return  $namaFileBaru;



}


?>