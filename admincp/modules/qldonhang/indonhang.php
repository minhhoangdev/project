<?php
    require_once('../../../tfpdf/tfpdf.php');
    include('../../config/config.php');

    if(isset($_GET['ma_giohang'])){
        $ma_giohang = $_GET['ma_giohang'];
    }
    $query=mysqli_query($mysqli,"SELECT * FROM tbl_chitietgiohang as a,tbl_sanpham as b 
    WHERE a.id_sanpham=b.id_sanpham and ma_giohang='$ma_giohang'");

    $pdf = new tFPDF();
    $pdf->AddPage("0");//0: in theo chiều ngang
    //$pdf->SetFont('Arial','B',16);
    // Add a Unicode font (uses UTF-8)
    $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
    $pdf->SetFont('DejaVu','',15);


    $pdf->SetfillColor(193,229,252);

    
    // Move to 8 cm to the right
    $pdf->Cell(80);
    // // Centered text in a framed 20*10 mm cell and line break
    // $pdf->Cell(20,10,'Title',0,1,'C');
    $pdf->Write(10,'Hóa đơn bán Balo');
    $pdf->Ln(10);

    $pdf->Write(10,'Đơn hàng của bạn gồm có:');
	$pdf->Ln(10);

	$width_cell=array(10,35,80,25,30,40);

	$pdf->Cell($width_cell[0],10,'STT',1,0,'C',true);
	$pdf->Cell($width_cell[1],10,'Mã hàng',1,0,'C',true);
	$pdf->Cell($width_cell[2],10,'Tên sản phẩm',1,0,'C',true);
	$pdf->Cell($width_cell[3],10,'Số lượng',1,0,'C',true); 
	$pdf->Cell($width_cell[4],10,'Giá',1,0,'C',true);
	$pdf->Cell($width_cell[5],10,'Thành tiền',1,1,'C',true); 
	$pdf->SetFillColor(235,236,236); 
	$fill=false;
	$i = 0;
    $tongtien=0;
	while($row = mysqli_fetch_array($query)){
		$i++;
        $tongtien+=$row[3]*$row['dongia'];
        $pdf->Cell($width_cell[0],10,$i,1,0,'C',$fill);
        $pdf->Cell($width_cell[1],10,$row['ma_giohang'],1,0,'C',$fill);
        $pdf->Cell($width_cell[2],10,$row['tensanpham'],1,0,'C',$fill);
        $pdf->Cell($width_cell[3],10,$row[3],1,0,'C',$fill);
        $pdf->Cell($width_cell[4],10,number_format($row['dongia'],0,',','.'),1,0,'C',$fill);
        $pdf->Cell($width_cell[5],10,number_format($row[3]*$row['dongia'],0,',','.'),1,1,'C',$fill);
        $fill = !$fill;
	}
    $pdf->Write(10,'Tổng Tiền:'.number_format($tongtien,0,',','.').' vnđ');
    $pdf->Ln(10);
    $pdf->Cell(70);
	$pdf->Write(10,'Cảm ơn bạn đã đặt hàng tại website của chúng tôi.');
	$pdf->Ln(10);
    $pdf->Cell(150);
    $pdf->Write(10,'......,Ngày......Tháng......Năm.......');
    $pdf->Ln(10);
    $pdf->Cell(185);
    $pdf->Write(10,'Ký tên');
    $pdf->Output();
?>