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

        case 'list_pekerjaan2';
        include 'list_pekerjaan2.php';
        break;

        case 'show_detail';
        include 'show_detail.php';
        break;

        case 'initiatorInbox';
        include 'initiatorInbox.php';
        break;
        
        case 'updateForm-1';
        include 'initiator-updateForm1.php';
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

        
        
    }
}
else
{
    ?>
    User Level <?= $_SESSION['level']; ?> <br> Nama User: <?= $_SESSION['username']; 
}
?>

