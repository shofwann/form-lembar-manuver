<?php
require 'functions.php';
$sql_manuver=mysqli_query($conn,"SELECT * FROM db_table_1 WHERE id_form='$_GET[id]'");
$sql_manuver2=mysqli_query($conn,"SELECT * FROM db_table_1 WHERE id_form='$_GET[id]'");
$tahapan_pembebasan=mysqli_query($conn,"SELECT * FROM db_table_2 WHERE id_form='$_GET[id]'");
$tahapan_pemnormalan=mysqli_query($conn,"SELECT * FROM db_table_3 WHERE id_form='$_GET[id]'");
$sql=mysqli_query($conn,"SELECT * FROM db_form WHERE id='$_GET[id]'");
$data=mysqli_fetch_assoc($sql);
if ($sql){

    $tanggal = $data["date"];
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

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 
  <link rel="stylesheet" href="css/shofwan.css">

</head>

<body id="page-top">
<br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Detail Pekerjaan
        </div>
        <div class="card-body">
            <div class="form-group cols-sm-6">
                <a href="" onclick="window.history.go(-1); return false;" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>              
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
            

        

        
            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="row" hidden>
                        <div class="col-2">
                            <label>ID Task:</label>
                            <input type="text" name="idTask" value="<?= $data['id']; ?>" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" id="hide"></div>
                        <div class="col-2" style="border-right:1px solid; background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">Document dibuat:</label>
                        </div>
                    </div>
                    <div class="row" style="height:60px;">
                        <div class="col"></div>
                        <div class="col-2 pt-3" style="border-bottom:1px solid #616A6B;border-right:1px solid;">
                            <h6 class="pt-2 pl-2"><?= $data["create_date"]; ?></h6>
                        </div>
                    </div><br>
                    <div class="row " >
                        <div class="col-4" style="background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">PEKERJAAN :</label>
                        </div>
                        <div class="col-4" style="background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">TANGGAL PELAKSANAAN :</label>
                        </div>
                        <div class="col-2" style=" background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">MULAI</label>
                        </div>
                        <div class="col-2" style="border-right:1px solid;background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">SELESAI</label>
                        </div>
                    </div>

                    <div class="row" style="height:80px;">
                        <div class="col-4" style="">
                            <h6 class="pt-4 pl-2"><?= $data["pekerjaan"]; ?></h6>
                        </div>
                        <div class="col-4" style="">
                            <h6 class="pt-4 pl-2"><?= date("d F Y", strtotime($tanggal)); ?></h6>
                        </div>
                        <div class="col-2" style="">
                            <h6 class="pt-4 pl-2"><?= $data["start"]; ?> WIB</h6>
                        </div>
                        <div class="col-2" style="border-right:1px solid;">
                            <h6 class="pt-4 pl-2"><?= $data["end"]; ?> WIB</h6>
                        </div>
                    </div>

                    <div class="row" >
                        <div class="col-4" style="background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">LOKASI :</label>
                        </div>
                        <div class="col-4" style="background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">INSTALLASI :</label>
                        </div>
                        <div class="col-4" style="border-right:1px solid;background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">Permintaan pembebanan diterima</label>
                        </div>
                    </div>
                    <div class="row" style="height:80px;">
                        <div class="col-4">
                            <h6 class="pt-4 pl-2"><?= $data["lokasi"]; ?></h6>
                        </div>
                        <div class="col-4">
                            <h6 class="pt-4 pl-2"><?= $data["installasi"]; ?></h6>
                        </div>
                        <div class="col-4" style="border-right:1px solid;">
                            <input type="datetime-local" name="report_date" id="report_date" class="pt-4 pl-2 form-control" style="border:1px solid #fff;" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-7" style="background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">MANUVER PEMBEBASAN INSTALLASI</label>
                        </div>
                        <div class="col-3" style="background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">MANUVER PENORMALAN INSTALLASI</label>
                        </div>
                        <div class="col-2" style="border-right:1px solid;background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">KELENGKAPAN DOKUMEN</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7" style="">
                            <br>
                            <div class="table-responsive"> 
                                <table class="table table-bordered" > 
                                <thead>
                                        <tr id="mirrodHead" style="background-color:#F8F9F9;">  
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
                            <br>  
                        </div>
                        <div class="col-3" style="">
                            <div class="table-responsive">
                                <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="background-color:#F8F9F9;">
                                            <th>Spv GITET</th>
                                            <th>Opr GITET</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyTable2">
                                    <?php while ($manuverBebas2 = mysqli_fetch_array($sql_manuver2)) { ?>
                                                <tr>
                                                    <td style="height:48px"><?= $manuverBebas2["spv_gitet_normal"]  ?></td>
                                                    <td><?= $manuverBebas2["opr_gitet_normal"]  ?></td>
                                                </tr>
                                            <?php } ?>

                                    </tbody>
                                </table>
                                 
                            </div>
                        </div>

                        <div class="col-2" style="border-right:1px solid;font-weight: bold;">
                        <br>
                                <div action="">
                                    <input type="checkbox" id="" name="wp" value="" disabled>
                                    <label for="vehicle1"> WP</label><br>
                                    <input type="checkbox" id="" name="ik" value="" disabled>
                                    <label for="vehicle2"> IK</label><br>
                                    <input type="checkbox" id="" name="k3" value="" disabled>
                                    <label for="vehicle3"> K3</label><br>
                                </div>
                        </div>
                    </div>

                    <div class="row" style="">
                        <div class="col-6" style="background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">ALIRAN DAYA PADA INSTALLASI MENJELANG DIBEBASKAN</label>
                        </div>
                        <div class="col-6" style="border-right:1px solid;background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">ALIRAN DAYA PADA INSTALLASI MENJELANG DINORMALKAN</label>
                        </div>
                    </div>
                    <div class="row" style="background-color:#F8F9F9;">
                        <div class="col-3 pl-4" style="padding-top:.30rem;padding-bottom:.30rem;height:40px;font-size: 15px;">
                            <label>Pembacaan SCADA</label>
                        </div>
                        <div class="col-3 pl-4" style="padding-top:.50rem;padding-bottom:.50rem;height:40px;font-size: 15px;">
                            <label>Hasil Studi DPF</label>
                        </div>
                        <div class="col-3 pl-4" style="padding-top:.50rem;padding-bottom:.50rem;height:40px;font-size: 15px;">
                            <label>Pembacaan SCADA</label>
                        </div>
                        <div class="col-3 pl-4" style="border-right:1px solid;padding-top:.50rem;padding-bottom:.50rem;height:40px;font-size: 15px;">
                            <label>Hasil Studi DPF</label>
                        </div>
                    </div>
                    <div class="row" style="">
                        <div class="col-3" style="padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text" style="border:1px solid #fff;" disabled>
                        </div>
                        <div class="col-3" style="padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text" style="border:1px solid #fff;" disabled>
                        </div>
                        <div class="col-3" style="padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text" style="border:1px solid #fff;" disabled>
                        </div>
                        <div class="col-3" style="border-right:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text" style="border:1px solid #fff;" disabled>
                        </div>
                    </div>
                    <div class="row" style="">
                        <div class="col-6" style="background-color:#F8F9F9;font-weight:bold;">
                            <label for="" class="pt-2 pl-2">ALIRAN DAYA SETELAH DIBEBASKAN</label>
                        </div>
                        <div class="col-6" style="border-right:1px solid;background-color:#F8F9F9;font-weight:bold;">
                            <label for="" class="pt-2 pl-2">ALIRAN DAYA SETELAH DINORMALKAN</label>
                        </div>
                    </div>
                    <div class="row" style="background-color:#F8F9F9;">
                        <div class="col-6 pl-4" style="padding-top:.30rem;padding-bottom:.30rem;height:40px;font-size: 15px;">
                            <label for="" class="">Pembacaan SCADA</label>
                        </div>
                        <div class="col-6 pl-4" style="border-right:1px solid;padding-top:.30rem;padding-bottom:.30rem;height:40px;font-size: 15px;">
                            <label for="" class="">Pembacaan SCADA</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6" style="padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text" style="border:1px solid #fff;" disabled>
                        </div>
                        <div class="col-6" style="border-right:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text" style="border:1px solid #fff;" disabled>
                        </div>

                        
                    </div>
                    <div class="row">
                        <div class="col-12" style="border-right:1px solid;background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">MANUVER PEMBEBASAN INSTALLASI</label>
                        </div>
                    </div>
                    <div class="row" style="background-color:#F8F9F9;">
                        <div class="col-12 pl-4" style="border-right:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label for="">Catatan Pra Pembebasan :</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="border-right:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <textarea name="catatan_pra_bebas" id="" cols="232" rows="3" style="border:1px solid #fff;color:red;" disabled><?= $data["catatan_pra_pembebasan"];?></textarea>
                        </div>
                    </div>
                    <div class="row" style="background-color:#F8F9F9;">
                        <div class="col-12" style="border-right:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label for="">Tahapan Manuver Pembebasan :</label>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-6" style="">
                                <div class="form-group ml-2">
                                    <img src="img/<?= $data["foto"];?>" id="output1" height="auto" width="900px" style="padding-top:.50rem;padding-right:.50rem"><br>
                                </div>
                            </div>

                            <div class="col-6" style="border-right:1px solid;">
                                <div class="table-responsive">
                                    <table class="table table-bordered mt-2" id="dynamic_field1" style="">
                                        <tr>
                                            <th rowspan="2" style="padding-top:35px;width:28px">No.</th>
                                            <th rowspan="2" style="width:35px;text-align:center;padding-top:35px">Lokasi</th>
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
                                                    <td><?= $pembebasan["remote_"]  ?></td>
                                                    <td><?= $pembebasan["real_"]  ?></td>
                                                    <td><?= $pembebasan["ads"]  ?></td>
                                                    <td><?= $pembebasan["installasi"]  ?></td>
                                                </tr>
                                                    <?php $i++ ?>
                                                    <?php endwhile; ?>
                                    </table>
                                </div>
                            </div>
                    </div>
                    <div class="row" style="background-color:#F8F9F9;">
                        <div class="col-12" style="border-right:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label for="">Catatan Pasca Pembebasan :</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="border-right:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <textarea name="catatan_pasca_bebas" id="" cols="232" rows="3" style="border:1px solid #fff;" disabled></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12" style="border-right:1px solid;background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">MANUVER PENORMALAN INSTALLASI</label>
                        </div>
                    </div>
                    <div class="row" style="background-color:#F8F9F9;">
                        <div class="col-12" style="border-right:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label for="">Catatan Pra Penormalan :</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="border-right:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <textarea name="catatan_pra_normal" id="" cols="232" rows="3" style="border:1px solid #fff;color:red;" disabled><?= $data["catatan_pra_penormalan"];?></textarea>
                        </div>
                    </div>
                    <div class="row" style="background-color:#F8F9F9;">
                        <div class="col-12" style="border-right:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label for="">Tahapan Manuver Penormalan :</label>
                        </div>
                    </div>
                    <div class="row">
                                <div class="col-6" style="">
                                    <div class="form-group ml-2">
                                        <img src="img/<?= $data["foto2"];?>" id="output2" height="auto" width="780px" style="padding-top:.50rem;padding-right:.50rem"><br>
                                    </div>
                                </div>
                                <div class="col-6" style="border-right:1px solid;">
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
                                                    <td><?= $penormalan["remote"]  ?></td>
                                                    <td><?= $penormalan["real_"]  ?></td>
                                                    <td><?= $penormalan["ads"]  ?></td>
                                                    <td><?= $penormalan["installasi"]  ?></td>
                                                </tr>
                                            <?php $i++ ?>
                                            <?php endwhile; ?>

                                        </table>
                                    </div>

                                </div>
                    </div> 
                    <div class="row" style="background-color:#F8F9F9;">
                        <div class="col-12" style="border-right:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label for="">Catatan Pasca Penormalan :</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="border-right:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <textarea name="catatan_pasca_normal" id="" cols="232" rows="3" style="" disabled></textarea>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-12" style="border-right:1px solid;border-bottom:1px solid; background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">Aproval</label>
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
    //         q.innerHTML = "<input type='text' name='a[]' style='width:100px;height:10px;border:1px solid #fff;' readonly>"
    //     }
    // }

//     function kembali() {
//   history.back(-2);
// }
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

   


</body>

</html>