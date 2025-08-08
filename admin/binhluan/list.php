<div class="main-content">
    <div class="container">
        <h3 class="text-primary fw-bold mb-4">Danh sách bình luận</h3>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nội dung</th>
                        <th scope="col">ID User</th>
                        <th scope="col">ID Sản phẩm</th>
                        <th scope="col">Ngày bình luận</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($listbinhluan as $binhluan) {
                        extract($binhluan);
                        $xoabl = "index.php?act=xoabl&id=" . $id;

                        echo '<tr>
                            <td>' . $id . '</td>
                            <td class="text-start">' . $noidung . '</td>
                            <td>' . $iduser . '</td>
                            <td>' . $idpro . '</td>
                            <td>' . $ngaybinhluan . '</td>
                            <td>
                                <a href="' . $xoabl . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\')">
                                    <i class="fa-solid fa-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
            <style>
                table {
                    table-layout: fixed;
                    width: 100%;
                }
            </style>
            <nav>
                <ul class="pagination justify-content-center mt-4">
                    <?php
                    for ($i = 1; $i <= $total_pages; $i++) : ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="index.php?act=listbl&page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>

        </div>
    </div>
</div>