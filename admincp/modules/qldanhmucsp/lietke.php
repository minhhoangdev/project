
	<?php
        $sql_lietke_danhmucsp="SELECT * FROM tbl_danhmuc ORDER BY thutu DESC";
        $row_lietke_danhmucsp=mysqli_query($mysqli,$sql_lietke_danhmucsp);
    ?>
    <div class="table-agile-info">
        <div class="panel panel-default">
        <div class="panel-heading">
        Liệt kê
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
                <th>Tên danh mục</th>
                <th>Thứ tự</th>
                <th style="width:30px;">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
                while($row=mysqli_fetch_array($row_lietke_danhmucsp)){
            ?>
                <tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td><?php echo $row['id_danhmuc'] ?></td>
                    <td><span class="text-ellipsis"><?php echo $row['tendanhmuc']?></span></td>
                    <td><span class="text-ellipsis"><?php echo $row['thutu']?></span></td>
                    <td>
                    <a href="?action=quanlydanhmucsanpham&query=sua&id_danhmuc=<?php echo $row['id_danhmuc']?>" class="active" ui-toggle-class=""><i class="fa fa-edit text-success text-active"></i></a>
                    <a href="modules/qldanhmucsp/xuly.php?action=quanlydanhmucsanpham&query=xoa&id_danhmuc=<?php echo $row['id_danhmuc']?>" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
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
