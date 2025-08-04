<?php
function loadall_thongke()
{
    $sql = "SELECT danhmuc.id AS madm, danhmuc.name AS tendm, 
                   COUNT(sanpham.id) AS countsp, 
                   MIN(sanpham.price) AS minprice, 
                   MAX(sanpham.price) AS maxprice, 
                   AVG(sanpham.price) AS avgprice 
            FROM sanpham 
            LEFT JOIN danhmuc ON danhmuc.id = sanpham.iddm 
            GROUP BY danhmuc.id 
            ORDER BY danhmuc.id DESC";

    return pdo_query($sql);
}
