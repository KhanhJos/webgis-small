<?php
//Kiểm tra tenquanhuyen có tồn tại isset()
//kiểm tra một biến có phải thuộc kiểu dữ liệu chuỗi hay không(string) is_string()
if ((isset($_GET['tenquanhuyen'])) && (is_string($_GET['tenquanhuyen']))) { // From index.php
	//Gán vào biến
    $name = $_GET['tenquanhuyen'];

} else { // Không có tên hợp lệ, hủy tập lệnh.
    echo '<p class="error">Trang này lỗi không lấy được tên quận đúng!.</p>';
    exit();
}

//Nhúng file kết nối với database
include('connect.php');

//Lấy dữ liệu từ file index.php
if ($name) {
 	if($name == "Tất cả"){
 		$sql = "SELECT COUNT(*) as dem
                        FROM public.diemdulich";
 	}
 	else{
 		$sql = "SELECT COUNT(public.diemdulich.mandiemdulich) as dem
                        FROM public.diemdulich
                        WHERE public.diemdulich.maquanhuyen like (Select public.quanhuyen.maquanhuyen from public.quanhuyen where public.quanhuyen.tenquanhuyen like '%$name%')";
 	}
    
    $query = pg_query($conn, $sql);
    $i = 1;
    $rows = pg_num_rows($query);

    if ($rows > 0) {


        $bg = '#eeeeee';
        //Nạp dữ liệu pg_fetch_array() 
        while ($row2 = pg_fetch_array($query, NULL, PGSQL_ASSOC)) {

            echo "<p style = 'color: green; margin-left: 30px; font-size: 18pt; padding:20px 20px 0;'><b>".$name." Có " . $row2['dem'] . " điểm du lịch</b></p>";
        }

    } else {
        echo "<p style = 'margin-left: 30px; font-size: 13pt; padding:20px 20px 0;'><b>Không tìm thấy kết quả nào!</b></p>";
    }
} else if (empty($name)) {
}
