<?php
        require 'functions.php';
                
        $folder = query("SELECT * FROM db_form WHERE user='$_SESSION[username]' ORDER BY id DESC LIMIT $awalData,$jumlahDataPerHalaman");               

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
                    <th rowspan="2" style="width:5%">No</th>
                    <th rowspan="2" style="width:20%">Pekerjaan</th>
                    <th rowspan="2">waktu</th>
                    <th rowspan="2">lokasi</th>
                    <th colspan="2">Status Aproval</th>
                    <th rowspan="2">Details</th>
                    </tr>
                    <tr>
                    <th>AMN</th>
                    <th>MSB</th>
                    </tr>
                </thead>
                <?php $no=1; ?>
                <?php foreach ( $folder as $data) : ?>
                <tbody>
                    <tr>
                    <td><?= $no+$awalData?></td>
                    <td><?= $data['pekerjaan'];?></td>
                    <td><?= $data['date'];?></td>
                    <td><?= $data['lokasi'];?></td>
                    <td><?php if($data['amn'] == "approve") {
                                echo "<a href='#' class='btn btn-success btn-icon-split' data-toggle='tooltip' data-placement='left' title='approve'><span class='icon text-white-50'><i class='fas fa-thumbs-up'></i></span></a>";
                            }elseif ($data['amn'] == "disapprove") {
                                echo "<a href='#' class='btn btn-danger btn-icon-split' data-toggle='tooltip' data-placement='left' title='disapprove'><span class='icon text-white-50'><i class='fas fa-thumbs-down'></i></span></a>";
                            }else{
                                echo "<a href='#' class='btn btn-warning btn-icon-split' data-toggle='tooltip' data-placement='left' title='pending'><span class='icon text-white-50'><i class='fas fa-spinner'></i></span></a>";
                            }?>
                            <a href='createPDF.php?id=<?= $data['id'];?>&jumlah=' class='' hidden><span class='icon text-danger'><i class='far fa-file-pdf fa-lg ml-3'></i></span></a>
                    </td>
                    <td><?php if($data['msb'] == "approve") {
                                echo "<a href='#' class='btn btn-success btn-icon-split' data-toggle='tooltip' data-placement='left' title='approve'><span class='icon text-white-50'><i class='fas fa-thumbs-up'></i></span></a>";
                            }elseif ($data['msb'] == "disapprove") {
                                echo "<a href='#' class='btn btn-danger btn-icon-split' data-toggle='tooltip' data-placement='left' title='disapprove'><span class='icon text-white-50'><i class='fas fa-thumbs-down'></i></span></a>";
                            }else{
                                echo "<a href='#' class='btn btn-warning btn-icon-split' data-toggle='tooltip' data-placement='left' title='pending'><span class='icon text-white-50'><i class='fas fa-spinner'></i></span></a>";
                            }?>
                            <a href='createPDF.php?id=<?= $data['id'];?>&jumlah=' class=''><span class='icon text-danger'><i class='far fa-file-pdf fa-lg ml-3'></i></span></a>
                    </td>
                    <td>
                        <a href="?url=show_detail&id=<?= $data['id'];?>" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                            <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">details</span>
                        </a>
                    </td>
                    </tr>
                </tbody>
                <?php $no++ ?>
                <?php endforeach; ?>
            </table>
            </div>
            <?php for($i=1; $i<= $jumlahHalaman; $i++) : ?>
                <?php if( $i == $halamanAktif) : ?>
                    <a href="initiator-dashboard.php?url=list_pekerjaan&halaman=<?= $i; ?>" style="font-weight:bold;"><?= $i; ?></a>
                <?php else : ?>
                    <a href="initiator-dashboard.php?url=list_pekerjaan&halaman=<?= $i; ?>"><?= $i; ?></a>
                <?php endif; ?>
            <?php endfor?>
        </div>
    </div>

    <div id="demo"></div>





    </div>
<script>
var ab = document.getElementsByTagName('a');
var ini = document.getElementById('ini');
var clas1 = document.getElementsByClassName('btn btn-warning btn-icon-split');
var clas2 = document.getElementsByClassName('btn btn-danger btn-icon-split');

for (let i=0; i<clas1.length; i++) {
    clas1[i].parentElement.children[1].style.display='none';
}

for (let i=0; i<clas2.length; i++) {
    clas2[i].parentElement.children[1].style.display='none';
}

var keyword = document.getElementById('keyword');
var tombolCari = document.getElementById('cari');
var bungkus = document.getElementById('bungkus');

keyword.addEventListener('keyup', function()  {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if( xhr.readyState == 4 && xhr.status == 200 ) {
            bungkus.innerHTML = xhr.responseText;
        }
    }


xhr.open('GET','ajax/data_table.php?keyword=' + keyword.value , true);

xhr.send();


});

</script>
<!-- <script src="js/shofwan.js"></script> -->
</body>

</html>
