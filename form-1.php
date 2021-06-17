<?php


if (!isset($_SESSION["username"])) {
	echo "<script>Anda Belum Login</script>";
  header("location:index.php");
	exit;
}



require "functions.php";


if( isset($_POST["submit"]) ){

    if( tambah($_POST) > 0){
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
            Input Manuver
        </div>
        <div class="card-body">
            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                <!-- Baris/row Ke-0 hide data auto-->
                    <div class="row" >
                        
                        <div class="col-2">
                            <label>Create Date:</label>
                            <input type="text" name="create_date" value="<?php echo date('d-M-Y');?>" class="form-control" readonly>
                        </div>

                        <div class="col-2">
                            <label>User :</label>
                            <input type="text" name="user" placeholder="" value="<?php echo $_SESSION['username'];?>" class="form-control" readonly>
                        </div>

                        <div class="col-2">
                            <label>ID Task:</label>
                            <input type="text" name="idTask" value="" class="form-control" >
                        
                        </div>
                        

                    </div>

                <!-- Baris/row Ke-1 Titel Pekerjaan-->
                    <div class="row">
                        <div class="col-4">
                            <label for="pekerjaan" class="control-label">Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control">
                        </div>
                        <div class="col">
                            <label for="start_date">Start</label>
                            <input type="datetime-local" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="col">
                            <label for="end_date">End</label>
                            <input type="datetime-local" name="end_date" id="end_date" class="form-control">
                        </div>
                        <div class="col">
                            <label for="report_date">Req Date Received</label>
                            <input type="datetime-local" name="report_date" id="report_date" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" name="lokasi" id="lokasi" class="form-control">
                        </div>
                        <div class="col">
                            <label for="waktu">Waktu</label>
                            <input type="datetime-local" name="waktu" id="waktu" class="form-control">
                        </div>
                        
                        <div class="col">
                            <label for="instal">Installasi</label>
                            <input type="text" name="instal" id="instal" class="form-control">
                        </div>
                    </div>

                

                
                <!-- Baris/row ke-3 Pengawas-->
                    <br>
                    
                    <div class="row"> 
                        
                        <div col="col-7">
                            <div class="table-responsive ml-2">
                            <h4 style="text-align:center;">Manuver Pembebasan Instalasi</h4>  
                               <table class="table table-bordered" > 
                               <thead>
                                    <tr id="mirrodHead" style="background-color:#F2F4F4;">  
                                        <th style="width:158px;">Lokasi</th>
                                        <th style="width:158px;">Peng. Pekerjaan</th>
                                        <th style="width:158px;">Peng. Manuver</th>
                                        <th style="width:158px;">Peng. K3</th>
                                        <th style="width:158px;">Spv GITET</th>
                                        <th style="width:158px;">Opr GITET</th>
                                    </tr>
                               </thead> 
                               <tbody id="table1">
     
                               </tbody>
                               </table> 
                                <button type="button" id="add1" class="btn btn-success" onclick="tambah()" >+</button>
                                <button type="button" id="remove1" class="btn btn-danger" onclick="kurang()">-</button>   
                            </div>  
                        </div> 

                        <div class="col-3 ml-5">
                            <div class="table-responsive">
                            <h4 style="text-align:center;">Manuver Penormalan Instalasi</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="background-color:#F2F4F4;">
                                            <th>Spv GITET</th>
                                            <th>Opr GITET</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table2">
                                    </tbody>
                                </table>
                                 
                            </div>
                        </div>

                        <div class="col-1 ml-3">
                            <br>
                                <label>Kelengkapan Dokumen :</label>
                                <div action="">
                                    <input type="checkbox" id="" name="wp" value="" disabled>
                                    <label for="vehicle1"> WP</label><br>
                                    <input type="checkbox" id="" name="ik" value="" disabled>
                                    <label for="vehicle2"> IK</label><br>
                                    <input type="checkbox" id="" name="k3" value="" disabled>
                                    <label for="vehicle3"> K3</label><br>
                                </div>
                        </div>
                            
                    </div>
                <!-- Baris/row ke-4 TM-->
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <h4>Aliran daya pada installasi menjelang dibebaskan</h4>
                        </div>
                        <div class="col-6">
                            <h4>Aliran daya pada installasi menjelang dinormalkan</h4>
                        </div>
                    </div>
                    <div class="row" style="background-color:#F2F4F4;">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label>Pembacaan SCADA</label>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label>Hasil Studi DPF</label>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label>Pembacaan SCADA</label>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label>Hasil Studi DPF</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <!-- <input type="text" style="border:1px solid #fff;"> -->
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <!-- <input type="text" style="border:1px solid #fff;"> -->
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <!-- <input type="text" style="border:1px solid #fff;"> -->
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <!-- <input type="text" style="border:1px solid #fff;"> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label>Aliran daya pada installasi setelah dibebaskan</label>
                        </div>
                        <div class="col-6">
                            <label>Aliran daya pada installasi setelah dinormalkan</label>
                        </div>
                    </div>
                    <div class="row" style="background-color:#F2F4F4;">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label>Pembacaan SCADA</label>
                        </div>
                        
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label>Pembacaan SCADA</label>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <!-- <input type="text" style="border:1px solid #fff;"> -->
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <!-- <input type="text" style="border:1px solid #fff;"> -->
                        </div>
                        
                    </div>
                <!-- Baris/row ke-5 image-->
                    <br>
                    <div class="row" style="background-color:#F2F4F4;">
                    <div class="col" style="border:1px solid; padding-top:10px;">
                    <h2 style="text-align:center;" >Manuver Pembebasan Installasi</h2>
                    </div>
                    
                    </div>
                    
                    <div class="row">
                            <div class="col-6" style="border:1px solid">
                                <div class="form-group ml-2">
                                    <img id="output1" height="auto" width="780px" style="padding-top:.50rem;padding-right:.50rem"><br>
                                    <input type="file" accept="image/*" onchange="loadFile1(event)" name="foto" required="required">
                                </div>
                            </div>

                            <div class="col-6" style="border:1px solid">
                                <div class="table-responsive">
                                    <table class="table table-bordered mt-2" id="dynamic_field1" style="">
                                        <tr>
                                            <th rowspan="2" style="padding-top:35px;width:28px">No.</th>
                                            <th rowspan="2" style="width:.78rem;text-align:center;padding-top:35px">Lokasi</th>
                                            <th colspan="3"style="width:7rem;text-align:center">Jam Manuver Buka</th>
                                            <th rowspan="2"style="padding-top:35px;width:7rem;">Installasi</th>
                                            <th rowspan="2"><button type="button" name="add3" id="add3" class="btn btn-success">Add More</button></th>
                                        </tr>
                                        <tr>
                                            <th>Remote</th>
                                            <th>Real (R/L)</th>
                                            <th>ADS</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                    </div>
                <!-- Baris/row ke-6 image-->
                        <br>
                        <div class="row" style="background-color:#F2F4F4;">
                            <div class="col" style="border:1px solid; padding-top:10px;">
                            <h2 style="text-align:center;">Manuver Penormalan Installasi</h2>
                            </div>
                        </div>
                        
                        <div class="row">
                                <div class="col" style="border:1px solid">
                                    <div class="form-group ml-2">
                                        <img id="output2" height="auto" width="780px" style="padding-top:.50rem;padding-right:.50rem"><br>
                                        <input type="file" accept="image/*" onchange="loadFile2(event)" name="foto2" required="required">
                                    </div>
                                </div>
                                <div class="col" style="border:1px solid">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mt-2" id="dynamic_field2" style="">
                                            <tr>
                                                <th rowspan="2" style="padding-top:35px;width:28px">No.</th>
                                                <th rowspan="2" style="width:.78rem;text-align:center;padding-top:35px">Lokasi</th>
                                                <th colspan="3"style="width:7rem;text-align:center">Jam Manuver Tutup</th>
                                                <th rowspan="2"style="padding-top:35px;width:7rem;">Installasi</th>
                                                <th rowspan="2"><button type="button" name="add4" id="add4" class="btn btn-success">Add More</button></th>
                                            </tr>
                                            <tr>
                                                <th>Remote</th>
                                                <th>Real (R/L)</th>
                                                <th>ADS</th>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                        </div>    
                <!-- Baris/row ke-7 Catatan-->
                    <br>
                    <div class="row" style="background-color:#F2F4F4;">
                    
                        <div class="col-6" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label for="">Catatan Pembebasan:</label>
                        </div>

                        <div class="col-6" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <label for="">Catatan Penormalan:</label>
                        </div>
                    </div>
                    <div class="row" style="">
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <textarea name="catatanBebas" id="" cols="90" rows="5"></textarea>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <textarea name="catatanNormal" id="" cols="90" rows="5"></textarea>
                        </div>
                    </div>

                <!-- Baris/row submit-->
                    <br>
                    <div class="row">
                        <div class="col-2">
                            <button type="submit" name="submit" >Simpan Form</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    
      
    <script type="text/javascript">
    

    function tambah(){
        table = document.getElementById("table1");
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);

       cell1.innerHTML = "<input type='text' name='lokasiPembebasan[]' id='' style='width:140px;border:1px solid #fff;'>";
       cell2.innerHTML = "<input type='text' name='pKerjaPembebasan[]' id='' style='width:140px;border:1px solid #fff;' disabled>";
       cell3.innerHTML = "<input type='text' name='pManuverPembebasan[]' id='' style='width:140px;border:1px solid #fff;' disabled>";
       cell4.innerHTML = "<input type='text' name='pK3Pembebasan[]' id='' style='width:140px;border:1px solid #fff;' disabled>";
       cell5.innerHTML = "<input type='text' name='spvPembebasan[]' id='' style='width:140px;border:1px solid #fff;' disabled>";
       cell6.innerHTML = "<input type='text' name='oprPembebasan[]' id='' style='width:140px;border:1px solid #fff;' disabled>";

       table1 = document.getElementById("table2");
       var row1 = table1.insertRow(-1);
       var cell7 = row1.insertCell(0);
       var cell8 = row1.insertCell(1);

       cell7.innerHTML = "<input type='text' name=spvPenormalan[] id='' style='width:140px;border:1px solid #fff;'>";
       cell8.innerHTML = "<input type='text' name=oprPenormalan[] id='' style='width:140px;border:1px solid #fff;'>";
    }

    function kurang(){
        table = document.getElementById("table1");
        row = table.getElementsByTagName('tr');
        if (row.length!='0'){
            row[row.length - 1].outerHTML='';
        }
        table = document.getElementById("table2");
        row = table.getElementsByTagName('tr');
        if (row.length!='0'){
            row[row.length - 1].outerHTML='';
        }

    }

    //---image_upload_&_show 1---//
        var loadFile1 = function(event) {
        var output1 = document.getElementById('output1');
        output1.src = URL.createObjectURL(event.target.files[0]);
        };
    //---image_upload_&_show 2---//
        var loadFile2 = function(event) {
        var output2 = document.getElementById('output2');
        output2.src = URL.createObjectURL(event.target.files[0]);
        };
    
    
     //--table-jquery--//
            $(document).ready(function(){
                //--table_add/remove w/ number1--/
                    var k=0;
                    generateIndex = () => {
                        lenghtRows = $('#dynamic_field1 tr').length-1;
                        return lenghtRows;
                    }
                    UpdateIndex = () => {
                        lengthRows = $('#dynamic_field1 tr').length-1;
                        for (k=0; k<lenghtRows; k++){
                            $('#dynamic_field1 tr td.cont-item')[k].textContent = k+1;
                        }
                    }
                    $('#add3').click(function(){
                        k=generateIndex();
                        $('#dynamic_field1').append('<tr id="row'+k+'"><td class="cont-item" style="width:16px">'+k+'</td><td><input type="text" name="lokasiManuverBebas[]" style="width:50px; padding:0px;"></td><td><input type="time" name="jamRemoteBebas[]" style="width:5rem;padding:0rem;" disabled></td><td><input type="time" name="jamRealBebas[]" style="width:5rem;padding:0rem;" disabled></td><td><input type="time" name="jamAdsBebas[]" style="width:5rem;padding:0rem;" disabled></td><td><input type="text" name="installManuverBebas[]" style="width:8rem;padding:0rem;"></td><td><button type="button" name="remove" id="'+k+'" class="btn btn-danger btn_remove">X</button></td></tr>');
                    });

                    $(document).on('click', '.btn_remove', function(){ 
                        k-=1; 
                        var button_id = $(this).attr("id");   
                        $('#row'+button_id+'').remove();  
                        UpdateIndex();
                    }); 

                //--table_add/remove w/ number2--/
                    var l=0;
                        generateIndex1 = () => {
                            lenghtRows1 = $('#dynamic_field2 tr').length-1;
                            return lenghtRows1;
                        }
                        UpdateIndex1 = () => {
                            lengthRows = $('#dynamic_field2 tr').length-1;
                            for (l=0; l<lenghtRows1; l++){
                                $('#dynamic_field2 tr td.cont-item')[l].textContent = l+1;
                            }
                        }
                        $('#add4').click(function(){
                            l=generateIndex1();
                            $('#dynamic_field2').append('<tr id="row1'+l+'"><td class="cont-item" style="width:16px">'+l+'</td><td><input type="text" name="lokasiManuverNormal[]" style="width:50px; padding:0px;"></td><td><input type="time" name="jamRemoteNormal[]" style="width:5rem;padding:0rem;" disabled></td><td><input type="time" name="jamRealNormal[]" style="width:5rem;padding:0rem;" disabled></td><td><input type="time" name="jamAdsNormal[]" style="width:5rem;padding:0rem;" disabled></td><td><input type="text" name="installManuverNormal[]" style="width:8rem;padding:0rem;"></td><td><button type="button" name="remove" id="'+l+'" class="btn btn-danger btn_remove2">X</button></td></tr>');
                        });

                        $(document).on('click', '.btn_remove2', function(){ 
                            l-=1; 
                            var button_id1 = $(this).attr("id");   
                            $('#row1'+button_id1+'').remove();  
                            UpdateIndex1();
                        }); 

                   
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