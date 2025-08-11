<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Thêm thư viện jQuery và jquery-toast-plugin -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-uppercase fw-bold">Danh sách đơn hàng</h3>

    </div>

    <form action="index.php?act=listdonhang" method="post" class="row g-2 mb-3">
        <div class="col-auto">
            <input type="text" name="kyw" class="form-control" placeholder="Nhập mã đơn hàng">
        </div>
        <div class="col-auto">
            <button type="submit" name="listok" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>Mã đơn hàng</th>
                    <th>Khách hàng</th>
                    <th>Mặt hàng </th>
                    <th>Giá trị</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listdonhang as $bill):
                    extract($bill);
                    $kh = $bill['bill_name'] . '<br><small>' . $bill['bill_email'] . '</small><br><small>' . $bill['bill_address'] . '</small><br><small>' . $bill['bill_tel'] . '</small>';
                    $ttdh = xulydonhang($bill['bill_status']);
                    $countsp = loadall_diemsoluong($bill['id']);
                    // Gán màu badge theo trạng thái đơn hàng
                    switch ($bill['bill_status']) {
                        case 0:
                            $badgeClass = 'secondary';
                            break; // Đơn hàng mới
                        case 1:
                            $badgeClass = 'warning';
                            break;   // Đang xử lý
                        case 2:
                            $badgeClass = 'info';
                            break;      // Đang giao hàng
                        case 3:
                            $badgeClass = 'success';
                            break;   // Đã giao
                        case 4:
                            $badgeClass = 'danger';
                            break;    // Đã hủy
                        default:
                            $badgeClass = 'dark';
                            break;
                    }
                ?>
                    <tr>
                        <td><input type="checkbox" name="chon[]" value="<?= $bill['id'] ?>"></td>
                        <td><strong>LHK-<?= $bill['id'] ?></strong></td>
                        <td class="text-start"><?= $kh ?></td>
                        <td><?= $countsp ?></td>
                        <td><strong><?= number_format($bill['total'], 0, ',', '.') ?></strong> VNĐ</td>
                        <td><span class="badge bg-<?= $badgeClass ?>"><?= $ttdh ?></span></td>
                        <td><?= $bill['ngaydathang'] ?></td>
                        <td>
                            <a href="index.php?act=chitietdonhangadmin&id=<?= $id ?>" class="btn btn-info btn-sm">Chi tiết</a>
                            <a href="index.php?act=suadonhang&id=<?= $bill['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="index.php?act=xoadonhang&id=<?= $bill['id'] ?>" onclick="return confirm('Bạn có chắc chắn xóa đơn hàng LHK- <?= $bill['id'] ?> không?');" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Phân trang sản phẩm -->
        <div class="text-center mt-3">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="index.php?act=listdonhang&page=<?= $i ?>" class="btn btn-sm <?= ($i == $page) ? 'btn-primary' : 'btn-outline-primary' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>

    </div>

</div>