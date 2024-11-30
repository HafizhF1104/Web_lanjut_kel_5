<?php
include 'koneksi.php';

if ($_GET['proses'] == 'insert') {
    try {
        $sql = $db->prepare("INSERT INTO dosen (nip, nama_dosen, email, prodi_id, notelp, alamat) 
                             VALUES (:nip, :nama_dosen, :email, :prodi_id, :notelp, :alamat)");
        $sql->execute([
            ':nip' => $_POST['nip'],
            ':nama_dosen' => $_POST['nama'],
            ':email' => $_POST['email'],
            ':prodi_id' => $_POST['id_prodi'],
            ':notelp' => $_POST['notelp'],
            ':alamat' => $_POST['alamat']
        ]);

        if ($sql) {
            echo "<script>window.location='index.php?p=dosen'</script>";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

if ($_GET['proses'] == 'edit') {
    try {
        $sql = $db->prepare("UPDATE dosen SET
                            nama_dosen = :nama_dosen,
                            email      = :email,
                            prodi_id   = :prodi_id,
                            notelp     = :notelp,
                            alamat     = :alamat WHERE id = :id");
        $sql->execute([
            ':nama_dosen' => $_POST['nama'],
            ':email' => $_POST['email'],
            ':prodi_id' => $_POST['id_prodi'],
            ':notelp' => $_POST['notelp'],
            ':alamat' => $_POST['alamat'],
            ':id' => $_POST['id']
        ]);

        if ($sql) {
            echo "<script>window.location='index.php?p=dosen'</script>";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

if ($_GET['proses'] == 'delete') {
    try {
        $sql = $db->prepare("DELETE FROM dosen WHERE id = :id");
        $sql->execute([':id' => $_GET['id']]);

        if ($sql) {
            header('Location: index.php?p=dosen'); 
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>
