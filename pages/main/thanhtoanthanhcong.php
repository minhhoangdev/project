<?php
    session_start();
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    include('../../admincp/config/config.php');
    require('../../carbon/autoload.php');
    require('../../mail/sendmail.php');

    $now=Carbon::now('Asia/Ho_chi_Minh');


    if(isset($_SESSION['dangnhap'])){
        $id_user=$_SESSION['dangnhap']['id'];
        $email_user=$_SESSION['dangnhap']['email'];
        $ho=$_SESSION['dangnhap']['ho'];
        $ten=$_SESSION['dangnhap']['ten'];
    }else{
        $id_user=$_SESSION['dangky']['id'];
        $email_user=$_SESSION['dangky']['email'];
        $ho=$_SESSION['dangky']['ho'];
        $ten=$_SESSION['dangky']['ten'];
    }

    $query=mysqli_query($mysqli,"SELECT * FROM tbl_shipping WHERE id_user='$id_user' LIMIT 1");
    $num=mysqli_num_rows($query);
    if($num>0){
        $row=mysqli_fetch_array($query);
        $id_shipping=$row['id_shipping'];
    }

    $ma_giohang=bin2hex(random_bytes(2)).'_'.rand(0,9999);

    //lấy tổng tiền từ giỏ hàng
	$tongtien=0;
    foreach($_SESSION['cart'] as $item){ 
        $thanhtien=$item['soluong']*$item['dongia'];
        $tongtien+=$thanhtien;
	}

    //thanh toán vnpay thành công
    if(isset($_GET['vnp_Amount'])){
        $vnp_Amount=$_GET['vnp_Amount'];
        $vnp_BankCode=$_GET['vnp_BankCode'];
        $vnp_BankTranNo=$_GET['vnp_BankTranNo'];
        $vnp_CardType=$_GET['vnp_CardType'];
        $vnp_OrderInfo=$_GET['vnp_OrderInfo'];
        $vnp_PayDate=$_GET['vnp_PayDate'];
        $vnp_TmnCode=$_GET['vnp_TmnCode'];
        $vnp_TransactionNo=$_GET['vnp_TransactionNo'];
        $ma_giohang=$_GET['vnp_TxnRef'];


        //insert vào đơn hàng
        $cart_query=mysqli_query($mysqli,"INSERT INTO tbl_giohang(ma_giohang,id_user,trangthai_giohang,tongtien,ngaydat,hinhthuc_thanhtoan,trangthai_thanhtoan,id_shipping) 
        VALUE('".$ma_giohang."','".$id_user."',1,'".$tongtien."','".$now."','vnpay',1,'".$id_shipping."')");

        //insert vào chi tiết đơn hàng
        foreach($_SESSION['cart'] as $item){
            $id_sanpham=$item['id_sanpham'];
            $soluong=$item['soluong'];

            mysqli_query($mysqli,"INSERT INTO tbl_chitietgiohang(ma_giohang,id_sanpham,soluong,options) 
                VALUE('".$ma_giohang."','".$id_sanpham."','".$soluong."','".$item['options']."')");
        }

        //insert vào tbl_vnpay
        $query=mysqli_query($mysqli,"INSERT INTO tbl_vnpay(vnp_amount,vnp_bankcode,vnp_banktranno,vnp_cardtype,vnp_orderinfo,vnp_paydate,vnp_tmncode,vnp_transactionno,ma_giohang) 
                    VALUE('".$vnp_Amount."','".$vnp_BankCode."','".$vnp_BankTranNo."','".$vnp_CardType."',
                    '".$vnp_OrderInfo."','".$vnp_PayDate."','".$vnp_TmnCode."','".$vnp_TransactionNo."','".$ma_giohang."')");
        if($query){
            $success="Thanh toán tại VNP thành công !";
        }else{
            $error="Thanh toán tại VNP thất bại !";
        }
    }
    //thanh toán paypal thành công
    if(isset($_GET['thanhtoan']) && $_GET['thanhtoan']=='paypal'){
        $ma_giohang=bin2hex(random_bytes(2)).'_'.rand(0,9999);
        //insert vào đơn hàng
        $cart_query=mysqli_query($mysqli,"INSERT INTO tbl_giohang(ma_giohang,id_user,trangthai_giohang,tongtien,ngaydat,hinhthuc_thanhtoan,trangthai_thanhtoan,id_shipping) 
        VALUE('".$ma_giohang."','".$id_user."',1,'".$tongtien."','".$now."','paypal',1,'".$id_shipping."')");

        //insert vào chi tiết đơn hàng
        foreach($_SESSION['cart'] as $item){
            $id_sanpham=$item['id_sanpham'];
            $soluong=$item['soluong'];

            mysqli_query($mysqli,"INSERT INTO tbl_chitietgiohang(ma_giohang,id_sanpham,soluong,options) 
                VALUE('".$ma_giohang."','".$id_sanpham."','".$soluong."','".$item['options']."')");
        }

        if($cart_query){
            $success="Thanh toán tại PayPal thành công !";
         }else{
             $error="Thanh toán tại PayPal thất bại !";
        }
    }
     //thanh toán momo thành công
    if(isset($_GET['partnerCode'])){
        $partnerCode=$_GET['partnerCode'];
        $orderId=$_GET['orderId'];
        $amount=$_GET['amount'];
        $orderInfo=$_GET['orderInfo'];
        $orderType=$_GET['orderType'];
        $transId=$_GET['transId'];
        $payType=$_GET['payType'];

        //insert vào đơn hàng
        $cart_query=mysqli_query($mysqli,"INSERT INTO tbl_giohang(ma_giohang,id_user,trangthai_giohang,tongtien,ngaydat,hinhthuc_thanhtoan,trangthai_thanhtoan,id_shipping) 
        VALUE('".$ma_giohang."','".$id_user."',1,'".$tongtien."','".$now."','momo',1,'".$id_shipping."')");

        //insert vào chi tiết đơn hàng
        foreach($_SESSION['cart'] as $item){
            $id_sanpham=$item['id_sanpham'];
            $soluong=$item['soluong'];

            mysqli_query($mysqli,"INSERT INTO tbl_chitietgiohang(ma_giohang,id_sanpham,soluong,options) 
                VALUE('".$ma_giohang."','".$id_sanpham."','".$soluong."','".$item['options']."')");
        }

        //insert vào tbl_momo
        $query=mysqli_query($mysqli,"INSERT INTO tbl_momo(partner_code,order_id,amount,order_info,order_type,trans_id,pay_type,ma_giohang) 
                    VALUE('".$partnerCode."','".$orderId."','".$amount."','".$orderInfo."',
                    '".$orderType."','".$transId."','".$payType."','".$ma_giohang."')");
        if($query){
           $success="Thanh toán tại MOMO thành công !";
        }else{
            $error="Thanh toán tại MOMO thất bại !";
        }
    }
    if(isset($success)){
        $_SESSION['thanhcong']=$success;
    }
    if(isset($error)){
        $_SESSION['thatbai']=$error;
    }
    //gửi mail
	$tenuser=$ho.' '.$ten;
	$tieude="Đặt hàng thành công !";
	$noidung="<p>Cảm ơn quý khách đã đặt hàng với mã đơn hàng:".$ma_giohang."</p> <br/>";
	$noidung.=" <table style="."width:600px;text-align:right;".">
	                <thead>
	                    <tr>
	                        <th>Tên sản phẩm</th>
	                        <th>Số lượng</th>
	                        <th>Đơn giá</th>
	                        <th>Thành tiền</th>
	                    </tr>
	                </thead>
	                <tbody>";
	foreach($_SESSION['cart'] as  $item){
	    $noidung.="	    <tr>
	                        <td>".$item['tensanpham']."</td>
	                        <td> ".$item['soluong']."</td>
	                        <td>".number_format($item['dongia'],0,',','.')." vnđ</td>  
	                        <td>".number_format($item['dongia']*$item['soluong'],0,',','.')." vnđ</td>   
	                    </tr>";
	}
	$noidung.="         <tr>
	                        <td colspan="."3"."></td>
	                        <td style="."font-size:15px;font-weight:bold;".">Tổng tiền : ".number_format($tongtien,0,',','.')." vnđ</td>
	                    </tr>
	                </tbody>
	            </table>";
	$emaildathang=$email_user;
	$mail=new Mailer();
	$mail->dathangmail($tieude,$noidung,$tenuser,$emaildathang);
    unset($_SESSION['cart']);
    header('Location:../../camon.html');
?>