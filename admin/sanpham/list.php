<!--  -->

<div class="main-content">
    <div class="container">
        <h3 class="title-page">QUẢN LÝ SẢN PHẨM</h3>

        <!-- Nút thêm sản phẩm -->
        <div class="d-flex justify-content-end">
            <a href="index.php?act=addsp" class="btn btn-primary mb-3">Thêm sản phẩm</a>
        </div>

        <!-- Form lọc/tìm kiếm -->
        <form action="index.php?act=listsp" method="post" class="row g-3 align-items-end mb-4">

            <!-- Từ khóa tìm kiếm -->
            <div class="col-md-5">
                <label class="form-label">Từ khóa</label>
                <input type="text" name="kyw" class="form-control" placeholder="Nhập tên sản phẩm..."
                    value="<?= isset($_POST['kyw']) ? htmlspecialchars($_POST['kyw']) : '' ?>" autocomplete="off">
            </div>

            <!-- Dropdown danh mục -->
            <div class="col-md-4">
                <label class="form-label">Danh mục</label>
                <select name="iddm" class="form-select">
                    <option value="0" <?= (!isset($_POST['iddm']) || $_POST['iddm'] == 0) ? 'selected' : '' ?>>Tất cả</option>
                    <?php
                    foreach ($listdanhmuc as $danhmuc) {
                        extract($danhmuc);
                        // Giữ lại giá trị danh mục đã chọn
                        $selected = (isset($_POST['iddm']) && $_POST['iddm'] == $id) ? 'selected' : '';
                        echo '<option value="' . $id . '" ' . $selected . '>' . $name . '</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- Nút lọc -->
            <div class="col-md-3 d-grid">
                <label class="form-label d-none d-md-block">&nbsp;</label>
                <input type="submit" name="listok" class="btn btn-primary" value="Lọc">
            </div>

        </form>


        <table id="example" class="table table-striped text-center" style="width:100%">
            <thead>
                <tr>
                    <th>Mã Loại </th>
                    <th>Hình</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá</th>
                    <!-- <th>Mô tả</th> -->
                    <th>Danh mục cùng loại</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($listsanpham as $sanpham) {
                    extract($sanpham);
                    $suasp = "index.php?act=suasp&id=" . $id;
                    $xoasp = "index.php?act=xoasp&id=" . $id;
                    $hinhpath = "../upload/" . $img;
                    $hinh = is_file($hinhpath)
                        ? "<img src='" . $hinhpath . "' height='90' style='object-fit:cover;width:80px;border-radius:5px;'>"
                        : "Không có hình";

                    echo '<tr class="align-middle">
                    <td>' . $id . '</td>
                    <td>' . $hinh . '</td>
                    <td style="max-width: 300px; white-space: normal; word-wrap: break-word;">' . $name . '</td>

                    <td>' . number_format($price, 0, ',', '.') . ' VND</td>

                  <!--  <td style="white-space: normal; word-break: break-word; max-width: 300px; text-align: justify;">' . $mota . '</td>-->

                  <td>' . (isset($mapDanhMuc[$sanpham['iddm']]) ? $mapDanhMuc[$sanpham['iddm']] : "Không rõ") . '</td>


                    <td>
                        <a href="' . $suasp . '" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                        
                         <a href="' . $xoasp . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa?\')" class="btn btn-danger ">
                                    <i class="fa-solid fa-trash"></i> Xóa
                                </a>
                    </td>
                </tr>';
                }
                ?>

            </tbody>

        </table>
        <!-- Phân trang sản phẩm -->
        <nav>
            <ul class="pagination justify-content-center mt-4">
                <?php
                for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="index.php?act=listsp&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>

    </div>
</div>
</div>
</div>