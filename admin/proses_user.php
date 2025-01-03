<?php 
include 'koneksi.php';

try {
    if ($_GET['proses'] == 'insert') {
        $sql = "INSERT INTO user (nama_lengkap, email, password, level_id, notelp, alamat, photo) 
                VALUES (:nama, :email, :password, :level_id, :notelp, :alamat, :photo)";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nama', $_POST['nama']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':password', $_POST['password']);
        $stmt->bindParam(':level_id', $_POST['level_id']);
        $stmt->bindParam(':notelp', $_POST['notelp']);
        $stmt->bindParam(':alamat', $_POST['alamat']);
        $stmt->bindParam(':photo', $_POST['photo']);
        
        if ($stmt->execute()) {
            echo "<script>window.location='index.php?p=user'</script>";
        }
    }
    
    if ($_GET['proses'] == 'edit') {
        $sql = "UPDATE user SET 
                nama_lengkap = :nama, 
                email = :email, 
                password = :password, 
                level_id = :level_id, 
                notelp = :notelp, 
                alamat = :alamat, 
                photo = :photo 
                WHERE id = :id";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->bindParam(':nama', $_POST['nama']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':password', $_POST['password']);
        $stmt->bindParam(':level_id', $_POST['level_id']);
        $stmt->bindParam(':notelp', $_POST['notelp']);
        $stmt->bindParam(':alamat', $_POST['alamat']);
        $stmt->bindParam(':photo', $_POST['photo']);
        
        if ($stmt->execute()) {
            echo "<script>window.location='index.php?p=user'</script>";
        }
    }
    
    if ($_GET['proses'] == 'delete') {
        $sql = "DELETE FROM user WHERE id = :id";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $_GET['id']);
        
        if ($stmt->execute()) {
            header('location:index.php?p=user');
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
