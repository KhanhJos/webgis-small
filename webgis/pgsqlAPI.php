<?php
    if(isset($_POST['functionname']))
    {
        $paPDO = initDB();
        $paSRID = '4326';
        $paPoint = $_POST['paPoint'];
        $functionname = $_POST['functionname'];
        
        $aResult = "null";
        if ($functionname == 'getGeoCMRToAjax')
            $aResult = getGeoCMRToAjax($paPDO, $paSRID, $paPoint);
        else if ($functionname == 'getInfoPoint')
            $aResult = getInfoPoint($paPDO, $paSRID, $paPoint);

        
        echo $aResult;
    
        closeDB($paPDO);
    }

    function initDB()
    {
         $paPDO = new PDO('pgsql:host=localhost;dbname=DiemDuLich;port=5432', 'postgres', 'admin');
        return $paPDO;
    }
    function query($paPDO, $paSQLStr)
    {
        try
        {
            // Khai báo exception
            $paPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Sử đụng Prepare 
            $stmt = $paPDO->prepare($paSQLStr);
            // Thực thi câu truy vấn
            $stmt->execute();
            
            // Khai báo fetch kiểu mảng kết hợp
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            // Lấy danh sách kết quả
            $paResult = $stmt->fetchAll();   
            return $paResult;                 
        }
        catch(PDOException $e) {
            echo "Thất bại, Lỗi: " . $e->getMessage();
            return null;
        }       
    }
    function closeDB($paPDO)
    {
        // Ngắt kết nối
        $paPDO = null;
    }

    function getGeoCMRToAjax($paPDO,$paSRID,$paPoint)
    {

        $paPoint = str_replace(',', ' ', $paPoint);   

        $strDistance = "ST_Distance('" . $paPoint . "',ST_AsText(geom))";
        $strMinDistance = "SELECT min(ST_Distance('" . $paPoint . "',ST_AsText(geom))) from diemdulich  ";
        $mySQLStr = "SELECT ST_AsGeoJson(geom)as geo from diemdulich where " . $strDistance . " = (" . $strMinDistance . ") and " . $strDistance . " < 0.05";

        $result = query($paPDO, $mySQLStr);
        
        if ($result != null)
        {
            // Lặp kết quả
            foreach ($result as $item){
                return $item['geo'];
            }
        }
        else
            return "null";
    }

    function getInfoPoint($paPDO,$paSRID,$paPoint)
    {
        $paPoint = str_replace(',', ' ', $paPoint);
        $strDistance = "ST_Distance('" . $paPoint . "',ST_AsText(geom))";
        $strMinDistance = "SELECT min(ST_Distance('" . $paPoint . "',ST_AsText(geom))) from diemdulich  ";
        $mySQLStr = "SELECT * from diemdulich where " . $strDistance . " = (" . $strMinDistance . ") and " . $strDistance . " < 0.05";
        $result = query($paPDO, $mySQLStr);
        if ($result != null)
        {
            $resFin = '<table>';
            // Lặp kết quả
            foreach ($result as $item){
                $resFin = $resFin.'<tr><td><b>Mã: </b>'.$item['mandiemdulich'].'</td></tr>';
                $resFin = $resFin.'<tr><td><b>Tên điểm du lịch: </b>'.$item['tendiemdulich'].'</td></tr>';
                $resFin = $resFin.'<tr><td><b>Địa chỉ: </b>'.$item['diachi'].'</td></tr>';
                $resFin = $resFin.'<tr><td><b>Mô tả: </b>'.$item['mota'].'</td></tr>';
   
                break;
            }
            $resFin = $resFin.'</table>';
            return $resFin;
        }
        else
            return "null";
    }
?>

