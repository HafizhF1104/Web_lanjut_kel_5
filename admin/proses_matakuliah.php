<?php 
include 'koneksi.php';

if ($_GET['proses']=='insert') {
    $sql=mysqli_query($db,"INSERT INTO matakuliah (kode_matakuliah, nama_matakuliah, semester, jenis_matakuliah, sks, jam, keterangan) VALUES('$_POST[kode_matakuliah]','$_POST[nama_matakuliah]','$_POST[semester]','$_POST[jenis_matakuliah]','$_POST[sks]','$_POST[jam]','$_POST[keterangan]')");

    if($sql){
            echo "<script>window.location='index.php?p=matakuliah'</script>";
           
    }
}
if ($_GET['proses']=='edit') {
    
    $sql=mysqli_query($db,"UPDATE matakuliah SET
                    kode_matakuliah   = '$_POST[kode_matakuliah]',
                    nama_matakuliah   = '$_POST[nama_matakuliah]',
                    semester          = '$_POST[semester]',
                    jenis_matakuliah  = '$_POST[jenis_matakuliah]',
                    sks               = '$_POST[sks]',
                    jam               = '$_POST[jam]',
                    keterangan        = '$_POST[keterangan]' WHERE id='$_POST[id]'");

    if($sql){
            echo "<script>window.location='index.php?p=matakuliah'</script>";
    }
}
if ($_GET['proses']=='delete') {
    $hapus=mysqli_query($db,"DELETE FROM matakuliah WHERE id='$_GET[id]'");
    if($hapus){
        header('location:index.php?p=matakuliah'); //redirect
    }
}
?>