<?php 
include 'koneksi.php';

// Menggunakan PDO untuk koneksi database
try {
    // Membuat koneksi PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_GET['proses'] == 'insert') {
        // Query untuk insert data
        $sql = "INSERT INTO level (nama_level, keterangan) VALUES (:nama_level, :keterangan)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nama_level', $_POST['nama_level']);
        $stmt->bindParam(':keterangan', $_POST['keterangan']);
        
        if ($stmt->execute()) {
            echo "<script>window.location='index.php?p=level'</script>";
        }
    }

    if ($_GET['proses'] == 'edit') {
        // Query untuk update data
        $sql = "UPDATE level SET nama_level = :nama_level, keterangan = :keterangan WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nama_level', $_POST['nama_level']);
        $stmt->bindParam(':keterangan', $_POST['keterangan']);
        $stmt->bindParam(':id', $_POST['id']);
        
        if ($stmt->execute()) {
            echo "<script>window.location='index.php?p=level'</script>";
        }
    }

    if ($_GET['proses'] == 'delete') {
        // Query untuk delete data
        $sql = "DELETE FROM level WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $_GET['id']);
        
        if ($stmt->execute()) {
            header('location:index.php?p=level');
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
