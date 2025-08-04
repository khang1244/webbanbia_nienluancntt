<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

session_start();
ob_start();
include "model/binhluan.php";
include "model/pdo.php";
include "model/sanpham.php";
include "model/danhmuc.php";
include "model/taikhoan.php";
include "model/cart.php";
include "model/cart_temp.php";
include "model/bill.php";
include "view/header.php";
include "global.php";


$spnew = loadall_sanpham_home();
$dsdm = loadall_danhmuc();
$dstop10 = loadall_sanpham_top10();


if ((isset($_GET['act'])) && ($_GET['act'] != "")) {
    $act = $_GET['act'];
    switch ($act) {
        // case 'sanpham':
        //     if (isset($_GET['iddm']) && ($_GET['iddm'] > 0)) {
        //         $iddm = $_GET['iddm'];
        //         $dssp = loadall_sanpham("", $iddm);
        //         $tendm = load_ten_dm($iddm);
        //     } else {
        //         $dssp = loadall_sanpham("", 0); // Hiển thị tất cả nếu không có iddm
        //     }
        //     include "view/sanpham.php";
        //     break;
        case 'home':
            // Lấy từ khóa tìm kiếm nếu có
            $kyw = isset($_POST['kyw']) ? $_POST['kyw'] : "";

            // Lấy id danh mục nếu bấm vào danh mục
            $iddm = isset($_GET['iddm']) ? $_GET['iddm'] : 0;

            // Load danh sách danh mục để hiển thị
            $dsdm = loadall_danhmuc();

            // Load sản phẩm theo từ khóa và danh mục
            $spnew = loadall_sanpham($kyw, $iddm);

            // Lấy tên danh mục nếu có iddm
            if ($iddm > 0) {
                $tendm = load_ten_dm($iddm);
            } else {
                $tendm = "Tất cả sản phẩm";
            }

            include "view/home.php";
            break;;

        case 'sanphamct':

            if (isset($_GET['idsp']) && ($_GET['idsp'] > 0)) {
                $id = $_GET['idsp'];
                $tangluotxem = tangluotxem($id); // ✅ tăng lượt xem
                $onesp = loadone_sanpham($id);
                extract($onesp);
                $spcungloai = load_sanpham_cungloai($id, $iddm); // ✅ lấy sản phẩm cùng loại

                include "view/sanphamct.php";
            } else {
                include "view/home.php";
            }

            break;
        case 'dangky':
            if (isset($_POST['dangky']) && ($_POST['dangky'])) {
                $email = $_POST['email'];
                $user = $_POST['user'];
                $fullname = $_POST['fullname'];
                $password = $_POST['password'];
                $repassword = $_POST['repassword'];

                // Kiểm tra tên đăng nhập dài tối thiểu 8 ký tự
                if (strlen($user) < 8) {
                    echo "<script>alert('Tên đăng nhập phải từ 8 ký tự trở lên!');</script>";
                }
                // Kiểm tra độ mạnh của mật khẩu
                elseif (
                    strlen($password) < 8 ||
                    !preg_match('/[A-Z]/', $password) ||         // ít nhất 1 chữ hoa
                    !preg_match('/[^a-zA-Z0-9]/', $password)      // ít nhất 1 ký tự đặc biệt
                ) {
                    echo "<script>alert('Mật khẩu phải có ít nhất 8 ký tự, gồm chữ hoa và ký tự đặc biệt!');</script>";
                }
                // Kiểm tra nhập lại mật khẩu
                elseif ($password !== $repassword) {
                    echo "<script>alert('Mật khẩu nhập lại không khớp!');</script>";
                } else {
                    // Kiểm tra tài khoản đã tồn tại hay chưa
                    $checkuser = trungtenkhidangky($user);
                    if ($checkuser) {
                        echo "<script>alert('Tên đăng nhập đã tồn tại, vui lòng chọn tên khác!');</script>";
                    } else {
                        // Mã hóa mật khẩu
                        $password_md5 = md5($password);

                        // Tiến hành thêm vào CSDL
                        insert_taikhoan($email, $user, $fullname, $password_md5);
                        $_SESSION['thongbao'] = "Đăng ký thành công, vui lòng đăng nhập!";

                        echo "<script>
                                alert('Đăng ký thành công!');
                                window.location.href='index.php?act=dangnhap';
                            </script>";
                        exit();
                    }
                    // Nếu có lỗi → quay lại trang đăng ký
                    header("Location: index.php?act=dangky");
                    exit();
                }
            }
            include "view/taikhoan/dangky.php";
            break;

        // case 'dangky':
        //     if (isset($_POST['dangky']) && ($_POST['dangky'])) {
        //         $email = $_POST['email'];
        //         $user = $_POST['user'];
        //         $fullname = $_POST['fullname'];
        //         $password = $_POST['password'];

        //         // Kiểm tra tài khoản đã tồn tại hay chưa
        //         $checkuser = trungtenkhidangky($user);
        //         if ($checkuser) {
        //             $thongbao = "Tên đăng nhập đã tồn tại, vui lòng chọn tên khác!";
        //         } else {
        //             // Mã hóa mật khẩu
        //             $password_md5 = md5($password);

        //             // Tiến hành thêm vào CSDL
        //             insert_taikhoan($email, $user, $fullname, $password_md5);
        //             $_SESSION['thongbao'] = "Đăng ký thành công, vui lòng đăng nhập!";

        //             // Chuyển hướng sang trang đăng nhập
        //             header("Location: index.php?act=dangnhap");
        //             exit(); // dừng thực thi
        //         }
        //     }
        //     include "view/taikhoan/dangky.php";
        //     break;

        case 'dangnhap':
            if (isset($_POST['dangnhap']) && $_POST['dangnhap']) {
                $user = $_POST['user'];
                $password = $_POST['password'];

                // Kiểm tra tài khoản
                $checkuser = checkuser($user, md5($password));

                if (is_array($checkuser)) {
                    $_SESSION['user'] = $checkuser;

                    // ✅ Thông báo + chuyển trang sau
                    if ($checkuser['role'] == 1) {
                        echo "<script>
                                alert('Đăng nhập thành công (quyền admin)!');
                                window.location.href = 'admin/index.php';
                            </script>";
                    } else {
                        echo "<script>
                                alert('Đăng nhập thành công!');
                                window.location.href = 'index.php';
                            </script>";
                    }
                    exit();
                } else {
                    $tk = trungtenkhidangky($user);
                    if (!$tk) {
                        echo "<script>alert('Tài khoản không tồn tại!');</script>";
                    } else {
                        echo "<script>alert('Mật khẩu không đúng!');</script>";
                    }
                }
            }

            include "view/taikhoan/dangnhap.php";
            break;

        // case 'edit_tk':

        //     if (isset($_POST['capnhat'])) {
        //         $id = $_POST['id'];
        //         $user = $_POST['user'];
        //         $password_input = $_POST['password'];
        //         $fullname = $_POST['fullname'];
        //         $email = $_POST['email'];
        //         $address = $_POST['address'];
        //         $tel = $_POST['tel'];

        //         if (!empty($password_input)) {
        //             // Có nhập mật khẩu mới => mã hóa
        //             $pass = md5($password_input);
        //         } else {
        //             // Không nhập => giữ nguyên mật khẩu cũ trong session
        //             $pass = $_SESSION['user']['password'];
        //         }
        //         // Kiểm tra trùng tên
        //         $check_trung = trungtenkhicapnhat($user, $id);
        //         if ($check_trung) {
        //             echo "<script>
        //                         alert('Tên đăng nhập đã tồn tại, vui lòng chọn tên khác!');
        //                         window.history.back();
        //                       </script>";
        //             exit();
        //         }

        //         update_taikhoan($id, $user, $pass, $fullname, $email, $address, $tel);

        //         // Cập nhật lại session
        //         $_SESSION['user'] = checkuser($user, $pass);

        //         echo "<script>
        //                     alert('Cập nhật thành công!');
        //                     window.location.href = 'index.php';
        //                   </script>";
        //         exit();
        //     }

        //     include "view/taikhoan/edit_tk.php";
        //     break;
        case 'edit_tk':
            if (isset($_POST['capnhat'])) {
                $id = $_POST['id'];
                $user = $_POST['user'];
                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];

                $pass = $_SESSION['user']['password']; // không đổi mật khẩu ở đây

                // Kiểm tra trùng tên
                $check_trung = trungtenkhicapnhat($user, $id);
                if ($check_trung) {
                    echo "<script>
                                alert('Tên đăng nhập đã tồn tại, vui lòng chọn tên khác!');
                                window.history.back();
                            </script>";
                    exit();
                }
                update_taikhoan($id, $user, $pass, $fullname, $email, $address, $tel);

                // Cập nhật lại session
                $_SESSION['user'] = checkuser($user, $pass);

                echo "<script>
                            alert('Cập nhật thành công!');
                            window.location.href = 'index.php';
                        </script>";
                exit();
            }

            include "view/taikhoan/edit_tk.php";
            break;

        case 'doimatkhau':
            if (isset($_POST['doimatkhau'])) {
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
            include "view/taikhoan/doimatkhau.php";
            break;

        case 'dangxuat':
            unset($_SESSION['user']); // Xóa thông tin đăng nhập
            unset($_SESSION['mycart']); // Xóa giỏ hàng khi đăng xuất
            header("Location: index.php"); // Quay về trang chủ
            exit(); // Dừng chương trình
            break;

        case 'addtocart':
            if (!isset($_SESSION['user'])) {
                echo "<script>alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!');</script>";
                echo "<script>window.location.href='index.php?act=dangnhap';</script>";
                exit();
            }

            if (isset($_POST['addtocart'])) {
                $iduser = $_SESSION['user']['id'];
                $idpro = $_POST['id'];
                $name = $_POST['name'];
                $img = $_POST['img'];
                $price = $_POST['price'];
                $soluong = $_POST['soluong'] ?? 1;
                $thanhtien = $soluong * $price;

                insert_cart_temp($iduser, $idpro, $img, $name, $price, $soluong, $thanhtien);
                header("Location: index.php?act=viewcart");
                exit();
            }
            break;


        case 'xoacart':
            if (isset($_GET['id'])) {
                delete_cart_temp_item($_GET['id']);
            }
            header("Location: index.php?act=viewcart");
            exit();
            break;


        case 'viewcart':
            if (isset($_SESSION['user'])) {
                $iduser = $_SESSION['user']['id'];
                $cart_items = load_cart_temp_by_user($iduser); // dữ liệu từ DB
                include "view/cart/viewcart.php";
            } else {
                header("Location: index.php?act=dangnhap");
            }
            break;


        case 'bill':
            include "view/cart/bill.php";
            break;

        case 'billcomfirm':
            if (isset($_POST['dongydathang'])) {
                date_default_timezone_set('Asia/Ho_Chi_Minh'); // 🛠️ Dòng quan trọng thêm vào
                $iduser = $_SESSION['user']['id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                $pttt = $_POST['pttt'];
                $ngaydathang = date("Y-m-d H:i:s");
                $tongdonhang = tongdonhang_temp($iduser);

                $idbill = insert_bill($iduser, $name, $email, $address, $tel, $pttt, $ngaydathang, $tongdonhang);
                $cart_items = load_cart_temp_by_user($iduser);

                foreach ($cart_items as $item) {
                    insert_cart($iduser, $item['idpro'], $item['img'], $item['name'], $item['price'], $item['soluong'], $item['thanhtien'], $idbill);
                }

                delete_cart_temp_by_user($iduser);
                $_SESSION['idbill'] = $idbill;
                header("Location: index.php?act=billcomfirm");
                exit();
            }

            if (isset($_SESSION['idbill'])) {
                $idbill = $_SESSION['idbill'];
                $bill = loadone_bill($idbill);
                $billct = loadall_cart($idbill);
                include "view/cart/billcomfirm.php";
                unset($_SESSION['idbill']);
            }
            break;

        case 'myorder':
            $listbill = loadall_bill($_SESSION['user']['id']);
            include "view/cart/myorder.php";
            break;

        case 'chitietdonhang':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $idbill = $_GET['id'];
                $bill = loadone_bill($idbill);
                $cart_detail = load_cart_by_idbill($idbill);
                include "view/cart/chitietdonhang.php";
            }
            break;

        case 'huydonhang':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];
                $bill = loadone_bill($id); // lấy đơn hàng theo ID

                // ✅ Chỉ hủy nếu đang ở trạng thái mới hoặc đang xử lý
                if ($bill['bill_status'] == 0 || $bill['bill_status'] == 1) {
                    update_bill_status($id, 4); // đổi trạng thái thành "Đã hủy"
                }
                // Quay lại danh sách đơn hàng
                header("Location: index.php?act=myorder");
            }
            break;
        default:
            include 'view/home.php';
            break;
    }
} else {
    include "view/home.php";
}

include "view/footer.php";
