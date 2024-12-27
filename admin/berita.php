

<?php 
$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
?>

    <div class="row-mb-5">
    <div class="card-header">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <h1 class="h2">Berita</h1>
    </div>
    </div>

    <div class="card-body">
            <div class="col-2 mb-3">
                <a href="index.php?p=berita&aksi=input" class="btn btn-primary"><i class="bi bi-building-add"></i> Tambah Berita</a>
            </div>
            <div class="table-responsive small">
            <table class="table table-bordered" id="table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>User</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>                   
                </tr>
                </thead>
                <tbody>
                <?php
                    include 'koneksi.php';
                    $ambil=mysqli_query($db,"SELECT * FROM user, kategori, berita WHERE user.id=berita.user_id AND kategori.id=berita.kategori_id");
                    $no=1;
                    while($data=mysqli_fetch_array($ambil)){
                ?>
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$data['judul']?></td>
                    <td><?=$data['nama_kategori']?></td>
                    <td><?=$data['email']?></td>
                    <td><?=$data['created_at']?></td>
                    <td>
                        <a href="index.php?p=berita&aksi=edit&id=<?=$data['id']?>" class="btn btn-success"><i class="bi bi-pencil"></i> Edit</a>
                        <a href="proses_berita.php?proses=delete&id=<?=$data['id']?>&file=<?=$data['file_upload']?>" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')"><i class="bi bi-trash"></i> Delete</a>
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
        <h1 class="h2">Input Berita</h1>
        </div>
            <div class="col-6 mx-auto">
                <br>
                <form action="proses_berita.php?proses=insert" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select select class="form-select" name="kategori_id">
                        <option selected>-Pilih Kategori-</option>
                        <?php
                            include 'koneksi.php';
                            $kategori=mysqli_query($db,"SELECT * FROM kategori");
                            while ($data_kategori=mysqli_fetch_array($kategori)) {
                                echo "<option value=".$data_kategori['id'].">".$data_kategori['nama_kategori']."</option>";
                            }
                        ?>
                    </select> 
                </div>
                <div class="mb-3">
                    <label class="form-label">File Upload</label>
                    <input type="file" class="form-control" name="fileToUpload" id="file-upload">
                </div>

                <div class="mb-4">
                    <img src="#" alt="Preview Uploaded Image" id="file-preview" width="300">
                </div>

                <div class="mb-3">
                    <label class="form-label" >Isi Berita</label>
                    <textarea class="form-control"  rows="10" name="isi_berita"></textarea>
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
        $ambil=mysqli_query($db,"SELECT * FROM berita WHERE id='$_GET[id]'");
        $data_berita=mysqli_fetch_array($ambil);
?>

        <div class="row-mb-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit berita</h1>
        </div>
            <div class="col-6 mx-auto">
                <br>
                
                <form action="proses_berita.php?proses=edit" method="post">
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="hidden" class="form-control" name="id" value="<?=$data_berita['id'] ?>">
                    <input type="text" class="form-control" name="judul" value="<?=$data_berita['judul'] ?>">
                </div>
                
              
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select select class="form-select" name="kategori_id">
                        <option selected>~ Pilih Kategori ~</option>
                        <?php
                            include 'koneksi.php';
                            $kategori=mysqli_query($db,"SELECT * FROM kategori");
                            while ($data_kategori=mysqli_fetch_array($kategori)) {
                                $selected=($data_kategori['id']==$data_berita['kategori_id'] ? 'selected' : '');
                                echo "<option value=".$data_kategori['id']." $selected>".$data_kategori['nama_kategori']."</option>";
                            }
                        ?>
                    </select> 
                </div>
                <div class="mb-3">
                    <label class="form-label">File Upload</label>
                    <input type="file" class="form-control" name="fileToUpload" id="file-upload">
                </div>

                <?php
                //$file=mysqli_query($db, "SELECT * FROM berita");
                if ($data_berita) {
                ?>      

                <div class="mb-4">
                    <img src="uploads/<?=$data_berita['file_upload']?>" alt="Preview Uploaded Image" id="file-preview" width="300">
                </div>

                <?php                
                }else{
                ?>

                <div class="mb-4">
                    <img src="#" alt="Preview Uploaded Image" id="file-preview" width="300">
                </div>

                <?php
                }
                ?>

                <div class="mb-3">
                    <label class="form-label" >Isi Berita</label>
                    <textarea class="form-control"  rows="10" name="isi_berita"><?= htmlspecialchars($data_berita['isi_berita']) ?></textarea>
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

<script>
    const input = document.getElementById('file-upload');
const previewPhoto = () => {
    const file = input.files;
    if (file) {
        const fileReader = new FileReader();
        const preview = document.getElementById('file-preview');
fileReader.onload = function (event) {
            preview.setAttribute('src', event.target.result);
        }
        fileReader.readAsDataURL(file[0]);
    }
}
input.addEventListener("change", previewPhoto);
</script>


        

