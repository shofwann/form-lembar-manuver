<?php
require 'functions.php';
$sql_manuver=mysqli_query($conn,"SELECT * FROM db_table_1 WHERE id_form='$_GET[id]'"); //table1
$sql_manuver2=mysqli_query($conn,"SELECT * FROM db_table_1 WHERE id_form='$_GET[id]'"); //table2
$tahapan_pembebasan=mysqli_query($conn,"SELECT * FROM db_table_3 WHERE id_form='$_GET[id]'"); //table3
$tahapan_penormalan=mysqli_query($conn,"SELECT * FROM db_table_4 WHERE id_form='$_GET[id]'"); //table4



$sql=mysqli_query($conn,"SELECT * FROM db_form WHERE id='$_GET[id]'");
$data=mysqli_fetch_assoc($sql);
if ($sql){


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
                    <div class="row">
                        <div class="col-2">
                            <label for="id" class="control-label">id</label>
                            <input type="text" name="id" id="id" class="form-control" value="<?= $data["id"]; ?>" readonly>
                        </div>  

                        <div class="col-2">
                            <label>Create Date:</label>
                            <input type="text" name="create_date" value="<?php echo date('d-M-Y');?>" class="form-control">
                        </div>

                        <div class="col-2">
                            <label>User :</label>
                            <input type="text" name="user" placeholder="" value="<?php echo $_SESSION['username'];?>" class="form-control">
                        </div>

                        <div class="col-2">
                                    <label for="fotoLama" class="control-label">fotolama 1</label>
                                    <input type="text" name="fotoLama" id="fotoLama" class="form-control" value="<?= $data["foto"]; ?>" readonly> <!--untuk menyimpan foto lama, jika user tidak ganti foto maka foto ini yg digunakan-->
                        </div> 
                        <div class="col-2">
                                    <label for="fotoLama" class="control-label">fotolama 2</label>
                                    <input type="text" name="fotoLama" id="fotoLama" class="form-control" value="<?= $data["foto2"]; ?>" readonly> <!--untuk menyimpan foto lama, jika user tidak ganti foto maka foto ini yg digunakan-->
                        </div> 
                    </div>


                <!-- Baris/row Ke-1-->
                    <div class="row">
                        
                        <div class="col-4">
                            <label>Pekerjaan :</label>
                            <input type="text" name="pekerjaan" placeholder="" value="<?= $data["pekerjaan"]; ?>" class="form-control">
                        </div>

                        <div class="col">
                            <label>Mulai</label>
                            <div class="col-0">
                            <input type="datetime" name="start_date" value="<?= $data["start_date"];?>">
                            </div>
                        </div>

                        <div class="col">
                            <label>Target</label>
                            <div class="col-0">
                            <input type="datetime" name="end_date" value="<?= $data["end_date"];?>">
                            </div>
                        </div>
                        <div class="col">
                                <label for="report_date">Req Date Received</label>
                                <div class="col-0">
                                <input type="datetime" name="report_date" id="report_date" class="form-control" value="<?= $data["report_date"]; ?>" >
                                </div>
                        </div>

                    </div>

                <!-- Baris/row Ke-2-->
                    <div class="row">
                        <div class="col">
                            <br>
                            <label>Lokasi :</label>
                            <input type="text" value="<?= $data["lokasi"]; ?>" name="lokasi" class="form-control" placeholder="">
                        </div>

                        <div class="col">
                            <br>
                            <label>Waktu Permintaan Diterima :</label>
                            <input type="date" value="<?= $data["waktu"]; ?>" name="req" class="form-control" placeholder="">
                        </div>

                        <div class="col">
                            <br>
                            <label>Installasi :</label>
                            <input type="text" value="<?= $data["installasi"]; ?>" name="instal" class="form-control" placeholder="">
                        </div>


                    </div>

                

                
                <!-- Baris/row ke-3-->
                    <br>
                    <div class="row"> 
                        
                        <div col="col-7">
                            <div class="table-responsive ml-2">
                            <h4 style="text-align:center;">Manuver Pembebasan Instalasi</h4>  
                               <table class="table table-bordered"> 
                                    <thead>
                                        <tr style="background-color:#F2F4F4;">  
                                            <th style="width:158px;">Lokasi</th>
                                            <th style="width:158px;">Peng. Pekerjaan</th>
                                            <th style="width:158px;">Peng. Manuver</th>
                                            <th style="width:158px;">Peng. K3</th>
                                            <th style="width:158px;">Spv GITET</th>
                                            <th style="width:158px;">Opr GITET</th>
                                        </tr> 
                                    </thead> 
                                    <tbody id="table1">
                                        <?php while ($manuverBebas = mysqli_fetch_array($sql_manuver)) { ?>
                                                <tr>
                                                    <td><input type="text" value="<?= $manuverBebas["lokasi"]  ?>" style="border:1px solid #fff;width:100px;"><input type="text" value="<?= $manuverBebas["id"]  ?>" style="border:1px solid #fff;width:50px;" ></td>
                                                    <td><?= $manuverBebas["pengawas_pekerjaan"]  ?></td>
                                                    <td><?= $manuverBebas["pengawas_manuver"]  ?></td>
                                                    <td><?= $manuverBebas["pengawas_manuver"]  ?></td>
                                                    <td><?= $manuverBebas["spv_gitet"]  ?></td>
                                                    <td><?= $manuverBebas["opr_gitet"]  ?></td>
                                                </tr>
                                        <?php } ?> 
                                    
                                    </tbody>
                               </table> 
                                <button type="button" id="add1" class="btn btn-success">+</button>
                                <button type="button" id="remove1" class="btn btn-danger">-</button>   
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
                                    <?php while ($manuverBebas1 = mysqli_fetch_array($sql_manuver2)) { ?>
                                                <tr  style="height:53px;">
                                                    <td><?= $manuverBebas1["spv_gitet_normal"]  ?></td>
                                                    <td><?= $manuverBebas1["opr_gitet_normal"]  ?></td>
                                                </tr>
                                        <?php } ?> 
                                    
                                    
                                    </tbody>
                                        
                                        
                                </table> 
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
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem" >
                            <input type="text" style="border:1px solid #fff;" readonly>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text" style="border:1px solid #fff;" readonly>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text" style="border:1px solid #fff;" readonly>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text" style="border:1px solid #fff;" readonly>
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
                            <input type="text" style="border:1px solid #fff;" readonly>
                        </div>
                        <div class="col" style="border:1px solid;padding-top:.50rem;padding-bottom:.50rem">
                            <input type="text" style="border:1px solid #fff;" readonly>
                        </div>
                        
                    </div>
                <!-- Baris/row ke-5 image-->
                    <h2>Manuver Pembebasan Installasi</h2>
                    <div class="row">
                            <div class="col-6" style="border:1px solid">
                                <div class="form-group ml-2">
                                    <img src="img/<?= $data["foto"];?>" id="output1" height="auto" width="780px" style="padding-top:.50rem;padding-right:.50rem"><br>
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
                                        <?php $i=1; ?>
                                        <?php while ($pembebasan = mysqli_fetch_assoc($tahapan_pembebasan) ) : ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><input type="text" value="<?= $pembebasan["lokasi"] ?>" style="width:8rem;padding:0rem;"></td>
                                            <td><?= $pembebasan["remote"] ?></td>
                                            <td><?= $pembebasan["real"] ?></td>
                                            <td><?= $pembebasan["ads"] ?></td>
                                            <td><input type="text" value="<?= $pembebasan["installasi"] ?>" style="width:8rem;padding:0rem;"></td>
                                            <td>
                                                <button type="button" onclick="hapus_baris1(this)" class="btn btn-danger btn_remove">X</button>
                                                <input type="text" name="id[]" value="<?= $pembebasan["id"] ?>">
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                        <?php endwhile; ?>
                                    </table>
                                </div>
                            </div>
                    </div>
                <!-- Baris/row ke-6 image-->
                        <h2>Manuver Penormalan Installasi</h2>
                        <div class="row">
                                <div class="col-6" style="border:1px solid">
                                    <div class="form-group ml-2">
                                        <img src="img/<?= $data["foto2"];?>" id="output2" height="auto" width="780px" style="padding-top:.50rem;padding-right:.50rem"><br>
                                        <input type="file" accept="image/*" onchange="loadFile2(event)" name="foto2" required="required">
                                    </div>
                                </div>
                                <div class="col-6" style="border:1px solid">
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
                                            <?php $i=1; ?>
                                            <?php while ($penormalan = mysqli_fetch_assoc($tahapan_penormalan) ) : ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><input type="text" value="<?= $penormalan["lokasi"] ?>" style="width:8rem;padding:0rem;"></td>
                                                <td><?= $penormalan["remote"] ?></td>
                                                <td><?= $penormalan["real"] ?></td>
                                                <td><?= $penormalan["ads"] ?></td>
                                                <td><input type="text" value="<?= $penormalan["installasi"] ?>" style="width:8rem;padding:0rem;"></td>
                                                <td>
                                                    <button type="button" onclick="hapus_baris2(this)" class="btn btn-danger btn_remove">X</button>
                                                    <input type="text" name="id[]" value="<?= $penormalan["id"] ?>">
                                                </td>
                                            </tr>
                                            <?php $i++ ?>
                                            <?php endwhile; ?>
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
                        <div class="form-group col-sm-1 ml-2">
                            <input type="submit" value="Rubah" class="btn btn-primary">
                        </div>
                    </div>
            </form>
            <?php  } ?>
        </div>
    </div>
    
      
    <script type="text/javascript">
    function hapus_baris1(tombol) {
        baris = tombol.parentElement.parentElement
        if (baris.children[])
        
    }

    

    
   

     //--table-jquery--//
            $(document).ready(function(){
                //---table_add/remove_dynamic 1---//
                    var i=0;
                    $('#add1').click(function(){
                        i++;
                        $('#table1').append('<tr><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td></tr>');
                        $('#table2').append('<tr><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td><td><input type="text" style="width:116.6px;border:1px solid #fff;"></td></tr>');
                    });

                    $('#remove1').on("click", function(){
                        $('#table1 tr:last').remove();
                        $('#table2 tr:last').remove();
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
                        $('#dynamic_field1').append('<tr id="row'+k+'"><td class="cont-item" style="width:16px">'+k+'</td><td><input type="text" name="lokasi[]" style="width:50px; padding:0px;"></td><td><input type="text" name="jam1[]" style="width:3rem;padding:0rem;"></td><td><input type="text" name="jam2[]" style="width:3rem;padding:0rem;"></td><td><input type="text" name="jam3[]" style="width:3rem;padding:0rem;"></td><td><input type="text" name="install[]" style="width:8rem;padding:0rem;"></td><td><button type="button" name="remove" id="'+k+'" class="btn btn-danger btn_remove">X</button><input type="text" name="id[]" value="0"></td></tr>');
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