<div class="container py-4 border bg-white my-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">📦 Đơn hàng của tui</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Mặt hàng</th>
                        <th>Tổng giá trị</th>
                        <th>Tình trạng</th>
                        <th>Chi tiết</th> <!-- Cột mới thêm -->

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($listbill)) {
                        foreach ($listbill as $bill) {
                            extract($bill);
                            $ttdh = xulydonhang($bill['bill_status']);
                            $diemsoluongsp = loadall_diemsoluong($bill['id']);

                            switch ($bill['bill_status']) {
                                //Đơn hàng mới
                                case 0:
                                    $badgeClass = 'secondary';
                                    $icon = '<i class="bi bi-plus-circle me-1"></i>';
                                    break;
                                // Đang xử lý
                                case 1:
                                    $badgeClass = 'warning';
                                    $icon = '<i class="bi bi-hourglass-split me-1"></i>';
                                    break;
                                // Đang giao hàng
                                case 2:
                                    $badgeClass = 'info';
                                    $icon = '<i class="bi bi-truck me-1"></i>';
                                    break;
                                // Đã giao hàng
                                case 3:
                                    $badgeClass = 'success';
                                    $icon = '<i class="bi bi-check-circle me-1"></i>';
                                    break;
                                // Đã hủy
                                case 4:
                                    $badgeClass = 'danger';
                                    $icon = '<i class="bi bi-x-circle me-1"></i>';
                                    break;
                                default:
                                    // Không xác định
                                    $badgeClass = 'dark';
                                    $icon = '';
                                    break;
                            }


                            echo '
                            <tr>
                                <td><strong>DAM-' . $bill['id'] . '</strong></td>
                                <td>' . $bill['ngaydathang'] . '</td>
                                <td>' . $diemsoluongsp . '</td>
                                <td>' . number_format($total, 0, ",", ".") . ' ₫</td>
                               <td><span class="badge bg-' . $badgeClass . '">' . $icon . $ttdh . '</span></td>
                                <td>
                                    <a class="btn btn-outline-primary btn-sm" href="index.php?act=chitietdonhang&id=' . $bill['id'] . '">Xem chi tiết</a>';

                            // ✅ Chỉ hiện nút hủy nếu trạng thái là 0 hoặc 1
                            if ($bill['bill_status'] == 0 || $bill['bill_status'] == 1) {
                                echo ' <a class="btn btn-outline-danger btn-sm ms-1"
                                           href="index.php?act=huydonhang&id=' . $bill['id'] . '"
                                           onclick="return confirm(\'Bạn có chắc muốn hủy đơn hàng này không?\');">
                                           Hủy đơn
                                       </a>';
                            }

                            echo '</td></tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>