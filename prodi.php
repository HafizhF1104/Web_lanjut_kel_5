<h2>Data Prodi</h2>
<table id="example" class="display">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Prodi</th>
            <th>Jenjang</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include 'admin/koneksi.php';
            $stmt = $db->query("SELECT * FROM prodi");
            $no=1;
            while ($data_prodi = $stmt->fetch(PDO::FETCH_ASSOC)){
            
        ?>
        <tr>
            <td><?= $no++?> </td>
            <td><?= $data_prodi['nama_prodi']?> </td>
            <td><?= $data_prodi['jenjang_prodi']?> </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>