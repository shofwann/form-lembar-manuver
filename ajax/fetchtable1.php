<?php
include '../functions.php';

$idnya = $_POST["idx"];
$idnya = trim($idnya);

?>

 <div class="row" id="">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr id="tableHead">
                                        <th>Lokasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $query = "SELECT * FROM db_ajax_table1 WHERE id_detail_lokasi='{$idnya}'";
                                $result = mysqli_query($conn,$query);
                                while ($data = mysqli_fetch_assoc($result)){
                                ?>
                                <tbody id="tableBody1">
                                    <tr>
                                        <td><input type="text" name="lokasi1[]" value="<?= $data['lokasi']; ?>"></td>
                                        <td><button type="button" class="btn btn-danger" onclick="hapus1(this)">x</button><input type="text" name="id1[]" value="<?= $data['id']; ?>" hidden></td>
                                    </tr>
                                </tbody>
                                <?php } ?>
                                <tfoot id="tableBody1n">

                                </tfoot>
                            </table>
                                <button type="button" id="add1" class="btn btn-success" onclick="tambah1()">+</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lokasi</th>
                                        <th>Installasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php $i=1; ?>
                                <?php
                                $query2 = "SELECT * FROM db_ajax_table2 WHERE id_detail_lokasi='{$idnya}'";
                                $result2 = mysqli_query($conn,$query2);
                                while ($data2 = mysqli_fetch_assoc($result2)){
                                ?>
                                <tbody id="tableBody2">
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><input type="text" name="lokasi2[]" value="<?= $data2['lokasi']; ?>" style="width:60px;"></td>
                                        <td><input type="text" name="installasi2[]" value="<?= $data2['installasi']; ?>"></td>
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick="hapus2(this)">x</button>
                                            <input type="text" name="id2[]" value="<?= $data2['id']; ?>" hidden>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php  $i++; ?>
                                <?php } ?>
                                <tfoot id="tableBody2n">

                                </tfoot>
                            </table>
                                <button type="button" id="add2" class="btn btn-success" onclick="tambah2()">+</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lokasi</th>
                                        <th>Installasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php $j=1; ?>
                                <?php
                                $query3 = "SELECT * FROM db_ajax_table3 WHERE id_detail_lokasi='{$idnya}'";
                                $result3 = mysqli_query($conn,$query3);
                                while ($data3 = mysqli_fetch_assoc($result3)){
                                ?>
                                <tbody id="tableBody3">
                                    <tr>
                                        <td><?= $j; ?></td>
                                        <td><input type="text" name="lokasi3[]" value="<?= $data3['lokasi']; ?>" style="width:60px;"></td>
                                        <td><input type="text" name="installasi3[]"value="<?= $data3['installasi']; ?>"></td>
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick="hapus3(this)">x</button>
                                            <input type="text" name="id3[]" value="<?= $data3['id']; ?>" hidden></td>
                                    </tr>   
                                </tbody>
                                <?php  $j++; ?>
                                <?php } ?>
                                <tfoot id="tableBody3n">

                                </tfoot>
                            </table>
                                <button type="button" id="add3" class="btn btn-success" onclick="tambah3()">+</button> 
                        </div>
                    </div>

                </div>
<script>
    
    
</script>

