<?php

$form = $_GET["form"];
$id = $_GET["idz"];


if ($form == 1) {
    echo
    "<script>
    alert('anda memilih form1');
    document.location.href = 'initiator-dashboard.php?url=autoForm1&idz=$id';
    </script>";
    //header("Location:initiator-dashboard.php?url=autoForm1&idz=$id");
}elseif ($form == 2){
    echo "<script>
    alert('anda memilih form2');
    document.location.href = 'initiator-dashboard.php?url=autoForm2&idz=$id';
    </script>";
}

?>

