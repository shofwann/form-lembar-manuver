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

        
        
    }
}
else
{
    ?>
    selamat datang <?php echo $_SESSION['username'];
}
?>

