

<?php 
$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
?>

    <div class="row-mb-5">
    <div class="card-header">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <h1 class="h2">Mata Kuliah</h1>
    </div>
</div>

    <div class="card-body">
            <div class="col-2 mb-3">
                <a href="index.php?p=matakuliah&aksi=input" class="btn btn-primary"><i class="bi bi-building-add"></i> Tambah Mata Kuliah</a>
            </div>
            <div class="table-responsive small">
            <table class="table table-bordered" id="table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Mata Kuliah</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Semester</th>
                    <th>Jenis Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Jam</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    include 'koneksi.php';
                    $ambil=mysqli_query($db,"SELECT * FROM matakuliah");
                    $no=1;
                    while($data=mysqli_fetch_array($ambil)){
                ?>
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$data['kode_matakuliah']?></td>
                    <td><?=$data['nama_matakuliah']?></td>
                    <td><?=$data['semester']?></td>
                    <td><?=$data['jenis_matakuliah']?></td>
                    <td><?=$data['sks']?></td>
                    <td><?=$data['jam']?></td>
                    <td><?=$data['keterangan']?></td>
                    <td>
                        <a href="index.php?p=matakuliah&aksi=edit&id=<?=$data['id']?>" class="btn btn-success"><i class="bi bi-pencil"></i> Edit</a>
                        <a href="proses_matakuliah.php?proses=delete&id=<?=$data['id']?>" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')"><i class="bi bi-trash"></i> Delete</a>
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
        <h1 class="h2">Input Mata Kuliah</h1>
        </div>
            <div class="col-6 mx-auto">
                <br>
                <form action="proses_matakuliah.php?proses=insert" method="post">
                <div class="mb-3">
                    <label class="form-label">Kode Mata Kuliah </label>
                    <input type="text" class="form-control" name="kode_matakuliah">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Mata Kuliah </label>
                    <input type="text" class="form-control" name="nama_matakuliah">
                </div>
                <div class="mb-3">
                    <label class="form-label">Semester</label>
                    <input type="number" class="form-control" name="semester">
                </div>
              
                    <div class="mb-3">
                        <label class="form-label">Jenis Mata Kuliah</label>
                        <select select class="form-select" name="jenis_matakuliah">
                            <option selected>~ Pilih Jenis Matkul ~</option>
                            <?php
                                $jenis=['Teori','Praktek'];
                                foreach($jenis as $jenismatkul){
                                    echo "<option value=".$jenismatkul.">".$jenismatkul."</option>";
                                }
                            ?>
                        </select> 
                    </div>

                <div class="mb-3">
                    <label class="form-label">SKS</label>
                    <input type="number" class="form-control" name="sks">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jam</label>
                    <input type="number" class="form-control" name="jam">
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan">
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
        include 'koneksi.php';
        $ambil=mysqli_query($db,"SELECT * FROM matakuliah WHERE id='$_GET[id]'");
        $data_matkul=mysqli_fetch_array($ambil);
?>

        <div class="row-mb-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Mata Kuliah</h1>
        </div>
            <div class="col-6 mx-auto">
                <br>
                
                <form action="proses_matakuliah.php?proses=edit" method="post">
                <div class="mb-3">
                    <label class="form-label">Kode Mata Kuliah</label>
                    <input type="hidden" class="form-control" name="id" value="<?=$data_matkul['id'] ?>">
                    <input type="text" class="form-control" name="kode_matakuliah" value="<?=$data_matkul['kode_matakuliah'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Mata Kuliah</label>
                    <input type="text" class="form-control" name="nama_matakuliah" value="<?=$data_matkul['nama_matakuliah'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Semester</label>
                    <input type="number" class="form-control" name="semester" value="<?=$data_matkul['semester'] ?>">
                </div>
              
                <div class="mb-3">
                    <label class="form-label">Jenis Mata Kuliah</label>
                    <select select class="form-select" name="jenis_matakuliah">
                        <option selected>~ Pilih Jenjang ~</option>
                        <?php
                            $jenis=['Teori','Praktek'];
                            foreach($jenis as $jenismatkul){
                            $selected=($data_matkul['jenis_matakuliah']==$jenismatkul) ? 'selected' : ''; 
                            echo "<option value=".$jenismatkul." $selected>".$jenismatkul."</option>";
                            }
                        ?>
                    </select> 
                </div>

                <div class="mb-3">
                    <label class="form-label">SKS</label>
                    <input type="number" class="form-control" name="sks" value="<?=$data_matkul['sks'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jam</label>
                    <input type="number" class="form-control" name="jam" value="<?=$data_matkul['jam'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan" value="<?=$data_matkul['keterangan'] ?>">
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
        

