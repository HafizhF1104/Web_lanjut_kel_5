<h2>Data Dosen</h2>
<table id="example" class="display">
    <thead>
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama Dosen</th>
            <th>Email</th>
            <th>Prodi</th>
            <th>No Telp</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include 'admin/koneksi.php';
            $stmt = $db->query("SELECT * FROM prodi INNER JOIN dosen ON prodi.id=dosen.prodi_id");
            $no=1;
            while ($data_dosen = $stmt->fetch(PDO::FETCH_ASSOC)){

            
        ?>
        <tr>
            <td><?= $no++?> </td>
            <td><?= $data_dosen['nip']?> </td>
            <td><?= $data_dosen['nama_dosen']?> </td>
            <td><?= $data_dosen['email']?> </td>
            <td><?= $data_dosen['nama_prodi']?> </td>
            <td><?= $data_dosen['notelp']?> </td>
            <td><?= $data_dosen['alamat']?> </td>

        </tr>
        <?php
            }
        ?>
    </tbody>
</table>