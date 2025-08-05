<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-body px-5 py-4">
            <h2 class="text-center mb-4">
                <span class="fw-bold text-dark">🍻 Cửa hàng bia Hoàng Khang</span><br>
                <span class="text-success fs-4">✅ Cảm ơn quý khách đã đặt hàng!</span>
            </h2>


            <?php
            if (isset($bill) && (is_array($bill))) {
                extract($bill);
            }
            ?>

            <!-- Thông tin đơn hàng -->
            <div class="mb-4">
                <h5 class="fw-bold border-start border-4 ps-3 text-primary">🧾 Thông tin đơn hàng</h5>
                <ul class="list-unstyled ps-3 mb-0 text-muted">
                    <li><strong>Mã đơn hàng:</strong> HK-<?= $bill['id']; ?></li>
                    <li><strong>Ngày đặt hàng:</strong> <?= $bill['ngaydathang']; ?></li>
                    <li><strong>Tổng đơn hàng:</strong> <?= number_format($total, 0, ",", ".") ?> VND</li>
                    <li><strong>Phương thức thanh toán:</strong>
                        <?php
                        switch ($bill['bill_pttt']) {
                            case 1:
                                echo '💸 Trả tiền khi nhận hàng';
                                break;
                            case 2:
                                echo '🏦 Chuyển khoản ngân hàng';
                                break;
                            case 3:
                                echo '💳 Thanh toán online';
                                break;
                            default:
                                echo '❓ Không xác định';
                        }
                        ?>
                    </li>

                </ul>
            </div>

            <!-- Thông tin người đặt -->
            <div class="mb-4">
                <h5 class="fw-bold border-start border-4 ps-3 text-primary">👤 Thông tin người đặt</h5>
                <ul class="list-unstyled ps-3 mb-0 text-muted">
                    <li><strong>Họ tên:</strong> <?= $bill['bill_name']; ?></li>
                    <li><strong>Địa chỉ:</strong> <?= $bill['bill_address']; ?></li>
                    <li><strong>Email:</strong> <?= $bill['bill_email']; ?></li>
                    <li><strong>Điện thoại:</strong> <?= $bill['bill_tel']; ?></li>
                </ul>
            </div>

            <!-- Chi tiết giỏ hàng -->
            <div>
                <h5 class="fw-bold border-start border-4 ps-3 text-primary">🛒 Chi tiết giỏ hàng</h5>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center table-striped rounded-3 overflow-hidden">
                        <thead class="table-dark text-white">
                            <tr>
                                <th>Hình</th>
                                <th>Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <?php
                        $tong = 0;
                        $i = 0;
                        foreach ($billct as $cart) {
                            $hinh = $img_path . $cart['img'];
                            $ttien = $cart['price'] * $cart['soluong'];
                            $tong += $ttien;
                            echo '<tbody>
                                <tr>
                                    <td><img src="' . $hinh . '" alt="" class="img-fluid rounded" style="height: 60px;"></td>
                                    <td>' . $cart['name'] . '</td>
                                    <td>' . number_format($cart['price'], 0, ',', '.') . ' VND</td>
                                    <td>' . $cart['soluong'] . '</td>
                                    <td class="fw-bold text-danger">' . number_format($ttien, 0, ',', '.') . ' VND</td>
                                </tr>
                            </tbody>';
                            $i += 1;
                        }
                        ?>
                    </table>
                </div>

                <div class="text-end fw-bold mt-3 fs-5">
                    Tổng tiền: <span class="text-danger"><?= number_format($tong, 0, ',', '.') ?> VND</span>
                </div>
            </div>
        </div>
    </div>
</div>