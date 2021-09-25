<?php

if (!isset($_SESSION["username"])) {
	echo "<script>Anda Belum Login</script>";
  header("location:index.php");
	exit;
}
if ($_SESSION["level"] != "initiator") {
    echo "<script>Mohon Logout dahulu !!</script>";
    unset($_SESSION['username']);
    session_unset();
    session_destroy();
    header("location:index.php");
      exit;
  
  }

include 'functions.php';

$query = mysqli_query($conn,"SELECT id_lokasi FROM db_ajax_lokasi ORDER BY id_lokasi DESC LIMIT 1");
$idNext = mysqli_fetch_assoc($query);
if ($query) {

if( isset($_POST["submit"]) ){

    if( tambahDB($_POST) > 0){
        //var_dump(tambah($_POST)); die;
        echo "<script>
                alert('data berhasil disubmit'); 
                document.location.href = 'initiator-dashboard.php';
                </script>
                ";  
                
    } else {
       // var_dump(tambah($_POST)); die;
        echo "<script>
                alert('data gagal disubmit'); 
                document.location.href = 'initiator-dashboard.php';
                </script>
                "; die;
                
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Databases</title>
      <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:16.60,16.60i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
<br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Input Database
        </div>
        

        <form action="" name="" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">

                    </div>
                    <div class="col">
                        <label for="">id diprediksi setelah disubmit</label>
                        <input name="lastId" type="text" id="idJenis" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <label for="">Pilih Form :</label>
                        <select name="form" id="form">
                            <option value="">-SELECT-</option>
                            <option value="1">form-1</option>
                            <option value="2">form-2</option>
                            
                            
                        </select>
                    </div>

                    <div class="col-3">
                        <label for="">Jenis Pekerjaan :</label>
                        <select name="jenis" id="jenis">
                            <option value="">-SELECT-</option>
                        </select>
                    </div>

                    <div class="col-3">
                        <label for="">Lokasi :</label>
                        <input name="lokasi" type="text" id="lokasi">
                    </div>

                    <div class="col-3">
                        <label for="">Detail Lokasi :</label>
                        <input name="detailLokasi" type="text">
                    </div>
                    
                </div>
                
                <div class="row" >
                    <div class="col">
                        <h5>Lokasi Pekerjaan</h5>
                    </div>
                    <div class="col">
                        <h5>Manuver Pembebasan</h5>
                    </div>
                    <div class="col">
                        <h5>Manuver Penormalan</h5>
                    </div>
                </div>
                <div class="row" >
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr id="tableHead">
                                        <th>Lokasi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody1">
                                    
                                </tbody>
                            </table>
                                <button type="button" id="add1" class="btn btn-success" onclick="tambah1()">+</button>
                                <button type="button" id="remove1" class="btn btn-danger" onclick="kurang1()">-</button> 
                        </div>
                    </div>
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lokasi</th>
                                        <th>Installasi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody2">
                                    
                                </tbody>
                            </table>
                                <button type="button" id="add2" class="btn btn-success" onclick="tambah2()">+</button>
                                <button type="button" id="remove2" class="btn btn-danger" onclick="kurang2()">-</button> 
                        </div>
                    </div>
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lokasi</th>
                                        <th>Installasi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody3">
                                    
                                </tbody>
                            </table>
                                <button type="button" id="add3" class="btn btn-success" onclick="tambah3()">+</button>
                                <button type="button" id="remove3" class="btn btn-danger" onclick="kurang3()">-</button> 
                        </div>
                    </div>

                </div>
                <br><br>
                <div class="row">
                    <div class="col-6">

                    </div>
                    <div class="col-2">
                        <button type="submit" name="submit">SAVE</button>
                    </div>
                
                </div>
            </div>
            
        </form>

        <?php } ?>
    
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#form').on('change',function(){
                var form  = $(this).val();
                $.ajax({
                    url: 'get_data.php',
                    type: "POST",
                    data: {
                        modul: 'jenis',
                        id:form
                    },
                    success: function(respond){
                        $('#jenis').html(respond);
                    },
                    error:function(){
                        alert('gagal mengambil data');
                    }
                })
            })
            
        })

        // $(document).ready(function(){
        //     $('#lokasi').on('key',function(){
        //         var x = $(this).val();
        //         $.ajax({
        //             url: 'got_data.php',
        //             type: "POST",
        //             data: {
        //                 modul: 'idJenis',
        //                 id:x
        //             },
        //             success: function(respond){
        //                 $('#idJenis').html(respond);
        //             },
        //             error:function(){
        //                 alert('gagal');
        //             }
        //         })
        //     })
        // })

        function tambah1() {
            table = document.getElementById('tableBody1');
            var row = table.insertRow(-1);
            cell1 = row.insertCell(0);
            cell1.innerHTML = "<input name='lokasiGitet[]' type='text'>";
        }
        function kurang1() {
            table = document.getElementById('tableBody1');
            row = table.getElementsByTagName('tr');
            if (row.length !='0') {
                row[row.length-1].outerHTML='';
            }
        }
        no = 1;
        function tambah2() {
            table = document.getElementById('tableBody2');
            var row = table.insertRow(-1);
            cell1 = row.insertCell(0);
            cell2 = row.insertCell(1);
            cell3 = row.insertCell(2);
            cell1.innerHTML = no++;
            cell2.innerHTML = "<input name='lokasiOpen[]' type='text'>";
            cell3.innerHTML = "<input name='installasiOpen[]' type='text'>";
        }
        function kurang2() {
            table = document.getElementById('tableBody2');
            row = table.getElementsByTagName('tr');
            if (row.length !='0') {
                row[row.length-1].outerHTML='';
            }
            no--;
        }
        no2 = 1;
        function tambah3() {
            table = document.getElementById('tableBody3');
            var row = table.insertRow(-1);
            cell1 = row.insertCell(0);
            cell2 = row.insertCell(1);
            cell3 = row.insertCell(2);
            cell1.innerHTML = no2++;
            cell2.innerHTML = "<input name='lokasiClose[]' type='text'>";
            cell3.innerHTML = "<input name='installasiClose[]' type='text'>";
        }
        function kurang3() {
            table = document.getElementById('tableBody3');
            row = table.getElementsByTagName('tr');
            if (row.length !='0') {
                row[row.length-1].outerHTML='';
            }
            no2--;
        }

        

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