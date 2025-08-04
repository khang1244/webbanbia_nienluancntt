<div class="main-content">
    <div class="container">
        <h3 class="text-primary fw-bold mb-4">Danh sách tài khoản</h3>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Mã tài khoản</th>
                        <th scope="col">Tên đăng nhập</th>
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Điện thoại</th>
                        <th scope="col">Vai trò</th>
                        <th scope="col">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($listtaikhoan as $taikhoan) {
                        extract($taikhoan);
                        $xoatk = "index.php?act=xoataikhoanadmin&id=" . $id;

                        echo '<tr>
                            <td>' . $id . '</td>
                             <td>' . $user . '</td>
                            <td>' . $fullname . '</td>
                            <td>' . $email . '</td>
                            <td>' . $address . '</td>
                            <td>' . $tel . '</td>
                            <td>' . $role . '</td>
                            <td>
                                <a href="' . $xoatk . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\')">
                                    <i class="fa-solid fa-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>