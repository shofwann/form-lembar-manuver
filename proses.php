<?php

$form = $_GET["form"];
$kec = $_GET["idz"];


if ($form == 1) {
    echo "<script>
    alert('anda memilih form1');
    document.location.href = 'initiator-dashboard.php?url=autoForm1&kecamatan=$kec';
    </script>";
    // header("Location:initiator-dashboard.php?url=autoForm1&kecamatan=$kec");
}elseif ($form == 2){
    echo "<script>
    alert('anda memilih form2');
    document.location.href = 'initiator-dashboard.php?url=autoForm1&kecamatan=$kec';
    </script>";
}

?>

