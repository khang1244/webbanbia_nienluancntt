<?php

// function insert_sanpham($tensp, $giasp, $img, $mota, $iddm)
// {
//     $sql = "INSERT INTO sanpham (name, price, img, mota, iddm)
//             VALUES ('$tensp', '$giasp', '$img', '$mota', '$iddm')";
//     pdo_execute($sql);
// }
function insert_sanpham($tensp, $giasp, $img, $mota, $iddm, $anhphu = "")
{
    $sql = "INSERT INTO sanpham (name, price, img, mota, iddm, anhphu)
            VALUES ('$tensp', '$giasp', '$img', '$mota', '$iddm', '$anhphu')";
    pdo_execute($sql);
}

// Hàm xóa sản phẩm theo id
function delete_sanpham($id)
{
    $sql = "delete from sanpham where id=" . $id;
    pdo_execute($sql);
}
// Lấy 8 sản phẩm mới nhất để hiển thị trên trang chủ
function loadall_sanpham_home()
{
    $sql = "select * from sanpham where 1 order by id desc limit 0,8";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}
// Lấy 10 sản phẩm được xem nhiều nhất
function loadall_sanpham_top10()
{
    $sql = "select * from sanpham where 1 order by luotxem desc limit 0,10";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}
// tìm kiếm sản phẩm theo từ khóa và danh mục ở trang chủ 
function loadall_sanpham($kyw = "", $iddm = 0)
{
    $sql = "SELECT * FROM sanpham WHERE 1";

    if ($kyw != "") {
        $sql .= " AND name LIKE '%" . $kyw . "%'";
    }

    if ($iddm > 0) {
        $sql .= " AND iddm = " . $iddm;
    }

    $sql .= " ORDER BY id DESC";

    return pdo_query($sql);
}

// Lấy sản phẩm theo ID chi tiết sản phẩm
// Hàm này sẽ được gọi khi người dùng click vào sản phẩm để xem chi tiết
function loadone_sanpham($id)
{
    $sql = "select * from sanpham where id=" . $id;
    $sp = pdo_query_one($sql);
    return $sp;
}
// Lấy sản phẩm cùng loại theo danh mục khi xem chi tiết sản phẩm
function load_sanpham_cungloai($id, $iddm)
{
    $sql = "select * from sanpham where iddm=" . $iddm . " AND id <>" . $id;
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}

// Cập nhật sản phẩm
function update_sanpham($id, $iddm, $tensp, $giasp, $mota, $hinh, $anhphu = "")
{
    if ($hinh != "") {
        // Nếu có hình ảnh mới thì cập nhật cả ảnh
        $sql = "UPDATE sanpham 
                SET iddm='$iddm', name='$tensp', price='$giasp', mota='$mota', img='$hinh', anhphu='$anhphu' 
                WHERE id=$id";
    } else {
        // Không cập nhật ảnh chính nếu không có hình mới
        $sql = "UPDATE sanpham 
                SET iddm='$iddm', name='$tensp', price='$giasp', mota='$mota', anhphu='$anhphu' 
                WHERE id=$id";
    }

    pdo_execute($sql);
}

// Phân trang sản phẩm
function loadall_sanpham_paginated($kyw = "", $iddm = 0, $start = 0, $limit = 3)
{
    $sql = "SELECT * FROM sanpham WHERE 1";
    if ($kyw != "") {
        $sql .= " AND name LIKE '%$kyw%'";
    }
    if ($iddm > 0) {
        $sql .= " AND iddm = '$iddm'";
    }
    $sql .= " ORDER BY id DESC LIMIT $start, $limit";
    return pdo_query($sql);
}

// Đếm tổng số sản phẩm để phân trang
function count_all_sanpham($kyw = "", $iddm = 0)
{
    $sql = "SELECT COUNT(*) as total FROM sanpham WHERE 1";
    if ($kyw != "") {
        $sql .= " AND name LIKE '%$kyw%'";
    }
    if ($iddm > 0) {
        $sql .= " AND iddm = '$iddm'";
    }
    $result = pdo_query_one($sql);
    return $result['total'];
}

// Tăng lượt xem sản phẩm
function tangluotxem($id)
{
    $sql = "UPDATE sanpham SET luotxem = luotxem + 1 WHERE id = $id";
    pdo_execute($sql);
}
// Khi bấm  vào danh mục thì hiển thị sản phẩm theo danh mục đó
function load_ten_dm($iddm)
{
    $sql = "SELECT name FROM danhmuc WHERE id = $iddm";
    $dm = pdo_query_one($sql);
    return $dm['name'];
}
// hàm tổng quan sản phẩm trong admin
function count_sanpham()
{
    $sql = "SELECT COUNT(*) FROM sanpham";
    return pdo_query_value($sql);
}
