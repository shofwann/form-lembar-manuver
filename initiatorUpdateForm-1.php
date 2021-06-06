<?php

require "functions.php";
$id = $_GET["id"];

$data =query("SELECT * FROM db_form WHERE id_form = $id")[0];

// cek apakah tombol submit sudah di klik

if( isset($_POST["submit"]) ){

    // cek apakah data berhasil dirubah

    if( ubah($_POST) > 0){
    echo "<script>
            alert('data Manuver berhasil disubmit'); 
            document.location.href = 'initiator-dashboard.php';
            </script>
            ";   
} else {
    echo "<script>
            alert('data Manuver gagal sisubmit'); 
            document.location.href = 'initiator-dashboard.php';
            </script>
            "; 
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

  <title>SB Admin 2 - Tables</title>

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
                <!-- Baris/row Ke-0-->
                    <div class="row" hidden>
                        
                        <div class="col-2">
                            <label>ID:</label>
                            <input type="text" name="id_form" value="<?= $data["id_form"];?>" class="form-control">
                        </div>
                        <div class="col-2">
                            <label>Create Date:</label>
                            <input type="text" name="c_date" value="<?= $data["c_date"];?>" class="form-control">
                        </div>

                        <div class="col-2">
                            <label>User :</label>
                            <input type="text" name="user" placeholder="" value="<?= $data["user"];?>" class="form-control">
                        </div>
                        <div class="col-2" >
                        <label for="fotoLama" class="control-label">foto</label>
                        <input type="text" name="fotoLama" id="fotoLama" class="form-control" value="<?= $data["foto"]; ?>"> <!--untuk menyimpan foto lama, jika user tidak ganti foto maka foto ini yg digunakan-->
                        </div> 
                        

                    </div>

                <!-- Baris/row Ke-1-->
                <div class="row">
                    <div class="col-4">
                        <label for="pekerjaan" class="control-label">Pekerjaan</label>
                        <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" value="<?= $data["pekerjaan"];?>">
                    </div>
                    <div class="col">
                        <label for="s_date">Start</label>
                        <input type="datetime-local" name="s_date" id="s_date" class="form-control" value="<?= $data["s_date"];?>">
                    </div>
                    <div class="col">
                        <label for="e_date">End</label>
                        <input type="datetime-local" name="e_date" id="e_date" class="form-control" value="<?= $data["e_date"];?>">
                    </div>
                    <div class="col">
                        <label for="r_date">Req Date Received</label>
                        <input type="text" name="r_date" id="r_date" class="form-control" value="<?= $data["r_date"];?>"> 
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control" value="<?= $data["lokasi"];?>">
                    </div>
                    <div class="col">
                        <label for="waktu">Waktu</label>
                        <input type="text" name="waktu" id="waktu" class="form-control" value="<?= $data["waktu"];?>">
                    </div>
                    
                    <div class="col">
                        <label for="instal">Installasi</label>
                        <input type="text" name="instal" id="instal" class="form-control" value="<?= $data["instal"];?>">
                    </div>
                </div>

                

                
                <!-- Baris/row ke-3-->
                    <br>
                    
                    <div class="row"> 
                        
                        <div col="col-7">
                            <div class="table-responsive ml-2">
                            <h4 style="text-align:center;">Manuver Pembebasan Instalasi</h4>  
                               <table class="table table-bordered" id="table1">  
                                    <tr style="background-color:#F2F4F4;">  
                                        <th style="width:158px;">Lokasi</th>
                                        <th style="width:158px;">Peng. Pekerjaan</th>
                                        <th style="width:158px;">Peng. Manuver</th>
                                        <th style="width:158px;">Peng. K3</th>
                                        <th style="width:158px;">Spv GITET</th>
                                        <th style="width:158px;">Opr GITET</th>
                                    </tr>  
                               </table> 
                                <button type="button" id="add1" class="btn btn-success">+</button>
                                <button type="button" id="remove1" class="btn btn-danger">-</button>   
                            </div>  
                        </div> 

                        <div class="col-3 ml-5">
                            <div class="table-responsive">
                            <h4 style="text-align:center;">Manuver Penormalan Instalasi</h4>
                                <table class="table table-bordered" id="table2">
                                        <tr style="background-color:#F2F4F4;">
                                            <th>Spv GITET</th>
                                            <th>Opr GITET</th>
                                        </tr>
                                </table>
                                <button type="button" id="add2" class="btn btn-success">+</button>
                                <button type="button" id="remove2" class="btn btn-danger">-</button>
                            </div>
                        </div>

                        <div class="col-1 ml-3">
                            <br>
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
                <!-- Baris/row ke-4 TM-->
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <label>Aliran daya pada installasi menjelang dibebaskan</label>
                        </div>
                        <div class="col-6">
                            <label>Aliran daya pada installasi menjelang dinormalkan</label>
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
                            <input type="text">
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text">
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text">
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text">
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
                            <input type="text">
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text">
                        </div>
                        
                    </div>
                <!-- Baris/row ke-5 image-->
                    <h2>Manuver Pembebasan Installasi</h2>
                    <div class="row">
                            <div class="col-6" style="border:1px solid">
                                <div class="form-group ml-2">
                                    <img src="img/<?= $data["foto"];?>" id="output1" height="auto" width="780px" style="padding-top:.50rem;padding-right:.50rem"><br>
                                    <input type="file" accept="image/*" onchange="loadFile1(event)" name="foto" >
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
                        <h2>Manuver Penormalan Installasi</h2>
                        <div class="row">
                                <div class="col" style="border:1px solid">
                                    <div class="form-group ml-2">
                                        <img id="output2" height="auto" width="780px" style="padding-top:.50rem;padding-right:.50rem"><br>
                                        <input type="file" accept="image/*" onchange="loadFile2(event)" name="foto2" >
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
                            <textarea name="" id="" cols="90" rows="5"></textarea>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <textarea name="" id="" cols="90" rows="5"></textarea>
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
     //--table-jquery--//
            $(document).ready(function(){
                //---table_add/remove_dynamic 1---//
                    var i=0;
                    $('#add1').click(function(){
                        i++;
                        $('#table1').append('<tr><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td></tr>');
                    });

                    $('#remove1').on("click", function(){
                        $('#table1 tr:last').remove();
                    });

                //---table_add/remove_dynamic 2---//

                    var j=0;
                    $('#add2').click(function (){
                        j++;
                        $('#table2').append('<tr><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td></tr>'); 
                    });

                    $('#remove2').on("click", function(){
                        $('#table2 tr:last').remove();
                    });

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
                        $('#dynamic_field1').append('<tr id="row'+k+'"><td class="cont-item" style="width:16px">'+k+'</td><td><input type="text" name="lokasi[]" style="width:50px; padding:0px;"></td><td><input type="text" name="jam1[]" style="width:3rem;padding:0rem;"></td><td><input type="text" name="jam2[]" style="width:3rem;padding:0rem;"></td><td><input type="text" name="jam3[]" style="width:3rem;padding:0rem;"></td><td><input type="text" name="install[]" style="width:8rem;padding:0rem;"></td><td><button type="button" name="remove" id="'+k+'" class="btn btn-danger btn_remove">X</button></td></tr>');
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
                            $('#dynamic_field2').append('<tr id="row1'+l+'"><td class="cont-item" style="width:16px">'+l+'</td><td><input type="text" name="lokasi[]" style="width:50px; padding:0px;"></td><td><input type="text" name="jam1[]" style="width:3rem;padding:0rem;"></td><td><input type="text" name="jam2[]" style="width:3rem;padding:0rem;"></td><td><input type="text" name="jam3[]" style="width:3rem;padding:0rem;"></td><td><input type="text" name="install[]" style="width:8rem;padding:0rem;"></td><td><button type="button" name="remove" id="'+l+'" class="btn btn-danger btn_remove2">X</button></td></tr>');
                        });

                        $(document).on('click', '.btn_remove2', function(){ 
                            l-=1; 
                            var button_id1 = $(this).attr("id");   
                            $('#row1'+button_id1+'').remove();  
                            UpdateIndex1();
                        }); 
            });

            
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