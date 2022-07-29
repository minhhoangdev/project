<?php			
	if(isset($_GET['action']) && isset($_GET['query'])){
		$link=$_GET['action'];
		$query=$_GET['query'];
	}
	else{
		$link="";
		$query="";
	}
	if($link=="quanlydanhmucsanpham" && $query=="them"){
		$activedm=1;
	}
	elseif($link=="quanlydanhmucsanpham" && $query=="sua"){
		$activedm=1;
	}
	elseif($link=="quanlysanpham" && $query=="them"){
		$activesp=1;
	}
	elseif($link=="quanlysanpham" && $query=="sua"){
		$activesp=1;
	}
	elseif($link=="quanlydonhang" && $query=="lietke"){
		$activedh=1;
	}
	elseif($link=="xemdonhang" && $query=="xemchitiet"){
		$activedh=1;
	}
	else{
		$activehome=1;
	}
?>
<!--sidebar start-->
<aside>
	<div id="sidebar" class="nav-collapse">
		<!-- sidebar menu start-->
		<div class="leftside-navigation">
			<ul class="sidebar-menu" id="nav-accordion">
				<li>
					<a  <?php if(isset($activehome)) echo'class="active"'?> href="index.php">
						<i class="fa fa-dashboard"></i>
						<span>Dashboard</span>
					</a>
				</li>
				
				<li class="sub-menu">
					<a <?php if(isset($activedm)||isset($activesp)||isset($activedh)) echo'class="active"'?> href="javascript:;">
						<i class="fa fa-book"></i>
						<span>Quản lý</span>
					</a>
					<ul class="sub">
						<li><a <?php if(isset($activedm)) echo'class="active"'?> href="index.php?action=quanlydanhmucsanpham&query=them">Danh mục </a></li>
						<li><a <?php if(isset($activesp)) echo'class="active"'?> href="index.php?action=quanlysanpham&query=them">Sản phẩm </a></li>
						<li><a <?php if(isset($activedh)) echo'class="active"'?> href="index.php?action=quanlydonhang&query=lietke">Đơn hàng </a></li>
					</ul>
				</li>

			</ul>            
		</div>
		<!-- sidebar menu end-->
	</div>
</aside>
<!--sidebar end-->