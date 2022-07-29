<div class="main">
    <div class="shop_top">
        <div class="container">
            <?php
                if(isset($_SESSION['cart'])){
                    $tongtien=0;
            ?>
            <!-- Responsive Arrow Progress Bar -->
            <div class="arrow-steps clearfix" style="margin-bottom:55px;">
                <div class="step current"> <span><a href="giohang.html" ><i class="fas fa-shopping-cart"></i> Giỏ hàng</a></span> </div>
                <div class="step"> <span><i class="fas fa-truck"></i> Giao hàng</span> </div>
                <div class="step"> <span><i class="far fa-credit-card"></i> Thanh toán</div>
                <div class="step"> <span><i class="fas fa-align-justify"></i> Đơn hàng chi tiết<span> </div>
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
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <style type="text/css">
                        a:hover{
                            text-decoration: none;
                        }
                        a{
                            color:#333;
                        }
                    </style>
                    <?php 
                        foreach($_SESSION['cart'] as $item){ 
                            $thanhtien=$item['soluong']*$item['dongia'];
                            $tongtien+=$thanhtien;
                            $options=unserialize($item['options']);
                    ?>
                    <tr>
                        <th scope="row"><?php echo $item['masanpham']?></th>
                        <td><a href="san-pham/<?php echo $item['id_sanpham']?>.html"><?php echo $item['tensanpham']?></a></td> 
                        <td><a href="san-pham/<?php echo $item['id_sanpham']?>.html"><img src="admincp/modules/qlsanpham/uploads/<?php echo $item['hinhanh']?>"  width="65"alt=""></a></td>
                        <td>Size: <?php echo $options['size'] ?><br>Color: <?php echo $options['color']?></td>
                        <td>
                            <a href="pages/main/xulygiohang.php?giohang=tangsoluong&id_sanpham=<?php echo $item['id_sanpham']?>"><i class="fas fa-plus"></i></a>
                                <span style="padding: 6px;"><?php echo $item['soluong']?></span>
                            <a href="pages/main/xulygiohang.php?giohang=giamsoluong&id_sanpham=<?php echo $item['id_sanpham']?>"><i class="fas fa-minus"></i></a></td>
                        <td><?php echo number_format($item['dongia'],0,',','.')?> vnđ</td>
                        <td><?php echo number_format($thanhtien,0,',','.')?> vnđ</td>
                        <td><a href="pages/main/xulygiohang.php?giohang=xoa&id_sanpham=<?php echo $item['id_sanpham']?>" class="btn text-danger"><i class="fas fa-times"></i></a></td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
            <div>
                <a href="pages/main/xulygiohang.php?giohang=xoatatca" class="btn btn-warning"><i class="fas fa-trash"></i> Xóa tất cả</a>
                <?php
                    if(!isset($_SESSION['dangnhap']) && !isset($_SESSION['dangky'])){
                ?>
                <a href="dangnhap.html" class="btn btn-info">Đăng nhập để đặt hàng</a>
                <?php
                    }else{
                ?>
                <a href="giaohang.html" class="btn btn-info">Đặt hàng</a>
                <?php
                    }
                ?>
                <p style="float: right;margin-right: 85px;">Tổng tiền: <?php echo number_format($tongtien,0,',','.')?> vnđ</p>
            </div>
            <?php
            }else{
            ?>
                <div style="text-align: center;">
                    <h1>Không có sản phẩm trong giỏ hàng</h1>
                    <a href="shop.html" class="btn btn-success">Mua Sắm ngay</a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
