<div class="form-w3layouts">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                   Thêm sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <!--enctype="multipart/form-data": thêm thằng này để gửi được file-->
                        <form role="form" method="POST" action="modules/qlsanpham/xuly.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã sản phẩm</label>
                                <input type="text" class="form-control" name="masanpham" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" class="form-control" name="tensanpham" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Số lượng</label>
                                <input type="text" class="form-control" name="soluong" id="exampleInputPassword1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Đơn giá</label>
                                <input type="text" class="form-control" name="dongia" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label id="imageName" for="exampleInputEmail1">Hình ảnh</label>
                                <input id="imageInput" type="file" name="hinhanh">
                                <button onclick="open_file()">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tóm tắt</label>
                                <textarea name="mota_tomtat" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả</label>
                                <textarea name="mota"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tình trạng</label>
                                <select name="tinhtrang" id="">
                                    <option value="0">Ẩn </option>
                                    <option value="1">Kích hoạt </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục</label>
                                <select name="id_danhmuc" id="">
                                    <?php 
                                        $sql_select="SELECT * FROM tbl_danhmuc";
                                        $query=mysqli_query($mysqli,$sql_select);
                                        while($row=mysqli_fetch_array($query)){
                                    ?>
                                    <option value="<?php echo $row['id_danhmuc']?>"><?php echo $row['tendanhmuc']?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info" name="themsanpham">Submit</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
