<div id="myCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000" data-bs-pause="false">

    <!-- Dấu chấm tròn -->
    <div class="carousel-indicators ">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
    </div>

    <!-- Các slide -->
    <div class="carousel-inner ">
        <div class="carousel-item active">
            <img src="images/products/1.jpg" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Slide 1">
        </div>
        <div class="carousel-item ">
            <img src="images/products/baner2.png" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Slide 2">
        </div>
        <div class="carousel-item ">
            <img src="images/products/baner1.jpg" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Slide 3">
        </div>
    </div>

    <!-- Mũi tên điều hướng -->
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<!-- // Thông tin giới thiệu -->
<section class="py-4 border border-1 border-dark bg-white my-4">
    <div class="container ">
        <div class="row g-3 text-center ">
            <div class="col-md-4 ">
                <div class="shadow-sm p-4 rounded bg-light h-100 border border-dark">
                    <div class="mb-3">
                        <i class="bi bi-truck fs-2 text-success"></i>
                    </div>
                    <h5 class="fw-bold fs-5">Giao hàng nhanh chóng</h5>
                    <p class="text-muted small mb-0 fs-5">Vận chuyển toàn quốc chỉ trong 2-3 ngày làm việc.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="shadow-sm p-4 rounded bg-light h-100 border border-dark">
                    <div class="mb-3">
                        <i class="bi bi-shield-check fs-2 text-primary"></i>
                    </div>
                    <h5 class="fw-bold fs-5">Tư vấn nhiệt tình</h5>
                    <p class="text-muted small mb-0 fs-5">Tư vấn 24/7</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="shadow-sm p-4 rounded bg-light h-100 border border-dark">
                    <div class="mb-3">
                        <i class="bi bi-credit-card fs-2 text-warning"></i>
                    </div>
                    <h5 class="fw-bold fs-5">Thanh toán linh hoạt</h5>
                    <p class="text-muted small mb-0 fs-5">Hỗ trợ COD, chuyển khoản và thanh toán quốc tế.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- DANH MỤC SẢN PHẨM -->
<div class="container py-4 border bg-white my-4">
    <div class="card shadow border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Icon trái
                <div class="d-none d-md-block">
                    <i class="bi bi-tags-fill text-warning fs-4"></i>
                </div> -->


                <!-- Tiêu đề giữa -->
                <h4 class="text-primary fw-bold mb-0 text-center flex-fill">
                    <i class="bi bi-list-ul me-2"></i> DANH MỤC SẢN PHẨM
                </h4>


                <!-- Icon phải
                <div class="d-none d-md-block">
                    <i class="bi bi-box-seam-fill text-success fs-4"></i>
                </div> -->

            </div>

            <!-- Các nút danh mục -->
            <div class="d-flex justify-content-center flex-wrap gap-3">
                <?php
                $iddm_selected = isset($_GET['iddm']) ? $_GET['iddm'] : 0;

                foreach ($dsdm as $danhmuc) {
                    extract($danhmuc);
                    $linkdm = "index.php?act=home&iddm=" . $id;
                    $active = ($iddm_selected == $id) ? 'btn-primary text-white fw-bold' : 'btn-outline-success';
                    // Lấy số lượng sản phẩm trong danh mục
                    $count_sanpham = count_sanpham_theo_danhmuc($id);
                    echo '
                    <a href="' . $linkdm . '" class="btn ' . $active . ' px-4 py-2">
                        <i class="bi bi-box-seam"></i> ' . $name . ' (' . $count_sanpham . ' )
                    </a>';
                }
                ?>
            </div>
        </div>
    </div>
</div>


<!-- SẢN PHẨM CỦA CHÚNG TÔI -->
<h2 id="showproduct" class="text-center mb-4 mt-5 fw-bold text-success">SẢN PHẨM CỦA CHÚNG TÔI</h2>
<!-- Thông báo tìm kiếm sản phẩm -->
<?php if (isset($thongbao_sanpham)): ?>
    <div class="alert <?= (isset($spnew) && empty($spnew)) ? 'alert-danger' : 'alert-info' ?>" role="alert">
        <?= $thongbao_sanpham ?>
    </div>
<?php endif; ?>

<!-- Thông báo tìm kiếm danh mục -->
<?php if (isset($thongbao_danhmuc)): ?>
    <div class="alert <?= (isset($danhmuc_result) && empty($danhmuc_result)) ? 'alert-danger' : 'alert-info' ?>" role="alert">
        <?= $thongbao_danhmuc ?>
    </div>
<?php endif; ?>

<div class="row g-4">
    <?php
    foreach ($spnew as $sp) {
        extract($sp);
        $linksp = "index.php?act=sanphamct&idsp=" . $id;
        $hinh = $img_path . $img;
        echo '
    <div class="col-6 col-md-3">
      <div class="card product-card shadow-sm border border-success h-100 overflow-hidden">
        <div class="position-relative overflow-hidden">
          <a href="' . $linksp . '">
              <a href="' . $linksp . '"><img src="' .  $hinh . '" style="width:100%; height:290px; object-fit:cover; border-radius:5px;" class="img-fluid" /></a>
          </a>
        </div>
        <div class="card-body d-flex flex-column justify-content-between p-2">
          <h6 class="card-title text-center fw-bold text-dark mb-1">' . $name . '</h6>
          <p class="text-center text-success fw-semibold mb-1">' . number_format($price, 0, ",", ".") . ' VND</p>
          <div class="text-center text-warning small mb-2">★★★★☆</div>
          <form action="index.php?act=addtocart" method="post" class="d-flex justify-content-center align-items-center gap-2 mb-2">
            <input type="hidden" name="id" value="' . $id . '">
            <input type="hidden" name="name" value="' . $name . '">
            <input type="hidden" name="img" value="' . $img . '">
            <input type="hidden" name="price" value="' . $price . '">
            <input type="number" name="soluong" value="1" min="1" class="form-control form-control-sm text-center" style="width: 55px;">
            <button type="submit" name="addtocart"  class="btn btn-warning btn-sm flex-fill">
              <i class="bi bi-cart-plus" ></i> Thêm vào giỏ hàng
            </button>
          </form>
          <a href="' . $linksp . '" class="btn btn-outline-success btn-sm w-100">
            <i class="bi bi-eye"></i> Xem chi tiết
          </a>
        </div>
      </div>
    </div>';
    }
    ?>
</div>

<!-- CSS: đặt trong thẻ <style> hoặc file style.css -->
<style>
    /* Khi hover vào card: nổi lên + đổ bóng + phóng ảnh */
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Khi hover vào ảnh: phóng to nhẹ */
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .product-card:hover .product-img {
        transform: scale(1.05);

    }
</style>

<!-- Sản phẩm bán chạy top 10 -->

<h2 class="text-center mb-4 mt-5 fw-bold text-success"> TOP 10 SẢN PHẨM ĐƯỢC XEM NHIỀU NHẤT</h2>
<div class="container py-4 border bg-white my-4">
    <div class="position-relative ">
        <button class="slider-btn left" onclick="scrollProducts(-1)">&#10094;</button>
        <div class="product-scroll overflow-hidden  ">
            <div class="d-flex gap-3 flex-nowrap product-track " id="sliderTrack" style="overflow-x: auto; scroll-behavior: smooth;">
                <?php
                foreach ($dstop10 as $sp) {
                    extract($sp);
                    $linksp = "index.php?act=sanphamct&idsp=" . $id;
                    $hinh = $img_path . $img;
                    echo '
                            <div class="col-6 col-md-3 ">
                           <div class="card product-card shadow-sm border border-success h-100 overflow-hidden ">

                                <div class="position-relative overflow-hidden">
                                <a href="' . $linksp . '">
                                    <a href="' . $linksp . '"><img src="' .  $hinh . '" style="width:100%; height:290px; object-fit:cover; border-radius:5px;" class="img-fluid" /></a>
                                </a>
                                </div>
                                <div class="card-body d-flex flex-column justify-content-between p-2">
                                <h6 class="card-title text-center fw-bold text-dark mb-1">' . $name . '</h6>
                                <p class="text-center text-success fw-semibold mb-1">' . number_format($price, 0, ",", ".") . ' VND</p>
                                <div class="text-center text-warning small mb-2">★★★★☆</div>
                                <form action="index.php?act=addtocart" method="post" class="d-flex justify-content-center align-items-center gap-2 mb-2">
                                    <input type="hidden" name="id" value="' . $id . '">
                                    <input type="hidden" name="name" value="' . $name . '">
                                    <input type="hidden" name="img" value="' . $img . '">
                                    <input type="hidden" name="price" value="' . $price . '">
                                    <input type="number" name="soluong" value="1" min="1" class="form-control form-control-sm text-center" style="width: 55px;">
                                    <button type="submit" name="addtocart"  class="btn btn-warning btn-sm flex-fill">
                                    <i class="bi bi-cart-plus" ></i> Thêm vào giỏ hàng
                                    </button>
                                </form>
                                <a href="' . $linksp . '" class="btn btn-outline-success btn-sm w-100">
                                    <i class="bi bi-eye"></i> Xem chi tiết
                                </a>
                                </div>
                            </div>
                            </div>';
                }
                ?>
            </div>
        </div>

        <button class="slider-btn right" onclick="scrollProducts(1)">&#10095;</button>

        </body>

        <!-- // xử lí khi tìm kiếm danh mục hoặc tìm kiếm theo tên thị tự động cuộn xuống chỗ hiển thị -->
        <script>
            window.onload = function() {
                const hasProductSection = document.getElementById("showproduct");
                const urlParams = new URLSearchParams(window.location.search);
                const isSearch = urlParams.has("act") && urlParams.get("act") === "home";

                // Nếu có phần kết quả tìm kiếm và từ act=home (được kích bởi form tìm)
                if (hasProductSection && isSearch) {
                    hasProductSection.scrollIntoView({
                        behavior: "smooth"
                    });
                }
            };
        </script>

        <script>
            // Hàm cuộn sản phẩm trái phải
            function scrollProducts(direction) {
                const track = document.getElementById('sliderTrack');
                const scrollAmount = 300; // Số pixel để cuộn mỗi lần

                // Cuộn trái hoặc phải
                track.scrollLeft += direction * scrollAmount;
            }
        </script>

        </html>
    </div>