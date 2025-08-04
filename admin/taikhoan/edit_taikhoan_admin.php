<div class=" container mt-5">
    <div class="row justify-content-center">
        <div class=" border col-md-6 bg-white p-4 rounded shadow-sm">
            <h3 class=" text-center mb-4">Cập Nhật Tài Khoản Admin</h3>

            <?php
            if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
                extract($_SESSION['user']);
            }
            ?>

            <form action="index.php?act=edit_taikhoan_admin" method="post">
                <div class="mb-3">
                    <label class="form-label">Tên đăng nhập</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="user" class="form-control" value="<?= $user ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Họ và Tên</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="text" name="fullname" class="form-control" value="<?= $fullname ?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" value="<?= $email ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" name="address" class="form-control" value="<?= $address ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                        <input type="text" name="tel" class="form-control" value="<?= $tel ?>" required>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="d-grid">
                    <button type="submit" name="capnhat" class="btn btn-success">Cập Nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>