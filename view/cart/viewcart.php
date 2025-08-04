<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Giỏ Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .btn {
            border-radius: 50px;
        }
    </style>
</head>

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
                                <td><img src="' . $hinh . '" alt="" class="img-thumbnail" style="height: 60px;"></td>
                                <td>' . $item['name'] . '</td>
                                <td>' . number_format($item['price'], 0, ',', '.') . ' VND</td>
                                <td>' . $item['soluong'] . '</td>
                                <td>' . number_format($ttien, 0, ',', '.') . ' VND</td>
                                <td>' . $xoasp . '</td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="text-end fw-bold mt-2">
                Tổng tiền: <span class="text-danger"><?= number_format($tong, 0, ',', '.') ?> VND</span>
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

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>