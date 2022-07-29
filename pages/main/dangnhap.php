<?php
    if(isset($_POST['dangnhap'])){
		//lay du lieu tu POST tra ve
		$email=$_POST['email'];
		$matkhau=md5($_POST['matkhau']);
        $sql_select="SELECT * FROM tbl_user WHERE email_user='$email' and matkhau_user='$matkhau' LIMIT 1";
        $query_select=mysqli_query($mysqli,$sql_select);
        $numrow=mysqli_num_rows($query_select);
        if($numrow >0){
            while($row=mysqli_fetch_array($query_select)){
                $dangnhap=array('id'=>$row['id_user'],'ho'=>$row['ho_user'],'ten'=>$row['ten_user'],'type'=>$row['type_user'],'email'=>$row['email_user']);
            }
			$_SESSION['dangnhap']=$dangnhap;
			header('Location:index.html');
        }else{
			$error="Tên đăng nhập hoặc mật khẩu không đúng !";
		}	
    }
             
?>

<div class="main">
    <div class="shop_top">
		<div class="container">
			<div class="col-md-6">
				<div class="login-page">
					<h4 class="title">Khánh hàng mới</h4>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis</p>
					<div class="button1">
					   <a href="dangky.html"><input type="submit" name="Submit" value="Đăng ký tài khoản"></a>
					 </div>
					 <div class="clear"></div>
				  </div>
				</div>
				<div class="login-title">
					<h4 class="title">Khánh hàng đã có tài khoản</h4>
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
								<input id="modlgn_username" type="text" name="email" class="inputbox" size="18" autocomplete="on">
								</p>
								<p id="login-form-password">
								<label for="modlgn_passwd">Mật khẩu</label>
								<input id="modlgn_passwd" type="password" name="matkhau" class="inputbox" size="18" autocomplete="off">
								</p>
								<div class="remember">
									<p id="login-form-remember">
										<label for="modlgn_remember"><a href="quenmatkhau.html">Quên mật khẩu ? </a></label>
									</p>
									<input type="submit" name="dangnhap" class="button" value="Đăng nhập"><div class="clear"></div>
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
