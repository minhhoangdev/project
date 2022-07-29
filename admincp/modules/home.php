<?php
	$query=mysqli_query($mysqli,"SELECT * FROM tbl_giohang");
	$count_order=mysqli_num_rows($query);

	//tong huy don
	$query_huydon=mysqli_query($mysqli,"SELECT * FROM tbl_giohang WHERE trangthai_giohang=0");
	$count_huydon=mysqli_num_rows($query_huydon);

	//tong doanh thu
	$query_total=mysqli_query($mysqli,"SELECT tongtien FROM tbl_giohang WHERE trangthai_giohang=2");
	$total=0;
	while($row_total=mysqli_fetch_array($query_total)){
		$total+=$row_total[0];
	}

	//tong don moi
	$query_order_new=mysqli_query($mysqli,"SELECT * FROM tbl_giohang WHERE trangthai_giohang=1");
	$total_order_new=mysqli_num_rows($query_order_new);
	
?>
		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-trash" style="font-size: 3em;color: #fff; text-align: left;"></i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>Tổng Đơn Hủy</h4>
					<h3><?php echo $count_huydon?></h3>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-cart-plus" style="font-size: 3em;color: #fff; text-align: left;"></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Tổng Đơn Mới</h4>
						<h3><?php echo $total_order_new?></h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Tổng Doanh Thu</h4>
						<h3><?php echo number_format($total,0,',','.')?></h3>
						<!-- <p>Other hand, we denounce</p> -->
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Tổng Đơn Hàng</h4>
						<h3><?php echo $count_order?></h3>
						<!-- <p>Other hand, we denounce</p> -->
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
		<!-- //market-->
		<div class="row">
			<div class="panel-body">
				<div class="col-md-12 w3ls-graph">
					<!--agileinfo-grap-->
						<div class="agileinfo-grap">
							<div class="agileits-box">
								<header class="agileits-box-header clearfix">
									<p>Thống kê theo: <span id="text-date"></span></p>
									<select class="select-date" name="" id="">
										<option value="7ngay">7 Ngày</option>
										<option value="28ngay">28 Ngày</option>
										<option value="90ngay">90 Ngày</option>
										<option value="365ngay">365 Ngày</option>
									</select>
									<h3>Thống kê đơn hàng</h3>
										<div class="toolbar">
										</div>
								</header>
								<div class="agileits-box-body clearfix">
									<div id="chart"></div>
								</div>
							</div>
						</div>
		<!--//agileinfo-grap-->

				</div>
			</div>
		</div>
