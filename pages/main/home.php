<?php
  $query=mysqli_query($mysqli,"SELECT * FROM tbl_sanpham ORDER BY id_sanpham DESC LIMIT 5");
  $query_fea=mysqli_query($mysqli,"SELECT * FROM tbl_sanpham ORDER BY id_sanpham DESC LIMIT 14");
?>
<div class="banner">
    <!-- start slider -->
    <div id="fwslider">
        <div class="slider_container">
            <div class="slide"> 
                <!-- Slide image -->
                <img src="images/slideshow_1.jpg" class="img-responsive" alt=""/>
                <!-- /Slide image -->
                <!-- Texts container -->
                <!-- <div class="slide_content">
                    <div class="slide_content_wrap"> -->
                        <!-- Text title -->
                        <!-- <h1 class="title">Run Over<br>Everything</h1> -->
                        <!-- /Text title -->
                        <!-- <div class="button"><a href="#">See Details</a></div>
                    </div>
                </div> -->
                <!-- /Texts container -->
            </div>
            <!-- /Duplicate to create more slides -->
            <div class="slide">
                <img src="images/slideshow_6.jpg" class="img-responsive" alt=""/>
                <div class="slide_content">
                    <!-- <div class="slide_content_wrap">
                        <h1 class="title">Run Over<br>Everything</h1>
                        <div class="button"><a href="#">See Details</a></div>
                    </div> -->
                </div>
            </div>
            <!--/slide -->
        </div>
        <div class="timers"></div>
        <div class="slidePrev"><span></span></div>
        <div class="slideNext"><span></span></div>
    </div>
   <!--/slider -->
</div>
<div class="main">
	<div class="content-top">
		<h2>Balo</h2>
		<p>hendrerit in vulputate velit esse molestie consequat, vel illum dolore</p>
		<div class="close_but"><i class="close1"> </i></div>
			<ul id="flexiselDemo3">
        <?php
          while ($row = mysqli_fetch_array($query)){
        ?>
        <li><img src="admincp/modules/qlsanpham/uploads/<?php echo $row['hinhanh']?>" /></li>
        <?php
          }
        ?>
		</ul>
		<script type="text/javascript">
            $(window).load(function() {
                $("#flexiselDemo3").flexisel({
                    visibleItems: 5,
                    animationSpeed: 1000,
                    autoPlay: true,
                    autoPlaySpeed: 3000,    		
                    pauseOnHover: true,
                    enableResponsiveBreakpoints: true,
                    responsiveBreakpoints: { 
                        portrait: { 
                            changePoint:480,
                            visibleItems: 1
                        }, 
                        landscape: { 
                            changePoint:640,
                            visibleItems: 2
                        },
                        tablet: { 
                            changePoint:768,
                            visibleItems: 3
                        }
                    }
                });
                
            });
	    </script>
	    <script type="text/javascript" src="js/jquery.flexisel.js"></script>
	</div>
</div>
<div class="features" style="padding:1% 0;">
	<div class="container">
		<h3 class="m_3">Nổi Bật</h3>
		<div class="close_but"><i class="close1"> </i></div>
		  <div class="row">
      <?php
        while ($rows=mysqli_fetch_array($query_fea)){
      ?>
        <div class="col-md-3 top_box1">
          <div class="view view-ninth"><a href="san-pham/<?php echo $rows['id_sanpham']?>.html">
                  <img src="admincp/modules/qlsanpham/uploads/<?php echo $rows['hinhanh']?>" class="img-responsive" alt=""/>
                  <div class="mask mask-1"> </div>
                  <div class="mask mask-2"> </div>
                    <div class="content">
                      <h2><?php echo $rows['tensanpham']?></h2>
                      <p><?php echo substr($rows['mota_tomtat'],0,30)?>...</p>
                    </div>
                  </a> </div>
                <h4 class="m_4"><a href="#"><?php echo $rows['tensanpham']?></a></h4>
                <p class="m_5"><?php echo substr($rows['mota_tomtat'],0,30)?>...</p>
        </div>
      <?php
        }
      ?>
		</div>
	 </div>
</div>