<?php

include 'functions.php';




?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Form Manuver</title>

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

<body id="page-top">
<br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Pilih Form Emergency
        </div>
        

        <form action="proses.php" name="" method="get">
            <div class="card-body">
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
                        <label for="">Piliih profinsi :</label>
                        <select name="idx" id="jenis">
                            <option value="">-SELECT-</option>
                        </select>
                    </div>

                    <div class="col-3">
                        <label for="">Piliih Kota :</label>
                        <select name="idy" id="lokasi">
                            <option value="">-SELECT-</option>

                        </select>
                    </div>

                    <div class="col-3">
                        <label for="">Piliih Kelurahan :</label>
                        <select name="idz" id="detail_lokasi">
                            <option value="">-SELECT-</option>

                        </select>
                    </div>
                    
                </div>
                
                <div class="row">
                                    <br>
                </div>
                <div class="row">
                    <div class="col-10">

                    </div>
                    <div class="col-2">
                        <button type="submit" name="submit">Next Page</button>
                    </div>
                
                </div>
            </div>
            
        </form>
    
    </div>
    
      
    <script type="text/javascript">
        $(document).ready(function(){
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

            $('#jenis').on('change',function(){
                var form = $(this).val();
                $.ajax({
                    url: 'get_data.php',
                    type: "POST",
                    data: {
                        modul: 'lokasi',
                        id:form
                    },
                    success: function(respond){
                        $('#lokasi').html(respond);
                    },
                    error:function(){
                        alert('gagal mengambil data');
                    }
                })
            })

            $('#lokasi').on('change',function(){
                var form = $(this).val();
                $.ajax({
                    url: 'get_data.php',
                    type: "POST",
                    data: {
                        modul: 'detail_lokasi',
                        id:form
                    },
                    success: function(respond){
                        $('#detail_lokasi').html(respond);
                    },
                    error:function(){
                        alert('gagal mengambil data');
                    }
                })
            })
            

        });
    


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