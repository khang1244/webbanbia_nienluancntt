<!-- Thêm font awesome và bootstrap nếu chưa có -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="container py-4">
    <h2 class="mb-4 fw-bold text-dark">📊 Thống kê tổng quan</h2>
    <div class="row g-4">
        <div class="col-md-4 col-sm-6">
            <div class="card shadow-lg border-0 rounded-4 bg-primary text-white h-100 hover-scale">
                <div class="card-body d-flex flex-column justify-content-center align-items-start">
                    <i class="fa-solid fa-layer-group fa-2x mb-3"></i>
                    <h5 class="card-title">Danh mục</h5>
                    <h3><?= $tong_dm ?> Danh mục</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card shadow-lg border-0 rounded-4 bg-success text-white h-100 hover-scale">
                <div class="card-body d-flex flex-column justify-content-center align-items-start">
                    <i class="fa-solid fa-box fa-2x mb-3"></i>
                    <h5 class="card-title">Sản phẩm</h5>
                    <h3><?= $tong_sp ?> Sản phẩm</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card shadow-lg border-0 rounded-4 bg-warning text-white h-100 hover-scale">
                <div class="card-body d-flex flex-column justify-content-center align-items-start">
                    <i class="fa-solid fa-comments fa-2x mb-3"></i>
                    <h5 class="card-title">Bình luận</h5>
                    <h3><?= $tong_bl ?> Bình luận</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card shadow-lg border-0 rounded-4 bg-info text-white h-100 hover-scale">
                <div class="card-body d-flex flex-column justify-content-center align-items-start">
                    <i class="fa-solid fa-users fa-2x mb-3"></i>
                    <h5 class="card-title">Người dùng</h5>
                    <h3><?= $tong_tk ?> Người dùng</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card shadow-lg border-0 rounded-4 bg-danger text-white h-100 hover-scale">
                <div class="card-body d-flex flex-column justify-content-center align-items-start">
                    <i class="fa-solid fa-receipt fa-2x mb-3"></i>
                    <h5 class="card-title">Đơn hàng</h5>
                    <h3><?= $tong_dh ?> Đơn hàng</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-scale {
        transition: transform 0.2s ease-in-out;
    }

    .hover-scale:hover {
        transform: scale(1.03);
    }
</style>