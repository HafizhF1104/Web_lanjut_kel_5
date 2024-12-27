
    
    <?php 
    include 'koneksi.php';
    $aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
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
                    
                    $ambil=mysqli_query($db,"SELECT * FROM level INNER JOIN user ON level.id=user.level_id");
                    $no=1;
                    while($data=mysqli_fetch_array($ambil)){
                ?>
                
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$data['nama_lengkap']?></td>
                    <td><?=$data['email']?></td>
                    <td><?=$data['nama_level']?></td>
                    <td><?=$data['notelp']?></td>
                    <td><?=$data['alamat']?></td>
                    <td><?=$data['photo']?></td>
                    <td>
                        <a href="index.php?p=user&aksi=edit&id=<?=$data['id']?>" class="btn btn-success"><i class="bi bi-pencil"></i> Edit</a>
                        <a href="proses_user.php?proses=delete&id=<?=$data['id']?>" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')"><i class="bi bi-trash"></i> Delete</a>
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
                    <select select class="form-control" name="level_id">
                        <option selected>-Pilih Level-</option>
                        <?php
                            $level=mysqli_query($db,"SELECT * FROM level");
                            while ($data_level=mysqli_fetch_array($level)) {
                                echo "<option value=".$data_level['id'].">".$data_level['nama_level']."</option>";
                            }
                        ?>
                    </select> 
                </div>
                <div class="mb-3">
                    <label class="form-label">No Telp</label>
                    <input type="number" class="form-control" name="notelp">
                </div>
                <div class="mb-3">
                    <label class="form-label" >Alamat</label>
                    <textarea class="form-control"  rows="3" name="alamat"></textarea>
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
        
        case 'edit' :
            
            $ambil=mysqli_query($db,"SELECT * FROM user WHERE id='$_GET[id]'");
            $data_user=mysqli_fetch_array($ambil);
    
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
                            $level=mysqli_query($db,"SELECT * FROM level");
                            while ($data_level=mysqli_fetch_array($level)) {
                                $selected=($data_level['id']==$data_user['level_id']) ? 'selected':''; //ternary
                                echo "<option value=".$data_level['id']." $selected>".$data_level['nama_level']."</option>";
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
    ?>
    