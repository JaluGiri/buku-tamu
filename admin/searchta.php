<!-- data tamu search -->
<?php

if(isset($_POST['cari'])) {
    include "connection.php";
    $no = 1;
    $cari = $_POST['cari'];
    $tamu = mysqli_query($conn, "SELECT * FROM tamu WHERE nama LIKE '%".$cari."%' OR alamat LIKE '%".$cari."%' OR notelp LIKE '%".$cari."%' OR kepada LIKE '%".$cari."%' OR jam LIKE '%".$cari."%'");
    while ($row = mysqli_fetch_assoc($tamu)) {

?>

<tr>
    <th scope="row"><?= $no++; ?></th>
    <!-- <td><?= $row['id']?></td> -->
    <td><?= $row['nama']?></td>
    <td><?= $row['alamat']?></td>
    <td><?= $row['notelp']?></td>
    <td><?= $row['pesan']?></td>
    <td><?= $row['kepada']?></td>
    <td><?= $row['jam']?></td>
    <td><?= $row['keperluan']?></td>
    <td>
    <div align="center">
    <a href="edittamu.php?id=<?= $row['id']?>">Ubah</a><br>
    <a href="deletetamu.php?id=<?= $row['id']?>">Hapus</a>
    </div>
    </td>
</tr>

<?php }} ?>


