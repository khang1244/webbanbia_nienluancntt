<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="border col-md-6 bg-white p-4 rounded shadow-sm">
            <h3 class="text-center mb-4">Đổi Mật Khẩu</h3>

            <form action="index.php?act=doimatkhauadmin" method="post">
                <div class="mb-3">
                    <label class="form-label">Mật khẩu hiện tại</label>
                    <input type="password" name="old_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mật khẩu mới</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nhập lại mật khẩu mới</label>
                    <input type="password" name="re_password" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" name="doimatkhauadmin" class="btn btn-success">Đổi Mật Khẩu</button>
                </div>
            </form>
        </div>
    </div>
</div>