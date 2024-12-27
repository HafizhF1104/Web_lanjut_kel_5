

<?php 
$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
?>

    <div class="row-mb-5">
    <div class="card-header">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <h1 class="h2">Kategori</h1>
    </div>
    </div>

    <div class="card-body">
            <div class="col-2 mb-3">
                <a href="index.php?p=kategori&aksi=input" class="btn btn-primary"><i class="bi bi-building-add"></i> Tambah Kategori</a>
            </div>
            <div class="table-responsive small">
            <table class="table table-bordered" id="table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>keterangan</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    include 'koneksi.php';
                    $ambil=mysqli_query($db,"SELECT * FROM kategori");
                    $no=1;
                    while($data=mysqli_fetch_array($ambil)){
                ?>
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$data['nama_kategori']?></td>
                    <td><?=$data['keterangan']?></td>
                    <td>
                        <a href="index.php?p=kategori&aksi=edit&id=<?=$data['id']?>" class="btn btn-success"><i class="bi bi-pencil"></i> Edit</a>
                        <a href="proses_kategori.php?proses=delete&id=<?=$data['id']?>" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')"><i class="bi bi-trash"></i> Delete</a>
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
        <h1 class="h2">Input Kategori</h1>
        </div>
            <div class="col-6 mx-auto">
                <br>
                <form action="proses_kategori.php?proses=insert" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" name="nama_kategori">
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
        $ambil=mysqli_query($db,"SELECT * FROM kategori WHERE id='$_GET[id]'");
        $data_kategori=mysqli_fetch_array($ambil);
?>

        <div class="row-mb-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Kategori</h1>
        </div>
            <div class="col-6 mx-auto">
                <br>
                
                <form action="proses_kategori.php?proses=edit" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="hidden" class="form-control" name="id" value="<?=$data_kategori['id'] ?>">
                    <input type="text" class="form-control" name="nama_kategori" value="<?=$data_kategori['nama_kategori'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan" value="<?=$data_kategori['keterangan'] ?>">
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
        

