<?php
    include('../../config/config.php');
    $tendanhmuc=$_POST['tendanhmuc'];
    $thutu=$_POST['thutu'];

    //thêm
    if(isset($_POST['themdnahmuc'])){
        $sql_them="INSERT INTO tbl_danhmuc(tendanhmuc,thutu) VALUE('".$tendanhmuc."','".$thutu."') ";
        mysqli_query($mysqli,$sql_them);
        header('Location:../../index.php?action=quanlydanhmucsanpham&query=them');
    }
    //sửa
    elseif(isset($_POST['suadanhmuc'])){
        $sql_sua="UPDATE tbl_danhmuc SET tendanhmuc='".$tendanhmuc."',thutu='".$thutu."' WHERE id_danhmuc=$_GET[id_danhmuc]";
        mysqli_query($mysqli,$sql_sua);
        header('Location:../../index.php?action=quanlydanhmucsanpham&query=them');
    }
    //xoa
    elseif(isset($_GET['query'])=="xoa"){
        $sql_xoa="DELETE FROM tbl_danhmuc WHERE id_danhmuc=$_GET[id_danhmuc]";
        mysqli_query($mysqli,$sql_xoa);
        header('Location:../../index.php?action=quanlydanhmucsanpham&query=them');
    }

?>