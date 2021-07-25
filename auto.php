<?php





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
                        <select name="form" id="form" onchange="pilih()">
                            <option value="">-SELECT-</option>
                            <option value="1">Form-1</option>
                            <option value="2">Form-2</option>
                        </select>
                    </div>

                    <div class="col-3">
                        <label for="">Piliih profinsi :</label>
                        <select name="idx" id="">
                            <option value="">-SELECT-</option>
                            <option value="">Jakarta</option>
                            <option value="">Jabar</option>
                        </select>
                    </div>

                    <div class="col-3">
                        <label for="">Piliih Kota :</label>
                        <select name="idy" id="">
                            <option value="">-SELECT-</option>
                            <option value="">Bandung</option>
                            <option value="">Depok</option>
                        </select>
                    </div>

                    <div class="col-3">
                        <label for="">Piliih Kelurahan :</label>
                        <select name="idz" id="kecamatan">
                            <option value="">-SELECT-</option>
                            <option value="1">Limo</option>
                            <option value="2">Margonda</option>
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

    function pilih() {
        var val = document.getElementById('kecamatan').value;
        if (document.getElementById('form').value == '1') {
           // document.getElementById('pesan').innerHTML = "1";
            document.getElementById('ini').href='?url=autoForm1'+'&id='+ val;
        } 
        else if (document.getElementById('form').value == '2') {
           // document.getElementById('pesan').innerHTML = "2";
            document.getElementById('ini').href='?url=autoForm2'+'&id='+ val;
        }

        else {
            document.getElementById('pesan').innerHTML = "anda belum pilih form";
        }
    }
        // let select = document.querySelector('#lang').value;
        // let result = document.querySelector('#result');
        // select.addEventListener('change', function () {
        //     result = this.value;
        // });
    function fungsi() {
        var val = document.getElementById('kecamatan').value;
        if (document.getElementById('form').value == '1') {
           // document.getElementById('pesan').innerHTML = "1";
            document.getElementById('ini').href='?url=autoForm1'+'&id='+ val;
        } 
        else if (document.getElementById('form').value == '2') {
           // document.getElementById('pesan').innerHTML = "2";
            document.getElementById('ini').href='?url=autoForm2'+'&id='+ val;
        }

        else {
            document.getElementById('pesan').innerHTML = "anda belum pilih form";
        }
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