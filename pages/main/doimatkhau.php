<?php
    if(isset($_SESSION['dangnhap'])){
        $id_user=$_SESSION['dangnhap']['id'];
    }else{
        $id_user=$_SESSION['dangky']['id'];
    }
    if(isset($_POST['thaydoimatkhau'])){
        $matkhaucu=md5($_POST['matkhaucu']);
        $matkhaumoi=md5($_POST['matkhaumoi']);
        if($matkhaumoi==md5("")||$matkhaucu==md5("")){
            $error_moi="Mật khẩu không được trống !";
        }else{
            $query=mysqli_query($mysqli,"SELECT * FROM tbl_user WHERE id_user='$id_user' LIMIT 1");
            $row=mysqli_fetch_array($query);
            if($row['matkhau_user']==$matkhaucu){
                $query=mysqli_query($mysqli,"UPDATE tbl_user SET matkhau_user='$matkhaumoi' WHERE id_user='$id_user'");
                $success="Đã đỗi mật khẩu thành công !";
            }
            else{
                $error="Mật khẩu cũ không chính xác !";
            }
        }
    }
?>
<div class="main">
    <div class="shop_top">
		<div class="container">
			<div class="col-md-6">
				 	<div class="login-title">
						<h4 class="title">Thay đổi mật khẩu</h4>
						<?php
						if(isset($error)){
						?>
						<p style="color: red;"><?php echo $error?></p>
						<?php
						}
                        if(isset($success)){
						?>
                        <p style="color: green;"><?php echo $success?></p>
                        <?php
                        }
                        if(isset($error_moi)){
                        ?>
                        <p style="color: red;"><?php echo $error_moi?></p>
                        <?php
                        }
                        ?>
						<div id="loginbox" class="loginbox">
							<form action="" method="POST" name="login" id="login-form">
								<fieldset class="input">
									<p id="login-form-password">
									<label for="modlgn_passwd">Mật khẩu cũ</label>
									<input id="modlgn_passwd" type="password" name="matkhaucu" class="inputbox" size="18" autocomplete="off">
                                    <p id="login-form-password">
									<label for="modlgn_passwd">Mật khẩu mới</label>
									<input id="modlgn_passwd" type="password" name="matkhaumoi" class="inputbox" size="18" autocomplete="off">
									</p>
									<div class="remember">
										<input type="submit" name="thaydoimatkhau" class="button" value="Thay đổi mật khẩu"><div class="clear"></div>
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