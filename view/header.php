<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <title>WEBSITE BÁN BIA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


</head>
<?php
include_once "model/cart_temp.php"; // Chắc chắn file cart.php có được include

$soluong_cart = 0;
if (isset($_SESSION['user'])) {
    $iduser = $_SESSION['user']['id'];
    $soluong_cart = dem_soluong_giohang($iduser); // Hàm bạn sẽ thêm ở bước 2
}
?>

<body class="bg-light">
    <div class="container">
        <!-- Topbar -->
        <div class="bg-light border-bottom py-4 border">
            <div class="container d-flex justify-content-between align-items-center">
                <!-- Logo + tên -->
                <div class="d-flex align-items-center gap-2">
                    <a href="index.php"> <img src="view/images/products/iconthuonghieu.jpg" width="44" height="44" class="rounded-circle shadow-sm"></a>
                    <span class="fw-bold text-dark fs-5">WEBSITE BÁN BIA HOÀNG KHANG</span>
                </div>

                <!-- Flash sale + hotline -->
                <div class="d-flex align-items-center gap-4">
                    <!-- Flash Sale -->
                    <div class="d-flex align-items-center gap-2 px-4 py-2 bg-white border rounded-pill shadow-sm">
                        <i class="bi bi-lightning-fill text-warning fs-5"></i>
                        <span class="fw-semibold text-dark">Giờ vàng sale chấn động 50%:</span>
                        <span class="fw-bold text-danger" id="countdown" style="min-width: 80px;">00:00:00</span>
                    </div>

                    <!-- Hotline -->
                    <div class="d-none d-md-block">
                        <small class="text-muted">Hotline: <strong>0762835400</strong></small>
                    </div>
                </div>
            </div>
        </div>


        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-success navbar-dark rounded shadow-sm mb-4 px-3 py-3">
            <div class="container-fluid">
                <!-- Nút thu gọn -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Nội dung -->
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <!-- Menu trái -->
                    <div class="navbar-nav me-auto gap-2 fs-6">
                        <a class="nav-link active text-white" href="index.php">Trang chủ</a>
                        <a class="nav-link text-white" href="">Giới thiệu</a>
                        <a class="nav-link text-white" href="#">Liên hệ</a>
                        <a class="nav-link text-white" href="#">Góp ý</a>
                        <a class="nav-link text-white" href="#">Giải đáp</a>
                    </div>

                    <!-- Tìm kiếm -->
                    <form class="d-flex me-3" role="search" action="index.php?act=home#showproduct" method="post">
                        <input class="form-control form-control-sm me-2" type="search" placeholder="Tìm kiếm..." name="kyw"
                            value="<?php echo isset($_POST['kyw']) ? htmlspecialchars($_POST['kyw']) : ''; ?>">
                        <button class="btn btn-warning btn-sm" type="submit">Tìm</button>
                    </form>


                    <!-- Tài khoản & giỏ hàng -->
                    <div class="d-flex align-items-center gap-2">
                        <!-- Dropdown tài khoản -->
                        <?php if (!isset($_SESSION['user']) || $_SESSION['user']['role'] == 0): ?>
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle"></i>
                                    <?= isset($_SESSION['user']) ? $_SESSION['user']['fullname'] : "Tài khoản" ?>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <?php if (isset($_SESSION['user'])): ?>
                                        <li><a class="dropdown-item" href="index.php?act=edit_tk">Cập nhật thông tin</a></li>
                                        <li><a class="dropdown-item" href="index.php?act=myorder">Đơn hàng của tôi</a></li>
                                        <li><a class="dropdown-item" href="index.php?act=doimatkhau">Đổi mật khẩu</a></li>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-danger"
                                                href="index.php?act=dangxuat"
                                                onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?')">
                                                Đăng xuất
                                            </a>
                                        </li>

                                    <?php else: ?>
                                        <li><a class="dropdown-item" href="index.php?act=dangky">Đăng ký</a></li>
                                        <li><a class="dropdown-item" href="index.php?act=dangnhap">Đăng nhập</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- // Giỏ hàng -->
                        <a href="index.php?act=viewcart" class="btn btn-outline-light btn-sm position-relative">
                            <i class="bi bi-cart3 fs-5"></i>
                            <?php if ($soluong_cart > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?= $soluong_cart ?>
                                </span>
                            <?php endif; ?>
                        </a>


                    </div>
                </div>
            </div>
        </nav>

        <script>
            // Thời gian mỗi lượt khuyến mãi (2 tiếng)
            const saleDuration = 2 * 60 * 60 * 1000;

            let endTime = new Date().getTime() + saleDuration;

            const countdownElement = document.getElementById("countdown");

            setInterval(() => {
                const now = new Date().getTime();
                let distance = endTime - now;

                if (distance <= 0) {
                    // Khi hết giờ, tự động lặp lại 2 giờ tiếp theo
                    endTime = now + saleDuration;
                    distance = saleDuration;
                }

                const hours = String(Math.floor(distance / (1000 * 60 * 60))).padStart(2, '0');
                const minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                const seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');

                countdownElement.innerHTML = `${hours}:${minutes}:${seconds}`;
            }, 1000);
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>