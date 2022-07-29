<?php
    if(isset($_SESSION['dangnhap'])){
        $id_user=$_SESSION['dangnhap']['id'];
    }else{
        $id_user=$_SESSION['dangky']['id'];
    }
    if(isset($_GET['trang'])){
        $trang=$_GET['trang'];
    }
    else{
        $trang=1;
    }
    if($trang==1){
        $begin=0;
    }else{
        $begin=($trang*5)-5;
    }
    $query_phantrang=mysqli_query($mysqli,"SELECT * FROM tbl_giohang  WHERE id_user='$id_user'");
	$count=mysqli_num_rows($query_phantrang);
	$so_trang=ceil($count/5);//ceil:làm tròn 
    if(isset($_GET['huydonhang']) && $_GET['huydonhang']==1){
        $id_giohang=$_GET['id_giohang'];
        mysqli_query($mysqli,"UPDATE tbl_giohang SET trangthai_giohang=0 WHERE id_giohang='$id_giohang'");
        header('Location:lichsudonhang.html');
    }
    $query=mysqli_query($mysqli,"SELECT * FROM tbl_giohang  WHERE id_user='$id_user' ORDER BY ngaydat DESC LIMIT $begin,5");
?>
<div class="main">
    <div class="shop_top">
        <div class="container">  
            <div class="col-md-12">
                <h1>Lịch Sử Đơn Hàng</h1><br>
                <div class="stats-last-agile">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>MÃ ĐƠN HÀNG</th>
                                <th>NGÀY ĐẶT</th>
                                <th>TRẠNG THÁI</th>
                                <th>HÌNH THỨC THANH TOÁN</th>
                                <th>Action</th>
                                <th>QUẢN LÝ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;
                                while($row=(mysqli_fetch_array($query))){
                                    $i++;
                            ?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo$row['ma_giohang']?></td>
                                <td><?php echo$row['ngaydat']?></td>
                                <?php 
                                    if($row['trangthai_giohang']==1){
                                ?>
                                <td><span class="label label-info">Đơn hàng mới </span></td>
                                <?php
                                    }
                                    if($row['trangthai_giohang']==2){
                                ?>
                                <td><span class="label label-success">Đơn hàng đã duyệt </span></td>
                                <?php 
                                    }
                                    if($row['trangthai_giohang']==0){
                                ?>
                                <td><span class="label label-danger">Đơn hàng đã hủy </span></td>
                                <?php
                                    }
                                ?>
                                <td><?php echo$row['hinhthuc_thanhtoan']?></td>
                                <?php
                                    if($row['trangthai_giohang']==1){
                                ?>
                                <td><a href="?quanly=lichsudonhang&huydonhang=1&id_giohang=<?php echo $row['id_giohang']?>&ma_giohang=<?php echo $row['ma_giohang']?>" class="btn btn-danger">Hủy Đơn Hàng</a></td>
                                <?php
                                    }else{
                                ?>
                                <td></td>
                                <?php
                                    }
                                ?>
                                <td>
                                    <a href="?quanly=lichsudonhang&xemdonhang=1&id_giohang=<?php echo $row['id_giohang']?>&ma_giohang=<?php echo $row['ma_giohang']?>">Xem đơn hàng</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <style type="text/css">
			    	ul.list_trang{
			    		padding: 0;
			    		margin: 0;
			    		list-style: none;
			    	}
			    	ul.list_trang li{
			    		float: left;
			    		padding: 5px 13px;
			    		margin: 5px;
			    		background: bisque;
			    	}
			    	ul.list_trang li a span{
			    		color: #000;
			    		text-align: center;
			    		text-decoration: none;
			    	}
			    </style>
				<div>
					<p>Trang: <?php echo $trang;echo'/';echo $so_trang?></p>
					<ul class="list_trang">
						<?php
							for($i=1;$i<=$so_trang;$i++){
						?>
						<li <?php if($i==$trang){echo 'Style="background:red"';}?>><a href="lichsudonhang/trang-<?php echo $i?>.html"><span><?php echo $i?></span></a></li>
						<?php 
						}
						?>
					</ul>
				</div>
            </div>
            <?php
                if(isset($_GET['xemdonhang'])){
                    $ma_giohang=$_GET['ma_giohang'];
                    $id_giohang=$_GET['id_giohang'];
                    $query_thanhtoan=mysqli_query($mysqli,"SELECT * FROM tbl_giohang WHERE ma_giohang='$ma_giohang' LIMIT 1");
                    $row_thanhtoan=mysqli_fetch_array($query_thanhtoan);
                    $trangthai_thanhtoan=$row_thanhtoan['trangthai_thanhtoan'];
                    $hinhthuc_thanhtoan=$row_thanhtoan['hinhthuc_thanhtoan'];
                    if($hinhthuc_thanhtoan=='momo'){
                        $query_momo=mysqli_query($mysqli,"SELECT * FROM tbl_momo WHERE ma_giohang='$ma_giohang' LIMIT 1");
                        $row_momo=mysqli_fetch_array($query_momo);
                        $tong_thanhtoan_momo=$row_momo['amount'];
                        $noidung_thanhtoan_momo=$row_momo['order_info'];
                        $loai_thanhtoan_momo=$row_momo['order_type'];
                        $loaithe_thanhtoan_momo=$row_momo['pay_type'];
                    }
                    if($hinhthuc_thanhtoan=='vnpay'){
                        $query_vnpay=mysqli_query($mysqli,"SELECT * FROM tbl_vnpay WHERE ma_giohang='$ma_giohang' LIMIT 1");
                        $row_vnpay=mysqli_fetch_array($query_vnpay);
                        $tong_thanhtoan_vnpay=$row_vnpay['vnp_amount'];
                        $ma_nganhang_vnpay=$row_vnpay['vnp_bankcode'];
                        $noidung_thanhtoan_vnpay=$row_vnpay['vnp_orderinfo'];
                        $ngay_thanhtoan_vnpay=$row_vnpay['vnp_paydate'];
                        $loaithe_thanhtoan_vnpay=$row_vnpay['vnp_cardtype'];
                    }
                    $query_chitiet=mysqli_query($mysqli,"SELECT * FROM tbl_chitietgiohang as a,tbl_sanpham as b,tbl_shipping as c
                                            WHERE a.id_sanpham=b.id_sanpham and ma_giohang='$ma_giohang' and c.id_user='$id_user' ")
            ?>
            <style type="text/css">
                .chitiet{
                    border: 5px solid gainsboro;
                    border-radius: 20px;
                }
                .title{
                    text-align: center;
                }
                .title a{
                    position: absolute;
                    padding: 11px;
                    margin-left: 520px;
                    font-size: 26px;
                    color: red;
                }
                .title a:hover{
                    color: blue;
                }
            </style>
            <script>$(document).ready(function(c) {
					$('.close').on('click', function(c){
						$('.chitiet').fadeOut('slow', function(c){
							$('.chitiet').remove();
                            window.location.replace('http://localhost:8080/Web_phpThuan/lichsudonhang.html');
						});
						});	  
					});
                    
			</script>
            <div class="col-md-12 chitiet">
                <div class="title">
                    <div class="close"><i class="fas fa-times"></i></div>
                    <br><h2>Chi tiết đơn hàng có mã đơn hàng: <?php echo $ma_giohang?></h2><br>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Thông tin sản phẩm</h3><br>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>TÊN SẢN PHẨM</th>
                                    <th>HÌNH ẢNH</th>
                                    <th>OPTIONS</th>
                                    <th>SỐ LƯỢNG</th>
                                    <th>ĐƠN GIÁ</th>
                                    <th>THÀNH TIỀN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=0;
                                    $tongtien=0;
                                    while($row=(mysqli_fetch_array($query_chitiet))){
                                        $ten=$row['ten'];
                                        $sodienthoai=$row['sodienthoai'];
                                        $diachi=$row['diachi'];
                                        $ghichu=$row['ghichu'];
                                        $i++;
                                        $tongtien+=$row['dongia']*$row[3];
                                        $option=unserialize($row['options']);
                                ?>
                                <tr>
                                    <td><?php echo $i?></td>
                                    <td><?php echo$row['tensanpham']?></td>
                                    <td><img src="admincp/modules/qlsanpham/uploads/<?php echo$row['hinhanh']?>" alt="" width="60"></td>
                                    <td>Size: <?php echo $option['size']?><br>Color: <?php echo $option['color']?></td>
                                    <td><?php echo$row[3]?></td>
                                    <td><?php echo number_format($row['dongia'],0,',','.')?> vnđ</td>
                                    <td><?php echo number_format($row['dongia']*$row[3],0,',','.')?> vnđ</td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <p style="float: right;">Tổng    Tiền: <?php echo number_format($tongtien,0,',','.')?> vnđ</p>
                    </div>
                </div>          
                <div class="row">
                    <div class="col-md-6">
                        <br><h3>Thông tin Thanh Toán</h3><br>
                        <table class="table table-striped"> 
                            <tr>
                                <th>Hình thức thanh toán</th>
                                <td><?php echo $hinhthuc_thanhtoan?></td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <?php
                                    if($trangthai_thanhtoan==0){
                                ?>
                                <td>Chưa thanh toán</td>
                                <?php
                                    }else{
                                ?>
                                <td>Đã thanh toán</td>
                                <?php
                                    }
                                ?>
                            </tr>
                            <?php
                            if($trangthai_thanhtoan==1){
                                if($hinhthuc_thanhtoan=='tienmat' || $hinhthuc_thanhtoan=='chuyenkhoan'){
                            ?>
                            <tr>
                                <th>Tổng thanh toán</th>
                                <td><?php echo number_format($tongtien,0,',','.')?> vnđ</td>
                            </tr>
                            <?php
                                }
                                if($hinhthuc_thanhtoan=='momo'){
                            ?>
                            <tr>
                                <th>Tổng thanh toán</th>
                                <td><?php echo number_format($tong_thanhtoan_momo,0,',','.')?> vnđ</td>
                            </tr>
                            <tr>
                                <th>Nội dung thanh toán</th>
                                <td><?php echo $noidung_thanhtoan_momo?></td>
                            </tr>
                            <tr>
                                <th>Loại thanh toán</th>
                                <td><?php echo $loai_thanhtoan_momo?></td>
                            </tr>
                            <tr>
                                <th>Loại thẻ thanh toán</th>
                                <td><?php echo $loaithe_thanhtoan_momo?></td>
                            </tr>
                            <?php
                                }
                                if($hinhthuc_thanhtoan=='vnpay'){
                            ?>
                            <tr>
                                <th>Mã ngân hàng</th>
                                <td><?php echo $ma_nganhang_vnpay?></td>
                            </tr>
                            <tr>
                                <th>Tổng thanh toán</th>
                                <td><?php echo number_format($tong_thanhtoan_vnpay/100,0,',','.')?> vnđ</td>
                            </tr>
                            <tr>
                                <th>Nội dung thanh toán</th>
                                <td><?php echo $noidung_thanhtoan_vnpay?></td>
                            </tr>
                            <tr>
                                <th>Ngày thanh toán</th>
                                <td><?php echo $ngay_thanhtoan_vnpay?></td>
                            </tr>
                            <tr>
                                <th>Loại thẻ thanh toán</th>
                                <td><?php echo $loaithe_thanhtoan_vnpay?></td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <br><h3>Thông tin Shipping</h3><br>
                        <table class="table table-striped"> 
                            <tr>
                                <th>Họ và Tên</th>
                                <td><?php echo $ten?></td>
                            </tr>
                            <tr>
                                <th>Số điện thoại</th>
                                <td><?php echo $sodienthoai?></td>
                            </tr>
                            <tr>
                                <th>Địa chỉ</th>
                                <td><?php echo $diachi?></td>
                            </tr>
                            <tr>
                                <th>Ghi chú</th>
                                <td><?php echo $ghichu?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>
