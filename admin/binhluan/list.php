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
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listbinhluan as $binhluan):
                        extract($binhluan);
                        $xoabl = "index.php?act=xoabl&id=" . $id;
                        $duyetbl = "index.php?act=duyetbl&id=" . $id;
                    ?>
                        <tr>
                            <td><?= $id ?></td>
                            <td class="text-start"><?= htmlspecialchars($noidung) ?></td>
                            <td><?= $iduser ?></td>
                            <td><?= $idpro ?></td>
                            <td><?= $ngaybinhluan ?></td>
                            <td>
                                <?php if ($trangthai == 1): ?>
                                    <span class="badge bg-success">Đã duyệt</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Chờ duyệt</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($trangthai == 0): ?>
                                    <a href="<?= $duyetbl ?>" class="btn btn-sm btn-success"
                                        onclick="return confirm('Bạn có muốn duyệt bình luận này không?')">
                                        <i class="fa fa-check"></i> Duyệt
                                    </a>
                                <?php endif; ?>
                                <a href="<?= $xoabl ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận có ID <?= $id ?> không?')">
                                    <i class="fa-solid fa-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <style>
                td.text-start {
                    word-wrap: break-word;
                    white-space: pre-wrap;
                    max-width: 300px;
                    overflow-wrap: break-word;
                }
            </style>

            <nav>
                <ul class="pagination justify-content-center mt-4">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="index.php?act=listbl&page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>

        </div>
    </div>
</div>