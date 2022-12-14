<!-- data users search -->
<?php

if(isset($_POST['search'])) {
    include "connection.php";
    $no = 1;
    $search = $_POST['search'];
    $pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE name LIKE '%".$search."%' OR email LIKE '%".$search."%' ");
    while ($row = mysqli_fetch_assoc($pengguna)) {

?>
<tr>
        <th scope="row"><?= $no++; ?></th>
        <td><?= $row['name']?></td>
        <td><?= $row['email']?></td>
        <td><?= $row['id']?></td>
        <td>
        <div align="center">
    <a href="editusers.php?id=<?= $row['id']?>">Ubah</a><br>
    <a href="deleteusers.php?id=<?= $row['id']?>">Hapus</a>
    </div>
    </td>
</tr>

<?php }} ?>