<div class="main-content">
    <div class="container">
        <h3 class="text-primary fw-bold mb-4">Quản lý người dùng</h3>

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
                            <td>' . $tel . '</td>';

                        // Kiểm tra nếu tài khoản đang đăng nhập là chính dòng này thì không cho đổi vai trò
                        if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $id) {
                            $vaitro_text = $role == 1 ? 'Admin (Bạn)' : 'User (Bạn)';
                            echo '<td>' . $vaitro_text . '</td>';
                        } else {
                            echo '<td>
                                <form method="post" action="index.php?act=capnhatroleadmin" class="d-flex justify-content-center align-items-center gap-2">
                                    <input type="hidden" name="id" value="' . $id . '">
                                    <select name="role" class="form-select form-select-sm" style="width: 100px;">
                                        <option value="0" ' . ($role == 0 ? 'selected' : '') . '>User</option>
                                        <option value="1" ' . ($role == 1 ? 'selected' : '') . '>Admin</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-success">✔</button>
                                </form>
                            </td>';
                        }

                        echo '<td>';
                        if ($role == 1) {
                            echo '<div class="alert alert-danger" role="alert">
                            Không thể xóa!
                            </div>
                            ';
                        } else {
                            // Nếu không phải admin thì hiển thị cả icon và chữ "Xóa"
                            echo '<a href="' . $xoatk . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\')">
                                    <i class="fa-solid fa-trash"></i> Xóa
                                </a>';
                        }
                        echo '</td>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>