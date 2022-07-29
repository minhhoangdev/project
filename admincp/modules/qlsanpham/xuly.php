<?php
    include('../../config/config.php');
    $masanpham=$_POST['masanpham'];
    $tensanpham=$_POST['tensanpham'];
    $soluong=$_POST['soluong'];
    $dongia=$_POST['dongia'];
    //xu ly anh
    $_hinhanh=$_FILES['hinhanh']['name'];
    $hinhanh_tmp=$_FILES['hinhanh']['tmp_name'];
    $hinhanh=time().'_'.$_hinhanh;

    $mota_tomtat=$_POST['mota_tomtat'];
    $mota=$_POST['mota'];
    $tinhtrang =$_POST['tinhtrang'];
    $id_danhmuc=$_POST['id_danhmuc'];

    //thêm
    if(isset($_POST['themsanpham'])){
        $sql_them="INSERT INTO tbl_sanpham(masanpham,tensanpham,soluong,dongia,hinhanh,mota_tomtat,mota,tinhtrang,id_danhmuc) 
        VALUE('".$masanpham."','".$tensanpham."','".$soluong."','".$dongia."',
                '".$hinhanh."','".$mota_tomtat."','".$mota."','".$tinhtrang."','".$id_danhmuc."') ";
        mysqli_query($mysqli,$sql_them);
        move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
        header('Location:../../index.php?action=quanlysanpham&query=them');
    }
    //sửa
    elseif(isset($_POST['suasanpham'])){
        if($_hinhanh==""){
            $sql_sua="UPDATE tbl_sanpham SET masanpham='".$masanpham."',tensanpham='".$tensanpham."',soluong='".$soluong."',
            dongia='".$dongia."',mota_tomtat='".$mota_tomtat."',mota='".$mota."',tinhtrang='".$tinhtrang."',
            id_danhmuc='".$id_danhmuc."'
             WHERE id_sanpham=$_GET[id_sanpham]";
        }
        else{
            $sql_select="SELECT * FROM tbl_sanpham WHERE id_sanpham='$_GET[id_sanpham]' LIMIT 1";
            $query=mysqli_query($mysqli,$sql_select);
            while($row=mysqli_fetch_array($query)){
                unlink('uploads/'.$row['hinhanh']);
            }
            $sql_sua="UPDATE tbl_sanpham SET masanpham='".$masanpham."',tensanpham='".$tensanpham."',soluong='".$soluong."',
            dongia='".$dongia."',hinhanh='".$hinhanh."',mota_tomtat='".$mota_tomtat."',mota='".$mota."',tinhtrang='".$tinhtrang."',
            id_danhmuc='".$id_danhmuc."'
             WHERE id_sanpham=$_GET[id_sanpham]";
        }
        mysqli_query($mysqli,$sql_sua);
        move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
        header('Location:../../index.php?action=quanlysanpham&query=them');
    }
    //xoa
    elseif(isset($_GET['query'])=="xoa"){
        $sql_xoa="DELETE FROM tbl_sanpham WHERE id_sanpham=$_GET[id_sanpham]";
        mysqli_query($mysqli,$sql_xoa);
        unlink('uploads/'.$row['hinhanh']);
        header('Location:../../index.php?action=quanlysanpham&query=them');
    }

?>