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
                <thead class="">
                    <tr>
                    <th rowspan="2" style="width:5%">No</th>
                    <th rowspan="2" style="width:20%">Pekerjaan</th>
                    <th rowspan="2">waktu</th>
                    <th rowspan="2">lokasi</th>
                    <th colspan="2">Status Aproval</th>
                    <th rowspan="2">Aproval</th>
                    </tr>
                    <tr>
                    <th>AMN</th>
                    <th>MSB</th>
                    </tr>
                </thead>
                
                <?php

                require "functions.php";
                $sql=mysqli_query($conn,"SELECT * FROM db_form WHERE user_msb = '$_SESSION[username]'");
                $no=0;
                while ($data=mysqli_fetch_array($sql)){
                $no++;
              
                ?>

                <tbody>
                    <tr>
                    <td><?= $no?></td>
                    <td><?= $data['pekerjaan'];?></td>
                    <td><?= $data['waktu'];?></td>
                    <td><?= $data['lokasi'];?></td>
                    <td><?= $data['amn'] == "disapprove" ? "<a href='#' class='btn btn-success btn-icon-split'><span class='icon text-white-50'><i class='fas fa-thumbs-down'></i></span></a>" : "<a href='#' class='btn btn-success btn-icon-split'><span class='icon text-white-50'><i class='fas fa-thumbs-up'></i></span></a>" ;?></td>
                    <td><?= $data['msb'] == "disapprove" ? "<a href='#' class='btn btn-success btn-icon-split'><span class='icon text-white-50'><i class='fas fa-thumbs-down'></i></span></a>" : "<a href='#' class='btn btn-success btn-icon-split'><span class='icon text-white-50'><i class='fas fa-thumbs-up'></i></span></a>" ;?></td>
                    <td>
                        <a href="?url=show_detail&id=<?= $data['id'];?>" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                            <i class="fas fa-info-circle"></i>
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
