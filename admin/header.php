<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8c204d0fdf.js" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" href="css/main.css"> -->
</head>

<body>
    <div class="container-fluid p-0">
        <div class="d-flex min-vh-100">
            <!-- Sidebar -->
            <div class="bg-primary text-white p-0" style="width: 250px;">

                <div class="text-center py-3 fw-bold fs-4 border-bottom">ADMIN</div>

                <ul class="nav flex-column px-2">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php?act=thongketongquan"><i class="fa-solid fa-chart-line me-2"></i>Thống kê tổng quan</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php?act=listdm"><i class="fa-solid fa-folder-open me-2"></i>Quản lý Danh mục</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php?act=listsp"><i class="fa-solid fa-boxes-stacked me-2"></i>Quản lý Sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php?act=listbl"><i class="fa-solid fa-comments me-2"></i>Quản lý Bình luận</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php?act=listtaikhoan"><i class="fa-solid fa-users me-2"></i>Quản lý Người dùng</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php?act=listdonhang"><i class="fa-solid fa-receipt me-2"></i>Quản lý Đơn hàng</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php?act=thongke"><i class="fa-solid fa-chart-bar me-2"></i>Thống kê sản phẩm theo loại</a></li>
                </ul>
            </div>

            <!-- Content -->
            <div class="col-md-10 p-0">
                <nav class="navbar navbar-light bg-white px-4 border-bottom">
                    <div class="ms-auto dropdown">
                        <a href="#" class="text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-user-circle me-2"></i>
                            <?php
                            if (isset($_SESSION['user'])) {
                                // Nếu có thông tin người dùng trong session (đã đăng nhập)
                                $ten_nguoi_dung = $_SESSION['user']['fullname'];
                                echo ucwords($ten_nguoi_dung); // Viết hoa chữ cái đầu của từng từ
                            } else {
                                // Nếu chưa đăng nhập
                                echo 'Tài khoản';
                            }
                            ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="index.php?act=edit_taikhoan_admin">Cập nhật thông tin cá nhân</a></li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="index.php?act=doimatkhauadmin">Đổi mật khẩu</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li><a class="dropdown-item text-danger" href="index.php?act=dangxuat">Đăng xuất</a></li>
                        </ul>
                    </div>
                </nav>
                <marquee behavior="scroll" direction="left" scrollamount="5" class="bg-white text-dark py-2 fw-bold">
                    🔔 Chào mừng bạn đến với trang quản trị! Hãy cập nhật sản phẩm thường xuyên để giữ nội dung mới nhất!
                </marquee>
                <div class="p-4">