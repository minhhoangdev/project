<?php
	// //loi ban dau
	// $loi_ho="";
	// $loi_email="";
	// $loi_ten="";
	// $loi_matkhau="";
	// $loi_nhaplaimatkhau="";

    if(isset($_POST['dangky'])){
		//lay du lieu tu POST tra ve
		$ho=$_POST['ho'];
		$ten=$_POST['ten'];
		$email=$_POST['email'];
		$matkhau=md5($_POST['matkhau']);
		$nhaplaimatkhau=md5($_POST['nhaplaimatkhau']);

		// //kiem tra loi
        if($ho=="" ||$ten=="" ||$email=="" ||$matkhau==md5("")||$nhaplaimatkhau==md5("")){
            $error="Thông tin bắt buộc không được trống !";
        }else{
			if($nhaplaimatkhau!=$matkhau){
				$error="Mật khẩu nhập lại không chính xác !";
			}else{
				$sql_dangky="INSERT INTO tbl_user(ho_user,ten_user,email_user,matkhau_user) VALUE('".$ho."','".$ten."','".$email."','".$matkhau."') ";
				$query=mysqli_query($mysqli,$sql_dangky);
				$sql_select="SELECT * FROM tbl_user WHERE email_user='$email' and matkhau_user='$matkhau' LIMIT 1";
				$query_select=mysqli_query($mysqli,$sql_select);
				$numrow=mysqli_num_rows($query_select);
				if($numrow >0){
					while($row=mysqli_fetch_array($query_select)){
						$dangky=array('id'=>$row['id_user'],'ho'=>$row['ho_user'],'ten'=>$row['ten_user'],'type'=>$row['type_user'],'email'=>$row['email_user']);
					}
					$_SESSION['dangky']=$dangky;
					header('Location:index.php');
				}
			}
		} 
    }
             
?>

<div class="main">
    <div class="shop_top">
		<div class="container">
			<h3>Thông tin khách hàng</h3>
			<?php
				if(isset($error)){
			?>
			<p style="color: red;"><?php echo $error?></p>
			<?php
			}
			?>
			<form method="POST" action=""> 
				<div class="register-top-grid">
					
					<div>
						<span>Họ <label>*</label></span>
						<input type="text" name="ho"> 
					</div>
					<div>
						<span>Tên<label>*</label></span>
						<input type="text" name="ten"> 
					</div>
					<div>
						<span>Địa chỉ Email<label>*</label></span>
						<input type="text" name="email"> 
					</div>
					<div class="clear"> </div>
				</div>
				<div class="clear"> </div>
				<div class="register-bottom-grid">
						<!-- <h3>LOGIN INFORMATION</h3> -->
						<div>
							<span>Mật khẩu<label>*</label></span>
							<input type="password" name="matkhau">
						</div>
						<div>
							<span>Nhập lại mật khẩu<label>*</label></span>
							<input type="password" name="nhaplaimatkhau">
						</div>
						<div class="clear"> </div>
				</div>
				<div class="clear"> </div>
				<button type="submit" name="dangky" class="btn btn-success" >Đăng ký</button>
			</form>
		</div>
	</div>
</div>