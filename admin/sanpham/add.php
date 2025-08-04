<div class="main-content ">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">THÊM MỚI SẢN PHẨM</h4>
        </div>
        <div class="card-body bg-light">
            <form action="index.php?act=addsp" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="iddm" class="form-label">Danh mục sản phẩm</label>
                    <select name="iddm" id="iddm" class="form-select" required>
                        <option value="" disabled selected>-- Chọn danh mục --</option>
                        <?php
                        foreach ($listdanhmuc as $danhmuc) {
                            extract($danhmuc);
                            echo '<option value="' . $id . '">' . $name . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" name="tensp" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá</label>
                    <input type="number" name="giasp" class="form-control" required>
                </div>

                <!-- Ảnh chính -->
                <div class="mb-3">
                    <label class="form-label">Ảnh chính</label>
                    <input type="file" name="hinh" class="form-control" required onchange="previewImage(event)">
                    <img id="preview" src="#" alt="Xem trước ảnh" class="mt-2 rounded" style="max-width: 100px; display: none;">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ảnh phụ (chọn nhiều)</label>
                    <input type="file" name="anhphu[]" multiple class="form-control" id="anhphu">
                    <div id="preview-anhphu" class="mt-2 d-flex flex-wrap gap-2"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="mota" class="form-control" rows="5" required></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" value="1" name="themmoi" class="btn btn-success">THÊM MỚI</button>
                    <button type="reset" class="btn btn-secondary">NHẬP LẠI</button>
                    <a href="index.php?act=listsp" class="btn btn-outline-primary">DANH SÁCH</a>
                </div>

                <?php
                if (isset($thongbao) && $thongbao != "") {
                    echo '<div class="mt-3 alert alert-info">' . $thongbao . '</div>';
                }
                ?>
            </form>
        </div>
    </div>
</div>
// Preview ảnh chính
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
// Preview ảnh phụ
<script>
    document.getElementById('anhphu').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('preview-anhphu');
        previewContainer.innerHTML = ''; // clear cũ

        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '80px';
                img.style.height = '80px';
                img.style.objectFit = 'cover';
                img.style.border = '1px solid #ccc';
                img.style.borderRadius = '4px';
                img.style.marginRight = '5px';
                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    });
</script>