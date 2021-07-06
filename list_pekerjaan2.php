<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>List Preview Status</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<body id="page-top">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Manuver</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th style="width:5%">No</th>
                    <th style="width:20%">Pekerjaan</th>
                    <th>waktu</th>
                    <th>lokasi</th>
                    <th colspan="2">Status Aproval</th>
                    <th>Aproval</th>
                    </tr>
                </thead>
                
                <?php

                require 'koneksi.php';
                $sql=mysqli_query($conn,"SELECT * FROM db_form WHERE user='$_SESSION[username]'");
                $no=0;
                while ($data=mysqli_fetch_array($sql)){
                $no++;
              
                ?>

                <tbody>
                    <tr>
                    <td><?php echo $no?></td>
                    <td><?php echo $data['pekerjaan'];?></td>
                    <td><?php echo $data['waktu'];?></td>
                    <td><?php echo $data['lokasi'];?></td>
                    <td><?php echo $data['amn'];?></td>
                    <td><?php echo $data['msb'];?></td>
                    <td>
                        <a href="?url=show_detail&id=<?php echo $data['id'];?>" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                            </span>
                            <span class="text">detail</span>
                        </a>
                        
                    </tr>
                </tbody>
                <?php }?>
            </table>
        </div>
    </div>





    </div>

  
</body>

</html>
