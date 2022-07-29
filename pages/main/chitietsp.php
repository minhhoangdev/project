<?php
	$sql_sp="SELECT * FROM tbl_sanpham as a,tbl_danhmuc as b 
	WHERE a.id_danhmuc=b.id_danhmuc and a.id_sanpham='$_GET[id_sanpham]' LIMIT 1";
	$query=mysqli_query($mysqli,$sql_sp);

	if(isset($_POST['them'])){
		$soluong=$_POST['select_soluong'];
		if(isset($_SESSION['size']) || isset($_SESSION['color'])){
			header("Location:../../pages/main/xulygiohang.php?giohang=them&id_sanpham=".$_GET['id_sanpham']."&soluong=".$soluong."");
		}else{
			header("Location:../pages/main/xulygiohang.php?giohang=them&id_sanpham=".$_GET['id_sanpham']."&soluong=".$soluong."");
		}
	}
	$id_danhmuc;

?>
<div class="main">
    <div class="shop_top">
		<div class="container">
			<?php
				while($row=mysqli_fetch_array($query)){
					$id_danhmuc=$row['id_danhmuc'];
			?>
			<form action="" method="post"></form>
			<div class="row">
				<div class="col-md-9 single_left">
				   <div class="single_image">
					     <ul id="etalage">
							<li>
								<img class="etalage_thumb_image" src="admincp/modules/qlsanpham/uploads/<?php echo $row['hinhanh']?>" />
								<img class="etalage_source_image" src="admincp/modules/qlsanpham/uploads/<?php echo $row['hinhanh']?>" />
							</li>
							<!-- <li>
								<img class="etalage_thumb_image" src="images/4.jpg" />
								<img class="etalage_source_image" src="images/4.jpg" />
							</li> -->
						</ul>
					    </div>
				        <!-- end product_slider -->
				        <div class="single_right">
				        	<h3><?php echo $row['tensanpham']?> </h3>
				        	<p class="m_10"><?php echo $row['mota_tomtat']?></p>
				        	<ul class="options">
								<h4 class="m_12">Chọn size(cm)</h4>
								<li><a href="san-pham/<?php echo $row['id_sanpham']?>/size=145.html">145</a></li>
								<li><a href="san-pham/<?php echo $row['id_sanpham']?>/size=148.html">148</a></li>
								<li><a href="san-pham/<?php echo $row['id_sanpham']?>/size=151.html">151</a></li>
								<li><a href="san-pham/<?php echo $row['id_sanpham']?>/size=156.html">156</a></li>
								<li><a href="san-pham/<?php echo $row['id_sanpham']?>/size=163.html">163</a></li>
							</ul>
				        	<ul class="product-colors">
								<h3>Chọn màu</h3>
								<li><a class="color1" href="san-pham/<?php echo $row['id_sanpham']?>/color=green.html"><span> </span></a></li>
								<li><a class="color2" href="san-pham/<?php echo $row['id_sanpham']?>/color=blue.html"><span> </span></a></li>
								<li><a class="color3" href="san-pham/<?php echo $row['id_sanpham']?>/color=violet.html"><span> </span></a></li>
								<li><a class="color4" href="san-pham/<?php echo $row['id_sanpham']?>/color=grey.html"><span> </span></a></li>
								<li><a class="color5" href="san-pham/<?php echo $row['id_sanpham']?>/color=yellow.html"><span> </span></a></li>
								<li><a class="color6" href="san-pham/<?php echo $row['id_sanpham']?>/color=red.html"><span> </span></a></li>
								<div class="clear"> </div>
							</ul>
							<ul class="add-to-links">
    			              <li><img src="images/wish.png" alt=""><a href="javascript::">Thêm vào sản phẩm yêu thích</a></li>
    			            </ul>
							<div class="social_buttons">
								<h4>95 Items</h4>
								<button type="button" class="btn1 btn1-default1 btn1-twitter" onclick="">
					              <i class="icon-twitter"></i> Tweet
					            </button>
					            <button type="button" class="btn1 btn1-default1 btn1-facebook" onclick="">
					              <i class="icon-facebook"></i> Share
					            </button>
					             <button type="button" class="btn1 btn1-default1 btn1-google" onclick="">
					              <i class="icon-google"></i> Google+
					            </button>
					            <button type="button" class="btn1 btn1-default1 btn1-pinterest" onclick="">
					              <i class="icon-pinterest"></i> Pinterest
					            </button>
					        </div>
				        </div>
				        <div class="clear"> </div>
				</div>
				<div class="col-md-3">
				  <div class="box-info-product">
					<p class="price2"><?php echo number_format( $row['dongia'],0,',','.')?> vnđ</p>
					    <form method="POST">
							<ul class="prosuct-qty">
								<span>Số lượng:</span>
								<select name="select_soluong">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
								</select>
							</ul>
							<?php
								if(isset($_GET['size']) || isset($_GET['color'])){
							?>
							<ul class="add-to-links">
    			              <li><p>
								  	<?php	
									  	if(isset($_GET['size'])){
											$_SESSION['size'] = $_GET['size'];
									  	}
										if(isset($_GET['color'])){
											$_SESSION['color'] = $_GET['color'];
										}
										if(isset($_SESSION['size'])){
											echo 'Size: '.$_SESSION['size'];
										}
										if(isset($_SESSION['color'])){
											echo '  Color: '.$_SESSION['color'];
										}
							  		?>
							  </p></li>
    			            </ul><br>
							<?php
								}
							?>
							<button type="submit" name="them" class="exclusive" value="themgiohang">
								<span style="font-size:12px">Thêm vào giỏ hàng</span>
							</button>
						</form>
				   </div>
			   </div>
			</div>		
			<div class="desc">
			   	<h4>Mô tả</h4>
			   	<p><?php echo $row['mota']?></p>
			</div>
			<?php 
			}
			?>
			<div class="row">
				<h4 class="m_11">Sản phẩm cùng danh mục</h4>
				<?php
					$query_sp_cung_dm=mysqli_query($mysqli,"SELECT * FROM tbl_sanpham WHERE id_danhmuc=$id_danhmuc ORDER BY RAND() Limit 3");
					while($rows=mysqli_fetch_assoc($query_sp_cung_dm)){
						if($rows['id_sanpham']!=$_GET['id_sanpham']){
				?>
				<div class="col-md-4 product1">
					<img src="admincp/modules/qlsanpham/uploads/<?php echo $rows['hinhanh']?>" class="img-responsive" alt=""/> 
					<div class="shop_desc"><a href="san-pham/<?php echo $rows['id_sanpham']?>.html">
						</a><h3><a href="san-pham/<?php echo $rows['id_sanpham']?>.html"></a><a href="san-pham/<?php echo $rows['id_sanpham']?>.html"><?php echo $rows['tensanpham']?></a></h3>
						<p><?php echo substr($rows['mota_tomtat'],0,30)?> </p>
						<!-- <span class="reducedfrom">$66.00</span> -->
						<span class="actual"><?php echo $rows['dongia']?> vnđ</span><br>
						<ul class="buttons">
							<li class="cart"><a href="pages/main/xulygiohang.php?giohang=them&id_sanpham=<?php echo $rows['id_sanpham']?>">Add To Cart</a></li>
							<li class="shop_btn"><a href="san-pham/<?php echo $rows['id_sanpham']?>.html">Read More</a></li>
							<div class="clear"> </div>
					    </ul>
				    </div>
				</div>
				<?php
					}
				}
				?>
			</div>	
	    </div>
	</div>
</div>