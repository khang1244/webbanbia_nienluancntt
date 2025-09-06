<?php
// ob_start(); // Bật bộ đệm output để tránh in linh tinh

// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

include_once "model/pdo.php";
include_once "model/cart_temp.php";
include_once "global.php";


if (isset($_POST['update_quantity'])) {
    //Dọn sạch mọi output buffer để không in ra dữ liệu thừa → đảm bảo trả về JSON sạch.
    while (ob_get_level()) {
        ob_end_clean(); // Loại bỏ mọi output buffer đang tồn tại
    }

    header('Content-Type: application/json; charset=utf-8');

    //📌 Lấy ID của sản phẩm và số lượng mới từ Ajax và ép kiểu sang số nguyên để bảo mật.
    $id = intval($_POST['id']);
    $soluong = intval($_POST['soluong']);

    //📌 Cập nhật số lượng trong DB 
    pdo_execute("UPDATE cart_temp SET soluong = $soluong WHERE id = $id");

    //📌 Tính lại thành tiền của sản phẩm và tổng tiền của giỏ hàng
    $row = pdo_query_one("SELECT price, soluong FROM cart_temp WHERE id = $id");
    $thanhtien = $row['price'] * $row['soluong'];

    //📌 Tính tổng tiền của giỏ hàng hiện tại
    $iduser = $_SESSION['user']['id'];
    $tong = pdo_query_one("SELECT SUM(price * soluong) AS tong FROM cart_temp WHERE iduser = $iduser")['tong'] ?? 0;

    echo json_encode([
        'thanhtien' => $thanhtien,
        'tongtien'  => $tong,
    ]);
    exit();
}



?>

<body>
    <div class="container my-5">
        <h3 class="text-center mb-4 text-uppercase fw-bold">
            <i class="bi bi-cart-plus"></i> Giỏ hàng
        </h3>

        <?php if (!empty($cart_items)) : ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tong = 0;
                        foreach ($cart_items as $item) {
                            $hinh = $img_path . $item['img'];
                            $ttien = $item['price'] * $item['soluong'];
                            $tong += $ttien;
                            $xoasp = '<a href="index.php?act=xoacart&id=' . $item['id'] . '" onclick="return confirm(\'Bạn có chắc muốn xóa sản phẩm này không?\');"><input type="button" value="Xóa" class="btn btn-danger btn-sm"></a>';

                            echo '
                            <tr>
                                <td><img src="' . htmlspecialchars($hinh) . '" alt="Ảnh sản phẩm" class="img-thumbnail" style="height: 60px;"></td>
                                <td>' . htmlspecialchars($item['name']) . '</td>
                                <td>' . number_format($item['price'], 0, ',', '.') . ' VND</td>
                                <td>
                                    <input type="number" 
                                        name="soluong[' . $item['idpro'] . ']" 
                                        value="' . $item['soluong'] . '" 
                                        min="1" 
                                        class="form-control quantity-input" 
                                        data-id="' . $item['id'] . '"
                                        style="width: 70px; margin: auto;">
                                </td>
                                <td id="thanhtien-' . $item['id'] . '">' . number_format($ttien, 0, ',', '.') . ' VND</td>
                                <td>' . $xoasp . '</td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="text-end fw-bold mt-2">
                Tổng tiền: <span class="text-danger fw-bold" id="tongtien"><?= number_format($tong, 0, ',', '.') ?> VND</span>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="index.php" class="btn btn-secondary">← Tiếp tục mua sắm</a>
                <form action="index.php?act=bill" method="post">
                    <button type="submit" class="btn btn-success" name="dongydathang">Bắt đầu đặt hàng</button>
                </form>
            </div>

        <?php else : ?>
            <div class="alert alert-warning text-center">
                Giỏ hàng của bạn đang trống.
            </div>
            <div class="text-center">
                <a href="index.php" class="btn btn-primary">← Quay lại mua sắm</a>
            </div>
        <?php endif; ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

    <script>
        function formatVND(num) {
            return new Intl.NumberFormat('vi-VN').format(num) + ' VND';
        }

        $(document).ready(function() {
            let timer;
            $(".quantity-input").on("input", function() {
                clearTimeout(timer);
                let input = $(this);
                timer = setTimeout(function() {
                    let id = input.data("id");
                    let newQty = parseInt(input.val());
                    if (isNaN(newQty) || newQty < 1) {
                        alert("Số lượng phải >= 1");
                        input.val(1);
                        newQty = 1;
                    }
                    $.ajax({
                        url: "",
                        type: "POST",
                        data: {
                            update_quantity: true,
                            id: id,
                            soluong: newQty
                        },
                        success: function(response) {
                            $("#thanhtien-" + id).text(formatVND(response.thanhtien));
                            $("#tongtien").text(formatVND(response.tongtien));

                            $.toast({
                                heading: 'Thành công',
                                text: 'Cập nhật số lượng thành công!',
                                icon: 'success',
                                showHideTransition: 'slide',
                                hideAfter: 2000,
                                position: 'top-right'
                            });
                        },
                        error: function(xhr) {
                            alert("Cập nhật số lượng thất bại!");
                            console.error(xhr.responseText);
                        }
                    });
                }, 500);
            });
        });
    </script>
</body>

</html>