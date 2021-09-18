<?php
session_start();
require "../functions.php";
$keyword = $_GET["keyword"];
$query = "SELECT * FROM db_form WHERE user_amn = '$_SESSION[username]' AND (pekerjaan LIKE '%$keyword%' OR date LIKE '%$keyword%' OR lokasi LIKE '%$keyword%')";
$folder = query($query);




 

?>

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th rowspan="2" style="width:5%">No</th>
                    <th rowspan="2" style="width:20%">Pekerjaan</th>
                    <th rowspan="2">waktu</th>
                    <th rowspan="2">lokasi</th>
                    <th colspan="2">Status Aproval</th>
                    <th rowspan="2">Details</th>
                    </tr>
                    <tr>
                    <th>AMN</th>
                    <th>MSB</th>
                    </tr>
                </thead>
                <?php $no=1; ?>
                <?php foreach ( $folder as $data) : ?>
                <tbody>
                    <tr>
                    <td><?= $no+$awalData?></td>
                    <td><?= $data['pekerjaan'];?></td>
                    <td><?= $data['date'];?></td>
                    <td><?= $data['lokasi'];?></td>
                    <td><?= $no+$awalData?></td>
                    <td><?= $data['pekerjaan'];?></td>
                    <td><?= date("d F Y", strtotime($data['date']));?></td>
                    <td><?= $data['lokasi'];?></td>
                    <td><?php if($data['amn'] == "approve") {
                                echo "<a href='#' class='btn btn-success btn-icon-split' data-toggle='tooltip' data-placement='left' title='approve'><span class='icon text-white-50'><i class='fas fa-thumbs-up'></i></span></a>";
                            }elseif ($data['amn'] == "disapprove") {
                                echo "<a href='#' class='btn btn-danger btn-icon-split' data-toggle='tooltip' data-placement='left' title='disapprove'><span class='icon text-white-50'><i class='fas fa-thumbs-down'></i></span></a>";
                            }else{
                                echo "<a href='#' class='btn btn-warning btn-icon-split' data-toggle='tooltip' data-placement='left' title='pending'><span class='icon text-white-50'><i class='fas fa-spinner'></i></span></a>";
                            }?>
                            
                    </td>
                    <td><?php if($data['msb'] == "approve") {
                                echo "<a href='#' class='btn btn-success btn-icon-split' data-toggle='tooltip' data-placement='left' title='approve'><span class='icon text-white-50'><i class='fas fa-thumbs-up'></i></span></a>";
                            }elseif ($data['msb'] == "disapprove") {
                                echo "<a href='#' class='btn btn-danger btn-icon-split' data-toggle='tooltip' data-placement='left' title='disapprove'><span class='icon text-white-50'><i class='fas fa-thumbs-down'></i></span></a>";
                            }else{
                                echo "<a href='#' class='btn btn-warning btn-icon-split' data-toggle='tooltip' data-placement='left' title='pending'><span class='icon text-white-50'><i class='fas fa-spinner'></i></span></a>";
                            }?>
                            

                    </td>
                    <td>
                        <a href="?url=show_detail&id=<?= $data['id_new'];?>" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                            <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">details</span>
                        </a>
                    </td>
                    </tr>
                </tbody>
                <?php $no++ ?>
                <?php endforeach; ?>
            </table>
           


           