<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="border col-md-6 bg-white p-4 rounded shadow-sm">
            <h3 class="text-center mb-4">Đổi Mật Khẩu</h3>

            <form action="index.php?act=doimatkhau" method="post">
                <div class="mb-3 position-relative">
                    <label class="form-label">Mật khẩu hiện tại</label>
                    <input type="password" name="old_password" id="old_password" class="form-control" required>
                    <i class="bi bi-eye-slash toggle-password" toggle="#old_password"></i>
                </div>

                <div class="mb-3 position-relative">
                    <label class="form-label">Mật khẩu mới</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required>
                    <i class="bi bi-eye-slash toggle-password" toggle="#new_password"></i>
                </div>

                <div class="mb-3 position-relative">
                    <label class="form-label">Nhập lại mật khẩu mới</label>
                    <input type="password" name="re_password" id="re_password" class="form-control" required>
                    <i class="bi bi-eye-slash toggle-password" toggle="#re_password"></i>
                </div>

                <div class="d-grid">
                    <button type="submit" name="doimatkhau" class="btn btn-success">Đổi Mật Khẩu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .toggle-password {
        position: absolute;
        top: 38px;
        right: 15px;
        cursor: pointer;
        color: #888;
        font-size: 1.2rem;
    }

    .toggle-password:hover {
        color: #000;
    }
</style>
<script>
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', function() {
            const input = document.querySelector(this.getAttribute('toggle'));
            const isPassword = input.type === "password";
            input.type = isPassword ? "text" : "password";
            this.classList.toggle("bi-eye");
            this.classList.toggle("bi-eye-slash");
        });
    });
</script>