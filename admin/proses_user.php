<?php 
include 'koneksi.php';

if ($_GET['proses']=='insert') {
    $sql=mysqli_query($db,"INSERT INTO user (nama_lengkap, email, password, level_id, notelp, alamat, photo) VALUES('$_POST[nama]','$_POST[email]','$_POST[password]','$_POST[level_id]','$_POST[notelp]','$_POST[alamat]','$_POST[photo]')");

    if($sql){
            echo "<script>window.location='index.php?p=user'</script>";
           
    }
}
if ($_GET['proses']=='edit') {
    
    $sql=mysqli_query($db,"UPDATE user SET
                    nama_lengkap = '$_POST[nama]',
                    email        = '$_POST[email]',
                    password     = '$_POST[password]',
                    level_id     = '$_POST[level_id]',
                    notelp       = '$_POST[notelp]',
                    alamat       = '$_POST[alamat]',
                    photo        = '$_POST[photo]' WHERE id='$_POST[id]'");

    if($sql){
            echo "<script>window.location='index.php?p=user'</script>";
    }
}
if ($_GET['proses']=='delete') {
    $hapus=mysqli_query($db,"DELETE FROM user WHERE id='$_GET[id]'");
    if($hapus){
        header('location:index.php?p=user'); //redirect
    }
}
?>