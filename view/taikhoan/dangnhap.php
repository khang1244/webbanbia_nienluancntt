<body>
    <div class="container py-5 ">
        <div class="row justify-content-center align-items-center">
            <!-- Cột trái: Form đăng nhập -->
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <h3 class="text-center mb-4">Đăng Nhập</h3>
                    <form action="index.php?act=dangnhap" method="post">
                        <div class="mb-3">
                            <label class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" name="user" placeholder="Nhập tên đăng nhập">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
                        </div>
                        <input type="submit" class="btn btn-primary w-100 py-2 mt-3" name="dangnhap" value="Đăng nhập">
                        <div class="text-center mt-2">
                            <a href="index.php" class="btn btn-outline-secondary btn-sm">Thoát</a>
                        </div>
                        <p class="text-center mt-3 mb-0">
                            Chưa có tài khoản? <a href="index.php?act=dangky" class="text-decoration-none text-primary">Đăng ký</a>
                        </p>
                        <p class="text-center mt-2">
                            <a href="index.php?act=quenmatkhau" class="text-decoration-none text-primary">Quên mật khẩu?</a>
                        </p>
                    </form>

                    <?php
                    if (isset($thongbao) && $thongbao != "") {
                        echo '<div class="alert alert-danger mt-3">' . $thongbao . '</div>';
                    }
                    ?>
                </div>
            </div>

            <!-- Cột phải: Nội dung giới thiệu -->
            <div class="col-md-6 text-center">
                <img src="images/products/iconthuonghieu.jpg" class="img-fluid mb-3" alt="Bia" style="max-height: 250px;">
                <h5 class="mb-2">Chào mừng đến với Đại lý Bia Hoàng Khang</h5>
                <p class="text-muted">Đăng nhập để đặt hàng nhanh, nhận ưu đãi và theo dõi đơn hàng của bạn.</p>
            </div>
        </div>
    </div>


</body>