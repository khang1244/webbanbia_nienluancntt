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

// // Xóa toàn bộ giỏ hàng tạm theo người dùng
// function delete_all_cart_temp($iduser)
// {
//     $sql = "DELETE FROM cart_temp WHERE iduser = ?";
//     return pdo_execute($sql, $iduser);
// }
// Tính tổng đơn hàng trong giỏ tạm
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
