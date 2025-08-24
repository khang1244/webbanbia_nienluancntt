<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thống kê sản phẩm theo loại</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        h3 {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <h3 class="text-center mb-4">Thống kê sản phẩm theo danh mục</h3>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>MÃ DANH MỤC</th>
                                <th>TÊN DANH MỤC</th>
                                <th>SỐ LƯỢNG</th>
                                <th>GIÁ CAO NHẤT</th>
                                <th>GIÁ THẤP NHẤT</th>
                                <th>GIÁ TRUNG BÌNH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listthongke as $thongke) {
                                extract($thongke);
                                echo '<tr>
                                        <td>' . $madm . '</td>
                                        <td>' . $tendm . '</td>
                                        <td>' . $countsp . '</td>
                                        <td>' . number_format($maxprice, 0, ',', '.') . ' đ</td>
                                        <td>' . number_format($minprice, 0, ',', '.') . ' đ</td>
                                        <td>' . number_format($avgprice, 0, ',', '.') . ' đ</td>
                                      </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-end">
                    <a href="index.php?act=bieudo" class="btn btn-primary">Xem biểu đồ</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>