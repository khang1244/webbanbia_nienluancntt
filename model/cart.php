<?php

// Hàm thêm sản phẩm vào giỏ hàng
function insert_cart($iduser, $idpro, $img, $name, $price, $soluong, $thanhtien, $idbill)
{
    $sql = "insert into cart(iduser, idpro, img, name, price, soluong, thanhtien, idbill) 
            values('$iduser', '$idpro', '$img', '$name', '$price', '$soluong', '$thanhtien', '$idbill')";
    return pdo_execute($sql);
}
// Hàm cập nhật giỏ hàng 
function loadall_cart($idbill)
{
    $sql = "select * from cart where idbill=" . $idbill;
    $bill = pdo_query($sql);
    return $bill;
}
