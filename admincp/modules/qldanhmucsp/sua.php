<?php
    $sql_select="SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$_GET[id_danhmuc]' LIMIT 1";
    $row_seclect=mysqli_query($mysqli,$sql_select);
?>

<div class="form-w3layouts">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                  Sửa danh mục
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="POST" action="modules/qldanhmucsp/xuly.php?id_danhmuc=<?php echo $_GET['id_danhmuc']?>">
                            <?php
                                while($row=mysqli_fetch_array($row_seclect)){
                            ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" value="<?php echo $row['tendanhmuc']?>" class="form-control" name="tendanhmuc" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thứ tự</label>
                                <input type="text" value="<?php echo $row['thutu']?>" class="form-control" name="thutu" id="exampleInputPassword1" >
                            </div>
                            <button type="submit" class="btn btn-info" name="suadanhmuc">Submit</button>
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