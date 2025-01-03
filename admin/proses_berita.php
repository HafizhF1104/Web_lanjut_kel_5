<?php
include 'koneksi.php';
session_start();
$target_dir = "uploads/";
$nama_file = rand() . '-' . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $nama_file;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

try {
    if ($_GET['proses'] == 'insert') {

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "File has been uploaded.";
            } else {
                echo "Error uploading file.";
            }
        }

        $stmt = $db->prepare("INSERT INTO berita (user_id, kategori_id, judul, file_upload, isi_berita) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $_SESSION['user_id'],
            $_POST['kategori_id'],
            $_POST['judul'],
            $nama_file,
            $_POST['isi_berita']
        ]);

        echo "<script>window.location='index.php?p=berita'</script>";
    }

    if ($_GET['proses'] == 'edit') {
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $kategori_id = $_POST['kategori_id'];
        $isi_berita = $_POST['isi_berita'];

        if ($_FILES['file_upload']['name']) {
            $file_upload = rand() . '-' . $_FILES['file_upload']['name'];
            move_uploaded_file($_FILES['file_upload']['tmp_name'], $target_dir . $file_upload);

            $stmt = $db->prepare("UPDATE berita SET judul = ?, kategori_id = ?, file_upload = ?, isi_berita = ? WHERE id = ?");
            $stmt->execute([$judul, $kategori_id, $file_upload, $isi_berita, $id]);
        } else {
            $stmt = $db->prepare("UPDATE berita SET judul = ?, kategori_id = ?, isi_berita = ? WHERE id = ?");
            $stmt->execute([$judul, $kategori_id, $isi_berita, $id]);
        }

        header('Location: index.php?p=berita');
    }

    if ($_GET['proses'] == 'delete') {
        unlink('uploads/' . $_GET['file']);

        $stmt = $db->prepare("DELETE FROM berita WHERE id = ?");
        $stmt->execute([$_GET['id']]);

        header('Location: index.php?p=berita');
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
