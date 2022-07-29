<!DOCTYPE HTML>
<html>
<head>
<!--Thay đổi đường dẫn khi sử dụng host khác-->
<base href="http://localhost:8080/Web_phpThuan/"/>

<title>Shop Balo</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery.min.js"></script>
<!-- <script src="js/jquery.easydropdown.js"></script> -->
<!--start slider -->
<link rel="stylesheet" href="css/fwslider.css" media="all">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<script src="js/jquery-ui.min.js"></script>
<script src="js/fwslider.js"></script>
<!--end slider -->
<script type="text/javascript">
        $(document).ready(function() {
            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });
                        
            $(".dropdown dd ul li a").click(function() {
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });
                        
            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            // $(document).bind('click', function(e) {
            //     var $clicked = $(e.target);
            //     if (!$clicked.parents().hasClass("dropdown"))
            //         $(".dropdown dd ul").hide();
            // });
            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });
        });
</script>
 <!----details-product-slider--->
<!-- Include the Etalage files -->
<link rel="stylesheet" href="css/etalage.css">
<script src="js/jquery.etalage.min.js"></script>
<!-- Include the Etalage files -->
<script>
		jQuery(document).ready(function($){
			$('#etalage').etalage({
				thumb_image_width: 300,
				thumb_image_height: 400,
				
				show_hint: true,
				click_callback: function(image_anchor, instance_id){
					alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
				}
			});
			// This is for the dropdown list example:
			$('.dropdownlist').change(function(){
				etalage_show( $(this).find('option:selected').attr('class') );
			});
	});
</script>
<!----//details-product-slider--->	

</head>
<body>
</div>
	<?php
        ob_start();//bật chế độ cache
        ob_flush();//tắt chế độ cache, giải flush data trong bộ nhớ đệm
        session_start();
        include("admincp/config/config.php");
        include("pages/header.php");
        include("pages/main.php");
        include("pages/footer.php");
        //ob_flush();
        
    ?>
    
    <style type="text/css">
        /* jQuery Demo */

        .clearfix:after {
        clear: both;
        content: "";
        display: block;
        height: 0;
        }

        /* Responsive Arrow Progress Bar */

        .container {
        font-family: 'Lato', sans-serif;
        }

        .arrow-steps .step {
        font-size: 14px;
        text-align: center;
        color: #777;
        cursor: default;
        margin: 0 1px 0 0;
        padding: 10px 0px 10px 0px;
        width: 15%;
        float: left;
        position: relative;
        background-color: #ddd;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        .arrow-steps .step a {
        color: #777;
        text-decoration: none;
        }

        .arrow-steps .step:after,
        .arrow-steps .step:before {
        content: "";
        position: absolute;
        top: 0;
        right: -17px;
        width: 0;
        height: 0;
        border-top: 19px solid transparent;
        border-bottom: 17px solid transparent;
        border-left: 17px solid #ddd;
        z-index: 2;
        }

        .arrow-steps .step:before {
        right: auto;
        left: 0;
        border-left: 17px solid #fff;
        z-index: 0;
        }

        .arrow-steps .step:first-child:before {
        border: none;
        }

        .arrow-steps .step:last-child:after {
         border: none;
        }

        .arrow-steps .step:first-child {
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
        }

        .arrow-steps .step:last-child {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
        }

        .arrow-steps .step span {
        position: relative;
        }

        *.arrow-steps .step.done span:before {
        opacity: 1;
        content: "";
        position: absolute;
        top: -2px;
        left: -10px;
        font-size: 11px;
        line-height: 21px;
        }

        .arrow-steps .step.current {
        color: #fff;
        background-color: #5599e5;
        }

        .arrow-steps .step.current a {
        color: #fff;
        text-decoration: none;
        }

        .arrow-steps .step.current:after {
        border-left: 17px solid #5599e5;
        }

        .arrow-steps .step.done {
        color: #173352;
        background-color: #2f69aa;
        }

        .arrow-steps .step.done a {
        color: #173352;
        text-decoration: none;
        }

        .arrow-steps .step.done:after {
        border-left: 17px solid #2f69aa;
        }
    </style>
    <script src="https://www.paypal.com/sdk/js?client-id=ASRpBZ4Su5w5jfLueo9zqCPxnuJPX50qE9HOrilDhI4iItJ57UxTwA7xUMdR7vc5Nk1HWxMwlW2lH1s9&currency=USD"></script>
    <script>
      paypal.Buttons({

        // Sets up the transaction when a payment button is clicked
        createOrder: function(data, actions) {
          var tongtien=document.getElementById('tongtien').value;
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: tongtien // Can reference variables or functions. Example: `value: document.getElementById('...').value`
              }
            }]
          });
        },

        // Finalize the transaction after payer approval
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                window.location.replace('http://localhost:8080/Web_phpThuan/pages/main/thanhtoanthanhcong.php?thanhtoan=paypal');

            // When ready to go live, remove the alert and show a success message within this page. For example:
            // var element = document.getElementById('paypal-button-container');
            // element.innerHTML = '';
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');
          });
        },
        onCancle:function(data){
            window.location.replace('http://localhost:8080/Web_phpThuan/index.php?quanly=thanhtoan');
        }
      }).render('#paypal-button-container');

    </script>
</body>	
</html>