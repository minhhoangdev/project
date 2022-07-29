<?php
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    require('../carbon/autoload.php');

    $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $ma_giohang=$_GET['ma_giohang'];
    $id_giohang=$_GET['id_giohang'];



    // $query=mysqli_query($mysqli,"SELECT * FROM tbl_chitietgiohang as a,tbl_sanpham as b 
    //                     WHERE a.id_sanpham=b.id_sanpham and ma_giohang='$ma_giohang'");
    $query=mysqli_query($mysqli,"SELECT * FROM tbl_chitietgiohang as a,tbl_sanpham as b,tbl_shipping as c
                         WHERE a.id_sanpham=b.id_sanpham and ma_giohang='$ma_giohang' and c.id_user=".$_GET['id_user']." ");
    
    //duyệt đơn
    if(isset($_POST['duyetdon'])){
        mysqli_query($mysqli,"UPDATE tbl_giohang SET trangthai_giohang=2 WHERE id_giohang='$id_giohang'");

        $doanhthu=0;
        $soluongban=0;
        //lấy ra tổng số lượng và tổng tiền của đơn hàng
        while ($row =mysqli_fetch_array($query)){
            $doanhthu+=$row[3]*$row['dongia'];
            $soluongban+=$row[3];
        }

        $sql_thongke="SELECT * FROM tbl_thongke WHERE ngaydat='$now'";
        $query_thongke=mysqli_query($mysqli,$sql_thongke);
        if(mysqli_num_rows($query_thongke)==0){
            $donhang=1;
            mysqli_query($mysqli,"INSERT INTO tbl_thongke(ngaydat,donhang,doanhthu,soluongban) 
                                    VALUE('".$now."','".$donhang."','".$doanhthu."','".$soluongban."')");

        }
        if(mysqli_num_rows($query_thongke)==1){
            while($row =mysqli_fetch_array($query_thongke)){
                $donhang_cu=$row['donhang'];
                $doanhthu_cu=$row['doanhthu'];
                $soluongban_cu=$row['soluongban'];
            }
            $donhang=$donhang_cu+1;
            $doanhthumoi=$doanhthu_cu+$doanhthu;
            $soluongbanmoi=$soluongban_cu+$soluongban;
            mysqli_query($mysqli,"UPDATE tbl_thongke SET donhang='".$donhang."',doanhthu='".$doanhthumoi."',soluongban='".$soluongbanmoi."'
                                    WHERE ngaydat='$now'");
        }
        header('Location:index.php?action=quanlydonhang&query=lietke');
    }

    //lấy ra trạng thái giỏ hàng
    $query_giohang=mysqli_query($mysqli,"SELECT * FROM tbl_giohang WHERE id_giohang='$id_giohang'");
    while($row=(mysqli_fetch_array($query_giohang))){
        $trangthai=$row['trangthai_giohang'];
    }

?>

<div class="col-md-12 stats-info stats-last widget-shadow">
	<div class="stats-last-agile">
        <a href="?action=quanlydonhang&query=lietke" class="btn btn-info">Tất cả đơn hàng</a>
        <?php 
            if($trangthai==1){
        ?>
        <form action="" method="POST">
           <input type="submit" name="duyetdon" value="Duyệt Đơn" class="btn btn-info" style="float: right;">  
        </form>
       <?php 
            }
            if($trangthai==2){
       ?>
        <h3 style="float: right; color:teal">Đã Duyệt</h3>
       <?php 
            }
       ?>
		<table class="table stats-table ">
			<thead>
				<tr>
                    <th>STT</th>
					<th>MÃ ĐƠN HÀNG</th>
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
                    $thanhtien=0;
                    while($row=(mysqli_fetch_array($query))){
                        $thanhtien+=$row['dongia']*$row[3];
                        $ten=$row['ten'];
                        $sodienthoai=$row['sodienthoai'];
                        $diachi=$row['diachi'];
                        $ghichu=$row['ghichu'];
                        $i++;
                        $option=unserialize($row['options']);
                ?>
				<tr>
                    <td><?php echo $i?></td>
					<td><?php echo$row['ma_giohang']?></td>
					<td><?php echo$row['tensanpham']?></td>
                    <td><img src="modules/qlsanpham/uploads/<?php echo$row['hinhanh']?>" alt="" width="60"></td>
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
        <p style="float: right;">Tổng    Tiền: <?php echo number_format($thanhtien,0,',','.')?> vnđ</p>
        <?php
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
                                        WHERE a.id_sanpham=b.id_sanpham and ma_giohang='$ma_giohang' and c.id_user=".$_GET['id_user']."")
        ?>
        <div class="row">
            <div class="col-md-6">
                <br><h3>Thông tin Thanh Toán</h3>
                <table class="table stats-table"> 
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
                <h3>Thông tin Shipping</h3>
                <table class="table stats-table"> 
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
</div>