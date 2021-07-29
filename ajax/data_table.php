<?php
require "../functions.php";
$keyword = $_GET["keyword"];
$query = "SELECT * FROM db_form WHERE pekerjaan LIKE '%$keyword%' OR start_date LIKE '%$keyword%' OR lokasi LIKE '%$keyword%'";
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
                    <td><?= $data['waktu'];?></td>
                    <td><?= $data['lokasi'];?></td>
                    <td><?= $data['amn'] == "disapprove" ? "<a href='#' class='btn btn-danger btn-icon-split'><span class='icon text-white-50'><i class='fas fa-thumbs-down'></i></span></a>" : "<a href='#' class='btn btn-success btn-icon-split'><span class='icon text-white-50'><i class='fas fa-thumbs-up'></i></span></a>";?></td>
                    <td><?= $data['msb'] == "disapprove" ? "<a href='#' class='btn btn-danger btn-icon-split'><span class='icon text-white-50'><i class='fas fa-thumbs-down'></i></span></a>" : "<a href='#' class='btn btn-success btn-icon-split'><span class='icon text-white-50'><i class='fas fa-thumbs-up'></i></span></a>";?></td>
                    <td>
                        <a href="?url=show_detail&id=<?= $data['id'];?>" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                            <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">detail</span>
                        </a>
                    </tr>
                </tbody>
                <?php $no++ ?>
                <?php endforeach; ?>
            </table>
           


           