<?php
    require 'pdf/fpdf.php';

    require 'functions.php';
    $query=mysqli_query($conn,"SELECT * FROM db_form WHERE id='$_GET[id]'");
    $data=mysqli_fetch_assoc($query);

    

    $pdf = new fpdf('L','mm','A4');

    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(130,0,'Pedoman Manuvar Untuk Pemeliharaan/Perbaikan/Perluasan Instalasi/ Pengaturan Tegangan',0,1);
    $pdf->Cell(59,5,'',0,1);

    $pdf->SetFont('Times','B','10');
    $pdf->Cell(16,5,'Pekerjaan','T,L',0);
    $pdf->Cell(2,5,':','T',0);
    $pdf->SetFont('Times','','10');
    $pdf->Cell(114,5,$data['pekerjaan'],'T,R',0);
    $pdf->SetFont('Times','B','10');
    $pdf->Cell(90,5,'Manuver Pembebasan','T,R',0,'C');
    $pdf->Cell(60,5,'Manuver Penormalan','T,R',1,'C');
    $pdf->Cell(132,5,'','L',0);
    $pdf->Cell(40,5,'','L',0,'');

    $rencana = $_GET['jumlah'];
    if ($rencana == 2){
        $a = 22.5;
        $b = 30;
        $c = '           .....                         .....            ';
        $d = '           .....                         .....            ';
    } elseif ($rencana == 3){
        $a = 15;
        $b = 20;
        $c = '           .....           .....            .....';
        $d = '        .....                .....                  .....';
    }
    //$a = 22.5;15 untuk 3 GITET, 22.5 untuk 2 GITET
    //$b= 30;  20 untuk 3 GITET, 30 untuk 2 GITET 
    $query2 = mysqli_query($conn,"SELECT * FROM db_table_1 WHERE id_form='$_GET[id]'");
    while( $data2 = mysqli_fetch_array($query2)) {
        $pdf->Cell($a,5,$data2['lokasi'],'C',0,'');
        
    }

    $pdf->Cell(5,5,'','R',0,'C');
    $query3 = mysqli_query($conn,"SELECT * FROM db_table_1 WHERE id_form='$_GET[id]'");
    while($data3 = mysqli_fetch_array($query3)) {
        $pdf->Cell($b,5,$data3['lokasi'],'',0,'C');
    }
    $pdf->Cell(5,5,'','L',1,'');
    $pdf->Cell(16,5,'Lokasi','L',0);
    $pdf->Cell(2,5,':','',0);
    $pdf->SetFont('Times','','10');
    $pdf->Cell(55,5,$data['lokasi'],'',0);
    $pdf->Cell(20,5,'Installasi','',0);
    $pdf->Cell(2,5,':','',0);
    $pdf->Cell(37,5,$data['installasi'],'R',0,'');
    $pdf->Cell(30,5,'Pengawas Pekerjaan','',0);
    $pdf->Cell(2,5,':','',0);
    $pdf->Cell(58,5,$c,'R',0);
    $pdf->Cell(60,5,$d,'R',1);

    $pdf->SetFont('Times','B','10');
    $pdf->Cell(16,5,'Waktu','L',0);
    $pdf->Cell(2,5,':','',0);
    $pdf->SetFont('Times','','10');
    $pdf->Cell(114,5,$data['waktu'],'R',0);
    $pdf->Cell(30,5,'Pengawas Manuver','',0);
    $pdf->Cell(2,5,':','',0);
    $pdf->Cell(58,5,$c,'R',0);
    $pdf->Cell(60,5,$d,'R',1);
    $pdf->Cell(80,5,'Permintaan Pembebasan Installasi diterima pada pukul :','L',0);
    $pdf->Cell(52,5,$data['report_date'],'R',0,'');
    $pdf->Cell(30,5,'Pengawas K3','',0);
    $pdf->Cell(2,5,':','',0);
    $pdf->Cell(58,5,$c,'R',0);
    $pdf->Cell(60,5,$d,'R',1);

    $pdf->Cell(132,5,'','L,R',0);
    $pdf->Cell(30,5,'Supervisor GITET','',0);
    $pdf->Cell(2,5,':','',0);
    $pdf->Cell(58,5,$c,'R',0);
    $pdf->Cell(60,5,$d,'R',1);

    $pdf->Cell(132,5,'','L,R,B',0);
    $pdf->Cell(30,5,'Operator GITET','B',0);
    $pdf->Cell(2,5,':','B',0);
    $pdf->Cell(58,5,$c,'R,B',0);
    $pdf->Cell(60,5,$d,'R,B',1);
    $pdf->Image('img/'.$data['foto'],10,52,-200);
    
    
    $tahapan_pembebasan=mysqli_query($conn,"SELECT * FROM db_table_3 WHERE id_form='$_GET[id]'");
    $no= 0;
    while($pembebasan = mysqli_fetch_array($tahapan_pembebasan)) {
        $no++;
        $pdf->Ln(5);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(150,5,'',0,0,'C');
        $pdf->Cell(5,5,$no.'.',1,0,'C');
        $pdf->Cell(10,5,$pembebasan['lokasi'],1,0,'C');
        $pdf->Cell(10,5,$pembebasan['remote_bebas'],1,0,'C');
        $pdf->Cell(10,5,$pembebasan['real_bebas'],1,0,'C');
        $pdf->Cell(10,5,$pembebasan['ads_bebas'],1,0,'C');
        $pdf->Cell(10,5,$pembebasan['installasi'],1,0,'C');
    }
    $pdf->output();

//--------------------------DOMPDF-------------------------------------------
// require_once 'dompdf/autoload.inc.php';

// use Dompdf\Dompdf;

// $pdf = new Dompdf();

// ob_start();
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

 
    <style>
        div {
            width: 100px;
            height: 100px;
        }

        .satu {
            background-color: salmon;
            float:left
        }

        .2 {
            background-color: limegreen;
        }

        .3 {
            background-color: lightskyblue;
        }
    </style>
</head>
<body>
    <div class="satu">
        <label for="">Pekerjaan</label>
        <br><br>
        <label for="">Lokasi</label>
        <label for="">Waktu</label>
    </div>
    <div class="satu">2</div>
    <div class="satu">3</div>
    
    
    
    
        

 
</body>
</html> -->



<?php
// $html =ob_get_clean();

// $pdf->loadHTML($html);


// $pdf->setPaper('A4','landscape');

// $pdf->render();

// $pdf->stream('print.pdf', Array('Attachment'=>0));

?>