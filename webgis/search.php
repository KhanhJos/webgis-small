<?php
//Kiểm tra rỗng và có là kiểu chuỗi hay không
if ((isset($_GET['tenquanhuyen'])) && (is_string($_GET['tenquanhuyen']))) { // From index.php
    //Gán giá trị đó vào biến name
    $name = $_GET['tenquanhuyen'];

} else { // Không có tên hợp lệ, hủy tập lệnh.
    echo '<p class="error">Trang này lỗi không lấy được tên quận đúng!.</p>';
    exit();
}


//Nhúng file kết nối với database
include('connect.php');


//Lấy dữ liệu từ file index.php
//Nếu name có dữ liệu
if ($name) {
    //truy vấn lấy ra các thuộc tính điểm du lịch ở quận name truyền vào
    //Câu truy vấn lớp
    $sql = "SELECT public.diemdulich.mandiemdulich,public.diemdulich.tendiemdulich,public.diemdulich.thoigianhoatdong,public.diemdulich.diachi,public.diemdulich.mota 
                        FROM public.diemdulich
                        WHERE public.diemdulich.maquanhuyen like (Select public.quanhuyen.maquanhuyen from public.quanhuyen where public.quanhuyen.tenquanhuyen like '%$name%')";
    //Thực hiện truy vấn
    $query = pg_query($conn, $sql);
    $i = 1;
    $rows = pg_num_rows($query);

    if ($rows > 0) {
        echo "<p style = 'margin-left: 30px; font-size: 13pt; padding:20px 20px 0;'><b>Có ";
        echo pg_num_rows($query);
        echo " kết quả được tìm thấy</b></p>";

        echo '<table class="table-bordered tbfind">
                            <tr>
                                <td><b>STT</b></td>
                                <td><b>Tên điểm du lịch</b></td>
                                <td><b>Thời gian hoạt động</b></td>
                                <td><b>Địa chỉ</b></td>
                                <td><b>Mô tả</b></td>
                                
                            </tr>';
        $bg = '#eeeeee';
        //Nạp dữ liệu pg_fetch_array() 
        while ($row2 = pg_fetch_array($query, NULL, PGSQL_ASSOC)) {
            $bg = ($bg == '#eeeeee' ? '#ffffff' : '#eeeeee');
            echo '<tr bgcolor="' . $bg . '">
                                <td style="text-align: center">' . $i . '</td>
                                <td>' . $row2['tendiemdulich'] . '</td>
                                <td>' . $row2['thoigianhoatdong'] . '</td>
                                <td style="text-align: center">' . $row2['diachi'] . '</td>
                                <td>' . $row2['mota'] . '</td>
                               
                            </tr>';
            $i++;
        }
        echo '</table>';
    } else {
        echo "<p style = 'margin-left: 30px; font-size: 13pt; padding:20px 20px 0;'><b>Không tìm thấy kết quả nào!</b></p>";
    }

} else if (empty($name)) {
}
