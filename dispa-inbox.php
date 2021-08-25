<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman list</title>

    <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Manuver Memerlukan Persetujuan</h6>
    </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    </div>
                    <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                            <tr>
                                <th style="width:3%;">No</th>
                                <th>Pekerjaan</th>
                                <th>Waktu</th>
                                <th>Installasi</th>
                                <th>lokasi</th>
                                <th>status</th>
                                <th>action</th>
                            </tr>
                            <?php
                                require "functions.php";
                                $datas=query("SELECT * FROM db_form WHERE  msb = 'approve' AND dispa = 'pembebasan' AND ae ='aprovMsb'");
                            ?>
                            <?php $i=1;?>
                            <?php foreach($datas as $row):?>
                            <tr>
                                <td><?=$i;?></td>
                                <td><?= $row["pekerjaan"];?></td>
                                <td><?= $row["waktu"];?></td>
                                <td><?= $row["installasi"];?></td>
                                <td><?= $row["lokasi"];?></td>
                                <td><?= $row["status"];?></td>
                                <td>
                                    
                                <a href="?url=dispaInputAwal&id=<?= $row["id"];?>" id="updateForm-1" class="btn btn-grey btn-icon-split"><span class="text far fa-edit"></span></a>
                                </td>
                            <?php $i++;?>
                            <?php endforeach; ?>
                                <!-- untuk percobaan -->
                            <?php
                                $datas=query("SELECT * FROM db_form WHERE amn_dispa = 'approve' AND status = 'penormalan'");
                            ?>
                            <?php foreach($datas as $row):?>
                            <tr>
                                <td><?=$i;?></td>
                                <td><?= $row["pekerjaan"];?></td>
                                <td><?= $row["waktu"];?></td>
                                <td><?= $row["installasi"];?></td>
                                <td><?= $row["lokasi"];?></td>
                                <td><?= $row["status"];?></td>
                                <td>
                                <a href="?url=dispaInputAkhir&id=<?= $row["id"];?>" id="updateForm-1" class="btn btn-grey btn-icon-split"><span class="text far fa-edit"></span></a>
                                </td>
                            <?php $i++;?>
                            <?php endforeach; ?>


                            <?php
                                $datas=query("SELECT * FROM db_form WHERE  amn_dispa = 'disapprove' AND status = 'pembebasan' AND user_dispa_awal = '$_SESSION[username]'");
                            ?>
                            <?php foreach($datas as $row):?>
                            <tr>
                                <td><?=$i;?></td>
                                <td><?= $row["pekerjaan"];?></td>
                                <td><?= $row["waktu"];?></td>
                                <td><?= $row["installasi"];?></td>
                                <td><?= $row["lokasi"];?></td>
                                <td><?= $row["status"];?></td>
                                <td> 
                                <a href="?url=dispaUpdateAwal&id=<?= $row["id"];?>" id="updateForm-1" class="btn btn-grey btn-icon-split"><span class="text far fa-edit"></span></a>
                                </td>
                            <?php $i++;?>
                            <?php endforeach; ?>

                            <?php
                                $datas=query("SELECT * FROM db_form WHERE amn_dispa = 'disapprove' AND status = 'penormalan' AND user_dispa_awal = '$_SESSION[username]'");
                            ?>
                            <?php foreach($datas as $row):?>
                            <tr>
                                <td><?=$i;?></td>
                                <td><?= $row["pekerjaan"];?></td>
                                <td><?= $row["waktu"];?></td>
                                <td><?= $row["installasi"];?></td>
                                <td><?= $row["lokasi"];?></td>
                                <td><?= $row["status"];?></td>
                                <td>
                                <a href="?url=dispaUpdateAkhir&id=<?= $row["id"];?>" id="updateForm-1" class="btn btn-grey btn-icon-split"><span class="text far fa-edit"></span></a>
                                </td>
                            <?php $i++;?>
                            <?php endforeach; ?> 
                    </table>
                </div>
            </div>
        
    </div>
    
</body>
</html>