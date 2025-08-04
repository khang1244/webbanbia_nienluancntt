<?php
if (is_array($sp)) {
    extract($sp);
    $tensp = $name;
    $hinhpath = "../upload/" . $img;
}
?>

<div class="main-content">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">CẬP NHẬT SẢN PHẨM</h4>
        </div>
        <div class="card-body bg-light">
            <form action="index.php?act=updatesp" method="post" enctype="multipart/form-data">
                <!-- Danh mục -->
                <div class="mb-3">
                    <label class="form-label">Danh mục</label>
                    <select name="iddm" class="form-select">
                        <option value="0">Tất cả</option>
                        <?php
                        foreach ($listdanhmuc as $danhmuc) {
                            $selected = ($iddm == $danhmuc['id']) ? 'selected' : '';
                            echo '<option value="' . $danhmuc['id'] . '" ' . $selected . '>' . $danhmuc['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <!-- Tên sản phẩm -->
                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" name="tensp" class="form-control" value="<?= $tensp ?>" required>
                </div>

                <!-- Giá -->
                <div class="mb-3">
                    <label class="form-label">Giá</label>
                    <input type="number" name="giasp" class="form-control" value="<?= $price ?>" required>
                </div>

                <!-- Ảnh chính -->
                <div class="mb-3">
                    <label class="form-label">Ảnh chính</label>
                    <input type="file" name="hinh" id="hinh" class="form-control">
                    <img id="preview-img" src="<?= $hinhpath ?>" height="90" style="object-fit:cover;width:80px;border-radius:5px;" class="mt-2 border">
                </div>

                <!-- Thay ảnh phụ -->
                <div class="mb-3">
                    <label class="form-label">Thay ảnh phụ (chọn nhiều):</label>
                    <input type="file" name="anhphu[]" id="anhphu" multiple class="form-control">

                </div>
                <!-- Ảnh phụ hiện tại -->
                <div class="mb-3" id="anhphu-hientai">
                    <?php
                    if (!empty($anhphu)) {
                        $ds_anhphu = explode('|', $anhphu);
                        foreach ($ds_anhphu as $anh) {
                            echo "<img src='../upload/$anh' style='width:60px;height:60px;object-fit:cover;border-radius:5px;margin-right:5px;' class='border'>";
                        }
                    }
                    ?>
                </div>



                <!-- Mô tả -->
                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="mota" class="form-control" rows="5" required><?= $mota ?></textarea>
                </div>

                <!-- Nút -->
                <div class="d-flex gap-2">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="submit" name="capnhat" class="btn btn-success" value="CẬP NHẬT">
                    <button type="reset" class="btn btn-secondary">NHẬP LẠI</button>
                    <a href="index.php?act=listsp" class="btn btn-outline-primary">DANH SÁCH</a>
                </div>

                <?php if (isset($thongbao) && $thongbao != "") echo $thongbao; ?>
            </form>
        </div>
    </div>
</div>

<script>
    // Preview ảnh chính
    document.getElementById('hinh').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview-img');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // Preview ảnh phụ thay thế vùng hiện tại
    document.getElementById('anhphu').addEventListener('change', function(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('anhphu-hientai');
        if (!previewContainer) return;

        previewContainer.innerHTML = "<label class='form-label'>Ảnh phụ mới:</label><br>";

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement("img");
                img.src = e.target.result;
                img.style.height = "60px";
                img.style.width = "60px";
                img.style.objectFit = "cover";
                img.style.border = "1px solid #ccc";
                img.style.borderRadius = "5px";
                img.style.marginRight = "5px";
                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    });
</script>