<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<form action="index.php?act=billcomfirm" method="post">
    <!-- Xác nhận thông tin đơn hàng -->
    <div class="card mb-4 shadow-sm border-0 rounded-4">
        <div class="card-header fw-bold bg-info text-white">
            <i class="bi bi-check-circle me-2"></i> XÁC NHẬN THÔNG TIN ĐƠN HÀNG
        </div>
        <div class="card-body">
            <p class="text-muted">Vui lòng kiểm tra lại thông tin của bạn trước khi bấm ĐỒNG Ý ĐẶT HÀNG.</p>
        </div>
    </div>
    <!-- THÔNG TIN ĐẶT HÀNG -->
    <div class="card mb-4 shadow-sm border-0 rounded-4">
        <div class="card-header fw-bold bg-primary text-white">
            <i class="bi bi-info-circle-fill me-2"></i>THÔNG TIN ĐẶT HÀNG
        </div>
        <div class="card-body">
            <?php
            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user']['fullname'];
                $address = $_SESSION['user']['address'];
                $email = $_SESSION['user']['email'];
                $tel = $_SESSION['user']['tel'];
            } else {
                $user = '';
                $address = '';
                $email = '';
                $tel = '';
            }
            ?>
            <div class="mb-3">
                <label class="form-label fw-semibold">👤 Người đặt hàng</label>
                <input type="text" class="form-control rounded-3" name="name" value="<?= $user ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">📍 Địa chỉ</label>
                <input type="text" class="form-control rounded-3" name="address" value="<?= $address ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">📧 Email</label>
                <input type="email" class="form-control rounded-3" name="email" value="<?= $email ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">📞 Điện thoại</label>
                <input type="tel" class="form-control rounded-3" name="tel" value="<?= $tel ?>" required>
            </div>

        </div>
    </div>

    <!-- PHƯƠNG THỨC THANH TOÁN -->
    <div class="card mb-4 shadow-sm border-0 rounded-4">
        <div class="card-header fw-bold bg-success text-white">
            <i class="bi bi-cash-coin me-2"></i>PHƯƠNG THỨC THANH TOÁN
        </div>
        <div class="card-body">
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="pttt" value="1" id="pt1" checked>
                <label class="form-check-label" for="pt1">💸 Trả tiền khi nhận hàng</label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="pttt" value="2" id="pt2">
                <label class="form-check-label" for="pt2">🏦 Chuyển khoản ngân hàng</label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="pttt" value="3" id="pt3">
                <label class="form-check-label" for="pt3">💳 Thanh toán online</label>
            </div>

            <!-- Nơi hiển thị nội dung chi tiết -->
            <div id="ptttInfo" class="mt-3 p-3 border rounded bg-light d-none"></div>
        </div>
    </div>

    <!-- THÔNG TIN GIỎ HÀNG -->
    <div class="card mb-4 shadow-sm border-0 rounded-4">
        <div class="card-header fw-bold bg-warning text-dark">
            <i class="bi bi-cart-check-fill me-2"></i>THÔNG TIN GIỎ HÀNG
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle table-hover rounded-3 overflow-hidden">
                    <thead class="table-dark text-white">
                        <tr>
                            <th>🖼️ Hình ảnh</th>
                            <th>📦 Sản phẩm</th>
                            <th>💰 Đơn giá</th>
                            <th>🔢 Số lượng</th>
                            <th>📊 Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tong = 0;
                        foreach ($cart as $item) {
                            $hinh = $img_path . $item['img'];
                            $ttien = $item['price'] * $item['soluong'];
                            $tong += $ttien;

                            echo '<tr>
                                <td><img src="' . $hinh . '" style="height: 60px;" class="img-thumbnail rounded-2"></td>
                                <td>' . $item['name'] . '</td>
                                <td>' . number_format($item['price'], 0, ',', '.') . ' VND</td>
                                <td>' . $item['soluong'] . '</td>
                                <td class="text-danger fw-bold">' . number_format($ttien, 0, ',', '.') . ' VND</td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="text-end fw-bold fs-5 mt-3">
                Tổng tiền: <span class="text-danger"><?= number_format($tong, 0, ',', '.') ?> VND</span>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="index.php" class="btn btn-outline-secondary rounded-pill px-4">← Tiếp tục mua sắm</a>
                <button type="submit" class="btn btn-success rounded-pill px-4" name="dongydathang">
                    ✅ Đồng ý đặt hàng
                </button>
            </div>
        </div>
    </div>
</form>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<!-- THÊM JAVASCRIPT DƯỚI FORM -->
<script>
    const radios = document.querySelectorAll('input[name="pttt"]');
    const infoDiv = document.getElementById('ptttInfo');

    function showPaymentInfo(value) {
        let content = '';
        switch (value) {
            case '1':
                content = '<strong>💸 Bạn sẽ thanh toán khi nhận hàng tại địa chỉ giao.</strong>';
                break;
            case '2':
                content = `<strong>🏦 Chuyển khoản ngân hàng:</strong><br>
                           - Chủ tài khoản: <b>Hoàng Khang</b><br>
                           - Số tài khoản: <b>0123 456 789</b><br>
                           - Ngân hàng: <b>Vietcombank - Chi nhánh Cần Thơ</b>`;
                break;
            case '3':
                content = '<strong>💳 Bạn sẽ thanh toán qua cổng thanh toán online.</strong>';
                break;
        }

        infoDiv.innerHTML = content;
        infoDiv.classList.remove('d-none');
    }

    radios.forEach(radio => {
        radio.addEventListener('change', () => {
            showPaymentInfo(radio.value);
        });
    });

    // Hiển thị mặc định nếu có radio được chọn sẵn
    const checked = document.querySelector('input[name="pttt"]:checked');
    if (checked) {
        showPaymentInfo(checked.value);
    }
</script>