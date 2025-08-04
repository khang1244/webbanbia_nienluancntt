<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    $bill = loadone_bill($id); // từ model/bill.php
}
?>

<div class="container mt-4">
    <h3 class="text-uppercase fw-bold mb-3">Cập nhật trạng thái đơn hàng</h3>
    <form action="index.php?act=updatesuadonhang" method="post" class="w-50">
        <input type="hidden" name="id" value="<?= $bill['id'] ?>">

        <div class="mb-3">
            <label for="bill_status" class="form-label">Trạng thái đơn hàng:</label>
            <select name="bill_status" id="bill_status" class="form-select">
                <option value="0" <?= ($bill['bill_status'] == 0) ? 'selected' : '' ?>>Đơn hàng mới</option>
                <option value="1" <?= ($bill['bill_status'] == 1) ? 'selected' : '' ?>>Đang xử lý</option>
                <option value="2" <?= ($bill['bill_status'] == 2) ? 'selected' : '' ?>>Đang giao hàng</option>
                <option value="3" <?= ($bill['bill_status'] == 3) ? 'selected' : '' ?>>Đã giao hàng</option>
                <option value="4" <?= ($bill['bill_status'] == 4) ? 'selected' : '' ?>>Đã hủy</option>
            </select>
        </div>

        <button type="submit" name="capnhat" class="btn btn-primary">Cập nhật</button>
        <a href="index.php?act=listdonhang" class="btn btn-secondary">Quay lại</a>
    </form>
</div>