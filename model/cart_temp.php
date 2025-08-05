<?php
// Thêm sản phẩm vào cart_temp
function insert_cart_temp($iduser, $idpro, $img, $name, $price, $soluong, $thanhtien)
{
    $sql = "INSERT INTO cart_temp(iduser, idpro, img, name, price, soluong, thanhtien)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    return pdo_execute($sql, $iduser, $idpro, $img, $name, $price, $soluong, $thanhtien);
}

// Lấy giỏ hàng tạm theo người dùng
function load_cart_temp_by_user($iduser)
{
    $sql = "SELECT * FROM cart_temp WHERE iduser = ?";
    return pdo_query($sql, $iduser);
}

// Xóa sản phẩm khỏi giỏ tạm (1 sản phẩm)
function delete_cart_temp_item($id)
{
    $sql = "DELETE FROM cart_temp WHERE id = ?";
    return pdo_execute($sql, $id);
}
// Tính tổng tiền giỏ hàng tạm theo người dùng
function tongdonhang_temp($iduser)
{
    $cart = load_cart_temp_by_user($iduser);
    $tong = 0;
    foreach ($cart as $item) {
        $tong += $item['price'] * $item['soluong'];
    }
    return $tong;
}

// // Xóa toàn bộ giỏ hàng của 1 user
function delete_cart_temp_by_user($iduser)
{
    $sql = "DELETE FROM cart_temp WHERE iduser = ?";
    pdo_execute($sql, $iduser);
}

// Đếm số lượng sản phẩm trong giỏ hàng tạm của người dùng
function dem_soluong_giohang($iduser)
{
    $sql = "SELECT COUNT(*) FROM cart_temp WHERE iduser = $iduser";
    return pdo_query_value($sql);
}
// Thêm sản phẩm vào giỏ hàng tạm (kiểm tra trùng)
function add_to_cart($iduser, $idpro, $img, $name, $price, $soluong_mua)
{
    // Kiểm tra sản phẩm đã có trong giỏ chưa
    $sql_check = "SELECT * FROM cart_temp WHERE iduser = ? AND idpro = ?";
    $existing = pdo_query_one($sql_check, $iduser, $idpro);

    if (!empty($existing)) {
        // Sản phẩm đã tồn tại trong giỏ rồi, không thêm nữa
        return false;
    } else {
        // Nếu chưa có thì thêm mới với số lượng là $soluong_mua
        $thanhtien = $price * $soluong_mua;
        $sql_insert = "INSERT INTO cart_temp(iduser, idpro, img, name, price, soluong, thanhtien)
                       VALUES (?, ?, ?, ?, ?, ?, ?)";
        pdo_execute($sql_insert, $iduser, $idpro, $img, $name, $price, $soluong_mua, $thanhtien);

        return true;
    }
}

// Kiểm tra xem sản phẩm đã có trong giỏ hàng tạm của người dùng chưa
function check_product_in_cart($iduser, $idpro)
{
    $sql = "SELECT COUNT(*) FROM cart_temp WHERE iduser = ? AND idpro = ?";
    $count = pdo_query_value($sql, $iduser, $idpro);
    return $count > 0;
}
