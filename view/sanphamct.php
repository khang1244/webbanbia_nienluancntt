<!-- CHI TIẾT SẢN PHẨM -->
<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb fs-5 fw-semibold text-dark">
            <li class="breadcrumb-item">
                <a href="index.php" class="text-decoration-none text-primary">Trang Chủ</a>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">Chi Tiết Sản Phẩm</li>
        </ol>
    </nav>


    <div class="row bg-white shadow rounded-4 p-4 align-items-center">
        <?php
        extract($onesp);
        $anhchinh = $img_path . $img;
        $anhphu_arr = !empty($anhphu) ? explode('|', $anhphu) : [];

        //echo '<div class="col-md-5 text-center mb-4 mb-md-0">';

        // Ảnh chính
        echo '<div class="col-md-5 text-center mb-4 mb-md-0">
        <div class="border rounded-4 shadow-sm overflow-hidden mb-3">
        <img id="mainImage" src="' . $anhchinh . '" alt="' . $name . '" 
             class="img-fluid rounded" 
             style="width:100%; max-height:350px; object-fit:contain;">
      </div>';

        // Ảnh phụ slider
        if (count($anhphu_arr) > 0) {
            echo '<div class="d-flex overflow-auto gap-2 py-2 px-1" style="scroll-snap-type: x mandatory;">';
            foreach ($anhphu_arr as $anh) {
                echo '<img src="' . $img_path . $anh . '" 
                   onclick="changeMainImage(this.src)" 
                   class="rounded border shadow-sm"
                   style="width: 70px; height: 70px; object-fit: cover; cursor: pointer; flex: 0 0 auto; scroll-snap-align: start;">';
            }
            echo '</div>';
        }

        echo '</div>'; // đóng col-md-5
        ?>

        <!-- Thông tin sản phẩm -->
        <div class="col-md-7">
            <h2 class="fw-bold mb-3" style="font-size: 34px;"><?= $name ?></h2>

            <!-- Đánh giá sản phẩm -->
            <div class="d-flex align-items-center text-warning mb-2">
                <span class="fs-5">★★★★★</span>
                <span class="text-muted small ms-2" style="font-size: 17px;">đánh giá | <a href="#" class="text-decoration-none">Viết đánh giá</a></span>
            </div>

            <!-- Giá sản phẩm -->
            <h4 class="text-danger fw-bold mb-4" style="font-size: 23px;">Giá bán: <?= number_format($price, 0, ',', '.') ?> VNĐ</h4>

            <!-- Form thêm vào giỏ hàng -->
            <form action="index.php?act=addtocart" method="post">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="name" value="<?= $name ?>">
                <input type="hidden" name="img" value="<?= $img ?>">
                <input type="hidden" name="price" value="<?= $price ?>">

                <!-- Chọn số lượng -->
                <div class="input-group mb-3" style="width: 140px;">
                    <button class="btn btn-outline-secondary" type="button" onclick="this.parentElement.querySelector('input').stepDown()">-</button>
                    <input type="number" name="soluong" value="1" min="1" class="form-control text-center">
                    <button class="btn btn-outline-secondary" type="button" onclick="this.parentElement.querySelector('input').stepUp()">+</button>
                </div>

                <!-- Nút thêm vào giỏ -->
                <button type="submit" name="addtocart" class="btn btn-warning w-100  py-2 fw-bold rounded-pill">
                    <i class="bi bi-cart-plus me-2"></i>Thêm vào giỏ hàng
                </button>
            </form>

            <!-- Chia sẻ -->
            <div class="mt-3">
                <strong>Chia sẻ:</strong>
                <a href="#" class="btn btn-outline-primary btn-sm rounded-circle mx-1"><i class="bi bi-facebook"></i></a>
                <a href="#" class="btn btn-outline-info btn-sm rounded-circle mx-1"><i class="bi bi-twitter"></i></a>
                <a href="#" class="btn btn-outline-danger btn-sm rounded-circle mx-1"><i class="bi bi-pinterest"></i></a>
                <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle mx-1"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>
</div>
<style>
    /* Áp dụng cho phần chứa thông tin sản phẩm */
    .col-md-7 {
        position: relative;
        top: -50px;
        /* Điều chỉnh giá trị âm để dịch chuyển lên trên */
    }

    /* Nếu muốn điều chỉnh cụ thể cho từng phần tử */
    h2,
    h4,
    .input-group,
    .btn-warning,
    .mt-3 {
        position: relative;

        /* Điều chỉnh giá trị âm để dịch chuyển lên trên */
    }
</style>
<!-- Tabs thông tin phụ -->
<div class="mt-5">
    <ul class="nav nav-tabs" id="productTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#detail" type="button">Mô tả về sản phẩm</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#same-type" type="button">Sản phẩm cùng loại</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#comments" type="button">Bình luận về sản phẩm</button>
        </li>
    </ul>

    <div class="tab-content border rounded-bottom p-3 bg-light" id="productTabsContent">
        <!-- Tab mô tả -->
        <div class="tab-pane fade show active" id="detail" role="tabpanel">
            <div class="short-description">
                <!-- Mô tả ngắn -->
                <p><?= substr($mota, 0, 2000) ?> </p> <!-- Giới hạn 3000 ký tự -->
            </div>

            <div class="full-description" style="display: none;">
                <!-- Mô tả đầy đủ -->
                <p><?= $mota ?></p>
            </div>

            <!-- Nút Xem thêm, căn giữa -->
            <div class="text-center mt-3">
                <button class="btn btn-primary" id="toggle-description">Xem thêm</button>
            </div>
        </div>

        <!-- Tab sản phẩm cùng loại -->
        <div class="tab-pane fade" id="same-type" role="tabpanel">
            <?php foreach ($spcungloai as $sp) {
                extract($sp);
                $hinh = $img_path . $img;
                $linksp = "index.php?act=sanphamct&idsp=" . $id;
                echo ' <div class="input-group mt-2">
                         <span class="input-group-text">' . $id . '</span> 
                              <img src="' . $hinh . '" alt="Tên sản phẩm" class="img-thumbnail border" style="width: 100px; height: auto; margin-left: 20px;">
                            <input type="text" name="same_type[]" class="form-control" value="' . $name . '">
                            <a href="' . $linksp . '" class="btn btn-outline-secondary">Xem</a>
                        </div>';
            }
            ?>
        </div>

        <!-- Tab bình luận -->
        <div class="tab-pane fade" id="comments" role="tabpanel">
            <?php
            extract($onesp);
            ?>
            <iframe src="view/binhluan/binhluanform.php?idsp=<?= $id ?>" width="100%" height="300" style="border:none; overflow:auto;"></iframe>
        </div>


    </div>
</div>

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
            <button class="slider-btn right" onclick="scrollProducts(1)">&#10095;</button>

            <style>
                #mainImage {
                    transition: all 0.3s ease-in-out;
                }

                #mainImage:hover {
                    transform: scale(1.02);
                }
            </style>
            <script>
                // Hàm cuộn sản phẩm trái phải
                function scrollProducts(direction) {
                    const track = document.getElementById('sliderTrack');
                    const scrollAmount = 300; // Số pixel để cuộn mỗi lần

                    // Cuộn trái hoặc phải
                    track.scrollLeft += direction * scrollAmount;
                }
            </script>
            <!-- // Thêm hiệu ứng hover cho ảnh chính -->
            <script>
                function changeMainImage(src) {
                    document.getElementById("mainImage").src = src;
                }
            </script>
            //
            <script>
                // Lắng nghe sự kiện click vào nút "Xem thêm"
                document.getElementById("toggle-description").addEventListener("click", function() {
                    const fullDesc = document.querySelector(".full-description");
                    const shortDesc = document.querySelector(".short-description");

                    if (fullDesc.style.display === "none") {
                        fullDesc.style.display = "block"; // Hiển thị mô tả đầy đủ
                        shortDesc.style.display = "none"; // Ẩn mô tả ngắn
                        this.textContent = "Thu gọn"; // Đổi thành "Thu gọn"
                    } else {
                        fullDesc.style.display = "none"; // Ẩn mô tả đầy đủ
                        shortDesc.style.display = "block"; // Hiển thị mô tả ngắn
                        this.textContent = "Xem thêm"; // Đổi thành "Xem thêm"
                    }
                });
            </script>