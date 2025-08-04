<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-lg rounded-4 p-4">
                <h3 class="text-center mb-4 fw-semibold">Cập nhật tài khoản</h3>

                <?php
                if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
                    extract($_SESSION['user']);
                }
                ?>

                <form action="index.php?act=edit_tk" method="post" class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Tên đăng nhập</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="text" name="user" class="form-control" value="<?= $user ?>" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Họ và tên</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                            <input type="text" name="fullname" class="form-control" value="<?= $fullname ?>" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                            <input type="email" name="email" class="form-control" value="<?= $email ?>" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Địa chỉ</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
                            <input type="text" name="address" class="form-control" value="<?= $address ?>" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Số điện thoại</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                            <input type="text" name="tel" class="form-control" value="<?= $tel ?>" required>
                        </div>
                    </div>

                    <input type="hidden" name="id" value="<?= $id ?>">

                    <div class="col-12 d-grid mt-3">
                        <button type="submit" name="capnhat" class="btn btn-success btn-lg">
                            <i class="bi bi-save2-fill me-2"></i> Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>