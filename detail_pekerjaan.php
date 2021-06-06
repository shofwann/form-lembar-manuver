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
            Detaik Pekerjaan
        </div>
        <div class="card-body">
            <div class="form-group cols-sm-6">
                <a href="?url=list_pekerjaan" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>              
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
            



        
            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
            <?php
                require 'koneksi.php';
                $sql=mysqli_query($conn,"SELECT * FROM inputroh WHERE id_input='$_GET[id]'");
                $data=mysqli_fetch_array($sql);
                if ($sql)
                {

                    ?>
                    <!-- Baris/row Ke-0-->
                            <div class="row">
                                

                                <div class="col-4">
                                    <label></label>
                                    <div class="col-0">
                                    <input type="date" data-date="" data-date-format="DD MMMM YYYY" value="2015-08-09">
                                    </div>
                                </div>

                                

                            </div>

                    <!-- Baris/row Ke-1-->
                        <div class="row">
                            <div class="col">
                                <label>User :</label>
                                <input type="text" name="user" placeholder="" value="<?php echo $data['user'];?>" class="form-control" readonly>
                            </div>

                            <div class="col-6">
                                <label>Pekerjaan :</label>
                                <input type="text" name="pekerjaan" placeholder="" value="<?php echo $data['pekerjaan'];?>" class="form-control" readonly>
                            </div>

                            <div class="col-2">
                                <label>Mulai</label>
                                <div class="col-0">
                                <input type="datetime-local" value="2017-06-13T13:00">
                                </div>
                            </div>

                            <div class="col-2">
                                <label>Target</label>
                                <div class="col-0">
                                <input type="datetime-local" value="2017-06-13T13:00">
                                </div>
                            </div>

                        </div>

                    <!-- Baris/row Ke-2-->
                        <div class="row">
                            <div class="col">
                                <br>
                                <label>Lokasi :</label>
                                <input type="text" name="lokasi" class="form-control" placeholder="" value="<?php echo $data['lokasi'];?>" readonly>
                            </div>

                            <div class="col">
                                <br>
                                <label>Installasi :</label>
                                <input type="text" name="waktu" class="form-control" placeholder="" value="<?php echo $data['waktu'];?>" readonly>
                            </div>

                            <div class="col">
                                <br>
                                <label>Waktu Permintaan Diterima :</label>
                                <input type="text" name="req" class="form-control" placeholder="" value="<?php echo $data['req'];?>" readonly>
                            </div>
                        </div>

                    
                    <!-- Baris/row Ke-3-->
                        <div class="row">
                            <div class="col-6">
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Peng. Pekerjaan</th>
                                                <th>Peng. Manuver</th>
                                                <th>Peng. K3</th>
                                                <th>Spv GITET</th>
                                                <th>Ope GITET</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>

                            </div>

                            <div class="col-4 ml-5">
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Spv GITET</th>
                                                <th>Ope GITET</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>



                            <div class="col-1 ml-3">
                                <br>
                                <form>
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
                            <div class="form-group col-2 ml-2">
                                <label for="">Foto SLD</label>
                                <img src="foto/<?php echo $data['foto'];?>" alt="" width="device-width">
                            </div>
                        </div>
                    
                    
              <?php  } ?>
    
            </form>
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