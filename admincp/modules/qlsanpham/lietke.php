
	<?php
        $sql_lietke_sp="SELECT * FROM tbl_sanpham as a ,tbl_danhmuc as b WHERE  a.id_danhmuc=b.id_danhmuc ";
        $row_lietke_sp=mysqli_query($mysqli,$sql_lietke_sp);
    ?>
    <div class="table-agile-info">
        <div class="panel panel-default">
        <div class="panel-heading">
        Liệt kê sản phẩm
        </div>
        <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
            <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
            </select>
            <button class="btn btn-sm btn-default">Apply</button>                
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
            <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
                <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
            </div>
        </div>
        </div>
        <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
            <tr>
                <th style="width:20px;">
                <label class="i-checks m-b-none">
                    <input type="checkbox"><i></i>
                </label>
                </th>
                <th>Id</th>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Hình ảnh</th>
                <th>Mô tả ngắn</th>
                <th>Mô tả</th>
                <th>Tình trạng</th>
                <th>Danh mục</th>
                <th style="width:30px;">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
                while($row=mysqli_fetch_array($row_lietke_sp)){
            ?>
                <tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td><?php echo $row['id_sanpham'] ?></td>
                    <td><span class="text-ellipsis"><?php echo $row['masanpham']?></span></td>
                    <td><span class="text-ellipsis"><?php echo $row['tensanpham']?></span></td>
                    <td><?php echo $row['soluong'] ?></td>
                    <td><span class="text-ellipsis"><?php echo $row['dongia']?></span></td>
                    <td><img src="modules/qlsanpham/uploads/<?php echo $row['hinhanh']?>" alt=""  width="50" height="45";></td>
                    <td><?php echo substr($row['mota_tomtat'],0,20) ?>...</td>
                    <td><span class="text-ellipsis"><?php echo substr($row['mota'],0,70)?>...</span></td>
                    <?php
                        if($row['tinhtrang']==1){
                    ?>
                    <td><span class="label label-success">Kích hoạt</span></td>
                    <?php
                        }else{
                    ?>
                        <td><span class="label label-danger">Ẩn</span></td>
                    <?php
                        }
                    ?>
                    <td><span class="text-ellipsis"><?php echo $row['tendanhmuc']?></span></td>
                    <td>
                    <a href="?action=quanlysanpham&query=sua&id_sanpham=<?php echo $row['id_sanpham']?>" class="active" ui-toggle-class=""><i class="fa fa-edit text-success text-active"></i></a>
                    <a href="modules/qlsanpham/xuly.php?action=quanlysanpham&query=xoa&id_sanpham=<?php echo $row['id_sanpham']?>" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                    </td>
                </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
        </div>
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
