<?php

function insert_taikhoan($email, $user, $fullname, $password)
{
    $sql = "INSERT INTO taikhoan(email, user, fullname, password)  VALUES ('$email', '$user','$fullname', '$password')";
    pdo_execute($sql);
}
// Hàm lấy tất cả tài khoản
function checkuser($user, $password)
{
    $sql = "SELECT * FROM taikhoan WHERE user = '" . $user . "' AND password = '" . $password . "'";
    $tk = pdo_query_one($sql);
    return $tk;
}
// hàm cập nhật tai khoản
function update_taikhoan($id, $user, $fullname, $email, $address, $tel)
{
    $sql = "UPDATE taikhoan SET user = '$user', fullname = '$fullname', email = '$email',address = '$address',tel = '$tel'    WHERE id = $id";
    pdo_execute($sql);
}

function trungtenkhidangky($user)
{
    $sql = "SELECT * FROM taikhoan WHERE user = '$user'";
    $trungtentaikhoan = pdo_query_one($sql);
    return $trungtentaikhoan;
}
function trungtenkhicapnhat($user, $id)
{
    $sql = "SELECT * FROM taikhoan WHERE user = '$user' AND id != $id";
    $trungtentaikhoancapnhat = pdo_query_one($sql);
    return $trungtentaikhoancapnhat;
}

// Hàm loading lấy tất cả tài khoản 
function loadall_taikhoan()
{
    $sql = "SELECT * FROM taikhoan ORDER BY id DESC";

    $listtaikhoan = pdo_query($sql);
    return $listtaikhoan;
}

// Hàm xóa tài khoản theo id
function delete_taikhoan($id)
{
    $sql = "DELETE FROM taikhoan WHERE id = ?";
    pdo_execute($sql, $id);
}
// Hàm đếm số lượng tài khoản trong admin quản lý tổng quan
function count_taikhoan()
{
    return pdo_query_value("SELECT COUNT(*) FROM taikhoan");
}

// Hàm lấy thông tin tài khoản theo id mới đổi mk đc
function load_taikhoan_by_id($id)
{
    $sql = "SELECT * FROM taikhoan WHERE id = ?";
    return pdo_query_one($sql, $id);
}
// Hàm cập nhật mật khẩu
function update_password($id, $new_pass_md5)
{
    $sql = "UPDATE taikhoan SET password = ? WHERE id = ?";
    pdo_execute($sql, $new_pass_md5, $id);
}
// Hàm kiểm tra email đã tồn tại chưa khi đăng ký
function trungemailkhidangky($email)
{
    // Viết truy vấn kiểm tra email trong CSDL
    $sql = "SELECT * FROM taikhoan WHERE email = ?";
    $stmt = pdo_get_connection()->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    return $user ? true : false;
}
// Hàm kiểm tra email đã tồn tại chưa khi cập nhật thông tin tài khoản
function update_role($id, $role)
{
    $sql = "UPDATE taikhoan SET role = ? WHERE id = ?";
    pdo_execute($sql, $role, $id);
}
