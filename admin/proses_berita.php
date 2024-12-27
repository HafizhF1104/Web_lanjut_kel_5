<?php 
include 'koneksi.php';
session_start();
$target_dir = "uploads/";
$nama_file = rand() . '-' . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $nama_file;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


if ($_GET['proses']=='insert') {

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
            // Tambahkan pemeriksaan kesalahan
            if (!is_writable($target_dir)) {
                echo "Folder tidak dapat ditulisi.";
            }
            if (!is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
                echo "File tidak valid.";
            }
        }
    }
    
    $sql=mysqli_query($db,"INSERT INTO berita(user_id, kategori_id, judul, file_upload, isi_berita) VALUES('$_SESSION[user_id]','$_POST[kategori_id]','$_POST[judul]','$nama_file','$_POST[isi_berita]')");

    if($sql){
            echo "<script>window.location='index.php?p=berita'</script>";
    }
}

if ($_GET['proses']=='edit') {
    // $sql=mysqli_query($db,"UPDATE berita SET
    //                 judul  = '$_POST[judul]',
    //                 kategori_id = '$_POST[kategori_id]' 
    //                 file_upload = '$_POST[file_upload]'
    //                 isi_berita = '$_POST[isi_berita]' WHERE id='$_POST[id]'");

    // if($sql){
    //         echo "<script>window.location='index.php?p=berita'</script>";
    // }

    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $kategori_id = $_POST['kategori_id'];
    $isi_berita = $_POST['isi_berita'];

    // Cek apakah file baru diupload
    if ($_FILES['file_upload']['name']) {
        $file_upload = $_FILES['file_upload']['name'];
        // Memindahkan file ke folder tujuan
        move_uploaded_file($_FILES['file_upload']['tmp_name'], "uploads/" . $file_upload);

        // Query dengan update file
        $query = "UPDATE berita SET judul='$judul', kategori_id='$kategori_id', file_upload='$file_upload', isi_berita='$isi_berita' WHERE id='$id'";
    } else {
        // Query tanpa update file
        $query = "UPDATE berita SET judul='$judul', kategori_id='$kategori_id', isi_berita='$isi_berita' WHERE id='$id'";
    }

    $result = mysqli_query($db, $query);

    if ($result) {
        header('Location: index.php?p=berita'); // Redirect ke halaman daftar berita
    } else {
        echo "Gagal mengupdate berita!";
    }
}
if ($_GET['proses']=='delete') {

    unlink('uploads/'.$_GET['file']);

    $hapus=mysqli_query($db,"DELETE FROM berita WHERE id='$_GET[id]'");
    if($hapus){
        header('location:index.php?p=berita'); //redirect
    }

}
?>