<?php
require 'functions.php';
$sql_manuver=mysqli_query($conn,"SELECT * FROM db_table_1 WHERE id_form='$_GET[id]'");
$sql_manuver2=mysqli_query($conn,"SELECT * FROM db_table_1 WHERE id_form='$_GET[id]'");
$tahapan_pembebasan=mysqli_query($conn,"SELECT * FROM db_table_2 WHERE id_form='$_GET[id]'");
$tahapan_pemnormalan=mysqli_query($conn,"SELECT * FROM db_table_3 WHERE id_form='$_GET[id]'");
$sql=mysqli_query($conn,"SELECT * FROM db_form WHERE id='$_GET[id]'");

$data = mysqli_fetch_assoc($sql);


// var_dump($cekbok);

if( isset($_POST["submit"]) ){

    if( inputDispaAkhir ($_POST) > 0){
        //var_dump(tambah($_POST)); die;
        echo "<script>
                alert('data berhasil disubmit'); 
                document.location.href = 'dispa-dashboard.php?url=dispaInbox';
                </script>
                ";  
                
    } else {
       // var_dump(tambah($_POST)); die;
        echo "<script>
                alert('data gagal disubmit'); 
                document.location.href = 'dispa-dashboard.php?url=dispaInbox';
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
  <!-- <link href="css/shofwan.css" rel="stylesheet"> -->

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
                <a href="" onclick="window.history.go(-1); return false;" class="btn btn-primary btn-icon-split">
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
                                    <label>Aprove Date</label>
                                    <div class="col-0">
                                    <input type="text" name="time" placeholder="" value="<?php echo date('d-M-Y H:i:s');?>" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="col">
                                    <label>User dispa :</label>
                                    <input type="text" name="userdispa" placeholder="" value="<?= $_SESSION['username'];?>" class="form-control" readonly>
                                </div>                                

                                <div class="col-2">
                                    <label for="fotoLama" class="control-label">foto</label>
                                    <input type="text" name="fotoLama" id="fotoLama" class="form-control" value="<?= $data["foto_dpf2"]; ?>" readonly> <!--untuk menyimpan foto lama, jika user tidak ganti foto maka foto ini yg digunakan-->
                                </div> 

                            </div>

                            <div class="row " >
                                <div class="col-4" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                                    <label for="" class="pt-2 pl-2">PEKERJAAN :</label>
                                </div>
                                <div class="col" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                                    <label for="" class="pt-2">TANGGAL PELAKSANAAN :</label>
                                </div>
                                <div class="col-2" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                                    <label for="" class="pt-2">MULAI</label>
                                </div>
                                <div class="col-2" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                                    <label for="" class="pt-2">SELESAI</label>
                                </div>
                            </div>

                            <div class="row" style="height:80px;">
                                <div class="col-4 pt-3" style="border:1px solid #B2BABB;">
                                    <h6><?= $data["pekerjaan"]; ?></h6>
                                </div>
                                <div class="col pt-3" style="border:1px solid #B2BABB;">
                                    <h6 class="pt-3 pl-2"><?= date("d F Y", strtotime($data["date"])); ?></h6>
                                </div>
                                <div class="col-2 pt-3" style="border:1px solid #B2BABB;">
                                    <h6 class="pt-4 pl-2"><?= date("H:i",strtotime($data["start"])); ?> WIB</h6>
                                </div>
                                <div class="col-2 pt-3" style="border:1px solid #B2BABB;">
                                    <h6 class="pt-4 pl-2"><?= date("H:i",strtotime($data["end"])); ?> WIB</h6>
                                </div>
                            </div>

                            <div class="row" >
                                <div class="col" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                                    <label for="" class="pt-2 pl-2">LOKASI :</label>
                                </div>
                                <div class="col" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                                    <label for="" class="pt-2 pl-2">INSTALLASI :</label>
                                </div>
                                <div class="col" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                                    <label for="" class="pt-2 pl-2">Permintaan pembebanan diterima</label>
                                </div>
                            </div>

                            <div class="row" style="height:80px;">
                                <div class="col border border-secondary pt-3">
                                    <h6 class="pt-4 pl-2"><?= $data["lokasi"]; ?></h6>
                                </div>
                                <div class="col border border-secondary pt-3">
                                    <h6 class="pt-4 pl-2"><?= $data["installasi"]; ?></h6>
                                </div>
                                <div class="col border border-secondary pt-3">
                                    <input type="datetime-local" name="report_date" value="<?= date("Y-m-d\TH:i", strtotime($data["report_date"])); ?>" id="report_date" class="form-control" style="border:1px solid #fff;" disabled>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-7" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                                    <label for="" class="pt-2 pl-2">MANUVER PEMBEBASAN INSTALLASI</label>
                                </div>
                                <div class="col-3" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                                    <label for="" class="pt-2 pl-2">MANUVER PENORMALAN INSTALLASI</label>
                                </div>
                                <div class="col" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                                    <label for="" class="pt-2 pl-2">KELENGKAPAN DOKUMEN</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-7" style="border:1px solid #B2BABB; ">
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
                                                        <td><?= $manuverBebas["pengawas_pekerjaan"]; ?></td>
                                                        <td><?= $manuverBebas["pengawas_manuver"]; ?></td>
                                                        <td><?= $manuverBebas["pengawas_k3"]; ?></td>
                                                        <td><?= $manuverBebas["spv_gitet"]; ?></td>
                                                        <td><?= $manuverBebas["opr_gitet"]; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            </table> 
                                            
                                        </div>
                                        <br>  
                                </div>
                                <div class="col-3" style="border:1px solid #B2BABB; ">
                                    <div class="table-responsive">
                                        <br>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr style="background-color:#F8F9F9;">
                                                    <th>Spv GITET<span style="color:red;">*</span></th>
                                                    <th>Opr GITET<span style="color:red;">*</span></th>
                                                </tr>
                                            </thead>
                                            <tbody id="table2">
                                                <?php while ($manuverBebas2 = mysqli_fetch_array($sql_manuver2)) { ?>
                                                    <tr>
                                                        <td><input type="text" name="spv_gitet_normal[]" value="<?= $manuverBebas2["opr_gitet_normal"];  ?>"><input type="text" name="sample[]" value="<?= $manuverBebas2["id"]  ?>" hidden></td>
                                                        <td><input type="text" name="opr_gitet_normal[]" value="<?= $manuverBebas2["spv_gitet_normal"];  ?>"></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                </div>

                                <div class="col" style="border:1px solid #B2BABB; font-weight: bold;">
                                    <br>
                                        <div action="">
                                            <?php $cekbok = explode(",", $data["document"]); ?> 
                                            <label>Kelengkapan Dokumen :</label>
                                            <div action="">
                                                <input type="checkbox" id="wp" name="document[]" value="wp" <?php in_array('wp', $cekbok) ? print 'checked' : ' '; ?> disabled>
                                                <label for="wp">wp</label><br>
                                                <input type="checkbox" id="ik" name="document[]" value="ik" <?php in_array('ik', $cekbok) ? print 'checked' : ' '; ?> disabled>
                                                <label for="ik"> IK</label><br>
                                                <input type="checkbox" id="k3" name="document[]" value="k3" <?php in_array('k3', $cekbok) ? print 'checked' : ' '; ?> disabled>
                                                <label for="k3"> K3</label><br>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="row">
                        <div class="col" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">ALIRAN DAYA PADA INSTALLASI MENJELANG DIBEBASKAN</label>
                        </div>
                        <div class="col" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">ALIRAN DAYA PADA INSTALLASI MENJELANG DINORMALKAN</label>
                        </div>
                    </div>

                    <div class="row" style="background-color:#F8F9F9;">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label>Pembacaan SCADA</label>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label>Hasil Studi DPF</label>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label>Pembacaan SCADA<span style="color:red;">*</span></label>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label>Hasil Studi DPF<span style="color:red;">*</span></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text" name="scada_awal_before" value="<?= $data["scada_awal_before"]; ?>" style="border:1px solid #fff; width:300px;" disabled>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text" name="dpf_awal" value="<?= $data["dpf_awal"]; ?>" style="border:1px solid #fff; width:300px;" disabled>
                            <a href="dpf/<?= $data["foto_dpf1"]; ?>" class="btn" download><span class="text fas fa-download"></span></a>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text" name="scada_akhir_before" style="border:1px solid #fff;" value="<?= $data["scada_akhir_before"]; ?>">
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text" name="dpf_akhir" style="border:1px solid #fff; width:300px; font-style:italic;" value="<?= $data["dpf_akhir"]; ?>">
                            <input type="file" name="dpfFile_akhir">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">ALIRAN DAYA SETELAH DIBEBASKAN</label>
                        </div>
                        <div class="col" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">ALIRAN DAYA SETELAH DINORMALKAN</label>
                        </div>
                    </div>
                    <div class="row" style="background-color:#F2F4F4;">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label>Pembacaan SCADA<span style="color:red;">*</span></label>
                        </div>
                    
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label>Pembacaan SCADA<span style="color:red;">*</span></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text" name="scada_awal_after" style="border:1px solid #fff; width:300px; font-style:italic;" value="<?= $data["scada_awal_after"]; ?>" disabled>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                        <input type="text" name="scada_akhir_after" style="border:1px solid #fff; width:300px;" value="<?= $data["scada_akhir_after"]; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">MANUVER PEMBEBASAN INSTALLASI</label>
                        </div>
                    </div>
                    <div class="row" style="background-color:#F8F9F9;">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label for="">Catatan Pra Pembebasan :</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <textarea name="catatan_pra_bebas" id="" cols="232" rows="3" style="border:1px solid #fff;color:red;" disabled><?= $data["catatan_pra_pembebasan"];?></textarea>
                        </div>
                    </div>
                    <div class="row" style="background-color:#F8F9F9;">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label for="">Tahapan Manuver Pembebasan :</label>
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
                                                    <td><?= $pembebasan["lokasi"];  ?></td>
                                                    <td><?= date("H:i T", strtotime($pembebasan["remote_"]));  ?></td>
                                                    <td><?= date("H:i T", strtotime($pembebasan["real_"]));  ?></td>
                                                    <td><?= date("H:i", strtotime($pembebasan["ads"]));  ?></td>
                                                    <td><?= $pembebasan["installasi"]  ?></td>
                                                </tr>
                                                    <?php $i++ ?>
                                                    <?php endwhile; ?>
                                            </table>
                                        </div>
                                    </div>
                        </div>

                        <div class="row" style="background-color:#F8F9F9;">
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <label for="">Catatan Pasca Pembebasan :</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                                <textarea name="catatan_pasca_pembebasan" id="" cols="190" rows="5" disabled><?= $data["catatan_pasca_pembebasan"]; ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col" style="border:1px solid #B2BABB; background-color:#F2F4F4;font-weight: bold;">
                            <label for="" class="pt-2 pl-2">MANUVER PENORMALAN INSTALLASI</label>
                        </div>
                    </div>
                    <div class="row" style="background-color:#F8F9F9;">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label for="">Catatan Pra Penormalan :</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <textarea name="catatan_pra_normal" id="" cols="232" rows="3" style="border:1px solid #fff;color:red;" disabled><?= $data["catatan_pra_penormalan"];?></textarea>
                        </div>
                    </div>
                    <div class="row" style="background-color:#F8F9F9;">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label for="">Tahapan Manuver Penormalan :</label>
                        </div>
                    </div>
                    <div class="row">
                                <div class="col" style="border:1px solid">
                                    <div class="form-group ml-2">
                                        <img src="img/<?= $data["foto2"];?>" id="output2" height="auto" width="780px" style="padding-top:.50rem;padding-right:.50rem">
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
                                                    <td><input type="time" value="<?= $penormalan["remote"]; ?>" name="remote_normal[]"><input type="text" name="sampel2[]" value="<?= $penormalan["id"]  ?>" hidden> WIB</td>
                                                    <td><input type="time" value="<?= $penormalan["real_"]; ?>" name="real_normal[]"> WIB</td>
                                                    <td><input type="time" value="<?= $penormalan["ads"]; ?>" name="ads_normal[]"> WIB</td>
                                                    <td><?= $penormalan["installasi"]  ?></td>
                                                </tr>
                                            <?php $i++ ?>
                                            <?php endwhile; ?>
                                        </table>
                                    </div>
                                </div>
                    </div> 

                    <div class="row" style="background-color:#F8F9F9;">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label for="">Catatan Pasca Penormalan :</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <textarea name="catatan_pasca_normal" id="" cols="232" rows="3" style="border:1px solid #fff;"><?= $data["catatan_pasca_penormalan"]; ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <textarea name="catatan_amndis_awal" id="" cols="113" rows="5" style="border:1px solid #fff;" disabled><?= $data["catatan_amnDispa_awal"]; ?></textarea>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <textarea name="catatan_amndis_akhir" id="" cols="113" rows="5" style="border:1px solid #fff;" disabled><?= $data["catatan_amnDispa_akhir"]; ?></textarea>
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
    //         q.innerHTML = "<input type='text' name='sample[]' style='width:120px;border:1px solid #fff'>"
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