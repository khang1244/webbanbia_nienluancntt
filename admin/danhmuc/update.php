<?php
if (is_array($dm)) {
    extract($dm);
}
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Card chứa form -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Cập nhật loại hàng hóa</h4>
                </div>
                <div class="card-body">
                    <form action="index.php?act=updatedm" method="post">

                        <div class="mb-3">
                            <label for="maloai" class="form-label">Mã loại</label>
                            <input type="text" id="maloai" name="maloai" value="<?php if (isset($id) && $id != '') echo $id; ?>" class="form-control" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="tenloai" class="form-label">Tên loại</label>
                            <input type="text" id="tenloai" name="tenloai" value="<?php if (isset($name) && $name != '') echo $name; ?>" class="form-control" placeholder="Nhập tên loại" required>
                        </div>

                        <div class="row mb10">
                            <input type="hidden" name="id" value="<?php if (isset($id) && ($id > 0)) echo $id; ?>">
                            <input type="submit" name="capnhat" value="Cập nhật" class="btn btn-primary col-4 pd-sm-2">
                            <input type="reset" value="Nhập lại" class="btn btn-secondary col-4">
                            <a href="index.php?act=listdm" class="btn btn-danger col-4">Danh sách</a>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>