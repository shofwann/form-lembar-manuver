<?php

include 'functions.php';

$form = $_POST['id'];
$modul = $_POST['modul'];


    $sql = mysqli_query($conn,"SELECT * FROM db_ajax_lokasi WHERE id_lokasi= $form ORDER BY nama ASC") or die(mysqli_error($conn));
    $jenis='<input type="text" placeholder="isi">';
    while ($dt = mysqli_fetch_array($sql)) {
        $jenis.='<input type="text" value="'.$dt['id_lokasi'].'">';
    }

    echo $jenis;





?>