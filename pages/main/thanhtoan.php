<?php
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
    if(!isset($_SESSION['cart'])){
        header('Location:giohang.html');
    }
    if($hoten=="" || $sodienthoai==""|| $diachi==""){
        header('Location:giaohang.html');
    }
?>
<div class="main">
    <div class="shop_top">
        <div class="container">
             <!-- Responsive Arrow Progress Bar -->
             <div class="arrow-steps clearfix" style="margin-bottom:55px;">
                 <div class="step done"> <span><a href="giohang.html" ><i class="fas fa-shopping-cart"></i> Giỏ hàng</a></span> </div>
                <div class="step done"> <span><a href="giaohang.html"><i class="fas fa-truck"></i> Giao hàng</a></span> </div>
                <div class="step current"> <span><a href="thanhtoan.html"><i class="far fa-credit-card"></i> Thanh toán</a></div>
                <div class="step"> <span><i class="fas fa-align-justify"></i> Đơn hàng chi tiết<span> </div>
            </div>
            <div class="col-md-12"> 
                <div class="col-md-8">
                    <div style="margin-bottom:50px">
                        <h2>Thông tin vận chuyển và đơn hàng</h2>
                        <ul class="team_list">
                            <li><p>Họ và tên: <?php echo $hoten?></p></li>
                            <li><p>Số điện thoại: <?php echo $sodienthoai?></p></li>
                            <li><p>Địa chỉ: <?php echo $diachi?></p></li>
                            <li><p>Ghi chú: <?php echo $ghichu?></p></li>
                        </ul>
                    </div>
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
                    <p style="float: right;font-size: 20px;font-weight: bold;">Tổng tiền: <?php echo number_format($tongtien,0,',','.')?> vnđ</p>
                </div>
                <style type="text/css">
                    .col-md-4.hinhthucthanhtoan .form-check{
                        margin:10px;
                    }
                    .btn-thanhtoan{
                        width: 343px;
                        height: 45px;
                        font-size: 17px;
                    }
                    .qrcode{
                        position: absolute;
                        margin: 0px 8px;
                        padding: 22px;
                        font-size: 31px;
                        color: #fef7f7;
                    }
                    .atm_momo{
                        position: absolute;
                        margin: 0px 17px;
                        padding: 8px;
                        font-size: 31px;
                        color: #fef7f7;
                    }
                    .thanhtoan-khac{
                        color: #888;
                        padding: 10px;
                        margin: 0px 0px 16px;
                    }
                </style>
                <div class="col-md-4 hinhthucthanhtoan">
                    <form action="pages/main/dathang.php" method="POST" >
                        <h2>Hình thức thanh toán</h2>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="hinhthucthanhtoan" value="tienmat" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Tiền mặt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="hinhthucthanhtoan" value="chuyenkhoan">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Chuyển khoản
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="hinhthucthanhtoan" value="vnpay">
                            <img src="Images/vnpay.png" height="32" width="32" alt="">
                            <label class="form-check-label" for="flexRadioDefault1">
                            VNPAY
                            </label>
                        </div>
                        <input type="submit" name="redirect" value="Thanh toán ngay" class="btn btn-success btn-thanhtoan" style="margin: 15px 0px 15px;">
                        <input type="hidden" value="<?php echo $tongtien=round($tongtien/22840)?>" id="tongtien">
                    </form>
                    <label class="thanhtoan-khac"><i class="fas fa-arrow-right"></i> Thanh toán bằng hình thức khác</label>
                    <div id="paypal-button-container"></div>
                    <form method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="pages/main/xulythanhtoanmomo_atm.php">
                        <i class="far fa-credit-card atm_momo"></i>
                        <input type="submit" name="momo_atm" value="Thanh toán MoMo ATM" class="btn btn-primary btn-thanhtoan" >
                    </form>
                    <form method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="pages/main/xulythanhtoanmomo_qrcode.php">
                        <i class="fas fa-qrcode qrcode"></i>
                        <input type="submit" name="momo_qrcode" value="Thanh toán MoMo QRCode" class="btn btn-danger btn-thanhtoan" style="margin: 15px 0px 15px;">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
