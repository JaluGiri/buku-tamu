<!-- data users search -->
<?php

if(isset($_POST['neang'])) {
    include "connection.php";
    $no = 1;
    $search = $_POST['neang'];
    $pengguna = mysqli_query($conn, "SELECT * FROM tujuan WHERE bagiann LIKE '%".$search."%' OR namaa LIKE '%".$search."%' OR emailtujuan LIKE '%".$search."%' ");
    while ($row = mysqli_fetch_assoc($tujuan)) {

?>
<tr>
        <th scope="row"><?= $no++; ?></th>
        <td><?= $row['namaa']?></td>
        <td><?= $row['bagiann']?></td>
        <td><?= $row['emailtujuan']?></td>
        <td>
        <div align="center">
    <a href="editusers.php?id=<?= $row['id']?>">Ubah</a><br>
    <a href="deleteemailtuj.php?id=<?= $row['id']?>">Hapus</a>
    </div>
    </td>
</tr>

<?php }} ?>