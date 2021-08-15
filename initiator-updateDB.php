<?php

if (!isset($_SESSION["username"])) {
	echo "<script>Anda Belum Login</script>";
  header("location:index.php");
	exit;
}

include 'functions.php';
if( isset($_POST["submit"]) ){

    if( ubahDB($_POST) > 0){
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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:16.60,16.60i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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


        <form action="" name="" method="post" id="form_id">
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
                        <label for="">Jenis Pekerjaan :</label>
                        <select name="idx" id="jenis">
                            <option value="">-SELECT-</option>
                        </select>
                    </div>

                    <div class="col-3">
                        <label for="">Lokasi :</label>
                        <select name="idy" id="lokasi">
                            <option value="">-SELECT-</option>

                        </select>
                    </div>

                    <div class="col-3">
                        <label for="">Detail Lokasi :</label>
                        <select name="idz" id="detail_lokasi" onChange="pilihan()">
                            <option value="">-SELECT-</option>

                        </select>
                    </div>

                </div>
                <div class="row">
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
                <div class="row" id="table">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr id="tableHead">
                                        <th>Lokasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody1">

                                </tbody>
                            </table>

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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="">

                                </tbody>
                            </table>

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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody3">

                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
                <br><br>

                <div class="row">
                    <br>
                </div>
                <div class="row">
                    <div class="col-10">
                    </div>

                    <div class="col-2">
                        <button type="submit" name="submit">Ubah</button>
                    </div>

                </div>
            </div>

        </form>

    </div>


    <script type="text/javascript">
    $(document).ready(function() {
        $('#form').on('change', function() {
            var form = $(this).val();
            $.ajax({
                url: 'get_data.php',
                type: "POST",
                data: {
                    modul: 'jenis',
                    id: form
                },
                success: function(respond) {
                    $('#jenis').html(respond);
                },
                error: function() {
                    alert('gagal mengambil data');
                }
            })
        })

        $('#jenis').on('change', function() {
            var form = $(this).val();
            $.ajax({
                url: 'get_data.php',
                type: "POST",
                data: {
                    modul: 'lokasi',
                    id: form
                },
                success: function(respond) {
                    $('#lokasi').html(respond);
                },
                error: function() {
                    alert('gagal mengambil data');
                }
            })
        })

        $('#lokasi').on('change', function() {
            var form = $(this).val();
            $.ajax({
                url: 'get_data.php',
                type: "POST",
                data: {
                    modul: 'detail_lokasi',
                    id: form
                },
                success: function(respond) {
                    $('#detail_lokasi').html(respond);
                },
                error: function() {
                    alert('gagal mengambil data');
                }
            })
        })        


    });

    function tambah1() {
        table = document.getElementById('tableBody1n');
        var row = table.insertRow(-1);
        cell1 = row.insertCell(0);
        cell2 = row.insertCell(1);
        cell1.innerHTML = "<input name='lokasi1[]' type='text'>";
        cell2.innerHTML = "<button type='button' onclick='hapus1new(this)' class='btn btn-danger btn_remove'>X</button><input type='text' name='id1[]' value='0'>";
    }

    function hapus1(ini) {
        row = ini.parentElement.parentElement
        if (row.children[1].children[1].value != "0"){
            id_hapus = row.children[1].children[1].cloneNode(true);
            id_hapus.setAttribute("name","id1_hapus[]");
            document.getElementById("form_id").appendChild(id_hapus);
        }
        row.remove();
    }

    function hapus1new(ini) {
        row = ini.parentElement.parentElement
        row.remove();
    }

    no = 1;
    function tambah2() {
        table = document.getElementById('tableBody2n');
        var row = table.insertRow(-1);
        cell1 = row.insertCell(0);
        cell2 = row.insertCell(1);
        cell3 = row.insertCell(2);
        cell4 = row.insertCell(3);
        cell1.innerHTML = no++;
        cell2.innerHTML = "<input name='lokasi2[]' type='text' style='width:60px;'>";
        cell3.innerHTML = "<input name='installasi2[]' type='text'>";
        cell4.innerHTML = "<button type='button' onclick='hapus2new(this)' class='btn btn-danger btn_remove'>X</button><input type='text' name='id2[]' value='0'>"
    }

    function hapus2(ini) {
        row = ini.parentElement.parentElement
        if (row.children[3].children[1].value != "0"){
            id_hapus = row.children[3].children[1].cloneNode(true);
            id_hapus.setAttribute("name","id2_hapus[]");
            document.getElementById("form_id").appendChild(id_hapus);
        }
        row.remove();
    }

    function hapus2new(ini) {
        row = ini.parentElement.parentElement
        row.remove();
    }

    no2 = 1;
    function tambah3() {
        table = document.getElementById('tableBody3n');
        var row = table.insertRow(-1);
        cell1 = row.insertCell(0);
        cell2 = row.insertCell(1);
        cell3 = row.insertCell(2);
        cell4 = row.insertCell(3);
        cell1.innerHTML = no2++;
        cell2.innerHTML = "<input name='lokasi3[]' type='text' style='width:60px;'>";
        cell3.innerHTML = "<input name='installasi3[]' type='text'>";
        cell4.innerHTML = "<button type='button' onclick='hapus3new(this)' class='btn btn-danger btn_remove'>X</button><input type='text' name='id3[]' value='0'>"
    }

    function hapus3(ini) {
        row = ini.parentElement.parentElement
        if (row.children[3].children[1].value != "0"){
            id_hapus = row.children[3].children[1].cloneNode(true);
            id_hapus.setAttribute("name","id3_hapus[]");
            document.getElementById("form_id").appendChild(id_hapus);
        }
        row.remove();
    }

    function hapus3new(ini) {
        row = ini.parentElement.parentElement
        row.remove();
    }

     
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>


    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/shofwan.js"></script>
</body>

</html>