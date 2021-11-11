<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <title>Map Du Lịch Hà Nội</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- learn -->
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css" />
        <script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js" type="text/javascript"></script>
</head>

<body onload="initialize_map();">

    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <div class="container">
            <!-- Tiêu đề -->
           	<p></p>
            <a class="navbar-brand" href="#">Xây dựng hệ thống Webgis quản lý điểm du lịch Hà Nội</a>
            <p></p>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-3">
           
            <p></p>
            <!-- Có 12 cột nên chia 3-7-2 -->
            
             <div class="col-sm-9">
            	<p></p>
                <div class="card">
                    <div class="card-body" id="map"></div>
                   	
                </div>
            </div>
            <div class="col-sm-3">
            	<p></p>
            	<div class="card">
                    <div class="card-body">
                        <form>
                            <div class="form-group">                  	
                            	<label>Thông tin</label>
                            	<div id="info"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
        	<div class="col-sm-6">
                <p></p>
                <!-- Vì là quản lý nên ta chọn quản lý và tìm kiếm theo từng quận huyện -->
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label>Tìm Kiếm</label>
                                <p></p>
                                <select class="form-control" id="searchqh">
                                    <option value="Ba Đình">Ba Đình</option>
                                    <option value="Ba Vì">Ba Vì</option>
                                    <option value="Bắc Từ Liêm">Bắc Từ Liêm</option>        
                                    <option value="Cầu Giấy">Cầu Giấy</option>
                                    <option value="Chương Mỹ">Chương Mỹ</option>
                                    <option value="Đan Phượng">Đan Phượng</option>
                                    <option value="Đông Anh">Đông Anh</option>
                                    <option value="Đống Đa">Đống Đa</option>
                                    <option value="Gia Lâm">Gia Lâm</option>
                                    <option value="Hà Đông">Hà Đông</option>
                                    <option value="Hai Bà Trưng">Hai Bà Trưng</option>
                                    <option value="Hoàn Kiếm">Hoàn Kiếm</option>
                                    <option value="Hoàng Mai">Hoàng Mai</option>
                                    <option value="Hoài Đức">Hoài Đức</option>
                                    <option value="Long Biên">Long Biên</option>
                                    <option value="Mê Linh">Mê Linh</option>
                                    <option value="Mỹ Đức">Mỹ Đức</option>
                                    <option value="Nam Từ Liêm">Nam Từ Liêm</option>
                                    <option value="Phú Xuyên">Phú Xuyên</option>
                                    <option value="Phúc Thọ">Phúc Thọ</option>
                                    <option value="Quốc Oai">Quốc Oai</option>
                                    <option value="Sơn Tây">Sơn Tây</option>  
                                    <option value="Sóc Sơn">Sóc Sơn</option>
                                    <option value="Tây Hồ">Tây Hồ</option>
                                    <option value="Thanh Xuân">Thanh Xuân</option>                          
                                    <option value="Thạch Thất">Thạch Thất</option>
                                    <option value="Thanh Oai">Thanh Oai</option>
                                    <option value="Thanh Trì">Thanh Trì</option>
                                    <option value="Thường Tín">Thường Tín</option>
                                    <option value="Ứng Hoà">Ứng Hoà</option>
                                </select>
                                <p></p>
                                <div class="form-row">
			                        <div class="col-md-6">
			                            <div class="form-group mb-1">
			                                <button type="button" name="submit" onclick="timkiem();" class="btn btn-primary btn-block">Tìm kiếm</button>
			                            </div>
			                        </div>
			                        <div class="col-md-6">
			                            <div class="form-group mb-1">
			                                <button type="reset" name="submit" onclick="lammoitimkiem();" class="btn btn-primary btn-block">Làm mới</button>
			                            </div>
			                        </div>
			                        <!-- Vì là quản lý nên ta chọn quản lý và tìm kiếm theo từng quận huyện -->
                            		<div class="form-group">
                            			<p></p>
                              			<label>Kết quả Tìm Kiếm</label>
                                		<p></p>
			                   				<div class="scrollbar" id="style-1">
               									<div class="force-overflow" id="divkq">
                   								 	<!-- Kết quả tìm kiếm -->
               									</div>
          									</div>
                           			</div>
			                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- kq -->
            <div class="col-sm-6">
                <p></p>
                <!-- Vì là quản lý nên ta chọn quản lý và tìm kiếm theo từng quận huyện -->
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label>Thống kê</label>
                                <p></p>
                                <p></p>
                                <select class="form-control" id="ThongKe">
                                	<option value="Tất cả">Tất cả</option>
                                    <option value="Ba Đình">Ba Đình</option>
                                    <option value="Ba Vì">Ba Vì</option>
                                    <option value="Bắc Từ Liêm">Bắc Từ Liêm</option>        
                                    <option value="Cầu Giấy">Cầu Giấy</option>
                                    <option value="Chương Mỹ">Chương Mỹ</option>
                                    <option value="Đan Phượng">Đan Phượng</option>
                                    <option value="Đông Anh">Đông Anh</option>
                                    <option value="Đống Đa">Đống Đa</option>
                                    <option value="Gia Lâm">Gia Lâm</option>
                                    <option value="Hà Đông">Hà Đông</option>
                                    <option value="Hai Bà Trưng">Hai Bà Trưng</option>
                                    <option value="Hoàn Kiếm">Hoàn Kiếm</option>
                                    <option value="Hoàng Mai">Hoàng Mai</option>
                                    <option value="Hoài Đức">Hoài Đức</option>
                                    <option value="Long Biên">Long Biên</option>
                                    <option value="Mê Linh">Mê Linh</option>
                                    <option value="Mỹ Đức">Mỹ Đức</option>
                                    <option value="Nam Từ Liêm">Nam Từ Liêm</option>
                                    <option value="Phú Xuyên">Phú Xuyên</option>
                                    <option value="Phúc Thọ">Phúc Thọ</option>
                                    <option value="Quốc Oai">Quốc Oai</option>
                                    <option value="Sơn Tây">Sơn Tây</option>  
                                    <option value="Sóc Sơn">Sóc Sơn</option>
                                    <option value="Tây Hồ">Tây Hồ</option>
                                    <option value="Thanh Xuân">Thanh Xuân</option>                          
                                    <option value="Thạch Thất">Thạch Thất</option>
                                    <option value="Thanh Oai">Thanh Oai</option>
                                    <option value="Thanh Trì">Thanh Trì</option>
                                    <option value="Thường Tín">Thường Tín</option>
                                    <option value="Ứng Hoà">Ứng Hoà</option>
                                </select>
                                <p></p>
                                <div class="form-row">
			                        <div class="col-md-6">
			                            <div class="form-group mb-1">
			                                <button type="button" name="submit" onclick="thongke();" class="btn btn-primary btn-block">Thống kê</button>
			                            </div>
			                        </div>
			                        <div class="col-md-6">
			                            <div class="form-group mb-1">
			                                <button type="reset" name="submit" onclick="lammoithongke();" class="btn btn-primary btn-block">Làm mới</button>
			                            </div>
			                        </div>
			                        
			                        <div class="form-group">
			                        	<p></p>
                              			<label>Kết quả Thống kê</label>
                                		<p></p>
			                   				<div class="scrollbar" id="style-1" >
               									<div class="force-overflow" id="divkqthongke">
                   								 	<!-- Kết quả  -->
               									</div>
          									</div>
                           			</div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end -->
        </div>
    </div>
		<?php include 'pgsqlAPI.php' ?>
		<script>
        //$("#document").ready(function () {
            var format = 'image/png';
            var map;
            // var minX = 8.49874900000009;
            // var minY = 1.65254800000014;
            // var maxX = 16.1921150000001;
            // var maxY = 13.0780600000001;
            // var cenX = (minX + maxX) / 2;
            // var cenY = (minY + maxY) / 2;
            var mapLat = 105.85236470000001;
            var mapLng = 21.028774777025742;
            var mapDefaultZoom = 9;


            //Hàm bản đồ
            //Tạo layer bản đồ thế giới
            //ol.layer.Tile() : hiển thị bản đồ dạng bản đồ nền, có thể xác định được cấp độ zoom phụ thuộc vào tỷ lệ bản đồ
            //source: new ol.source.OSM({}) : Sử dụng nguồn bản đồ OpenStreetMap
            function initialize_map() {
                layerBG = new ol.layer.Tile({
                    source: new ol.source.OSM({})
                });

                 // Khai báo layer thành phố đã có trong GeoServer 
                 //ol.layer.Image() : hiển thị bản đồ dưới dạng ảnh với mức độ zoom và phân giải tùy ý
                 //kiểu layer chúng ta sử dụng ở đây là Image và kiểu source(nguồn) là ImageWMS ( cung cấp các hình ảnh đơn lẻ)
                 //ratio: 1, : mặc định là 1.5 , phải bằng 1 hoặc hơn, nó gấp đôi chiều rộng và chiều cao của chế độ xem bản đồ
                 //url:'http://localhost:8080/geoserver/HN/wms', : là link đến service của geoserver
                 //params : {} : Các tham số yêu cầu WMS
                 //'FORMAT':format,  ở đây FORMAT là image/png
                 //'VERSION':'1.1.1', Phiên bản 
                 //'STYLES':'', : kiểu styles hiển thị cho layer, rỗng ở đây là mặc định
                 //'LAYERS':'thanhpho' : là tên layer trong geoserver
                var layerThanhPho = new ol.layer.Image({
                    source: new ol.source.ImageWMS({
                        ratio: 1,
                        url:'http://localhost:8080/geoserver/DiemDuLich/wms',
                        params:{
                            'FORMAT':format,
                            'VERSION':'1.1.1',
                            'STYLES':'',
                            'LAYERS':'thanhpho',
                        }
                    })
                });
                
                var layerQuanHuyen = new ol.layer.Image({
                    source: new ol.source.ImageWMS({
                        ratio: 1,
                        url:'http://localhost:8080/geoserver/DiemDuLich/wms',
                        params:{
                            'FORMAT':format,
                            'VERSION':'1.1.1',
                            'STYLES':'',
                            'LAYERS':'quanhuyen',
                        }
                    })
                });

                var layerDiemDuLich = new ol.layer.Image({
                    source: new ol.source.ImageWMS({
                        ratio: 1,
                        url:'http://localhost:8080/geoserver/DiemDuLich/wms',
                        params:{
                            'FORMAT':format,
                            'VERSION':'1.1.1',
                            'STYLES':'',
                            'LAYERS':'diemdulich',
                        }
                    })
                });
                //view cách thức hiển thị bản đồ 
                //center : trọng tâm bản đồ khi load
                //zoom : mức độ zoom của bản đồ 
                var viewMap = new ol.View({
                    center: ol.proj.fromLonLat([mapLat, mapLng]),
                    zoom: mapDefaultZoom
                });
                //Map hiển thị bản đồ 
                //target: ID của thẻ div chúng ta sẽ đưa map lên, ở đây là ‘map’
                //layers: layer chúng ta khai báo bên trên, mỗi layer cách nhau dấu ,
                map = new ol.Map({
                    target: "map",
                    layers: [layerBG, layerQuanHuyen,layerThanhPho,layerDiemDuLich],
                    //view: quy định cách thức hiển thị của bản đồ
                    view: viewMap
                });
                var styles = {
                    'Point': new ol.style.Style({
                        stroke: new ol.style.Stroke({
                            color: 'yellow',
                            width: 3
                    })
                }),
                    'MultiPolygon': new ol.style.Style({
                        fill: new ol.style.Fill({
                        color: 'orange'
                        }),
                        stroke: new ol.style.Stroke({
                            color: 'yellow', 
                            width: 2
                        })
                    })
                };
                //Tạo hàm styleFunction gán vào biến
                var styleFunction = function (feature) {
                    return styles[feature.getGeometry().getType()];
                };
                //Sử dụng layer vector
                var vectorLayer = new ol.layer.Vector({
                    //source: vectorSource,
                    style: styleFunction
                });
                var stylePoint = new ol.style.Style({
                image: new ol.style.Icon({
                    anchor: [0.5, 0.5],
                    anchorXUnits: "fraction",
                    anchorYUnits: "fraction",
                    src: "Yellow_dot.svg"
                })

                });
                map.addLayer(vectorLayer);
                //end highlight
                

                function createJsonObj(result) {                    
                    var geojsonObject = '{'
                            + '"type": "FeatureCollection",'
                            + '"crs": {'
                                + '"type": "name",'
                                + '"properties": {'
                                    + '"name": "EPSG:4326"'
                                + '}'
                            + '},'
                            + '"features": [{'
                                + '"type": "Feature",'
                                + '"geometry": ' + result
                            + '}]'
                        + '}';
                    return geojsonObject;
                }
                    
                function drawGeoJsonObj(paObjJson) {
                    var vectorSource = new ol.source.Vector({
                        features: (new ol.format.GeoJSON()).readFeatures(paObjJson, {
                            dataProjection: 'EPSG:4326',
                            featureProjection: 'EPSG:3857'
                        })
                    });
                    vectorLayer.setSource(vectorSource);
                }
                function highLightObj(result) {
                var strObjJson = createJsonObj(result);
                var objJson = JSON.parse(strObjJson);
                drawGeoJsonObj(objJson);
                }
                function displayObjInfo(result, coordinate)
                {
                    //alert("result: " + result);
                    //alert("coordinate des: " + coordinate);
                    $("#info").html(result);
                }
                //View click
                map.on('singleclick', function (evt) {
                    //alert("coordinate org: " + evt.coordinate);
                    //var myPoint = 'POINT(12,5)';
                    var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
                    var lon = lonlat[0];
                    var lat = lonlat[1];
                    var myPoint = 'POINT(' + lon + ' ' + lat + ')';
                    //alert("myPoint: " + myPoint);
                    //*
                    //ajax
                    vectorLayer.setStyle(stylePoint);
                    $.ajax({
                        type: "POST",
                        url: "pgsqlAPI.php",
                        //dataType: 'json',
                        //data: {functionname: 'reponseGeoToAjax', paPoint: myPoint},
                        data: {functionname: 'getInfoPoint', paPoint: myPoint},
                        success : function (result, status, erro) {
                            displayObjInfo(result, evt.coordinate );
                        },

                        error: function (req, status, error) {
                            alert(req + " " + status + " " + error);
                        }

                    });
                     $.ajax({
                        type: "POST",
                        url: "pgsqlAPI.php",
                        //dataType: 'json',
                        //data: {functionname: 'reponseGeoToAjax', paPoint: myPoint},
                        data: {functionname: 'getGeoCMRToAjax', paPoint: myPoint},
                        success : function (result, status, erro) {
                            highLightObj(result, evt.coordinate );
                        },

                        error: function (req, status, error) {
                            alert(req + " " + status + " " + error);
                        }

                    });

                    //*/
                });
            };

             
        //});

        //Tìm kiếm Điểm du lịch
	    function timkiem() {
	        var txttenquanhuyen = document.getElementById('searchqh').value;

	        xmlhttp = new XMLHttpRequest();

	        xmlhttp.onreadystatechange = function () {
	            //Kiểm tra kết nối thành công, nếu thành công sẽ gán dữ liệu cho nó
	            if (xmlhttp.readyState == 4) {
	                document.getElementById("divkq").innerHTML = xmlhttp.responseText;
	            }
	        }
	        //url : vào trang xltimkiem.php với giá trị tiêu chí và khu vực tương ứng
	        xmlhttp.open("GET", "search.php?tenquanhuyen=" + txttenquanhuyen);
	        xmlhttp.send();

		}

		//Thống kê
		function thongke() {
	        var txttenquanhuyen = document.getElementById('ThongKe').value;
	

	        xmlhttp = new XMLHttpRequest();

	        xmlhttp.onreadystatechange = function () {
	            //Kiểm tra kết nối thành công, nếu thành công sẽ gán dữ liệu cho nó
	            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	                document.getElementById("divkqthongke").innerHTML = xmlhttp.responseText;
	            }
	        }
	        //url : vào trang xltimkiem.php với giá trị tiêu chí và khu vực tương ứng
	        xmlhttp.open("GET", "thongke.php?tenquanhuyen=" + txttenquanhuyen);
	        xmlhttp.send();
			}

			//làm mới
			function lammoithongke() {
		        document.getElementById("divkqthongke").innerText = "";  
			}
			function lammoitimkiem(){
				document.getElementById("divkq").innerText = "";
			}
        </script>

<p></p>
<footer class="page-footer font-small bg-warning lighten-3 pt-4">

	<!-- Footer Links -->
	<div class="container text-center text-md-left">

		<!-- Grid row -->
		<div class="row">

			<!-- Grid column -->
			<div class="col-md-4 col-lg-3 mr-5 my-md-4 my-0 mt-4 mb-1">

				<!-- Content -->
				<h5 class="font-weight-bold text-uppercase mb-4">Giới thiệu WEBGIS</h5>
				<a style="font-size: 17px"><b>WebGIS quản lý điểm du lịch Hà Nội</b>
					là một giải pháp client – server cho phép quản lý, phân tích, cập nhật, phân phối thông tin bản đồ các điểm du lịch tại Hà Nội
					và GIS trên mạng Internet, với giao
					diện thân thiện, đơn giản phù hợp với nhiều người dùng.</a>
			</div>
			<!-- Grid column -->

			<hr class="clearfix w-100 d-md-none">

			<!-- Grid column -->
			<div class="col-md-2 col-lg-2 my-md-4 my-0 mt-4 mb-1">

				<h5 class="font-weight-bold text-uppercase mb-4">Liên hệ</h5>

				<ul class="list-unstyled">
					<p>0123456789</p>
                    <p>abc@gmail.com</p>
				

			</div>
			<!-- Grid column -->

			<hr class="clearfix w-100 d-md-none">

			<!-- Grid column -->
			<div class="col-md-4 col-lg-3 my-md-4 my-0 mt-4 mb-1">

				<!-- Contact details -->
				<h5 class="font-weight-bold text-uppercase mb-4">Thông tin</h5>

				<ul class="list-unstyled">
					<p>Nguyễn Văn A</p>
                    <p>Nguyễn Văn B</p>
                    <p>Nguyễn Văn C</p>
				</ul>

			</div>
			<!-- Grid column -->

			<hr class="clearfix w-100 d-md-none">

			<!-- Grid column -->
			<div class="col-md-2 col-lg-2 mx-auto my-4">

				<!-- Social buttons -->
				<h5 class="font-weight-bold text-uppercase mb-4">Địa chỉ</h5>
				<p>Hà Nội - Việt Nam</p>
			
			</div>
			<!-- Grid column -->
		</div>
		<!-- Grid row -->

	</div>
	<!-- Footer Links -->

	<!-- Copyright -->
	<div class="footer-copyright text-center text-white py-3">
		Chúc bạn có một trải nhiệm tuyệt vời với map của chúng tôi !
	</div>
	<!-- Copyright -->

</footer>
</body>
<!-- <script src="app.js"></script> -->
</html>