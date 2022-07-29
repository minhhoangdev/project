<?php
	session_start();	
	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	require('../../carbon/autoload.php');
	include('../../admincp/config/config.php');
	require_once('config_vnpay.php');

	$now=Carbon::now('Asia/Ho_chi_Minh');

	if(!isset($_SESSION['dangnhap']) && !isset($_SESSION['dangky'])){
		header('Location:dangnhap.html');
	}else{
		$ma_giohang=bin2hex(random_bytes(2)).'_'.rand(0,9999);
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

		$hinhthucthanhtoan=$_POST['hinhthucthanhtoan'];

		//lấy tổng tiền từ giỏ hàng
		$tongtien=0;
        foreach($_SESSION['cart'] as $item){ 
            $thanhtien=$item['soluong']*$item['dongia'];
            $tongtien+=$thanhtien;
		}

		if($hinhthucthanhtoan=="tienmat" || $hinhthucthanhtoan=="chuyenkhoan"){//đặt hàng = tiền mặt hoặc chuyển khoản
			//insert vào đơn hàng
			$cart_query=mysqli_query($mysqli,"INSERT INTO tbl_giohang(ma_giohang,id_user,trangthai_giohang,tongtien,ngaydat,hinhthuc_thanhtoan,id_shipping) 
			VALUE('".$ma_giohang."','".$id_user."',1,'".$tongtien."','".$now."','".$hinhthucthanhtoan."','".$id_shipping."')");

			//insert vào chi tiết đơn hàng
			foreach($_SESSION['cart'] as $item){
				$id_sanpham=$item['id_sanpham'];
				$soluong=$item['soluong'];

				mysqli_query($mysqli,"INSERT INTO tbl_chitietgiohang(ma_giohang,id_sanpham,soluong,options) 
					VALUE('".$ma_giohang."','".$id_sanpham."','".$soluong."','".$item['options']."')");
			}
			if($cart_query){
				$success="Đặt hàng thành công !";
			 }else{
				 $error="Đặt hàng không thành công !";
			}
			if($success){
				$_SESSION['thanhcong']=$success;
			}
			if($error){
				$_SESSION['thatbai']=$error;
			}
			header('Location:../main/thanhtoanthanhcong.php');
		}elseif($hinhthucthanhtoan=="vnpay"){//thanh toán = vnpay
			$vnp_TxnRef = $ma_giohang; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
			$vnp_OrderInfo = 'Thanh toán đơn hàng tại web';//nội dung thanh toán
			$vnp_OrderType = 'billpayment';
			$vnp_Amount = $tongtien * 100;
			$vnp_Locale = 'vn';
			$vnp_BankCode = 'NCB';
			$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

			$vnp_ExpireDate = $expire;

			$inputData = array(
				"vnp_Version" => "2.1.0",
				"vnp_TmnCode" => $vnp_TmnCode,
				"vnp_Amount" => $vnp_Amount,
				"vnp_Command" => "pay",
				"vnp_CreateDate" => date('YmdHis'),
				"vnp_CurrCode" => "VND",
				"vnp_IpAddr" => $vnp_IpAddr,
				"vnp_Locale" => $vnp_Locale,
				"vnp_OrderInfo" => $vnp_OrderInfo,
				"vnp_OrderType" => $vnp_OrderType,
				"vnp_ReturnUrl" => $vnp_Returnurl,
				"vnp_TxnRef" => $vnp_TxnRef,
				"vnp_ExpireDate"=>$vnp_ExpireDate,
			);

			if (isset($vnp_BankCode) && $vnp_BankCode != "") {
				$inputData['vnp_BankCode'] = $vnp_BankCode;
			}

			//var_dump($inputData);
			ksort($inputData);
			$query = "";
			$i = 0;
			$hashdata = "";
			foreach ($inputData as $key => $value) {
				if ($i == 1) {
					$hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
				} else {
					$hashdata .= urlencode($key) . "=" . urlencode($value);
					$i = 1;
				}
				$query .= urlencode($key) . "=" . urlencode($value) . '&';
			}

			$vnp_Url = $vnp_Url . "?" . $query;
			if (isset($vnp_HashSecret)) {
				$vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
				$vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
			}
			$returnData = array('code' => '00'
				, 'message' => 'success'
				, 'data' => $vnp_Url);
				if (isset($_POST['redirect'])) {				
					header('Location: ' . $vnp_Url);
					die();
				} else {
					echo json_encode($returnData);
				}
		}			
	}
?>