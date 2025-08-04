<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <!-- Card chứa form -->
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h5 class="mb-0 fw-bold">Thêm mới loại hàng hóa</h5>
                </div>
                <div class="card-body px-4 py-4">
                    <form action="index.php?act=adddm" method="post">

                        <div class="mb-3">
                            <label for="maloai" class="form-label fw-semibold">Mã loại</label>
                            <input type="text" id="maloai" name="maloai" class="form-control" disabled placeholder="Tự động tạo">
                        </div>

                        <div class="mb-4">
                            <label for="tenloai" class="form-label fw-semibold">Tên loại</label>
                            <input type="text" id="tenloai" name="tenloai" class="form-control" placeholder="Nhập tên loại" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <input type="submit" name="themmoi" value="Thêm mới" class="btn btn-success w-30">
                            <input type="reset" value="Nhập lại" class="btn btn-outline-secondary w-30">
                            <a href="index.php?act=listdm" class="btn btn-danger w-30">Danh sách</a>
                        </div>

                        <?php
                        if (isset($thongbao) && ($thongbao != ""))
                            echo '<div class="alert alert-info mt-3 mb-0">' . $thongbao . '</div>';
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>