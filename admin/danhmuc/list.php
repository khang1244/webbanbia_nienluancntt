<!-- BẮT ĐẦU: Giao diện quản lý danh mục -->
<div class="main-content py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0 text-uppercase">
                <i class="fa-solid fa-list me-2 text-primary"></i> Quản lý danh mục
            </h3>
            <a href="index.php?act=adddm" class="btn btn-primary rounded-pill shadow-sm">
                <i class="fa-solid fa-plus me-1"></i> Thêm danh mục
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle shadow-sm rounded">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 10%;">Mã loại</th>
                        <th style="width: 60%;">Tên loại</th>
                        <th style="width: 30%;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($listdanhmuc as $danhmuc) {
                        extract($danhmuc);
                        $suadm = "index.php?act=suadm&id=" . $id;
                        $xoadm = "index.php?act=xoadm&id=" . $id;
                        echo '
                        <tr class="text-center">
                            <td class="fw-semibold">' . $id . '</td>
                            <td class="text-start">' . $name . '</td>
                            <td>
                                <a href="' . $suadm . '" class="btn btn-warning btn-sm me-2 shadow-sm">
                                    <i class="fa-solid fa-pen-to-square"></i> Sửa
                                </a>
                                <a href="' . $xoadm . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa?\')" class="btn btn-danger btn-sm shadow-sm">
                                    <i class="fa-solid fa-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- KẾT THÚC -->