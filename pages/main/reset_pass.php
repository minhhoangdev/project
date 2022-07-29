<?php
	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	require_once('carbon/autoload.php');

    $email=base64_decode($_GET['email']);
    $token=$_GET['key'];

    if(isset($_POST['reset_pass'])){
		//lay du lieu tu POST tra ve
		$matkhaumoi=md5($_POST['matkhaumoi']);
        $matkhaunhaplai=md5($_POST['matkhaunhaplai']);

        if($matkhaumoi==md5('') || $matkhaunhaplai==md5('')){
            $error="Mật khẩu bắt buộc không được trống !";
        }else{
            if($matkhaumoi!=$matkhaunhaplai){
                $error="Mật khẩu nhập lại không đúng !";
            }else{
                $sql_select="UPDATE tbl_user SET matkhau_user='$matkhaumoi' WHERE email_user='$email'";
                $query_select=mysqli_query($mysqli,$sql_select);
                if($query_select){
                   $success="Thay đổi mật khẩu thành công !";
				   $now=Carbon::now('Asia/Ho_chi_Minh');
				   mysqli_query($mysqli,"INSERT INTO tbl_resetpass(m_email,m_token,m_time) VALUE ('".$email."','".$token."','".$now."')");
                }else{
                    $error="Thay đổi mật khẩu không thành công !";
                }	
            }
           
        }
    }
             
?>

<div class="main">
    <div class="shop_top">
		<div class="container">
			<div class="col-md-6">
				<?php 
            	    if(isset($success)){
            	?>
            	<div class="alert alert-success time">
            	    <p><span style="color: green;"><?php echo $success?></span></p>
            	</div>
            	<?php
            	    }
            	?>
				<div class="login-title">
					<h4 class="title">Reset Password</h4>
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
								<label for="modlgn_username">Mật khẩu mới</label>
								<input id="modlgn_username" type="password" name="matkhaumoi" class="inputbox" size="18">
								</p>
								<p id="login-form-password">
								<label for="modlgn_passwd">Mật khẩu nhập lại</label>
								<input id="modlgn_passwd" type="password" name="matkhaunhaplai" class="inputbox" size="18">
								</p>
								<div class="remember">
									<input type="submit" name="reset_pass" class="button" value="Submit"><div class="clear"></div>
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
