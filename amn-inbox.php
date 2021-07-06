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
        <h6 class="m-0 font-weight-bold text-primary">Data Manuver Memerlukan Perbaikan</h6>
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
                                <th>action</th>
                            </tr>
                            <?php
                                require "functions.php";
                                $datas=query("SELECT * FROM db_form WHERE  ae = 'approve'");
                            ?>
                            <?php $i=1;?>
                            <?php foreach($datas as $row):?>
                            <tr>
                                <td><?=$i;?></td>
                                <td><?= $row["pekerjaan"];?></td>
                                <td><?= $row["waktu"];?></td>
                                <td><?= $row["installasi"];?></td>
                                <td><?= $row["lokasi"];?></td>
                                <td>
                                    
                                <a href="?url=amnApprove&id=<?= $row["id"];?>" id="updateForm-1" class="btn btn-grey btn-icon-split"></span><span class="text far fa-edit"></span></a>
                                <!-- <a href="remove.php?id=<?= $row["id"];?>" onclick="return confirm('yakin menghapus');">Delete</a></td> -->
                            </tr>
                            <?php $i++;?>
                            <?php endforeach; ?>
                            
                    </table>
                </div>
            </div>
        
    </div>
    
</body>
</html>