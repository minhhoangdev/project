<?php
session_start();
header('Content-type: text/html; charset=utf-8');

include('helper.php');

$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa'; 

$tongtien=0;
foreach($_SESSION['cart'] as $item){ 
    $thanhtien=$item['soluong']*$item['dongia'];
    $tongtien+=$thanhtien;
}
$ma_giohang=bin2hex(random_bytes(2)).'_'.rand(0,9999);
$_SESSION['ma_giohang']=$ma_giohang;


$orderInfo = "Thanh toán qua MoMo";
$amount = $tongtien;//tổng tiền
$orderId = time()."";
$redirectUrl = "http://localhost:8080/Web_phpThuan/pages/main/thanhtoanthanhcong.php";
$ipnUrl = "http://localhost:8080/Web_phpThuan/pages/main/thanhtoanthanhcong.php";
$extraData = "";

$requestId = time() . "";
$requestType = "captureWallet";
$extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
//before sign HMAC SHA256 signature
$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
$signature = hash_hmac("sha256", $rawHash, $secretKey);
$data = array('partnerCode' => $partnerCode,
    'partnerName' => "Test",
    "storeId" => "MomoTestStore",
    'requestId' => $requestId,
    'amount' => $amount,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature);
$result = execPostRequest($endpoint, json_encode($data));
$jsonResult = json_decode($result, true);  // decode json
//Just a example, please check more in there
header('Location: ' . $jsonResult['payUrl']);
?>