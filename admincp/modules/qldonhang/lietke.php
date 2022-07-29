<?php
    $query=mysqli_query($mysqli,"SELECT * FROM tbl_giohang as a,tbl_user as b WHERE a.id_user=b.id_user ORDER BY ngaydat DESC");
	$query_user=mysqli_query($mysqli,"SELECT * FROM tbl_user ");
	

?>
<div class="col-md-12 stats-info stats-last widget-shadow">
	<div class="stats-last-agile">
		<table class="table stats-table ">
			<thead>
				<tr>
					<th>MÃ ĐƠN HÀNG</th>
                    <th>TÊN KHÁCH HÀNG</th>
                    <th>Email</th>
					<th>TRẠNG THÁI</th>
					<th>QUẢN LÝ</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
                <?php
                    while($row=(mysqli_fetch_array($query))){
                ?>
				<tr>
					<td><?php echo$row['ma_giohang']?></td>
					<td><?php echo$row['ten_user']?></td>
                    <td><?php echo$row['email_user']?></td>
                    <?php 
                        if($row['trangthai_giohang']==1){
                    ?>
                    <td><span class="label label-info">Đơn hàng mới </span></td>
                    <?php
                        }
						if($row['trangthai_giohang']==2){
                    ?>
					<td><span class="label label-success">Đơn hàng đã duyệt </span></td>
					<?php 
						}
						if($row['trangthai_giohang']==0){
					?>
					<td><span class="label label-danger">Đơn hàng đã hủy </span></td>
					<?php
						}
					?>
					<td><a href="?action=xemdonhang&query=xemchitiet&id_giohang=<?php echo $row['id_giohang']?>&ma_giohang=<?php echo $row['ma_giohang']?>&id_user=<?php echo $row['id_user']?>">Xem đơn hàng</a></td>
					<td><a href="modules/qldonhang/indonhang.php?ma_giohang=<?php echo $row['ma_giohang']?>">In đơn hàng</a></td>
				</tr>
                <?php
                }
                ?>
			</tbody>
		</table>
		<footer class="panel-footer">
            <div class="row">
                <div class="col-sm-5 text-center">
                <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">                
                <ul class="pagination pagination-sm m-t-none m-b-none">
                    <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                    <li><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">4</a></li>
                    <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                </ul>
                </div>
            </div>
        </footer>
	</div>
</div>