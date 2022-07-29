<?php
    if(!isset($_SESSION['cart'])){
        header('Location:giohang.html');
    }
    if(isset($_SESSION['dangnhap'])){
        $id_user=$_SESSION['dangnhap']['id'];
    }else{
        $id_user=$_SESSION['dangky']['id'];
    } 

    $query=mysqli_query($mysqli,"SELECT * FROM tbl_shipping WHERE id_user='$id_user' LIMIT 1");
    $num=mysqli_num_rows($query);
    if($num>0){
        $row=mysqli_fetch_array($query);
        $hoten=$row['ten'];
        $sodienthoai=$row['sodienthoai'];
        $diachi=$row['diachi'];
        $ghichu=$row['ghichu'];
    }else{
        $hoten="";
        $sodienthoai="";
        $diachi="";
        $ghichu="";
    }

    if(isset($_POST['themvanchuyen'])){
        $hoten=$_POST['hoten'];
        $sodienthoai=$_POST['sodienthoai'];
        $diachi=$_POST['diachi'];
        $ghichu=$_POST['ghichu'];
        if($hoten=="" || $sodienthoai==""|| $diachi==""){
            $error="Thông tin bắt buộc không được trống !";
        }else{
            mysqli_query($mysqli,"INSERT INTO tbl_shipping(ten,sodienthoai,diachi,ghichu,id_user) 
            VALUE('".$hoten."','".$sodienthoai."','".$diachi."','".$ghichu."','".$id_user."')");
            $success="Thêm thông tin giao hàng thành công !";
        }
    }

    if(isset($_POST['capnhatvanchuyen'])){
        $hoten=$_POST['hoten'];
        $sodienthoai=$_POST['sodienthoai'];
        $diachi=$_POST['diachi'];
        $ghichu=$_POST['ghichu'];
        if($hoten=="" || $sodienthoai==""|| $diachi==""){
            $error="Thông tin bắt buộc không được trống !";
        }else{
            mysqli_query($mysqli,"UPDATE  tbl_shipping SET ten='$hoten',sodienthoai='$sodienthoai',diachi='$diachi',ghichu='$ghichu'
                                WHERE id_user='$id_user'");
            $success="Cập nhật  thông tin giao hàng  thành công !";
        }
       
    }

    if(isset($_POST['hinhthucthanhtoan'])){
        if($hoten=="" || $sodienthoai==""|| $diachi==""){
            $error="Thông tin bắt buộc không được trống !";
        }else{
            header("Location:thanhtoan.html");
        }
    }



?>
<div class="main">
    <div class="shop_top">
        <div class="container">
             <!-- Responsive Arrow Progress Bar -->
             <div class="arrow-steps clearfix" style="margin-bottom:55px;">
                <div class="step done"> <span><a href="giohang.html" ><i class="fas fa-shopping-cart"></i> Giỏ hàng</a></span> </div>
                <div class="step current"> <span><a href="giaohang.html"><i class="fas fa-truck"></i> Giao hàng</a></span> </div>
                <div class="step"> <span><i class="far fa-credit-card"></i> Thanh toán</div>
                <div class="step"> <span><i class="fas fa-align-justify"></i> Đơn hàng chi tiết<span> </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <?php 
                        if(isset($success)){
                    ?>
                    <div class="alert alert-success time">
                        <p><span style="color: green;"><?php echo $success?></span></p>
                    </div>
                    <?php
                        }
                    ?>
                    <?php 
                        if(isset($error)){
                    ?>
                    <div class="alert alert-danger time">
                        <p><span style="color: red;"><?php echo $error?></span></p>
                    </div>
                    <?php
                        }
                    ?>
                    <div id="loginbox" class="loginbox">
                        <form action="" method="POST" name="login" id="login-form">
                            <fieldset class="input">
                                <p id="login-form-password">
                                <label for="modlgn_passwd">Họ và Tên *</label>
                                <input id="modlgn_passwd" type="text" value="<?php echo $hoten?>" name="hoten" class="inputbox" size="18" autocomplete="off">
                                <p id="login-form-password">
                                <label for="modlgn_passwd">Số Điện Thoại *</label>
                                <input id="modlgn_passwd" type="text" value="<?php echo $sodienthoai?>" name="sodienthoai" class="inputbox" size="18" autocomplete="off">
                                </p>
                                <p id="login-form-password">
                                <label for="modlgn_passwd">Địa chỉ *</label>
                                <input id="modlgn_passwd" type="text" value="<?php echo $diachi?>" name="diachi" class="inputbox" size="18" autocomplete="off">
                                </p>
                                <p id="login-form-password">
                                <label for="modlgn_passwd">Ghi Chú</label>
                                <input id="modlgn_passwd" type="text" value="<?php echo $ghichu?>" name="ghichu" class="inputbox" size="18" autocomplete="off">
                                </p>
                                <?php
                                    if($num>0){
                                ?>
                                <div class="remember">
                                    <input type="submit" name="capnhatvanchuyen" class="button" value="Cập nhật vận chuyển">
                                    <div class="clear"></div>
                                </div>
                                <?php
                                    }else{
                                ?>
                                <div class="remember">
                                    <input type="submit" name="themvanchuyen" class="button" value="Thêm vận chuyển">
                                    <div class="clear"></div>
                                </div>
                                <?php
                                    }
                                ?>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Mã sản phẩm</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Options</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $tongtien=0;
                                foreach($_SESSION['cart'] as $item){ 
                                    $thanhtien=$item['soluong']*$item['dongia'];
                                    $tongtien+=$thanhtien;
                                    $options=unserialize($item['options']);
                            ?>
                            <tr>
                                <th scope="row"><?php echo $item['masanpham']?></th>
                                <td><?php echo $item['tensanpham']?></td> 
                                <td><img src="admincp/modules/qlsanpham/uploads/<?php echo $item['hinhanh']?>"  width="65"alt=""></td>
                                <td>Size: <?php echo $options['size'] ?><br>Color: <?php echo $options['color']?></td>
                                <td><span style="padding: 6px;"><?php echo $item['soluong']?></span></td>
                                <td><?php echo number_format($item['dongia'],0,',','.')?> vnđ</td>
                                <td><?php echo number_format($thanhtien,0,',','.')?> vnđ</td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                    <div>
                        <p style="float: right;font-size: 20px;font-weight: bold;">Tổng tiền: <?php echo number_format($tongtien,0,',','.')?> vnđ</p>                   
                    </div>
                </div>
                <form action="" method="POST">
                    <input type="submit" value="Hình thức thanh toán" name="hinhthucthanhtoan" class="btn btn-warning" style="float: right;margin-top:30px">
                </form>
            </div>
            <div class="col-md-12">
               
                <!-- <a href="thanhtoan.html" class="btn btn-info" style="float: right">Hình thức thanh toán</a> -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    setTimeout(function() {
        document.querySelector('.time').style.display="none";
    },6000);
</script>
