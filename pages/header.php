<?php
    if(isset($_GET['dangxuat'])){
        unset($_SESSION['dangnhap']);
        unset($_SESSION['dangky']);
        // $_SESSION['cart_cu']=$_SESSION['cart'];
        // unset($_SESSION['cart']);
        header('Location:dangnhap.html');
    }
    if(isset($_POST['search'])){
        $value=$_POST['tukhoa'];
        if(isset($_GET['quanly']) && $_GET['quanly']=='q_danhmuc'){
            header("Location:index.php?quanly=q_danhmuc&id_danhmuc=".$_GET['id_danhmuc']."&tukhoa=".$value."");
        }else{
            header("Location:index.php?quanly=timkiem&tukhoa=".$value."");
        }
    }
?>
<div class="header">
	<div class="container">
		<div class="row">
		    <div class="col-md-12">
                <div class="header-left">
                    <div class="logo">
                        <a href="index.html"><img src="images/logo.png" alt=""/></a>
                    </div>
                    <div class="menu">
                        <a class="toggleMenu" href="#"><img src="images/nav.png" alt="" /></a>
                        <ul class="nav" id="nav">
                            <li><a href="shop.html">Shop</a></li>
                            <li><a href="tintuc.html">Tin tức</a></li>
                            <li><a href="giohang.html">Giỏ hàng</a></li>
                            <li><a href="lienhe.html">Liên hệ</a></li>
                            <?php 
                                if(!isset($_SESSION['dangnhap']) && !isset($_SESSION['dangky'])){
                            ?>
                            <li><a href="dangnhap.html">Đăng nhập</a></li>
                            <?php
                            }
                            ?>					
                            <div class="clear"></div>
                        </ul>
                            <script type="text/javascript" src="js/responsive-nav.js"></script>
                    </div>
                   			
                    <div class="clear"></div>
                </div>
                <div class="header_right">
                    <!-- start search-->
                    <div class="search-box">
                        <style>
                            input:-webkit-autofill,
                            input:-webkit-autofill:hover,
                            input:-webkit-autofill:focus,
                            input:-webkit-autofill:active {
                                -webkit-transition: "color 9999s ease-out, background-color 9999s ease-out";
                                -webkit-transition-delay: 9999s;
                            }
                        </style>
                        <div id="sb-search" class="sb-search">
                            <form method="POST">
                                <input class="sb-search-input" placeholder="Nhập tên sản phẩm..." type="search" name="tukhoa" id="search">
                                <input class="sb-search-submit" name="search" type="submit" value="timkiem">
                                <span class="sb-icon-search"> </span>
                            </form>
                        </div>
                    </div>
                    <!----search-scripts---->
                    <script src="js/classie.js"></script>
                    <script src="js/uisearch.js"></script>
                    <script>
                        new UISearch( document.getElementById( 'sb-search' ) );
                    </script>
                    <!----//search-scripts---->
                    <ul class="icon1 sub-icon1 profile_img">
                        <li>
                            <a class="active-icon c1" href="javascript::"> </a>
                            <?php
                                if(isset($_SESSION['cart'])){
                                    
                            ?>
                            <ul class="sub-icon1 list">
                                <?php
                                    foreach($_SESSION['cart'] as $item){
                                ?>
                                <div class="product_control_buttons">
                                    <a href="giohang.html"><img src="images/edit.png" alt=""/></a>
                                        <a href="pages/main/xulygiohang.php?giohang=xoa&id_sanpham=<?php echo $item['id_sanpham']?>"><img src="images/close_edit.png" alt=""/></a>
                                </div>
                                <div class="clear"></div>
                                <li class="list_img"><img src="admincp/modules/qlsanpham/uploads/<?php echo $item['hinhanh']?>"  width="50"alt=""/></li>
                                <li class="list_desc"><h4><a href="#"><?php echo $item['tensanpham']?></a></h4><span class="actual"><?php echo $item['soluong']?> x
                                <?php echo number_format($item['dongia'],0,',','.')?> vnđ</span></li>
                                <div class="login_buttons">
                                    <div class="check_button"></div>
                                </div>
                                <?php
                                    }
                                ?>
                                <div class="login_buttons">
                                    <div class="check_button"><a href="?quanly=dathang">Đặt hàng</a></div>
                                    <div class="clear"></div>
                                </div>
                            </ul>
                            <?php
                                }
                            ?>
                        </li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <?php 
                     if(isset($_SESSION['dangnhap'])){
                         if($_SESSION['dangnhap']['type']=="ADM"){
                ?>
                    <dl id="sample" class="dropdown">
                        <dt><a href="javascript::"><span>Tài khoản (<?php echo$_SESSION['dangnhap']['ho'];echo $_SESSION['dangnhap']['ten']?>)</span></a></dt>
                        <dd>
                            <ul>
                                <li><a href="admincp/index.php" >Admin Home</a></li>
                                <li><a href="index.php?dangxuat">Đăng xuất</a></li>
                            </ul>
                        </dd>
                    </dl>
                <?php
                        }else{
                ?>	
                    <dl id="sample" class="dropdown">
                        <dt><a href="javascript::"><span>Tài khoản (<?php echo$_SESSION['dangnhap']['ho'];echo $_SESSION['dangnhap']['ten']?>)</span></a></dt>
                        <dd>
                            <ul>
                                <li><a href="lichsudonhang.html">Lịch sử đơn hàng</a></li>
                                <li><a href="doimatkhau.html">Đổi mật khẩu</a></li>
                                <li><a href="index.php?dangxuat">Đăng xuất</a></li>
                            </ul>
                        </dd>
                    </dl>
                <?php
                        }
                    }
                ?>
                <?php 
                     if(isset($_SESSION['dangky'])){
                         if($_SESSION['dangky']['type']=="USR"){
                ?>
                    <dl id="sample" class="dropdown">
                        <dt><a href="javascript::"><span>Tài khoản (<?php echo$_SESSION['dangky']['ho'];echo $_SESSION['dangky']['ten']?>)</span></a></dt>
                        <dd>
                            <ul>
                                <li><a href="lichsudonhang.html">Lịch sử đơn hàng</a></li>
                                <li><a href="doimatkhau.html">Đổi mật khẩu</a></li>
                                <li><a href="index.php?dangxuat">Đăng xuất</a></li>
                            </ul>
                        </dd>
                    </dl>
                <?php
                        }
                    }
                ?>					
            </div>
	    </div>
    </div>
</div>