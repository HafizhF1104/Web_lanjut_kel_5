<?php
include 'koneksi.php';

if ($_GET['proses'] == 'insert') {
    try {
        
        $tgl = $_POST['thn'] . '-' . $_POST['bln'] . '-' . $_POST['tgl'];
        $hobies = implode(",", $_POST['hobi']);
        
        $sql = "INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, jekel, hobi, email, prodi_id, notelp, alamat) 
                VALUES (:nim, :nama, :tgl_lahir, :jekel, :hobi, :email, :prodi_id, :notelp, :alamat)";
        $stmt = $db->prepare($sql);

        $stmt->execute([
            ':nim' => $_POST['nim'],
            ':nama' => $_POST['nama'],
            ':tgl_lahir' => $tgl,
            ':jekel' => $_POST['jekel'],
            ':hobi' => $hobies,
            ':email' => $_POST['email'],
            ':prodi_id' => $_POST['id_prodi'],
            ':notelp' => $_POST['notelp'],
            ':alamat' => $_POST['alamat'],
        ]);

        echo "<script>window.location='index.php?p=mhs'</script>";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

if ($_GET['proses'] == 'edit') {
    try {
        $tgl = $_POST['thn'] . '-' . $_POST['bln'] . '-' . $_POST['tgl'];
        $hobies = implode(",", $_POST['hobi']);

        $sql = "UPDATE mahasiswa 
                SET nama_mhs = :nama, tgl_lahir = :tgl_lahir, jekel = :jekel, hobi = :hobi, 
                    email = :email, prodi_id = :prodi_id, notelp = :notelp, alamat = :alamat 
                WHERE nim = :nim";
        $stmt = $db->prepare($sql);

        $stmt->execute([
            ':nim' => $_POST['nim'],
            ':nama' => $_POST['nama'],
            ':tgl_lahir' => $tgl,
            ':jekel' => $_POST['jekel'],
            ':hobi' => $hobies,
            ':email' => $_POST['email'],
            ':prodi_id' => $_POST['id_prodi'],
            ':notelp' => $_POST['notelp'],
            ':alamat' => $_POST['alamat'],
        ]);

        echo "<script>window.location='index.php?p=mhs'</script>";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

if ($_GET['proses'] == 'delete') {
    try {
        $sql = "DELETE FROM mahasiswa WHERE nim = :nim";
        $stmt = $db->prepare($sql);

        $stmt->execute([':nim' => $_GET['nim']]);

        header('location:index.php?p=mhs'); 
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>
