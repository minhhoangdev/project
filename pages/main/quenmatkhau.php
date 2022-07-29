<?php
	require_once('mail/sendmail.php');

    if(isset($_POST['reset_pass'])){
		//lay du lieu tu POST tra ve
		$email=$_POST['email'];
        $sql_select="SELECT * FROM tbl_user WHERE email_user='$email'  LIMIT 1";
        $query_select=mysqli_query($mysqli,$sql_select);
        $numrow=mysqli_num_rows($query_select);
        if($numrow >0){
			$row=mysqli_fetch_array($query_select);
			$ho=$row['ho_user'];
			$ten=$row['ten_user'];
			$name=$ho.' '.$ten;
			$email_reset=base64_encode($email);
		
            $token=bin2hex(random_bytes(9)).rand(0,9999);
           
			$tieude="Reset Password";
			$noidung="<a href="."http://localhost:8080/Web_phpThuan/?quanly=reset_pass&email=".$email_reset."&key=".$token."".">Nhấn vào đây để tiến hành đặt lại mật khẩu";

			$mail=new Mailer();
			$mail->reset_pass($email,$name,$tieude,$noidung);
        
        }else{
			$error="Email không tồn tại !";
		}	
    }      
?>

<div class="main">
    <div class="shop_top">
		<div class="container">
			<div class="col-md-6">
				<div class="login-title">
					<h4 class="title">Nhập email đã đăng ký !</h4>
					<?php
						if(isset($error)){
					?>
					<p style="color: red;"><?php echo $error?></p>
					<?php
					}
					?>
					<div id="loginbox" class="loginbox">
						<form action="" method="POST" name="login" id="login-form">
							<fieldset class="input">
								<p id="login-form-username">
								<label for="modlgn_username">Email</label>
								<input id="modlgn_username" type="email" name="email" class="inputbox" size="18" autocomplete="on">
								</p>
								<div class="remember">
									<input type="submit" name="reset_pass" class="button" value="Tiếp theo"><div class="clear"></div>
								</div>
							</fieldset>
						</form>
					</div>
			    </div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>

