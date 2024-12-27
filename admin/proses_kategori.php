<?php 
include 'koneksi.php';

if ($_GET['proses']=='insert') {
    $sql=mysqli_query($db,"INSERT INTO kategori (nama_kategori,keterangan) VALUES('$_POST[nama_kategori]','$_POST[keterangan]')");

    if($sql){
            echo "<script>window.location='index.php?p=kategori'</script>";
           
    }
}
if ($_GET['proses']=='edit') {
    $sql=mysqli_query($db,"UPDATE kategori SET
                    nama_kategori  = '$_POST[nama_kategori]',
                    keterangan = '$_POST[keterangan]' WHERE id='$_POST[id]'");

    if($sql){
            echo "<script>window.location='index.php?p=kategori'</script>";
    }
}
if ($_GET['proses']=='delete') {
    $hapus=mysqli_query($db,"DELETE FROM kategori WHERE id='$_GET[id]'");
    if($hapus){
        header('location:index.php?p=kategori'); //redirect
    }
}
?>