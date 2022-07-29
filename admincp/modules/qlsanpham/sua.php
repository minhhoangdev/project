<?php
    $sql_select="SELECT * FROM tbl_sanpham WHERE id_sanpham='$_GET[id_sanpham]'  LIMIT 1";
    $row_select=mysqli_query($mysqli,$sql_select);
?>
<div class="form-w3layouts">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                   Cập nhật sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <!--enctype="multipart/form-data": thêm thằng này để gửi được file-->
                        <form role="form" method="POST" action="modules/qlsanpham/xuly.php?id_sanpham=<?php echo $_GET['id_sanpham']?>" enctype="multipart/form-data">
                            <?php
                                while($row=mysqli_fetch_array($row_select)){
                            ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã sản phẩm</label>
                                <input type="text" value="<?php echo $row['masanpham']?>" class="form-control" name="masanpham" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" value="<?php echo $row['tensanpham']?>" class="form-control" name="tensanpham" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Số lượng</label>
                                <input type="text" value="<?php echo $row['soluong']?>" class="form-control" name="soluong" id="exampleInputPassword1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Đơn giá</label>
                                <input type="text" value="<?php echo $row['dongia']?>" class="form-control" name="dongia" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh</label>
                                <input type="file" name="hinhanh">
                                <img src="modules/qlsanpham/uploads/<?php echo $row['hinhanh']?>" alt="" width="100">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tóm tắt</label>
                                <textarea  name="mota_tomtat" ><?php echo $row['mota_tomtat']?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả</label>
                                <textarea name="mota"><?php echo $row['mota']?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tình trạng</label>
                                <select name="tinhtrang" id="">
                                    <?php
                                        if($row['tinhtrang']==0){
                                    ?>
                                    <option value="0" selected>Ẩn </option>
                                    <option value="1">Kích hoạt </option>
                                    <?php 
                                    }else{
                                    ?>
                                    <option value="0" >Ẩn </option>
                                    <option value="1" selected>Kích hoạt </option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục</label>
                                <select name="id_danhmuc" id="">
                                    <?php 
                                        $sql="SELECT * FROM tbl_danhmuc";
                                        $query=mysqli_query($mysqli,$sql);
                                        while($row_dm=mysqli_fetch_array($query)){
                                            if($row['id_danhmuc']==$row_dm['id_danhmuc']){
                                    ?>
                                    <option selected value="<?php echo $row_dm['id_danhmuc']?>"><?php echo $row_dm['tendanhmuc']?> </option>
                                    <?php
                                            }else{
                                    ?>
                                    <option value="<?php echo $row_dm['id_danhmuc']?>"><?php echo $row_dm['tendanhmuc']?> </option>
                                    <?php
                                            }
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info" name="suasanpham">Submit</button>
                            <?php 
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>