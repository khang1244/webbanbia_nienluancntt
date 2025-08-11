    <?php
    function insert_comment($idpro, $iduser, $noidung, $ngaybinhluan)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đảm bảo múi giờ VN
        $ngaybinhluan = date("Y-m-d H:i:s");
        $sql = "INSERT INTO binhluan (noidung, iduser, idpro, ngaybinhluan, trangthai) VALUES ('$noidung', '$iduser', '$idpro', '$ngaybinhluan', 0)";
        pdo_execute($sql);
    }
    // Hàm lấy bình luận theo ID sản phẩm
    function load_comments($idpro)
    {
        $sql = "SELECT bl.*, tk.fullname as fullname FROM binhluan bl
                LEFT JOIN taikhoan tk ON bl.iduser = tk.id
                WHERE bl.idpro = ? AND bl.trangthai = 1
                ORDER BY bl.id DESC";
        return pdo_query($sql, $idpro);
    }
    // phần code bên admin
    // Load toàn bộ bình luận
    function loadall_binhluan()
    {
        $sql = "SELECT * FROM binhluan ORDER BY id DESC";
        return pdo_query($sql);
    }

    // Xóa bình luận theo ID
    function delete_binhluan($id)
    {
        $sql = "DELETE FROM binhluan WHERE id = ?";
        pdo_execute($sql, $id);
    }
    // Hàm đếm số lượng bình luận
    function count_binhluan()
    {
        $sql = "SELECT COUNT(*) FROM binhluan";
        return pdo_query_value($sql);
    }
    function loadall_binhluan_paginated($start, $limit)
    {
        $sql = "SELECT * FROM binhluan ORDER BY id DESC LIMIT $start, $limit";
        return pdo_query($sql);
    }
