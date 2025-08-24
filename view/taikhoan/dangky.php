<body style="background-color: #f8f9fa;">
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <!-- Form đăng ký -->
            <div class="col-lg-6 mb-4">
                <div class="card p-4 shadow rounded-4">
                    <h3 class="text-center mb-4 fw-semibold">Đăng ký tài khoản</h3>
                    <form action="index.php?act=dangky" method="post">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="email@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" name="user" placeholder="Tên đăng nhập">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Nguyễn Văn A">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <div class="position-relative">
                                <input type="password" class="form-control" name="password" id="password">
                                <i class="bi bi-eye-slash toggle-password" toggle="#password"></i>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nhập lại mật khẩu</label>
                            <div class="position-relative">
                                <input type="password" class="form-control" name="repassword" id="repassword">
                                <i class="bi bi-eye-slash toggle-password" toggle="#repassword"></i>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary w-100 py-2 mt-2" name="dangky" value="Đăng ký">
                        <p class="text-center mt-3 mb-0">
                            Đã có tài khoản? <a href="index.php?act=dangnhap" class="text-decoration-none text-primary">Đăng nhập</a>
                        </p>
                    </form>
                </div>
            </div>

            <!-- Cột phải: Ảnh hoặc giới thiệu -->
            <div class="col-lg-5 text-center">
                <img src="images/products/iconthuonghieu.jpg" class="img-fluid rounded-3 shadow mb-3" alt="banner đăng ký" style="max-height: 250px;">
                <h5 class="fw-semibold">Tạo tài khoản để mua bia dễ dàng hơn!</h5>
                <p class="text-muted">Bạn sẽ được lưu đơn hàng, tích điểm và nhận nhiều ưu đãi độc quyền từ Hoàng Khang Beer.</p>
            </div>
        </div>
    </div>


</body>
<style>
    .toggle-password {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
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
            if (input.type === "password") {
                input.type = "text";
                this.classList.remove('bi-eye-slash');
                this.classList.add('bi-eye');
            } else {
                input.type = "password";
                this.classList.remove('bi-eye');
                this.classList.add('bi-eye-slash');
            }
        });
    });
</script>