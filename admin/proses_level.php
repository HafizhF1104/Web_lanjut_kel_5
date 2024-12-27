<?php 
include 'koneksi.php';

if ($_GET['proses']=='insert') {
    $sql=mysqli_query($db,"INSERT INTO level (nama_level,keterangan) VALUES('$_POST[nama_level]','$_POST[keterangan]')");

    if($sql){
            echo "<script>window.location='index.php?p=level'</script>";
           
    }
}
if ($_GET['proses']=='edit') {
    include 'koneksi.php';
    $sql=mysqli_query($db,"UPDATE level SET
                    nama_level = '$_POST[nama_level]',
                    keterangan = '$_POST[keterangan]' WHERE id='$_POST[id]'");

    if($sql){
            echo "<script>window.location='index.php?p=level'</script>";
    }
}
if ($_GET['proses']=='delete') {
    $hapus=mysqli_query($db,"DELETE FROM level WHERE id='$_GET[id]'");
    if($hapus){
        header('location:index.php?p=level'); //redirect
    }
}
?>