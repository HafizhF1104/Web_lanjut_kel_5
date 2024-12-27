<?php 
include 'koneksi.php';

if ($_GET['proses']=='insert') {
    $sql=mysqli_query($db,"INSERT INTO prodi (nama_prodi,jenjang_prodi) VALUES('$_POST[nama_prodi]','$_POST[jenjang]')");

    if($sql){
            echo "<script>window.location='index.php?p=prodi'</script>";
           
    }
}
if ($_GET['proses']=='edit') {
    include 'koneksi.php';
    $sql=mysqli_query($db,"UPDATE prodi SET
                    nama_prodi  = '$_POST[nama_prodi]',
                    jenjang_prodi = '$_POST[jenjang]' WHERE id='$_POST[id]'");

    if($sql){
            echo "<script>window.location='index.php?p=prodi'</script>";
    }
}
if ($_GET['proses']=='delete') {
    $hapus=mysqli_query($db,"DELETE FROM prodi WHERE id='$_GET[id]'");
    if($hapus){
        header('location:index.php?p=prodi'); //redirect
    }
}
?>