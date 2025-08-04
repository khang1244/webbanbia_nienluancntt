<?php

$img_path = "../upload/";

?>

<div class="container my-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-receipt"></i> Chi tiết đơn hàng <strong>DAM-<?= $bill['id'] ?></strong>
            </h4>

        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <p><i class="bi bi-calendar-check"></i> <strong>Ngày đặt:</strong> <?= $bill['ngaydathang'] ?></p>
                </div>
                <div class="col-md-4">
                    <p><i class="bi bi-wallet2"></i> <strong>Tổng tiền:</strong> <?= number_format($bill['total'], 0, ",", ".") ?> ₫</p>
                </div>
                <div class="col-md-4">
                    <p><i class="bi bi-truck"></i> <strong>Trạng thái:</strong> <?= xulydonhang($bill['bill_status']) ?></p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-dark text-white">
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($cart_detail as $item):
                            $hinh = $img_path . $item['img'];
                            $thanhtien = $item['price'] * $item['soluong'];
                        ?>
                            <tr>
                                <td><img src="<?= $hinh ?>" class="img-thumbnail" style="width: 70px; height: 70px; object-fit: cover;"></td>
                                <td><?= $item['name'] ?></td>
                                <td><?= number_format($item['price'], 0, ",", ".") ?> ₫</td>
                                <td><?= $item['soluong'] ?></td>
                                <td class="text-success fw-bold"><?= number_format($thanhtien, 0, ",", ".") ?> ₫</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>