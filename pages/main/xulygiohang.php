<?php
    session_start();
    include('../../admincp/config/config.php');
    //them gio hang
    if(isset($_GET['giohang']) && $_GET['giohang']=="them"){
        $id_sanpham=$_GET['id_sanpham'];
        if(isset($_GET['soluong'])){
           $soluong=$_GET['soluong'];
        }else{
            $soluong=1;
        }
        if(isset($_SESSION['size'])){
			$size=$_SESSION['size'];
		}
        else{
            $size='default';
        }
		if(isset($_SESSION['color'])){
			$color=$_SESSION['color'];
		}else{
            $color='default';
        }
        $options=array('size'=>$size, 'color'=>$color);
        $options_serialized=serialize($options);
       
        $sql_select="SELECT * FROM tbl_sanpham WHERE id_sanpham='$id_sanpham'";
        $query=mysqli_query($mysqli,$sql_select);
        $row=mysqli_fetch_array($query);
        if($row){
            $sanphammoi[]=array('masanpham'=>$row['masanpham'],'id_sanpham'=>$id_sanpham,'tensanpham'=>$row['tensanpham'],
                                'dongia'=>$row['dongia'],'hinhanh'=>$row['hinhanh'],'soluong'=>$soluong,'options'=>$options_serialized);
            //nếu tồn tại giỏ hàng
            if(isset($_SESSION['cart'])){
                $found=false;
                foreach($_SESSION['cart'] as $item_cart){
                    //nếu tồn tại sản phẩm -> tăng số lượng
                    if($item_cart['id_sanpham']==$id_sanpham){

                        $options_old=unserialize($item_cart['options']);

                        if($size=='default' && $options_old['size']!='default'){
                            $new_size=$options_old['size'];
                        }else{
                            $new_size=$size;
                        }

                        if($color=='default' && $options_old['color']!='default'){
                            $new_color=$options_old['color'];
                        }else{
                            $new_color=$color;
                        }

                        $options_new=array('size'=>$new_size, 'color'=>$new_color);
                        $options_serialized_new=serialize($options_new);

                        if($color!=$item_cart['options'])
                        $sanpham[]=array('masanpham'=>$item_cart['masanpham'],'id_sanpham'=>$item_cart['id_sanpham'],'tensanpham'=>$item_cart['tensanpham'],
                                        'dongia'=>$item_cart['dongia'],'hinhanh'=>$item_cart['hinhanh'],'soluong'=>$item_cart['soluong']+1,'options'=>$options_serialized_new);
                        $found=true;
                    }else{//không tồn tại -> lấy ra các sản phẩm hiện có trong giỏ hàng
                        $sanpham[]=array('masanpham'=>$item_cart['masanpham'],'id_sanpham'=>$item_cart['id_sanpham'],'tensanpham'=>$item_cart['tensanpham'],
                        'dongia'=>$item_cart['dongia'],'hinhanh'=>$item_cart['hinhanh'],'soluong'=>$item_cart['soluong'],'options'=>$item_cart['options']);
                    }
                }
                if($found==false){
                    $_SESSION['cart']=array_merge($sanpham,$sanphammoi);//array_merge: nối mảng
                }else{
                    $_SESSION['cart']=$sanpham;
                }
            }else{
                $_SESSION['cart']=$sanphammoi;
            }
            unset($_SESSION['size']);
            unset($_SESSION['color']);
        }
    }
    //xoa tat ca
    if(isset($_GET['giohang']) && $_GET['giohang']=="xoatatca"){
        unset($_SESSION['cart']);
    }
    //xoa
    if(isset($_GET['giohang']) && $_GET['giohang']=="xoa"){
        foreach($_SESSION['cart'] as $item_cart){
            if($item_cart['id_sanpham']!=$_GET['id_sanpham']){
                $sanpham[]=array('masanpham'=>$item_cart['masanpham'],'id_sanpham'=>$item_cart['id_sanpham'],'tensanpham'=>$item_cart['tensanpham'],
                'dongia'=>$item_cart['dongia'],'hinhanh'=>$item_cart['hinhanh'],'soluong'=>$item_cart['soluong'],'options'=>$item_cart['options']);
            }
        }
        $_SESSION['cart']=$sanpham;
    }
    //them so luong
    if(isset($_GET['giohang']) && $_GET['giohang']=="tangsoluong"){
        foreach($_SESSION['cart'] as $item_cart){
            if($item_cart['id_sanpham']!=$_GET['id_sanpham']){
                $sanpham[]=array('masanpham'=>$item_cart['masanpham'],'id_sanpham'=>$item_cart['id_sanpham'],'tensanpham'=>$item_cart['tensanpham'],
                'dongia'=>$item_cart['dongia'],'hinhanh'=>$item_cart['hinhanh'],'soluong'=>$item_cart['soluong'],'options'=>$item_cart['options']);
            }
            else{
                $sanpham[]=array('masanpham'=>$item_cart['masanpham'],'id_sanpham'=>$item_cart['id_sanpham'],'tensanpham'=>$item_cart['tensanpham'],
                'dongia'=>$item_cart['dongia'],'hinhanh'=>$item_cart['hinhanh'],'soluong'=>$item_cart['soluong']+1,'options'=>$item_cart['options']);
            }
        }
        $_SESSION['cart']=$sanpham;
    }
    //giamsoluong
    if(isset($_GET['giohang']) && $_GET['giohang']=="giamsoluong"){
        foreach($_SESSION['cart'] as $item_cart){
            if($item_cart['id_sanpham']!=$_GET['id_sanpham']){
                $sanpham[]=array('masanpham'=>$item_cart['masanpham'],'id_sanpham'=>$item_cart['id_sanpham'],'tensanpham'=>$item_cart['tensanpham'],
                'dongia'=>$item_cart['dongia'],'hinhanh'=>$item_cart['hinhanh'],'soluong'=>$item_cart['soluong'],'options'=>$item_cart['options']);
            }
            else{
                if($item_cart['soluong'] ==1){
                   unset($item_cart[$_GET['id_sanpham']]);
                }else{
                    $sanpham[]=array('masanpham'=>$item_cart['masanpham'],'id_sanpham'=>$item_cart['id_sanpham'],'tensanpham'=>$item_cart['tensanpham'],
                    'dongia'=>$item_cart['dongia'],'hinhanh'=>$item_cart['hinhanh'],'soluong'=>$item_cart['soluong']-1,'options'=>$item_cart['options']);
                }
               
            }
        }
        $_SESSION['cart']=$sanpham;
    }
    header('Location:../../giohang.html');
?>