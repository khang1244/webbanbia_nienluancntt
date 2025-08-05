<?php
function insert_danhmuc($tenloai)
{
    $sql = "insert into danhmuc(name) values('$tenloai')";
    pdo_execute($sql);
}
function delete_danhmuc($id)
{
    $sql = "delete from danhmuc where id=" . $id;
    pdo_execute($sql);
}
// Khi bấm  vào danh mục thì hiển thị sản phẩm theo danh mục đó
function load_ten_dm($iddm)
{
    $sql = "SELECT name FROM danhmuc WHERE id = $iddm";
    $dm = pdo_query_one($sql);
    return $dm['name'];
}
// Lấy tất cả danh mục để hiển thị trong admin
function loadall_danhmuc()
{
    $sql = "select * from danhmuc order by id desc";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}
// ✅ Lấy danh mục theo id
function loadone_danhmuc($id)
{
    $sql = "select * from danhmuc where id=" . $id;
    $dm = pdo_query_one($sql);
    return $dm;
}
// ✅ Cập nhật danh mục
function update_danhmuc($id, $tenloai)
{
    $sql = "update danhmuc set name='" . $tenloai . "' where id=" . $id;
    pdo_execute($sql);
}
// Hàm tổng quan danh mục trong admin
function count_danhmuc()
{
    $sql = "SELECT COUNT(*) FROM danhmuc";
    return pdo_query_value($sql);
}
// Hàm lấy danh mục theo id và trả về số lượng sản phẩm trong danh mục đó
function count_sanpham_theo_danhmuc($iddm)
{
    $sql = "SELECT COUNT(*) FROM sanpham WHERE iddm = $iddm";
    return pdo_query_value($sql); // Trả về số lượng sản phẩm trong danh mục
}
