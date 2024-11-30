<?php 
include 'koneksi.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list': 
?>
    <div class="row-mb-5">
        <div class="card-header">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <h1 class="h2">Dosen</h1>
            </div>
        </div>

        <div class="card-body">
            <div class="col-2 mb-3">
                <a href="index.php?p=dosen&aksi=input" class="btn btn-primary"><i class="bi bi-person-plus"></i> Tambah Dosen</a>
            </div>
            <div class="table-responsive small">
                <table class="table table-bordered table-striped" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Dosen</th>
                            <th>Email</th>
                            <th>Prodi</th>
                            <th>No Telp</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        
                        $stmt = $db->prepare("SELECT * FROM prodi INNER JOIN dosen ON prodi.id = dosen.prodi_id");
                        $stmt->execute();
                        $data_dosen = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $no = 1;

                        foreach ($data_dosen as $data) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nip'] ?></td>
                            <td><?= $data['nama_dosen'] ?></td>
                            <td><?= $data['email'] ?></td>
                            <td><?= $data['nama_prodi'] ?></td>
                            <td><?= $data['notelp'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td>
                                <a href="index.php?p=dosen&aksi=edit&id=<?= $data['id'] ?>" class="btn btn-success"><i class="bi bi-pencil"></i> Edit</a>
                                <a href="proses_dosen.php?proses=delete&id=<?= $data['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')"><i class="bi bi-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
    break;

    case 'input':
?>
    <div class="row-mb-5">
    <div class="card-header">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h1 class="h2">Input Dosen</h1>
        </div>
    </div>
    <div class="card-body">
        <div class="col-6 mx-auto">
            <form action="proses_dosen.php?proses=insert" method="post">
                <div class="mb-3">
                    <label class="form-label">NIP</label>
                    <input type="number" class="form-control" name="nip">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Prodi</label>
                    <select class="form-control" name="id_prodi">
                        <option selected>-Pilih Prodi-</option>
                        <?php
                            $stmt = $db->prepare("SELECT * FROM prodi");
                            $stmt->execute();
                            $prodi = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($prodi as $data_prodi) {
                                echo "<option value='".$data_prodi['id']."'>".$data_prodi['nama_prodi']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">No Telp</label>
                    <input type="number" class="form-control" name="notelp">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control" rows="3" name="alamat"></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <button type="reset" class="btn btn-warning" name="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
    </div>
<?php
    break;

    case 'edit':
        $stmt = $db->prepare("SELECT * FROM dosen WHERE id = :id");
        $stmt->execute([':id' => $_GET['id']]);
        $data_dosen = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <div class="row-mb-5">
    <div class="card-header">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h1 class="h2">Edit Dosen</h1>
        </div>
    </div>
    <div class="card-body">
        <div class="col-6 mx-auto">
            <form action="proses_dosen.php?proses=edit" method="post">
                <div class="mb-3">
                    <label class="form-label">NIP</label>
                    <input type="hidden" class="form-control" name="id" value="<?= $data_dosen['id'] ?>">
                    <input type="number" class="form-control" name="nip" value="<?= $data_dosen['nip'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?= $data_dosen['nama_dosen'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= $data_dosen['email'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Prodi</label>
                    <select class="form-control" name="id_prodi">
                        <option selected>-Pilih Prodi-</option>
                        <?php
                            $stmt = $db->prepare("SELECT * FROM prodi");
                            $stmt->execute();
                            $prodi = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($prodi as $data_prodi) {
                                $selected = ($data_prodi['id'] == $data_dosen['prodi_id']) ? 'selected' : '';
                                echo "<option value='".$data_prodi['id']."' $selected>".$data_prodi['nama_prodi']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">No Telp</label>
                    <input type="number" class="form-control" name="notelp" value="<?= $data_dosen['notelp'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control" rows="3" name="alamat"><?= htmlspecialchars($data_dosen['alamat']) ?></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
    </div>
<?php
    break;
}
?>
