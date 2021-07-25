<?php
                require 'functions.php';
                
                $folder = query("SELECT * FROM db_form WHERE user_amn='$_SESSION[username]' ORDER BY id DESC LIMIT $awalData,$jumlahDataPerHalaman");               

?>


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
    </div><br>

    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" name="keyword" id="keyword" size="30" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off" autofocus>
              <div class="input-group-append">
                <button class="btn btn-secondary" type="button" name="cari" id="cari">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
    </form>

    <div class="card-body">
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            </div>
            <div id="bungkus">
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
                <?php $no=1; ?>
                <?php foreach ( $folder as $data) : ?>
                <tbody>
                    <tr>
                    <td><?= $no+$awalData?></td>
                    <td><?= $data['pekerjaan'];?></td>
                    <td><?= $data['waktu'];?></td>
                    <td><?= $data['lokasi'];?></td>
                    <td><?= $data['amn'] == "disapprove" ? "<a href='#' class='btn btn-danger btn-icon-split'><span class='icon text-white-50'><i class='fas fa-thumbs-down'></i></span></a>" : "<a href='#' class='btn btn-success btn-icon-split'><span class='icon text-white-50'><i class='fas fa-thumbs-up'></i></span></a>";?></td>
                    <td><?= $data['msb'] == "disapprove" ? "<a href='#' class='btn btn-danger btn-icon-split'><span class='icon text-white-50'><i class='fas fa-thumbs-down'></i></span></a>" : "<a href='#' class='btn btn-success btn-icon-split'><span class='icon text-white-50'><i class='fas fa-thumbs-up'></i></span></a>";?></td>
                    <td>
                        <a href="?url=show_detail&id=<?= $data['id'];?>" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                            <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">details</span>
                        </a>
                    </tr>
                </tbody>
                <?php $no++ ?>
                <?php endforeach; ?>
            </table>
            </div>
            <?php for($i=1; $i<= $jumlahHalaman; $i++) : ?>
                <?php if( $i == $halamanAktif) : ?>
                    <a href="amn-dashboard.php?url=amnList&halaman=<?= $i; ?>" style="font-weight:bold;"><?= $i; ?></a>
                <?php else : ?>
                    <a href="amn-dashboard.php?url=amnList&halaman=<?= $i; ?>"><?= $i; ?></a>
                <?php endif; ?>
            <?php endfor?>
        </div>
    </div>





    </div>

<script src="js/shofwan.js"></script>
</body>

</html>

