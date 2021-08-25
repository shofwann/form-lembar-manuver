<?php


if (isset($_GET['url']))
{
    $url=$_GET['url'];

    switch($url)
    {
        case'form-1';
        include "form-1.php";
        break;

        case'listManuverDispa';
        include 'listManuverDispa.php';
        break;

        case 'list_pekerjaan';
        include 'list_pekerjaan2.php';
        break;

        case 'show_detail';
        include 'show_detail.php';
        break;

        case 'initiatorInbox';
        include 'initiator-Inbox.php';
        break;
        
        case 'updateForm-1';
        include 'initiator-updateForm1.php';
        break;

        case 'insertDB';
        include 'initiator-insertDB.php';
        break;

        case 'updateDB';
        include 'initiator-updateDB.php';
        break;

        case 'amnInbox';
        include 'amn-inbox.php';
        break;

        case 'amnList';
        include 'amn-list.php';
        break;

        case 'amnApprove';
        include 'amn-approve.php';
        break;

        case 'msbInbox';
        include 'msb-inbox.php';
        break;

        case 'msbList';
        include 'msb-list.php';
        break;

        case 'msbApprove';
        include 'msb-approve.php';
        break;

        case 'dispaInbox';
        include 'dispa-inbox.php';
        break;

        case 'dispaInputAwal';
        include 'dispa-inputAwal.php';
        break;

        case 'dispaInputAkhir';
        include 'dispa-inputAkhir.php';
        break;

        case 'dispaList';
        include 'dispa-list.php';
        break;

        case 'tes';
        include 'tes.php';
        break;

        case 'trial';
        include 'auto.php';
        break;

        case 'autoForm1';
        include 'auto-form1.php';
        break;

        case 'autoForm2';
        include 'auto-form2.php';
        break;

        case 'amnDispaInbox';
        include 'dispa-amn-inbox.php';
        break;

        case 'amnDispaList';
        include 'dispa-amn-list.php';
        break;

        case 'amnApproveAwal';
        include 'dispa-amn-approve-awal.php';
        break;

        case 'amnApproveAkhir';
        include 'dispa-amn-approve-akhir.php';
        break;

        case 'dispaUpdateAwal';
        include 'dispa-update-awal.php';
        break;

        case 'dispaUpdateAkhir';
        include 'dispa-update-akhir.php';
        break;


        


        


        
        
    }
}
else
{
    ?>
    User Level <?= $_SESSION['level']; ?> <br> Nama User: <?= $_SESSION['username']; 
}
?>

