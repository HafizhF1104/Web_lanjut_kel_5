<?php 
include 'koneksi.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch($aksi){
    case 'list': 
    ?>
    
    <div class="row-mb-5">
        <div class="card-header">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <h1 class="h2">User</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="col-2 mb-3">
                <a href="index.php?p=user&aksi=input" class="btn btn-primary"><i class="bi bi-person-plus"></i> Tambah User</a>
            </div>
            <div class="table-responsive small">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>No Telp</th>
                            <th>Alamat</th>
                            <th>Photo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $db->query("SELECT * FROM level INNER JOIN user ON level.id=user.level_id");
                        $no = 1;
                        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($data['nama_lengkap']) ?></td>
                            <td><?= htmlspecialchars($data['email']) ?></td>
                            <td><?= htmlspecialchars($data['nama_level']) ?></td>
                            <td><?= htmlspecialchars($data['notelp']) ?></td>
                            <td><?= htmlspecialchars($data['alamat']) ?></td>
                            <td><?= htmlspecialchars($data['photo']) ?></td>
                            <td>
                                <a href="index.php?p=user&aksi=edit&id=<?= $data['id'] ?>" class="btn btn-success"><i class="bi bi-pencil"></i> Edit</a>
                                <a href="proses_user.php?proses=delete&id=<?= $data['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')"><i class="bi bi-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Input User</h1>
        </div>
        <div class="col-6 mx-auto">
            <br>
            <form action="proses_user.php?proses=insert" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="mb-3">
                    <label class="form-label">Level</label>
                    <select class="form-control" name="level_id">
                        <option selected>-Pilih Level-</option>
                        <?php
                        $stmt = $db->query("SELECT * FROM level");
                        while ($data_level = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=" . $data_level['id'] . ">" . htmlspecialchars($data_level['nama_level']) . "</option>";
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
                    <label class="form-label">Photo</label>
                    <input type="file" class="form-control" name="photo">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <button type="reset" class="btn btn-warning" name="reset">Reset</button>
                </div>
                <hr>
            </form>
        </div>
    </div>
    <?php
    break;

    case 'edit':
        $stmt = $db->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        $data_user = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="row-mb-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit User</h1>
        </div>
            <div class="col-6 mx-auto">
                <br>
                
                <form action="proses_user.php?proses=edit" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="hidden" class="form-control" name="id" value="<?=$data_user['id'] ?>">
                    <input type="text" class="form-control" name="nama" value="<?=$data_user['nama_lengkap']?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?=$data_user['email']?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" value="<?=$data_user['password']?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Level</label>
                    <select select class="form-control" name="level_id">
                        <option selected>-Pilih Level-</option>
                        <?php
                            $stmt = $db->query("SELECT * FROM level");
                            while ($data_level = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $selected=($data_level['id']==$data_user['level_id']) ? 'selected':''; //ternary
                                echo "<option value=" . $data_level['id'] . " $selected>" . htmlspecialchars($data_level['nama_level']) . "</option>";
                            }
                        ?>
                    </select> 
                </div>
                <div class="mb-3">
                    <label class="form-label">No Telp</label>
                    <input type="number" class="form-control" name="notelp" value="<?=$data_user['notelp']?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" >Alamat</label>
                    <textarea class="form-control"  rows="3" name="alamat"><?= htmlspecialchars($data_user['alamat']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Photo</label>
                    <input type="file" class="form-control" name="photo" value="<?=$data_user['photo']?>">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                   
                </div>
                <hr>
                </form>
            </div>
        </div>
    <?php 
break;
}

    