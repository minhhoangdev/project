<?php
    if(!isset($_SESSION['thanhcong']) && !isset($_SESSION['thatbai'])){
        header('Location:index.html');
    }
?>
<div class="main">
    <div class="shop_top">
        <div class="container">
            <?php if(isset($_SESSION['thanhcong'])){echo "<h2>$_SESSION[thanhcong]</h2>";}?>
            <?php if(isset($_SESSION['thatbai'])){echo "<h2>$_SESSION[thatbai]</h2>";}?>
            <p>Xem thông tin đơn hàng tại <a href="lichsudonhang.html">Lịch sử đơn hàng</a></p>
            <h1>Cảm ơn bạn đã đặt hàng, Chúng tôi sẽ liên hệ bạn sớm nhất</h1>
        </div>
    </div>
</div>
<?php
    if(isset($_SESSION['thanhcong'])){
        unset($_SESSION['thanhcong']);
    }
    if(isset($_SESSION['thatbai'])){
        unset($_SESSION['thatbai']);
    }
?>