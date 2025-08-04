<?php
function insert_bill($iduser, $name, $email, $address, $tel, $pttt, $ngaydathang, $tongdonhang)
{
    $sql = "INSERT INTO bill (iduser, bill_name, bill_email, bill_address, bill_tel, bill_pttt, ngaydathang, total)
            VALUES ('$iduser', '$name', '$email', '$address', '$tel', '$pttt', '$ngaydathang', '$tongdonhang')";
    return pdo_execute_return_lastInsertId($sql);
}
//xem chi tiết đơn hàng
function loadone_bill($id)
{
    $sql = "select * from bill where id=" . $id;
    $bill = pdo_query_one($sql);
    return $bill;
}

//xử lý đơn hàng của tui
function loadall_bill($iduser)
{
    $sql = "SELECT * FROM bill WHERE iduser = " . $iduser . " ORDER BY id DESC";
    $listbill = pdo_query($sql);
    return $listbill;
}

//xử lý đơn hàng của tui
function xulydonhang($n)
{
    switch ($n) {
        case '0':
            return "Đơn hàng mới";
        case '1':
            return "Đang xử lý";
        case '2':
            return "Đang giao hàng";
        case '3':
            return "Đã giao hàng";
        case '4':
            return "Đã hủy";
        default:
            return "Không xác định";
    }
}

// Hàm đếm số lượng sản phẩm trong giỏ hàng theo idbill đơn hàng
function loadall_diemsoluong($idbill)
{
    $sql = "SELECT * FROM cart WHERE idbill = $idbill";
    $bill = pdo_query($sql);
    return sizeof($bill);
}
// Hàm lấy tất cả sản phẩm trong giỏ hàng theo idbill đơn hàng xem chi tiết
function load_cart_by_idbill($idbill)
{
    $sql = "SELECT * FROM cart WHERE idbill = $idbill";
    return pdo_query($sql);
}

// phân trang đơn hàng và loading tất cả đơn hàng
function loadall_bill_phantrangdonhangadmin($start, $limit)
{
    $sql = "SELECT * FROM bill ORDER BY id DESC LIMIT $start, $limit";
    return pdo_query($sql);
}
// Hàm tìm kiếm đơn hàng theo từ khóa
function loadall_bill_timkiemdonhang($kyw = "")
{
    $sql = "SELECT * FROM bill WHERE 1";
    if ($kyw != "") {
        $sql .= " AND id = " . intval($kyw); // Tìm theo ID đơn hàng
    }
    $sql .= " ORDER BY id DESC";
    return pdo_query($sql);
}
// Xóa đơn hàng  theo ID
function delete_donhang($id)
{
    $sql = "DELETE FROM bill WHERE id = ?";
    pdo_execute($sql, $id);
}
//tổng quan đơn hàng trong admin , Hàm đếm tổng số đơn hàng để chia trang
function count_donhang()
{
    $sql = "SELECT COUNT(*) FROM bill";
    return pdo_query_value($sql);
}
// Cập nhật trạng thái đơn hàng
function update_bill_status($id, $status)
{
    $sql = "UPDATE bill SET bill_status = $status WHERE id = $id";
    pdo_execute($sql);
}
