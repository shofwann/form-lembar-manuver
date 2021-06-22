<?php
require 'functions.php';
$sql_manuver=mysqli_query($conn,"SELECT * FROM db_table_1 WHERE id_form='$_GET[id]'");
$tahapan_pembebasan=mysqli_query($conn,"SELECT * FROM db_table_3 WHERE id_form='$_GET[id]'");
$tahapan_pemnormalan=mysqli_query($conn,"SELECT * FROM db_table_4 WHERE id_form='$_GET[id]'");
$sql=mysqli_query($conn,"SELECT * FROM db_form WHERE id='$_GET[id]'");
$data=mysqli_fetch_assoc($sql);
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
                <a href="?url=list_pekerjaan2" class="btn btn-primary btn-icon-split">
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
                                    <input type="text" name="id" id="id" class="form-control" value="<?= $data["id"]; ?>" readonly>
                                </div> 

                                <div class="col-3">
                                    <label>Create Date</label>
                                    <div class="col-0">
                                    <input type="text" data-date="" data-date-format="" value="<?= $data['create_date'];?>" readonly>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <label>User :</label>
                                    <input type="text" name="user" placeholder="" value="<?= $data['user'];?>" class="form-control" readonly>
                                </div>

                                <div class="col-2">
                                    <label for="fotoLama" class="control-label">foto</label>
                                    <input type="text" name="fotoLama" id="fotoLama" class="form-control" value="<?= $data["foto"]; ?>" readonly> <!--untuk menyimpan foto lama, jika user tidak ganti foto maka foto ini yg digunakan-->
                                </div> 

                            </div>

                    <!-- Baris/row Ke-1-->
                        <div class="row">
                            <div class="col">
                                <label for="pekerjaan" class="control-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" value="<?= $data["pekerjaan"]; ?>" readonly>
                            </div>
                            <div class="col">
                                <label for="start_date">Start</label>
                                <input type="text" name="start_date" id="start_date" class="form-control" value="<?= $data["start_date"];?>" readonly>
                            </div>
                            <div class="col">
                                <label for="end_date">End</label>
                                <input type="text" name="end_date" id="end_date" class="form-control" value="<?= $data["end_date"];?>" readonly> <!-- nOte -->
                            </div>
                            <div class="col">
                                <label for="report_date">Req Date Received</label>
                                <input type="text" name="report_date" id="report_date" class="form-control" value="<?= $data["report_date"]; ?>" readonly>
                            </div>
                        </div>

                    <!-- Baris/row Ke-2-->
                        <div class="row">
                            <div class="col">
                                <label for="lokasi">Lokasi</label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control" value="<?= $data["lokasi"]; ?>" readonly>
                            </div>
                            <div class="col">
                                <label for="waktu">Waktu</label>
                                <input type="text" name="waktu" id="waktu" class="form-control" value="<?= $data["waktu"]; ?>" readonly>
                            </div>
                        
                            <div class="col">
                                <label for="instal">Installasi</label>
                                <input type="text" name="instal" id="instal" class="form-control" value="<?= $data["installasi"]; ?>" readonly>
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
                                            <?php while ($manuverBebas = mysqli_fetch_array($sql_manuver)) { ?>
                                                <tr>
                                                    <td><?= $manuverBebas["spvPenormalan"]  ?></td>
                                                    <td><?= $manuverBebas["oprPenormalan"]  ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                            
                                            
                                    </table>
                                    
                                </div>
                            </div>
                            <div class="col-1 ml-3">
                                <br>
                                    <label>Kelengkapan Dokumen :</label>
                                    <div action="">
                                        <input type="checkbox" id="" name="" value="" disabled="disabled">
                                        <label for="vehicle1"> WP</label><br>
                                        <input type="checkbox" id="" name="" value="" disabled="disabled">
                                        <label for="vehicle2"> IK</label><br>
                                        <input type="checkbox" id="" name="" value="" disabled="disabled">
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
                                <input type="text" style="border:1px solid #fff">
                            </div>
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <input type="text" style="border:1px solid #fff">
                            </div>
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <input type="text" style="border:1px solid #fff">
                            </div>
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <input type="text" style="border:1px solid #fff">
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
                                <input type="text" style="border:1px solid #fff">
                            </div>
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <input type="text" style="border:1px solid #fff">
                            </div>
                        </div>
                    <!-- Baris/ row ke-5-->
                        <h2>Manuver Pembebasan Installasi</h2>
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
                                                    <td><?= $pembebasan["remote"]  ?></td>
                                                    <td><?= $pembebasan["real"]  ?></td>
                                                    <td><?= $pembebasan["ads"]  ?></td>
                                                    <td><?= $pembebasan["installasi"]  ?></td>
                                                </tr>
                                                    <?php $i++ ?>
                                                    <?php endwhile; ?>
                                            </table>
                                        </div>
                                    </div>
                        </div>
                    <!-- Baris/ row ke-6-->
                        <h2>Manuver Penormalan Installasi</h2>
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
                                                    <td><?= $penormalan["remote"]  ?></td>
                                                    <td><?= $penormalan["real"]  ?></td>
                                                    <td><?= $penormalan["ads"]  ?></td>
                                                    <td><?= $penormalan["installasi"]  ?></td>
                                                </tr>
                                                    <?php $i++ ?>
                                                    <?php endwhile; ?>
                                        </table>
                                    </div>

                                </div>
                        </div>

                        <div class="row" style="background-color:#F2F4F4;">
                    
                            <div class="col-6" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <label for="">Catatan Pembebasan:</label>
                            </div>

                            <div class="col-6" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <label for="">Catatan Penormalan:</label>
                            </div>
                        </div>
                        <div class="row" style="">
                            <div class="col-6" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <textarea name="" id="" cols="90" rows="5"></textarea>
                            </div>
                            <div class="col-6" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <textarea name="" id="" cols="90" rows="5"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row" hidden>
                            <div class="col-2">
                            <button type="submit" name="submit" >Simpan Form Data Manuver</button>
                            </div>
                    
                        </div>                                   
            </form>
            <?php  } ?>
        </div>
    </div>


    <script>
    
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