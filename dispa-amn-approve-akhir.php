<?php
require 'functions.php';
$sql_manuver=mysqli_query($conn,"SELECT * FROM db_table_1 WHERE id_form='$_GET[id]'");
$sql_manuver2=mysqli_query($conn,"SELECT * FROM db_table_1 WHERE id_form='$_GET[id]'");
$tahapan_pembebasan=mysqli_query($conn,"SELECT * FROM db_table_3 WHERE id_form='$_GET[id]'");
$tahapan_pemnormalan=mysqli_query($conn,"SELECT * FROM db_table_4 WHERE id_form='$_GET[id]'");
$sql=mysqli_query($conn,"SELECT * FROM db_form WHERE id='$_GET[id]'");
$data=mysqli_fetch_assoc($sql);

if( isset($_POST["submit"]) ){

    if( amnDispaAproveAkhir ($_POST) > 0){
        //var_dump(tambah($_POST)); die;
        echo "<script>
                alert('data berhasil disubmit'); 
                document.location.href = 'dispa-amn-dashboard.php?url=amnDispaInbox';
                </script>
                ";  
                
    } else {
       // var_dump(tambah($_POST)); die;
        echo "<script>
                alert('data gagal disubmit'); 
                document.location.href = 'dispa-amn-dashboard.php?url=amnDispaInbox';
                </script>
                "; die;
                
    }
}

if ($sql){

?>



<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Tables</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/shofwan.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  


</head>

<body id="page-top">
<br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Detail Pekerjaan
        </div>
        <div class="card-body">
            <div class="form-group cols-sm-6">
                <a href="?url=amnDispaInbox" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>              
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
            

        

        
            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
            
                    <!-- Baris/row Ke-0-->
                            <div class="row">
                                
                                <div class="col-2">
                                    <label for="id" class="control-label">id</label>
                                    <input type="text" name="idTask" id="idTask" class="form-control" value="<?= $data["id"]; ?>" readonly>
                                </div> 

                                <div class="col-3">
                                    <label>Time Aproval</label>
                                    <input type="text" name="time" data-date="" class="form-control" value="<?= date('d-M-Y H:i:s'); ?>" readonly>
                                </div>

                                <div class="col-3">
                                    <label>Level AMN Dispa :</label>
                                    <input type="text" name="level" class="form-control" placeholder="" value="<?= $_SESSION['level']; ?>" class="form-control" disabled>
                                </div>

                                <div class="col">
                                    <label>User AMN :</label>
                                    <input type="text" name="userAmnDispa" placeholder="" value="<?= $_SESSION['username'];?>" class="form-control" readonly>
                                </div>                                

                                

                            </div>

                    <!-- Baris/row Ke-1-->
                        <div class="row">
                            <div class="col">
                                <label for="pekerjaan" class="control-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" value="<?= $data["pekerjaan"]; ?>" disabled>
                            </div>
                            <div class="col">
                                <label for="start_date">Start</label>
                                <input type="text" name="start_date" id="start_date" class="form-control" value="<?= $data["start_date"];?>" disabled>
                            </div>
                            <div class="col">
                                <label for="end_date">End</label>
                                <input type="text" name="end_date" id="end_date" class="form-control" value="<?= $data["end_date"];?>" disabled> <!-- nOte -->
                            </div>
                            <div class="col">
                                <label for="report_date">Req Date Received</label>
                                <input type="text" name="report_date" id="report_date" class="form-control" value="<?= $data["report_date"]; ?>" disabled>
                            </div>
                        </div>

                    <!-- Baris/row Ke-2-->
                        <div class="row">
                            <div class="col">
                                <label for="lokasi">Lokasi</label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control" value="<?= $data["lokasi"]; ?>" disabled>
                            </div>
                            <div class="col">
                                <label for="waktu">Waktu</label>
                                <input type="text" name="waktu" id="waktu" class="form-control" value="<?= $data["waktu"]; ?>" disabled>
                            </div>
                        
                            <div class="col">
                                <label for="instal">Installasi</label>
                                <input type="text" name="instal" id="instal" class="form-control" value="<?= $data["installasi"]; ?>" disabled>
                            </div>
                        </div>

                    
                    <!-- Baris/row Ke-3-->
                        <div class="row">
                            <div class="col-7">
                                <div class="table-responsive ml-2">
                                        <h4 style="text-align:center;">Manuver Pembebasan Instalasi</h4>
                                        <table class="table table-bordered" > 
                                            <thead> 
                                                <tr style="background-color:#F2F4F4;">  
                                                    <th style="width:158px;">Lokasi</th>
                                                    <th style="width:158px;">Peng. Pekerjaan</th>
                                                    <th style="width:158px;">Peng. Manuver</th>
                                                    <th style="width:158px;">Peng. K3</th>
                                                    <th style="width:158px;">Spv GITET</th>
                                                    <th style="width:158px;">Opr GITET</th>
                                                </tr> 
                                            </thead> 
                                            <tbody id="table1">
                                                <?php while ($manuverBebas = mysqli_fetch_array($sql_manuver)) { ?>
                                                <tr>
                                                    <td><?= $manuverBebas["lokasi"]  ?></td>
                                                    <td><?= $manuverBebas["pengawas_pekerjaan"]  ?></td>
                                                    <td><?= $manuverBebas["pengawas_manuver"]  ?></td>
                                                    <td><?= $manuverBebas["pengawas_manuver"]  ?></td>
                                                    <td><?= $manuverBebas["spv_gitet"]  ?></td>
                                                    <td><?= $manuverBebas["opr_gitet"]  ?></td>
                                                </tr>
                                                <?php } ?>
                                            
                                            </tbody>
                                            
                                    </table>
                                        
                                </div>
                            </div>

                            <div class="col-3 ml-5">
                                <div class="table-responsive">
                                <h4 style="text-align:center;">Manuver Penormalan Instalasi</h4>
                                    <table class="table table-bordered" id="table2">
                                        <thead>
                                            <tr style="background-color:#F2F4F4;">
                                                <th>Spv GITET</th>
                                                <th>Opr GITET</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyTable2">
                                            <?php while ($manuverBebas2 = mysqli_fetch_array($sql_manuver2)) { ?>
                                                <tr>
                                                    <td><?= $manuverBebas2["spv_gitet_normal"]  ?></td>
                                                    <td><?= $manuverBebas2["opr_gitet_normal"]  ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                            
                                            
                                    </table>
                                    
                                </div>
                            </div>
                            <div class="col-1 ml-3">
                            <br>
                                <?php $cekbok = explode(",", $data["document"]); ?> 
                                    <label>Kelengkapan Dokumen :</label>
                                    <div action="">
                                        <input type="checkbox" id="" name="" value="wp" <?php in_array('wp', $cekbok) ? print 'checked' : ' '; ?> disabled="disabled">
                                        <label for="vehicle1"> WP</label><br>
                                        <input type="checkbox" id="" name="" value="ik" <?php in_array('ik', $cekbok) ? print 'checked' : ' '; ?> disabled="disabled">
                                        <label for="vehicle2"> IK</label><br>
                                        <input type="checkbox" id="" name="" value="k3" <?php in_array('k3', $cekbok) ? print 'checked' : ' '; ?>  disabled="disabled">
                                        <label for="vehicle3"> K3</label><br>
                                    </div>
                            </div>
                        </div>
                    
                    <!-- Baris/ row ke-4-->
                        <div class="row"> 
                            <div class="col-6">
                                <label>Aliran daya pada installasi menjelang dibebaskan</label>
                            </div>
                            <div class="col-6">
                                <label>Aliran daya pada installasi menjelang dinormalkan</label>
                            </div>
                        </div>

                        <div class="row" style="background-color:#F2F4F4;">
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <label>Pembacaan SCADA</label>
                            </div>
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <label>Hasil Studi DPF</label>
                            </div>
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <label>Pembacaan SCADA</label>
                            </div>
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <label>Hasil Studi DPF</label>
                            </div>                   
                        </div>

                        <div class="row">
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <input type="text" name="scada_awal_before" style="border:1px solid #fff; width:300px; font-style:italic;" value="<?= $data["scada_awal_before"]; ?>" disabled>
                            </div>
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <input type="text" name="dpf_awal" style="border:1px solid #fff; width:300px; font-style:italic;" value="<?= $data["dpf_awal"]; ?>" disabled>
                                <a href="dpf/<?= $data["foto_dpf1"]; ?>" class="btn" download><span class="text fas fa-download"></span></a>
                            </div>
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <input type="text" name="scada_awal_before" style="border:1px solid #fff; width:300px; font-style:italic;" value="<?= $data["scada_akhir_before"]; ?>" disabled>
                            </div>
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <input type="text" name="dpf_akhir" style="border:1px solid #fff; width:300px; font-style:italic;" value="<?= $data["dpf_akhir"]; ?>" disabled>
                                <a href="dpf/<?= $data["foto_dpf2"]; ?>" class="btn" download><span class="text fas fa-download"></span></a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label>Aliran daya pada installasi setelah dibebaskan</label>
                            </div>
                            <div class="col-6">
                                <label>Aliran daya pada installasi setelah dinormalkan</label>
                            </div>
                        </div>

                        <div class="row" style="background-color:#F2F4F4;">
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <label>Pembacaan SCADA</label>
                            </div>
                        
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <label>Pembacaan SCADA</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <input type="text" name="scada_awal_after" style="border:1px solid #fff; width:300px; font-style:italic;" value="<?= $data["scada_awal_after"]; ?>" disabled>
                            </div>
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <input type="text" name="scada_akhir_after" style="border:1px solid #fff; width:300px; font-style:italic;" value="<?= $data["scada_akhir_after"]; ?>" disabled>
                            </div>
                        </div>
                    <!-- Baris/ row ke-5-->
                        <h2>Manuver Pembebasan Installasi</h2>
                        <div class="row">
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <label for="">Catatan Pra Pembebasan:</label>
                            </div>
                    
                        </div>
                        <div class="row">
                                <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                    <textarea name="catatan_pra_pembebasan" id="" cols="230" rows="5" disabled><?= $data["catatan_pra_pembebasan"]; ?></textarea>
                                </div>
                        </div>   
                        <div class="row">
                                    <div class="col-6" style="border:1px solid">
                                        <div class="form-group ml-2">
                                            <img src="img/<?= $data["foto"];?>" id="output1" height="auto" width="770px" style="padding-top:.50rem;padding-right:.50rem"><br>
                                        </div>
                                    </div>

                                    <div class="col-6" style="border:1px solid">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mt-2" id="dynamic_field1" style="">
                                                <tr>
                                                    <th rowspan="2" style="padding-top:35px;width:28px">No.</th>
                                                    <th rowspan="2" style="width:.78rem;text-align:center;padding-top:35px">Lokasi</th>
                                                    <th colspan="3"style="width:7rem;text-align:center">Jam Manuver Buka</th>
                                                    <th rowspan="2"style="padding-top:35px;width:7rem;">Installasi</th>
                                                </tr>
                                                <tr>
                                                    <th>Remote</th>
                                                    <th>Real (R/L)</th>
                                                    <th>ADS</th>
                                                </tr>
                                                    <?php $i=1; ?>
                                                    <?php while ($pembebasan = mysqli_fetch_assoc($tahapan_pembebasan) ) : ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $pembebasan["lokasi"]  ?></td>
                                                    <td><?= $pembebasan["remote_bebas"]  ?></td>
                                                    <td><?= $pembebasan["real_bebas"]  ?></td>
                                                    <td><?= $pembebasan["ads_bebas"]  ?></td>
                                                    <td><?= $pembebasan["installasi"]  ?></td>
                                                </tr>
                                                    <?php $i++ ?>
                                                    <?php endwhile; ?>
                                            </table>
                                        </div>
                                    </div>
                        </div>
                    <!-- Baris/ row ke-6-->
                        <div class="row">
                                <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                    <label for="">Catatan Pasca Pembebasan:</label>
                                </div>
                        
                        </div>
                        <div class="row">
                                <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                    <textarea name="catatan_pasca_pembebasan" id="" cols="190" rows="5" disabled><?= $data["catatan_pasca_pembebasan"]; ?></textarea>
                                </div>
                        </div>
                        <h2>Manuver Penormalan Installasi</h2>
                        <div class="row">
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <label for="">Catatan Pra Penormalan:</label>
                            </div>
                    
                        </div>
                        <div class="row">
                                <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                    <textarea name="catatan_pra_penormalan" id="" cols="190" rows="5" disabled><?= $data["catatan_pra_penormalan"]; ?></textarea>
                                </div>
                        </div>  
                        <div class="row">
                                <div class="col" style="border:1px solid">
                                    <div class="form-group ml-2">
                                        <img src="img/<?= $data["foto2"];?>" id="output2" height="auto" width="770px" style="padding-top:.50rem;padding-right:.50rem"><br>
                                    </div>
                                </div>
                                <div class="col" style="border:1px solid">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mt-2" id="dynamic_field2" style="">
                                            <tr>
                                                <th rowspan="2" style="padding-top:35px;width:28px">No.</th>
                                                <th rowspan="2" style="width:.78rem;text-align:center;padding-top:35px">Lokasi</th>
                                                <th colspan="3"style="width:7rem;text-align:center">Jam Manuver Tutup</th>
                                                <th rowspan="2"style="padding-top:35px;width:7rem;">Installasi</th>
                                                
                                            </tr>
                                            <tr>
                                                <th>Remote</th>
                                                <th>Real (R/L)</th>
                                                <th>ADS</th>
                                            </tr>
                                            <?php $i=1; ?>
                                                    <?php while ($penormalan = mysqli_fetch_assoc($tahapan_pemnormalan) ) : ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $penormalan["lokasi"]  ?></td>
                                                    <td><?= $penormalan["remote_normal"]  ?></td>
                                                    <td><?= $penormalan["real_normal"]  ?></td>
                                                    <td><?= $penormalan["ads_normal"]  ?></td>
                                                    <td><?= $penormalan["installasi"]  ?></td>
                                                </tr>
                                                    <?php $i++ ?>
                                                    <?php endwhile; ?>
                                        </table>
                                    </div>

                                </div>
                        </div>

                        <div class="row">
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <label for="">Catatan Pasca Penormalan:</label>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                    <textarea name="catatan_pasca_pembebasan" id="" cols="190" rows="5" disabled><?= $data["catatan_pasca_penormalan"]; ?></textarea>
                                </div>
                        </div> 
                        <div class="row">
                            <div class="col">
                                <br>
                                <input type="radio" value="approve" class="btn-check" name="aproval" id="success-outlined" required autocomplete="off">
                                <label class="btn btn-outline-success" for="success-outlined">Aproved</label>
                                <input type="radio" value="disapprove" class="btn-check" name="aproval" id="danger-outlined" required autocomplete="off">
                                <label class="btn btn-outline-danger" for="danger-outlined">Disapproved</label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-2">
                            <button type="submit" name="submit" >Submit</button>
                            </div>
                    
                        </div>                                   
            </form>
            <?php  } ?>
        </div>
    </div>


    <script>
    
    // table = document.getElementById("table1");
    // totalRow = table.rows.length;
    // for (j=0; j < totalRow; j++){
	// 		z=document.getElementById("bodyTable2").insertRow(j);
    //     for (k=0; k<2; k++){
    //         q = z.insertCell(k);
    //         q.innerHTML = "<input type='text' name='a[]' style='width:100px;height:10px;border:1px solid #fff;' disabled>"
    //     }
    // }
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

   


</body>

</html>