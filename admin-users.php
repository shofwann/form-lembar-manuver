<?php
if (!isset($_SESSION["username"])) {
	echo "<script>Anda Belum Login</script>";
  header("location:index.php");
	exit;
}

require "functions.php";

if( isset($_POST["submit"]) ){

    if( tambahUser($_POST) > 0){
        //var_dump(tambah($_POST)); die;
        echo "<script>
                alert('data berhasil disubmit'); 
                document.location.href = 'admin-dashboard.php?url=users';
                </script>
                ";  
                
    } else {
       // var_dump(tambah($_POST)); die;
        echo "<script>
                alert('data gagal disubmit'); 
                document.location.href = 'admin-dashboard.php?url=users';
                </script>
                "; die;
                
    }
}

$sql = mysqli_query($conn,"SELECT * FROM db_user ORDER By id DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:16.60,16.60i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</head>
<body id="page-top"> <br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
                Nama User
        </div>
        <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>nama</td>
                <td>:</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>level</td>
                <td>:</td>
                <td>
                    <select name="level" id="">
                        <option value="">-pilih-</option>
                        <option value="admin">Admin</option>
                        <option value="initiator">Initiator</option>
                        <option value="amn">AMN</option>
                        <option value="msb">MSB</option>
                        <option value="dispa">Dispa</option>
                        <option value="amn_dispa">Amn Dispa</option>
                        <option value="plh_amn">PLH AMN</option>
                        <option value="plh_msb">PLH MSB</option>
                        <option value="plh_amndispa">PLH AMN Dispa</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="3"><button type="submit" name="submit">Tambah</button></td>
            </tr>
        </table>
    </form>

    <table class="table-bordered">
        
        <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2" style="width: 100px;">Nama</th>
            <th rowspan="2"style="width: 100px;">Level</th>
            <th colspan="2">Action</th>
        </tr>
        <tr>
            <th>Ubah</th>
            <th>Hapus</th>
        </tr>
        
        <?php $no=1; ?>
        <?php if(mysqli_num_rows($sql) > 0) { ?>
            <?php while($data = mysqli_fetch_assoc($sql)) { ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $data["username"]; ?></td>
                    <td><?= $data["level"]; ?></td>
                    <td><a href="?url=userUbah&id=<?= $data["id"]; ?>"><i class="fas fa-pencil-alt"></i></a></td>
                    <td><a href="?url=hapus&id=<?= $data["id"]; ?>" onclick="return confirm('Apakah anda yakin menghapus <?= $data['username']; ?>?')"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
                <?php $no++; ?>
            <?php } ?>
        <?php } ?>
        
    </table>

        </div>

   
    
    </div>
    
</body>
</html>