<?php
$conn=mysqli_connect("localhost","root","","db_lemver");
date_default_timezone_set('Asia/Jakarta');
// untuk ae
$jumlahDataPerHalaman = 5;
$jumlahManuver = count(query("SELECT * FROM db_form"));
$jumlahHalaman = ceil($jumlahManuver/$jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// untuk amn


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
    $query = "INSERT INTO db_form (id,create_date,user,pekerjaan,start_date,end_date,report_date,lokasi,waktu,installasi,foto,foto2,ae,amn,msb) VALUES ('$idTask','$create_date','$user','$pekerjaan','$start_date','$end_date','$report_date','$lokasi','$waktu','$instal','$foto','$foto2','approve','process','process')";
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
             amn = 'process',
             msb = 'process'
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
    $level = $post["level"];
    $time =$post["time"];

    $query = "UPDATE db_form SET 
             user_amn = '$userAmn',
             level_amn = '$level',
             time_amn_aprove = '$time',
             ae = 'aprovAmn',
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
    $level = $post["level"];
    $time = $post["time"];


    // rencana ditambahkan dispa = pembebasan dan status = pembebasan
    $query = "UPDATE db_form SET 
             user_msb = '$userMsb',
             level_msb ='$level',
             time_msb_aprove = '$time',
             ae = 'aprovMsb',
             msb = '$aproval',
             status = 'pembebasan',
             dispa = 'pembebasan'
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

    if (isset($_POST["document"])){
        $document = implode(",", $post["document"]);
        mysqli_query($conn,"UPDATE db_form SET document = '$document' WHERE id='$idTask'");
    }

   
    $fotolama = $post["fotoLama"];
    $scada_awal_before = htmlspecialchars($post["scada_awal_before"]);
    $scada_awal_after = htmlspecialchars($post["scada_awal_after"]);
    $dpf_awal = htmlspecialchars($post["dpf_awal"]);
    $catatan = htmlspecialchars($post["catatan_pasca_pembebasan"]);
    $userDispa = $post["userdispa"];
    $timeDispaAproveAwal = $post["timeAproveDispaAwal"];

    if( $_FILES['dpfFile_awal']['error'] === 4){
        $foto = $fotolama;
    } else {
        $foto = upload3();
    }

    $query = "UPDATE db_form SET
              user_dispa_awal = '$userDispa',
              scada_awal_before = '$scada_awal_before',
              scada_awal_after = '$scada_awal_after',
              dispa = 'approve',
              dpf_awal = '$dpf_awal',
              amn_dispa = 'checked',
              catatan_pasca_pembebasan = '$catatan',
              time_dispa_awal_aprove = '$timeDispaAproveAwal',
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


function inputDispaAkhir($post) {
    global $conn;
    $idTask = $post["idTask"];
    $jumlah_baris_nama = count($post["spv_gitet_normal"]);
    for ($i=0; $i<$jumlah_baris_nama; $i++){
        $nama_spv = $post["spv_gitet_normal"][$i];
        $nama_opr = $post["opr_gitet_normal"][$i];
        $id_isi = $post["sample"][$i];
        $query = "UPDATE db_table_1 SET
                 spv_gitet_normal = '$nama_spv',
                 opr_gitet_normal = '$nama_opr'
                 WHERE id = $id_isi
                 ";
                 mysqli_query($conn,$query);
    }

    $fotolama = $post["fotoLama"];
    $scada_akhir_before = htmlspecialchars($post["scada_akhir_before"]);
    $scada_akhir_after = htmlspecialchars($post["scada_akhir_after"]);
    $dpf_akhir = htmlspecialchars($post["dpf_akhir"]);
    $catatan = htmlspecialchars($post["catatan_pasca_penormalan"]);
    $userDispa = $post["userdispa"]; 
    $timeDispaAproveAkhir = $post["time"];

    if( $_FILES['dpfFile_akhir']['error'] === 4){
        $foto2 = $fotolama;
    } else {
        $foto2 = upload4();
    }

    
    $query = "UPDATE db_form SET
             user_dispa_akhir = '$userDispa',
             scada_akhir_before = '$scada_akhir_before',
             scada_akhir_after = '$scada_akhir_after',
             dpf_akhir = '$dpf_akhir',
             catatan_pasca_penormalan = '$catatan',
             time_dispa_akhir_aprove = '$timeDispaAproveAkhir',
             amn_dispa = 'checked',
             dispa = 'approve',
             foto_dpf2 = '$foto2'
             WHERE id = '$idTask'
             ";
    mysqli_query($conn,$query);

    $jumlah_manuver_normal = count($post["remote_normal"]);
    for ($i=0; $i<$jumlah_manuver_normal; $i++){
        $remote_normal = $post["remote_normal"][$i];
        $real_normal = $post["real_normal"][$i];
        $ads_normal = $post["ads_normal"][$i];
        $id_isi2 = $post["sampel2"][$i];
        $query = "UPDATE db_table_4 SET
                 remote_normal = '$remote_normal',
                 real_normal = '$real_normal',
                 ads_normal = '$ads_normal'
                 WHERE id = $id_isi2
                 ";
        mysqli_query($conn,$query);
    }

    return mysqli_affected_rows($conn);



}

function upload4() {
    $namaFile = $_FILES["dpfFile_akhir"]["name"];
    $ukuranFile = $_FILES["dpfFile_akhir"]["size"];
    $error = $_FILES["dpfFile_akhir"]["error"];
    $tmpNama = $_FILES["dpfFile_akhir"]["tmp_name"];

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

function amnDispaAproveAwal($post) {
    global $conn;
    $idTask = $post["idTask"];
    $userAmnDispa = $post["userAmnDispa"];
    $aproval = $post["aproval"];
    $timaAprovalAmnDispaAwal = $post["time"];

    $query = "UPDATE db_form SET
              user_amn_dispa_awal = '$userAmnDispa',
              amn_dispa = '$aproval',
              time_amnDispa_awal_aprove = '$timaAprovalAmnDispaAwal',
              dispa = 'process'
              WHERE id = '$idTask'
             ";
    mysqli_query($conn,$query);

    if ($aproval == 'approve') {
        mysqli_query($conn,"UPDATE db_form SET status = 'penormalan' WHERE id='$idTask'");
    }

    return mysqli_affected_rows($conn);



}

function amnDispaAproveAkhir($post) {
    global $conn;
    $idTask = $post["idTask"];
    $userAmnDispa = $post["userAmnDispa"];
    $aproval = $post["aproval"];
    $timeAprovalAmnDispaAkhir = $post["time"];

    $query = "UPDATE db_form SET
              user_amn_dispa_awal = '$userAmnDispa',
              amn_dispa = '$aproval',
              time_amnDispa_akhir_aprove = '$timeAprovalAmnDispaAkhir',
              dispa = 'done'
              WHERE id = '$idTask'
             ";
    mysqli_query($conn,$query);

    if ($aproval == 'approve') {
        mysqli_query($conn,"UPDATE db_form SET status = 'done' WHERE id='$idTask'");
    }

    return mysqli_affected_rows($conn);

}

function tambahDB($post) {
    global $conn;
    $form = $post["form"];
    $jenis = $post["jenis"];
    $lokasi = $post["lokasi"];
    $detail = $post["detailLokasi"];

    $cek_lokasi = mysqli_query($conn,"SELECT * FROM db_ajax_lokasi WHERE nama='$lokasi'");
    $ambil_cek_lokasi = mysqli_fetch_assoc($cek_lokasi);
    
    //error_reporting(0);
    $cek_detail = mysqli_query($conn,"SELECT * FROM db_ajax_detail_lokasi WHERE nama='$detail' AND id_lokasi='$ambil_cek_lokasi[id_lokasi]'");
    $jumlah_detail = mysqli_num_rows($cek_detail);
    if($cek_detail->num_rows >0){
        echo "
        <script>
        alert ('data sudah ada dalam database');
        history.back(-1);
        </script>
        ";
        die;
    }
    // var_dump($jumlah_detail);  die;

    $query = mysqli_query($conn,"SELECT * FROM db_ajax_lokasi WHERE nama='$lokasi' AND id_jenis='$jenis'");
    
    $idNext = mysqli_query($conn,"SELECT * FROM db_ajax_lokasi ORDER BY id_lokasi DESC LIMIT 1");
    $isiIdNext = mysqli_fetch_assoc($idNext);
    
    $idNext2 = mysqli_query($conn, "SELECT * FROM db_ajax_detail_lokasi ORDER BY id_detail_lokasi DESC LIMIT 1");
    $isiIdNext2 = mysqli_fetch_assoc($idNext2);

    

    if ($query->num_rows > 0){
        $data = mysqli_fetch_assoc($query);
        mysqli_query($conn,"INSERT INTO db_ajax_detail_lokasi (id_lokasi,nama) VALUES ($data[id_lokasi],'$detail')");
    } else {
        mysqli_query($conn,"INSERT INTO db_ajax_lokasi (id_jenis,nama) VALUES ($jenis,'$lokasi')");
        mysqli_query($conn,"INSERT INTO db_ajax_detail_lokasi (id_lokasi,nama) VALUES ($isiIdNext[id_lokasi]+1,'$detail')");
    }
    

    $baris_table1 = count($_POST["lokasiGitet"]); 
    
    for($i=0; $i<$baris_table1; $i++){
        $lokasiGitet = $_POST["lokasiGitet"][$i];
        //var_dump($lokasiGitet); die;
        mysqli_query($conn,"INSERT INTO db_ajax_table1 (id_detail_lokasi,lokasi) VALUES ($isiIdNext2[id_detail_lokasi]+1,'$lokasiGitet')");
    }

    $baris_table2 = count($post["lokasiOpen"]);
    for($i=0; $i<$baris_table2; $i++) {
        $lokasiOpen = $_POST["lokasiOpen"][$i];
        $installasiOpen = $_POST["installasiOpen"][$i];
        mysqli_query($conn,"INSERT INTO db_ajax_table2 (id_detail_lokasi,lokasi,installasi) VALUES ($isiIdNext2[id_detail_lokasi]+1,'$lokasiOpen','$installasiOpen')");
    }

    $baris_table3 = count($post["lokasiClose"]);
    for($i=0; $i<$baris_table3; $i++) {
        $lokasiClose = $_POST["lokasiClose"][$i];
        $installasiClose = $_POST["installasiClose"][$i];
        mysqli_query($conn,"INSERT INTO db_ajax_table3 (id_detail_lokasi,lokasi,installasi) VALUES ($isiIdNext2[id_detail_lokasi]+1,'$lokasiClose' ,'$installasiClose')");
    }

    return mysqli_affected_rows($conn);

}

function ubahDB($post) {
    global $conn;
    $idDetailLokasi = $post["idz"];

    $jumlah_baris1 = count($_POST["lokasi1"]);
    for ($i=0; $i<$jumlah_baris1; $i++) {
        $lokasi = $post["lokasi1"][$i];
        $idUpdate = $post["id1"][$i];
        if ($idUpdate == "0"){
            $query = "INSERT INTO db_ajax_table1 (id_detail_lokasi,lokasi) VALUES ($idDetailLokasi,'$lokasi')";
        } else {
            $query = "UPDATE db_ajax_table1 SET id_detail_lokasi = $idDetailLokasi, lokasi = '$lokasi' WHERE id=$idUpdate";
        }
        mysqli_query($conn,$query);
    }

    if(isset($post["id1_hapus"])){
        $jumlah_hapus = count($post["id1_hapus"]);
        for ($i=0; $i<$jumlah_hapus; $i++){
            $id_hapus = $post["id1_hapus"][$i];
            $query = "DELETE FROM db_ajax_table1 WHERE id=$id_hapus";
            mysqli_query($conn,$query);
        }
    }

    $jumlah_baris2 = count($post["lokasi2"]);
    for ($i=0; $i<$jumlah_baris2; $i++){
        $lokasi = $post["lokasi2"][$i];
        $installasi = $post["installasi2"][$i];
        $idUpdate = $post["id2"][$i];
        if ($idUpdate == "0"){
            $query = "INSERT INTO db_ajax_table2 (id_detail_lokasi,lokasi,installasi) VALUES ($idDetailLokasi,'$lokasi','$installasi')";
        } else{
            $query = "UPDATE db_ajax_table2 SET id_detail_lokasi=$idDetailLokasi, lokasi='$lokasi', installasi='$installasi' WHERE id=$idUpdate";
        }
        mysqli_query($conn,$query);
    }

    if(isset($post["id2_hapus"])){
        $jumlah_hapus = count($post["id2_hapus"]);
        for ($i=0; $i<$jumlah_hapus; $i++){
            $id_hapus = $post["id2_hapus"][$i];
            $query = "DELETE FROM db_ajax_table2 WHERE id=$id_hapus";
            mysqli_query($conn,$query);
        }
    }

    $jumlah_baris3 = count($post["lokasi3"]);
    for ($i=0; $i<$jumlah_baris3; $i++){
        $lokasi = $post["lokasi3"][$i];
        $installasi = $post["installasi3"][$i];
        $idUpdate = $post["id3"][$i];
        if ($idUpdate == "0"){
            $query = "INSERT INTO db_ajax_table3 (id_detail_lokasi,lokasi,installasi) VALUES ($idDetailLokasi,'$lokasi','$installasi')";
        } else{
            $query = "UPDATE db_ajax_table3 SET id_detail_lokasi=$idDetailLokasi, lokasi='$lokasi', installasi='$installasi' WHERE id=$idUpdate";
        }
        mysqli_query($conn,$query);
    }

    if(isset($post["id3_hapus"])){
        $jumlah_hapus = count($post["id3_hapus"]);
        for ($i=0; $i<$jumlah_hapus; $i++){
            $id_hapus = $post["id3_hapus"][$i];
            $query = "DELETE FROM db_ajax_table3 WHERE id=$id_hapus";
            mysqli_query($conn,$query);
        }
    }

    return mysqli_affected_rows($conn);

}



