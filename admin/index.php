<?php
session_start();
// ✅ Chặn người không phải admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
    header("Location: ../index.php"); // Trở về giao diện người dùng
    exit();
}
include "../model/pdo.php";
include "../model/danhmuc.php";
include "../model/sanpham.php";
include "../model/binhluan.php"; // ✅ Phải có
include "../model/bill.php"; // ✅ Phải có để xử lý đơn hàng
include "../model/taikhoan.php";
include "../model/thongke.php"; // ✅ Nếu có model thống kê thì thêm vào`

include "header.php";

//controller
if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'adddm':
            //kiểm tra xem người dùng có click vào nút add hay không
            if (isset($_POST['themmoi']) && $_POST['themmoi']) {
                $tenloai = $_POST['tenloai'];
                insert_danhmuc($tenloai);
                echo "<script>
                            alert('Thêm danh mục thành công!');
                            window.location.href = 'index.php?act=listdm';
                        </script>";
            }
            include "danhmuc/add.php";
            break;
        case 'listdm':
            $listdanhmuc = loadall_danhmuc();
            include "danhmuc/list.php";
            break;
        case 'xoadm':
            if (isset($_GET['id']) && $_GET['id']) {
                delete_danhmuc($_GET['id']);
                echo "<script>
                            alert('Xóa danh mục thành công!');
                            window.location.href = 'index.php?act=listdm';
                        </script>";
            }
            $listdanhmuc = loadall_danhmuc();

            include "danhmuc/list.php";
            break;
        case 'suadm':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $dm = loadone_danhmuc($_GET['id']); // ✅ đúng hàm để lấy 1 danh mục
                echo "<script>
                            alert('Cập nhật danh mục thành công!');
                            window.location.href = 'index.php?act=listdm';
                        </script>";
            }
            include "danhmuc/update.php";
            break;

        case 'updatedm':
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $tenloai = $_POST['tenloai'];
                $id = $_POST['id'];
                update_danhmuc($id, $tenloai);
            }
            // sau khi cập nhật xong thì load lại danh sách
            $listdanhmuc = loadall_danhmuc();
            include "danhmuc/list.php";
            break;
        /* controller cho sản phẩm */
        // case 'addsp':
        //     // Lấy danh sách danh mục để hiển thị trong form
        //     $listdanhmuc = loadall_danhmuc();

        //     // Kiểm tra xem người dùng đã submit form chưa
        //     if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
        //         // Lấy dữ liệu từ form
        //         $iddm = $_POST['iddm'];
        //         $tensp = $_POST['tensp'];
        //         $giasp = $_POST['giasp'];
        //         $mota = $_POST['mota'];

        //         // Lấy tên file ảnh
        //         $img = $_FILES['hinh']['name'];

        //         // Đường dẫn thư mục lưu file
        //         $target_dir = "../upload/";
        //         $target_file = $target_dir . basename($img);

        //         // Di chuyển file từ thư mục tạm sang thư mục lưu trữ
        //         if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
        //             // Upload thành công
        //         } else {
        //             // Upload thất bại (có thể log ra hoặc thông báo)
        //         }


        //         // Thêm sản phẩm vào database
        //         insert_sanpham($tensp, $giasp, $img, $mota, $iddm);

        //         // Gán thông báo
        //         $thongbao = "Thêm thành công";
        //     }

        //     // Hiển thị form thêm sản phẩm
        //     include "sanpham/add.php";
        //     break;
        case 'addsp':
            // Lấy danh sách danh mục để hiển thị trong form
            $listdanhmuc = loadall_danhmuc();

            // Kiểm tra xem người dùng đã submit form chưa
            if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                // Lấy dữ liệu từ form
                $iddm = $_POST['iddm'];
                $tensp = $_POST['tensp'];
                $giasp = $_POST['giasp'];
                $mota = $_POST['mota'];

                // Đường dẫn lưu ảnh
                $target_dir = "../upload/";

                // ✅ Xử lý ảnh chính
                $img = $_FILES['hinh']['name'];
                $target_file = $target_dir . basename($img);
                move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file);

                // ✅ Xử lý ảnh phụ
                $anhphu = "";
                if (isset($_FILES['anhphu']) && count($_FILES['anhphu']['name']) > 0) {
                    foreach ($_FILES['anhphu']['name'] as $key => $tenfile) {
                        $tmp = $_FILES['anhphu']['tmp_name'][$key];
                        if ($tenfile != "") {
                            move_uploaded_file($tmp, $target_dir . $tenfile);
                            $anhphu .= $tenfile . "|";
                        }
                    }
                    $anhphu = rtrim($anhphu, "|"); // xóa dấu "|" cuối
                }

                // ✅ Gọi hàm thêm sản phẩm có cả ảnh phụ
                insert_sanpham($tensp, $giasp, $img, $mota, $iddm, $anhphu);
                echo "<script>
                            alert('Thêm sản phẩm thành công!');
                            window.location.href = 'index.php?act=listsp';
                        </script>";
            }

            // Hiển thị form
            include "sanpham/add.php";
            break;
        case 'listsp':
            // Phân trang: mỗi trang 3 sản phẩm
            $limit = 4;
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
            $start = ($page - 1) * $limit;

            // Lấy danh sách danh mục
            $listdanhmuc = loadall_danhmuc();

            // Xử lý từ khóa và iddm
            if (isset($_POST['listok']) && ($_POST['listok'])) {
                $kyw = $_POST['kyw'];
                $iddm = $_POST['iddm'];
            } else {
                $kyw = isset($_GET['kyw']) ? $_GET['kyw'] : '';  // Lấy giá trị từ GET nếu có
                $iddm = isset($_GET['iddm']) ? $_GET['iddm'] : 0;
            }

            // Lấy danh sách sản phẩm có phân trang
            $listsanpham = loadall_sanpham_paginated($kyw, $iddm, $start, $limit);

            // Tính tổng trang
            $total_products = count_all_sanpham($kyw, $iddm);
            $total_pages = ceil($total_products / $limit);

            // map danh mục id => name
            $mapDanhMuc = [];
            foreach ($listdanhmuc as $dm) {
                $mapDanhMuc[$dm['id']] = $dm['name'];
            }

            include "sanpham/list.php";
            break;

        case 'xoasp':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                delete_sanpham($_GET['id']);
            }

            // Phân trang: mỗi trang 5 sản phẩm
            $limit = 5;
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
            $start = ($page - 1) * $limit;

            // Lấy danh sách danh mục
            $listdanhmuc = loadall_danhmuc();

            // Khai báo biến từ khóa và iddm
            $kyw = '';
            $iddm = 0;

            // Lấy danh sách sản phẩm có phân trang
            $listsanpham = loadall_sanpham_paginated($kyw, $iddm, $start, $limit);

            // Tính tổng số trang
            $total_products = count_all_sanpham($kyw, $iddm);
            $total_pages = ceil($total_products / $limit);

            // map danh mục id => name
            $mapDanhMuc = [];
            foreach ($listdanhmuc as $dm) {
                $mapDanhMuc[$dm['id']] = $dm['name'];
            }
            echo "<script>
                            alert('Xóa sản phẩm thành công!');
                            window.location.href = 'index.php?act=listsp';
                        </script>";

            include "sanpham/list.php";
            break;

        case 'suasp':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                // lấy thông tin của danh mục cần sửa
                $sp = loadone_sanpham($_GET['id']); // đúng hàm cần dùng

            }
            $listdanhmuc = loadall_danhmuc(); // lấy danh sách danh mục

            include "sanpham/update.php";
            break;
        // case 'updatesp':
        //     if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
        //         $id = $_POST['id'];
        //         $iddm = $_POST['iddm'];
        //         $tensp = $_POST['tensp'];
        //         $giasp = $_POST['giasp'];
        //         $mota = $_POST['mota'];
        //         $hinh = $_FILES['hinh']['name'];
        //         $target_dir = "../upload/";
        //         $target_file = $target_dir . basename($_FILES["hinh"]["name"]);

        //         if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
        //             // echo "The file ". htmlspecialchars( basename( $_FILES["hinh"]["name"])). " has been uploaded.";
        //         } else {
        //             // echo "Sorry, there was an error uploading your file.";
        //         }

        //         update_sanpham($id, $iddm, $tensp, $giasp, $mota, $hinh);
        //         $thongbao = "Cập nhật thành công";
        //     }

        //     // Sau khi cập nhật, load lại danh mục và phân trang sản phẩm
        //     $listdanhmuc = loadall_danhmuc();
        //     $limit = 3;
        //     $page = 1;
        //     $start = 0;
        //     $listsanpham = loadall_sanpham_paginated('', 0, $start, $limit);
        //     $total_products = count_all_sanpham('', 0);
        //     $total_pages = ceil($total_products / $limit);

        //     // map danh mục id => name
        //     $mapDanhMuc = [];
        //     foreach ($listdanhmuc as $dm) {
        //         $mapDanhMuc[$dm['id']] = $dm['name'];
        //     }

        //     include "sanpham/list.php";
        //     break;
        case 'updatesp':
            if (isset($_POST['capnhat']) && $_POST['capnhat']) {
                $id = $_POST['id'];
                $iddm = $_POST['iddm'];
                $tensp = $_POST['tensp'];
                $giasp = $_POST['giasp'];
                $mota = $_POST['mota'];

                // Lấy sản phẩm cũ để giữ ảnh nếu không đổi
                $sp = loadone_sanpham($id);

                // Xử lý ảnh chính
                $hinh = $_FILES['hinh']['name'];
                $target_dir = "../upload/";
                if ($hinh != "") {
                    $target_file = $target_dir . basename($hinh);
                    move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file);
                } else {
                    $hinh = $sp['img']; // giữ ảnh cũ nếu không chọn ảnh mới
                }

                // Xử lý ảnh phụ
                $anhphu = $sp['anhphu']; // giữ ảnh phụ cũ nếu không thay
                if (isset($_FILES['anhphu']) && $_FILES['anhphu']['name'][0] != "") {
                    $anhphu = "";
                    foreach ($_FILES['anhphu']['name'] as $key => $tenfile) {
                        $tmp = $_FILES['anhphu']['tmp_name'][$key];
                        move_uploaded_file($tmp, $target_dir . $tenfile);
                        $anhphu .= $tenfile . "|";
                    }
                    $anhphu = rtrim($anhphu, "|");
                }

                // Cập nhật sản phẩm
                update_sanpham($id, $iddm, $tensp, $giasp, $mota, $hinh, $anhphu);
            }

            // Load lại dữ liệu để hiển thị danh sách
            $listdanhmuc = loadall_danhmuc();
            $limit = 4;
            $page = 1;
            $start = 0;
            $listsanpham = loadall_sanpham_paginated('', 0, $start, $limit);
            $total_products = count_all_sanpham('', 0);
            $total_pages = ceil($total_products / $limit);

            // map danh mục id => name
            $mapDanhMuc = [];
            foreach ($listdanhmuc as $dm) {
                $mapDanhMuc[$dm['id']] = $dm['name'];
            }
            echo "<script>
                            alert('Cập nhật sản phẩm thành công!');
                            window.location.href = 'index.php?act=listsp';
                        </script>";

            include "sanpham/list.php";
            break;

        case 'dangxuat':
            unset($_SESSION['user']); // Xóa thông tin đăng nhập
            echo "<script>
                            alert('Đăng xuất thành công!');
                            window.location.href = 'index.php';
                        </script>";
            exit(); // Dừng chương trình
            break;
        case 'listbl':
            $limit = 8; // mỗi trang 8 bình luận
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            if ($page < 1) $page = 1;

            $start = ($page - 1) * $limit;

            $listbinhluan = loadall_binhluan_paginated($start, $limit);
            // $total_bl = count_binhluan();
            $total_bl = (int) count_binhluan();
            $total_pages = ceil($total_bl / $limit);


            include "binhluan/list.php";
            break;

        case 'duyetbl':
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = intval($_GET['id']);
                $sql = "UPDATE binhluan SET trangthai = 1 WHERE id = ?";
                pdo_execute($sql, $id);
                echo "<script>
                            alert('Duyệt bình luận thành công!');
                            window.location.href = 'index.php?act=listbl';
                        </script>";
            }
            break;
        case 'xoabl':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                delete_binhluan($_GET['id']);
                echo "<script>
                alert('Xóa bình luận thành công!');
                window.location.href = 'index.php?act=listbl';
              </script>";
            }

            $limit = 8;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            if ($page < 1) $page = 1;
            $start = ($page - 1) * $limit;

            $listbinhluan = loadall_binhluan_paginated($start, $limit);
            $total_bl = (int) count_binhluan();
            $total_pages = ceil($total_bl / $limit);

            include "binhluan/list.php";
            break;


        case 'listdonhang':
            // Khởi tạo giá trị mặc định
            $kyw = '';

            // Phân trang: mỗi trang 4 đơn hàng
            $limit = 4;
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
            $start = ($page - 1) * $limit;
            $total_products = 0; // ✅ Thêm dòng này trước if
            // Nếu có tìm kiếm theo mã đơn hàng
            if (isset($_POST['listok']) && $_POST['kyw'] != "") {
                $kyw = trim($_POST['kyw']);
                if (str_starts_with(strtoupper($kyw), 'DAM-')) {
                    $kyw = substr($kyw, 4);
                }
                $listdonhang = loadall_bill_timkiemdonhang($kyw);
                $total_pages = 1; // Không cần phân trang khi tìm kiếm cụ thể
            } else {
                $listdonhang =  loadall_bill_phantrangdonhangadmin($start, $limit);
                $total_products = (int) count_donhang(); // Chắc chắn trả về int
                $total_pages = ceil($total_products / $limit);
            }

            include "donhang/listdonhang.php";
            break;


        case 'chitietdonhangadmin':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $idbill = $_GET['id'];
                $bill = loadone_bill($idbill);
                $cart_detail = load_cart_by_idbill($idbill);
                include "donhang/chitietdonhangadmin.php";
            }
            break;
        // case 'suadonhang':
        //     include "donhang/suadonhang.php";
        //     break;
        case 'xoadonhang':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                delete_donhang($_GET['id']);
                echo "<script>
                alert('Xóa đơn hàng thành công!');
                window.location.href = 'index.php?act=listdonhang';
              </script>";
            }
            exit;
            break;

        case 'listtaikhoan':
            $listtaikhoan = loadall_taikhoan();
            include "taikhoan/listtaikhoan.php";
            break;

        case 'capnhatroleadmin':
            if (isset($_POST['id']) && isset($_POST['role'])) {
                $id = $_POST['id'];
                $role = $_POST['role'];

                // Không cho admin tự đổi vai trò chính mình
                if ($_SESSION['user']['id'] == $id) {
                    $_SESSION['message'] = "Bạn không thể đổi vai trò của chính mình!";
                } else {
                    update_role($id, $role); // <-- bạn cần có hàm này trong model
                    echo "<script>
                            alert('Cập nhật vai trò thành công!');
                            window.location.href = 'index.php?act=listtaikhoan';
                        </script>";
                }
                exit;
            }
            break;


        case 'edit_taikhoan_admin':

            if (isset($_POST['capnhat'])) {
                $id = $_POST['id'];
                $user = $_POST['user'];
                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];


                // Kiểm tra trùng tên
                $check_trung = trungtenkhicapnhat($user, $id);
                if ($check_trung) {
                    echo "<script>
                                alert('Tên đăng nhập đã tồn tại, vui lòng chọn tên khác!');
                                window.history.back();
                            </script>";
                    exit();
                }
                update_taikhoan($id, $user, $fullname, $email, $address, $tel);

                // Cập nhật lại session 
                $_SESSION['user'] = load_taikhoan_by_id($id);


                echo "<script>
                            alert('Cập nhật thành công!');
                            window.location.href = 'index.php';
                        </script>";
                exit();
            }
            include "taikhoan/edit_taikhoan_admin.php";
            break;
        case 'doimatkhauadmin':
            if (isset($_POST['doimatkhauadmin'])) {
                $id = $_SESSION['user']['id'];
                $old_password = $_POST['old_password'];
                $new_password = $_POST['new_password'];
                $re_password = $_POST['re_password'];

                if ($new_password != $re_password) {
                    echo "<script>alert('Mật khẩu mới nhập lại không khớp!');</script>";
                } else {
                    $tk = load_taikhoan_by_id($id);

                    if ($tk['password'] != md5($old_password)) {
                        echo "<script>alert('Mật khẩu cũ không đúng!');</script>";
                    } else if ($tk['password'] == md5($new_password)) {
                        echo "<script>alert('Mật khẩu mới không được trùng mật khẩu cũ!');</script>";
                    } else {
                        update_password($id, md5($new_password));
                        echo "<script>
                                        alert('Đổi mật khẩu thành công. Vui lòng đăng nhập lại!');
                                        window.location.href = 'index.php?act=dangnhap';
                                      </script>";
                        unset($_SESSION['user']);
                        exit();
                    }
                }
            }

            // Luôn include lại form để hiển thị lại nếu không redirect
            include "taikhoan/doimatkhau.php";
            break;

        case 'xoataikhoanadmin':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                delete_taikhoan($_GET['id']);
                echo "<script>
                alert('Xóa tài khoản thành công!');
                window.location.href = 'index.php?act=listtaikhoan';
              </script>";
            }
            break;
        case 'thongketongquan':
            include_once "../model/danhmuc.php";
            include_once "../model/sanpham.php";
            include_once "../model/binhluan.php";
            include_once "../model/taikhoan.php";
            include_once "../model/bill.php";


            $tong_dm = count_danhmuc();
            $tong_sp = count_sanpham();
            $tong_bl = count_binhluan();
            $tong_tk = count_taikhoan();
            $tong_dh = count_donhang();

            include "thongke/dashboard.php";
            break;
        case 'suadonhang':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $bill = loadone_bill($_GET['id']);

                if ($bill['bill_status'] == 4) {
                    // Nếu đã hủy, không cho sửa
                    echo '<div class="alert alert-danger m-3">Đơn hàng này đã bị hủy và không thể chỉnh sửa!</div>';
                } else {
                    include "donhang/suadonhang.php";
                }
            }
            break;

        case 'updatesuadonhang': // dùng để XỬ LÝ khi admin bấm nút cập nhật
            if (isset($_POST['capnhat'])) {
                $id = $_POST['id'];
                $bill_status = $_POST['bill_status'];
                update_bill_status($id, $bill_status);
                echo "<script>
                alert('Cập nhật trạng thái đơn hàng thành công!');
                window.location.href = 'index.php?act=listdonhang';
              </script>";
            }
            break;
        case 'thongke':
            $listthongke = loadall_thongke();
            include "thongke/list.php";
            break;
        case 'bieudo':
            $listthongke = loadall_thongke();
            include "thongke/bieudo.php";
            break;

        default:
            include "home.php";
            break;
    }
} else {
    include "home.php";
}

include "footer.php";
