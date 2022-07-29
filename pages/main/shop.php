<?php
	if(isset($_GET['trang'])){
		$trang=$_GET['trang'];
	}
	else{
		$trang=1;
	}
	if($trang==1){
		$begin=0;
	}else{
		$begin=($trang*8)-8;
	}

	$sql_sp="SELECT * FROM tbl_sanpham as a, tbl_danhmuc as b WHERE a.id_danhmuc=b.id_danhmuc ORDER BY a.id_sanpham DESC LIMIT $begin,8";
	$query_sp=mysqli_query($mysqli,$sql_sp);
	
	$query_phantrang=mysqli_query($mysqli,"SELECT * FROM tbl_sanpham");
	$count=mysqli_num_rows($query_phantrang);
	$so_trang=ceil($count/8);//ceil:làm tròn 

	$query_dm=mysqli_query($mysqli,"SELECT * FROM tbl_danhmuc");
?>
<div class="main">
	<div class="shop_top">
		<div class="container">
			<div class="col-md-12">
				<div class="col-md-2">
					<h2>Danh mục</h2>
					<ul class="team_list" style="margin-top: 24px;">
						<?php
							while($row_dm=mysqli_fetch_array($query_dm)){
						?>
						<li><a href="?quanly=q_danhmuc&id_danhmuc=<?php echo $row_dm['id_danhmuc']?>"><?php echo$row_dm['tendanhmuc']?></a></li>
						<?php
							}
						?>
					</ul>
				</div>
				<div class="col-md-10">
					<h2 style="text-align:center;margin-bottom:20px">Sản phẩm</h2>
					<div class="row shop_box-top">
						<?php 
							while($row=mysqli_fetch_array($query_sp)){				
						?>
						<div class="col-md-3 shop_box"><a href="san-pham/<?php echo $row['id_sanpham']?>.html">
							<img src="admincp/modules/qlsanpham/uploads/<?php echo $row['hinhanh']?>" class="img-responsive" alt=""/>
							<span class="new-box">
								<span class="new-label">New</span>
							</span>
							<span class="sale-box">
								<span class="sale-label">Sale!</span>
							</span>
							<div class="shop_desc">
								<h3><a href="#"><?php echo $row['tensanpham']?></a></h3>
								<p><?php echo substr($row['mota_tomtat'],0,20)?>...</p>
								<!-- <span class="reducedfrom">200.000 vnđ</span> -->
								<span class="actual"><?php echo number_format($row['dongia'],0,',','.')?> vnđ</span><br>
								<ul class="buttons">
									<li class="cart"><a href="pages/main/xulygiohang.php?giohang=them&id_sanpham=<?php echo $row['id_sanpham']?>">Thêm vào giỏ hàng</a></li>
									<div class="clear"> </div>
								</ul>
							</div>
						</a></div>
						<?php
						}
						?>
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
							<li <?php if($i==$trang){echo 'Style="background:red"';}?>><a href="shop/trang-<?php echo $i?>.html"><span><?php echo $i?></span></a></li>
							<?php 
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

