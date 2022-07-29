<?php
	session_start();
	if(!(isset($_SESSION['dangnhap'])&& $_SESSION['dangnhap']['type']=="ADM")){
		header('Location:../index.html');
	}
?>
<!DOCTYPE html>
<head>
<title>Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="css/monthly.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>

</head>
<body>
<section id="container">
	<?php
		ob_start();//bật chế độ cache
		ob_flush();//tắt chế độ cache, giải flush data trong bộ nhớ đệm
		include('config/config.php');
		include('modules/header.php');
		include('modules/sidebar.php');
		
	?>
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">
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
					include('modules/qldanhmucsp/them.php');
					include('modules/qldanhmucsp/lietke.php');
				}
				elseif($link=="quanlydanhmucsanpham" && $query=="sua"){
					include('modules/qldanhmucsp/sua.php');
				}
				elseif($link=="quanlysanpham" && $query=="them"){
					include('modules/qlsanpham/them.php');
					include('modules/qlsanpham/lietke.php');
				}
				elseif($link=="quanlysanpham" && $query=="sua"){
					include('modules/qlsanpham/sua.php');
				}
				elseif($link=="quanlydonhang" && $query=="lietke"){
					include('modules/qldonhang/lietke.php');
				}
				elseif($link=="xemdonhang" && $query=="xemchitiet"){
					include('modules/qldonhang/chitietdonhang.php');
				}
				else{
					include('modules/home.php');
				}
			?>
		</section>
	<!--main content end-->
		<?php
			include('modules/footer.php');
		?>
	</section>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<script>
        CKEDITOR.replace('mota_tomtat');
		CKEDITOR.replace('mota');
</script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		thongke();
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		var char = new  Morris.Area({
			element: 'chart',
			padding: 10,
			behaveLikeLine: true,
			gridEnabled: false,
			gridLineColor: '#dddddd',
			axes: true,
			resize: true,
			smooth:true,
			pointSize: 0,
			lineWidth: 0,
			fillOpacity:0.85,
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'date',
            redraw: true,
            ykeys: ['order', 'sales', 'quantity'],
            labels: ['Đơn hàng', 'Doanh Thu', 'Số lượng'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		$('.select-date').change(function () {
			var thoigian=$(this).val();
			if(thoigian=='7ngay'){
				var text='7 ngày qua';
			}else if(thoigian=='28ngay'){
				var text='28 ngày qua';
			}else if(thoigian=='90ngay'){
				var text='90 ngày qua';
			}else{
				var text='365 ngày qua';
			}
			//$('#text-date').text(text);
			$.ajax({
				url:"modules/thongke.php",
				method:"POST",
				dataType:"JSON",
				data:{thoigian:thoigian},
				success:function(data){
					char.setData(data);
					$('#text-date').text(text);
				}
			});
		})
		function thongke(){
			var text='365 ngày qua';
			$('#text-date').text(text);
			$.ajax({
				url:"modules/thongke.php",
				method:"POST",
				dataType:"JSON",
				success:function(data){
					char.setData(data);
					$('#text-date').text(text);
				}
			});
		}
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="js/monthly.js"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
