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

            // Kiểm tra và tìm kiếm sản phẩm theo từ khóa
            if (!empty($kyw)) {
                if (strlen($kyw) >= 3) {  // Kiểm tra nếu từ khóa dài ít nhất 3 ký tự
                    // Tìm sản phẩm theo từ khóa và danh mục (nếu có)
                    $spnew = loadall_sanpham($kyw, $iddm);
                    if (empty($spnew)) {
                        $thongbao_sanpham = "Không có sản phẩm phù hợp với từ khóa \"$kyw\".";
                    } else {
                        $thongbao_sanpham = "Đã tìm thấy " . count($spnew) . " sản phẩm phù hợp với từ khóa \"$kyw\".";
                    }
                } else {
                    // Nếu từ khóa quá ngắn, thông báo cho khách hàng
                    $thongbao_sanpham = "Từ khóa tìm kiếm phải có ít nhất 3 ký tự!";
                    $spnew = []; // Không thực hiện tìm kiếm nếu từ khóa quá ngắn
                }
            } else {
                $spnew = []; // Nếu không có từ khóa, không tìm kiếm
            }

            // Kiểm tra nếu có danh mục được chọn
            if ($iddm > 0) {
                // Tìm sản phẩm trong danh mục nếu có iddm
                $spnew = loadall_sanpham("", $iddm); // Tìm sản phẩm theo danh mục
                if (empty($spnew)) {
                    $thongbao_danhmuc = "Danh mục này không có sản phẩm!";
                } else {
                    // Lấy tên danh mục
                    $tendm = load_ten_dm($iddm);
                    $thongbao_danhmuc = "Danh mục \"$tendm\" có " . count($spnew) . " sản phẩm.";
                }
            }

            // Load danh sách danh mục để hiển thị
            $dsdm = loadall_danhmuc();

            // Lấy tên danh mục nếu có iddm
            if ($iddm > 0) {
                $tendm = load_ten_dm($iddm);
            } else {
                $tendm = "Tất cả sản phẩm";
            }

            // Gửi dữ liệu và hiển thị view
            include "view/home.php";
            break;






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
            if (!empty($_POST['dangky'])) {
                $email = $_POST['email'];
                $user = $_POST['user'];
                $fullname = $_POST['fullname'];
                $password = $_POST['password'];
                $repassword = $_POST['repassword'];

                // Kiểm tra tên đăng nhập >= 8 ký tự
                if (strlen($user) < 8) {
                    echo "<script>
                    alert('Tên đăng nhập phải từ 8 ký tự trở lên!');
                    window.location.href='index.php?act=dangky';
                  </script>";
                    exit();
                }

                // Kiểm tra mật khẩu: ít nhất 8 ký tự, có chữ hoa và ký tự đặc biệt
                if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password)) {
                    echo "<script>
                    alert('Mật khẩu phải có ít nhất 8 ký tự, gồm chữ hoa và ký tự đặc biệt!');
                    window.location.href='index.php?act=dangky';
                  </script>";
                    exit();
                }

                // Kiểm tra mật khẩu nhập lại khớp
                if ($password !== $repassword) {
                    echo "<script>
                    alert('Mật khẩu nhập lại không khớp!');
                    window.location.href='index.php?act=dangky';
                  </script>";
                    exit();
                }

                // Kiểm tra tên đăng nhập đã tồn tại chưa
                if (trungtenkhidangky($user)) {
                    echo "<script>
                    alert('Tên đăng nhập đã tồn tại, vui lòng chọn tên khác!');
                    window.location.href='index.php?act=dangky';
                  </script>";
                    exit();
                }

                // Kiểm tra email đã tồn tại chưa
                if (trungemailkhidangky($email)) {
                    echo "<script>
                    alert('Email đã được sử dụng, vui lòng nhập email khác!');
                    window.location.href='index.php?act=dangky';
                  </script>";
                    exit();
                }

                // Mã hóa mật khẩu và thêm tài khoản mới
                $password_md5 = md5($password);
                insert_taikhoan($email, $user, $fullname, $password_md5);

                // Thông báo đăng ký thành công và chuyển sang trang đăng nhập
                $_SESSION['thongbao'] = "Đăng ký thành công, vui lòng đăng nhập!";
                echo "<script>
                alert('Đăng ký thành công!');
                window.location.href='index.php?act=dangnhap';
              </script>";
                exit();
            }

            // Hiển thị form đăng ký
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

                    // Chuyển hướng bằng header, không dùng alert nữa (alert sẽ làm mất tự động chuyển trang)
                    if ($checkuser['role'] == 1) {
                        header("Location: admin/index.php?act=thongketongquan");
                        exit();
                    } else {
                        header("Location: index.php");
                        exit();
                    }
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
            // Kiểm tra nếu người dùng chưa đăng nhập thì chuyển hướng đến trang đăng nhập
            if (!isset($_SESSION['user'])) {
                header("Location: index.php?act=dangnhap");
                exit;
            }
            $iduser = $_SESSION['user']['id'];
            $idpro = $_POST['id'];
            $name = $_POST['name'];
            $img = $_POST['img'];
            $price = $_POST['price'];
            $soluong = intval($_POST['soluong']);

            // Hàm kiểm tra sản phẩm đã có trong giỏ chưa
            if (check_product_in_cart($iduser, $idpro)) {
                // Nếu đã có thì thông báo không cho thêm nữa
                echo "<script>alert('Sản phẩm đã có trong giỏ hàng! Vui lòng vào giỏ hàng để thay đổi số lượng sản phẩm.'); 
                window.location.href='index.php?act=viewcart';</script>";
            } else {
                // Thêm sản phẩm vào giỏ
                $result = add_to_cart($iduser, $idpro, $img, $name, $price, $soluong);
                if ($result) {
                    echo "<script>alert('Thêm sản phẩm vào giỏ hàng thành công!'); window.location.href=' index.php?act=viewcart';</script>";
                } else {
                    echo "<script>alert('Thêm sản phẩm thất bại!'); window.location.href='index.php';</script>";
                }
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
