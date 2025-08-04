<?php
session_start();
include "../../model/pdo.php";
include "../../model/binhluan.php";

$idpro = isset($_GET['idsp']) ? intval($_GET['idsp']) : 0;

// Xử lý gửi bình luận
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
    $noidung = trim($_POST['content']);
    $iduser = $_SESSION['user']['id'];
    if (!empty($noidung)) {
        $ngaybinhluan = date("Y-m-d H:i:s");
        insert_comment($idpro, $iduser, $noidung, $ngaybinhluan);
    }
    header("Location: binhluanform.php?idsp=$idpro");
    exit;
}

// Lấy danh sách bình luận
$comments = load_comments($idpro);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bình luận</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="p-2 bg-light">
    <h5 class="text-primary">Bình luận</h5>

    <?php foreach ($comments as $cmt): ?>
        <div class="border p-2 mb-2 rounded bg-white">
            <strong><?= htmlspecialchars($cmt['fullname']) ?></strong>
            <p class="mb-1"><?= htmlspecialchars($cmt['noidung']) ?></p>
            <small class="text-muted"><?= $cmt['ngaybinhluan'] ?></small>
        </div>
    <?php endforeach; ?>

    <?php if (isset($_SESSION['user'])): ?>
        <form action="binhluanform.php?idsp=<?= $idpro ?>" method="post" class="mt-3">
            <div class="mb-2">
                <textarea name="content" class="form-control form-control-sm" rows="2" placeholder="Nhập bình luận..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Gửi bình luận</button>
        </form>
    <?php else: ?>
        <p class="text-muted mt-2">Vui lòng <a href="../../index.php?act=dangnhap" target="_top">đăng nhập</a> để bình luận.</p>
    <?php endif; ?>
</body>

</html>