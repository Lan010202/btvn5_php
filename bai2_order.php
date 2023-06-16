<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "baitapphp_1";
$connection = mysqli_connect($servername,$username,$password);

if(!$connection)
    die("Thất bại " . mysqli_error()); 
    // Thông báo lỗi nếu kết nối thất bại 
if (!mysqli_select_db($connection, $database))     
    die("thất bại " . mysql_error()); 
   // Thông báo lỗi nếu chọn CSDL thất bại
echo '--------------- TẠO BẢNG ---------------<br/>';
//bảng khách hàng
$createtableKH = "
   CREATE TABLE IF NOT EXiSTS KHACHHANG (
    MAKH char(4) PRIMARY KEY,
    HOTEN VARCHAR(255),
    DCHI VARCHAR(255),
    SODT VARCHAR(20),
    NGSINH DATE,
    DOANHSO DECIMAL(10, 2),
    NGDK DATE
)"; 
$result = mysqli_query($connection,$createtableKH);
if (!$result){
    die ('Thất bại: '. mysqli_error($connection));
} else {
    echo 'Thành công tạo bảng: '. $createtableKH. '</br>';
};

//bảng nhân viên
$createtableNV = "
   CREATE TABLE IF NOT EXiSTS NHANVIEN (
    MANV char(4) PRIMARY KEY,
    HOTEN VARCHAR(255),
    NGVL DATE,
    SODT VARCHAR(20)
)"; 
$result = mysqli_query($connection,$createtableNV);
if (!$result){
    die ('Thất bại: '. mysqli_error($connection));
} else {
    echo 'Thành công tạo bảng: '. $createtableNV. '</br>';
};

//bảng sản phẩm 
$createtableSP = "
   CREATE TABLE IF NOT EXiSTS SANPHAM (
    MASP char(4) PRIMARY KEY,
    TENSP VARCHAR(255),
    DVT VARCHAR(20),
    NUOCSX VARCHAR(255),
    GIA DECIMAL(10, 2)
)"; 
$result = mysqli_query($connection,$createtableSP);
if (!$result){
    die ('Thất bại: '. mysqli_error($connection));
} else {
    echo 'Thành công tạo bảng: '. $createtableSP. '</br>';
};

//tạo bảng hóa đơn
$createtableHD = "
   CREATE TABLE IF NOT EXiSTS HOADON (
    SOHD int PRIMARY KEY,
    NGHD DATE,
    MAKH char(4),
    MANV char(4),
    TRIGIA DECIMAL(10, 2),
    FOREIGN KEY (MAKH) REFERENCES KHACHHANG(MAKH) ON DELETE CASCADE,
    FOREIGN KEY (MANV) REFERENCES NHANVIEN(MANV) ON DELETE CASCADE
)"; 
$result = mysqli_query($connection,$createtableHD);
if (!$result){
    die ('Thất bại: '. mysqli_error($connection));
} else {
    echo 'Thành công tạo bảng: '. $createtableHD. '</br>';
};

//tạo bảng chi tiết hóa đơn
$createtableCTHD = "
   CREATE TABLE IF NOT EXiSTS CTHD (
    SOHD int,
    MASP char(4),
    SL int,
    PRIMARY KEY (SOHD, MASP),
    FOREIGN KEY (SOHD) REFERENCES HOADON(SOHD) ON DELETE CASCADE,
    FOREIGN KEY (MASP) REFERENCES SANPHAM(MASP) ON DELETE CASCADE
)"; 
$result = mysqli_query($connection,$createtableCTHD);
if (!$result){
    die ('Thất bại: '. mysqli_error($connection));
} else {
    echo 'Thành công tạo bảng: '. $createtableCTHD. '</br>';
};

echo '--------------- THÊM DỮ LIỆU ---------------<br/>';
//khách hàng
$sql_insertKH = "
INSERT INTO KHACHHANG (MAKH, HOTEN, DCHI, SODT, NGSINH, DOANHSO, NGDK) 
VALUES
    ('KH01','Nguyen Van A','731 Tran Hung Dao, Q5, TpHCM','08823451','1960-10-22','13,060,000','2006-07-22'),
    ('KH02','Tran Ngoc Han','23/5 Nguyen Trai, Q5, TpHCM','0908256478','1974-04-03','280,000','2006-07-30'),
    ('KH03','Tran Ngoc Linh','45 Nguyen Canh Chan, Q1, TpHCM','0938776266','1980-06-12','3,860,000','2006-08-05'),
    ('KH04','Tran Minh Long','50/34 Le Dai Thanh, Q10, TpHCM','0917325476','1965-03-09','250,000','2006-10-20'),
    ('KH05','Le Nhat Minh','30 Truong Dinh, Q3, TpHCM','08246108','1950-03-10','21,000','2006-10-28'),
    ('KH06','Le Hoai Thuong','227 Nguyen Van Cu, Q5, TpHCM','08631738','1981-12-31','915,000','2006-11-24'),
    ('KH07','Nguyen Van Tam','32/3 Tran Binh Trong, Q5, TpHCM','0916783565','1971-06-04','12,500','2006-06-01'),
    ('KH08','Nguyen Van Ba','123 Nguyen Hue, Q1, TpHCM','0938435756','1972-01-10','450,000','2006-12-01'),
    ('KH09','Tran Van Hai','456 Nguyen Trai, Q5, TpHCM','0938435757','1973-02-11','650,000','2007-01-01'),
    ('KH10','Le Van Hung','789 Nguyen Canh Chan, Q1, TpHCM','0938435758','1974-03-12','850,000','2007-01-02');
";

    $result = mysqli_query($connection,$sql_insertKH);
    if (!$result){
        die ('Thất bại: '. mysqli_error($connection));
    } else {
        echo 'Thành công thêm dữ liệu: '. $sql_insertKH. '</br>';
    };


//nhân viên 
$sql_insertNV = "
INSERT INTO NHANVIEN (MANV, HOTEN, NGVL, SODT) 
VALUES
    ('NV01', 'Nguyen Nhu Nhut', '2006-04-13', '0927345678'),
    ('NV02', 'Le Thi Phi Yen', '2006-04-21', '0987567390'),
    ('NV03', 'Nguyen Van B', '2006-04-27', '0997047382'),
    ('NV04', 'Ngo Thanh Tuan', '2006-04-24', '0913758498'),
    ('NV05', 'Nguyen Thi Truc Thanh', '2006-07-20', '0918590387');
";

    $result = mysqli_query($connection,$sql_insertNV);
    if (!$result){
        die ('Thất bại: '. mysqli_error($connection));
    } else {
        echo 'Thành công thêm dữ liệu: '. $sql_insertNV. '</br>';
    };


//sản phẩm
$sql_insertSP = "
INSERT INTO SANPHAM (MASP,TENSP, DVT, NUOCSX, GIA) 
VALUES
    ('SP01','But chi', 'cay', 'Viet Nam', '5,000'),
    ('SP02','But chi', 'hop', 'Viet Nam', '30,000'),
    ('SP03','But bi', 'cay', 'Viet Nam', '5,000'),
    ('SP04','But bi', 'hop', 'Trung Quoc', '7,000'),
    ('SP05','Tap 100 giay mong', 'quyen', 'Trung Quoc', '2,500'),
    ('SP06','Tap 200 giay mong', 'quyen', 'Trung Quoc', '4,500'),
    ('SP07','Tap 100 giay mong', 'quyen', 'Viet Nam', '3,000'),
    ('SP08','Tap 200 giay mong', 'quyen', 'Viet Nam', '5,500'),
    ('SP09','Tap 100 giay mong', 'chuc', 'Viet Nam', '23,000'),
    ('SP10','Tap 200 giay mong', 'chuc', 'Viet Nam', '53,000');
";
    $result = mysqli_query($connection,$sql_insertSP);
    if (!$result){
        die ('Thất bại: '. mysqli_error($connection));
    } else {
        echo 'Thành công thêm dữ liệu: '. $sql_insertSP. '</br>';
    };


//hóa đơn
$sql_insertHD = "
INSERT INTO HOADON (SOHD, NGHD, MAKH, MANV, TRIGIA) 
VALUES
    (1, '2023-06-15', 'KH01', 'NV01', 100000),
    (2, '2023-06-16', 'KH02', 'NV02', 200000),
    (3, '2023-06-17', 'KH03', 'NV03', 300000),
    (4, '2023-06-18', 'KH04', 'NV04', 400000),
    (5, '2023-06-19', 'KH05', 'NV04', 500000),
    (6, '2023-06-20', 'KH06', 'NV03', 600000),
    (7, '2023-06-21', 'KH07', 'NV02', 700000),
    (8, '2023-06-22', 'KH08', 'NV01', 800000);
";
    $result = mysqli_query($connection,$sql_insertHD);
    if (!$result){
        die ('Thất bại: '. mysqli_error($connection));
    } else {
        echo 'Thành công thêm dữ liệu: '. $sql_insertHD. '</br>';
    };


//chi tiết hóa đơn
$sql_insertCTHD = "
INSERT INTO CTHD (SOHD, MASP, SL) 
VALUES
    (1,'SP01', 1),
    (1,'SP02', 2),
    (2,'SP03', 3),
    (2,'SP04', 4),
    (3,'SP01', 5),
    (3,'SP03', 6),
    (4,'SP03', 7),
    (4,'SP01', 8),
    (5,'SP02', 9),
    (5,'SP04', 10),
    (6,'SP010',11),
    (6,'SP08', 12),
    (7,'SP09', 13),
    (7,'SP07', 14),
    (8,'SP06', 15),
    (8,'SP05', 16);
";
    $result = mysqli_query($connection,$sql_insertCTHD);
    if (!$result){
        die ('Thất bại: '. mysqli_error($connection));
    } else {
        echo 'Thành công thêm dữ liệu: '. $sql_insertCTHD. '</br>';
    };

// Thêm thuộc tính GHICHU vào quan hệ SANPHAM
$sql_Add = "ALTER TABLE SANPHAM ADD COLUMN GHICHU VARCHAR(20)";
$result = mysqli_query($connection,$sql_Add);
    if (!$result){
        die ('Thất bại: '. mysqli_error($connection));
    } else {
        echo 'Thành công thêm dữ liệu: '. $sql_Add. '</br>';
    };

// Thêm thuộc tính LOAIKH vào quan hệ KHACHHANG
$sql_AddCo_LOAIKH = "ALTER TABLE KHACHHANG ADD COLUMN LOAIKH TINYINT";
$result = mysqli_query($connection,$sql_AddCo_LOAIKH );
    if (!$result){
        die ('Thất bại: '. mysqli_error($connection));
    } else {
        echo 'Thành công thêm dữ liệu: '. $sql_AddCo_LOAIKH . '</br>';
    };

// Cập nhật tên "Nguyễn Văn B" cho dữ liệu Khách Hàng có mã là KH01
$sql_Update = "UPDATE KHACHHANG SET HOTEN = 'Nguyễn Văn B' WHERE MAKH = 'KH01'";

$result = mysqli_query($connection,$sql_Update );
    if (!$result){
        die ('Thất bại: '. mysqli_error($connection));
    } else {
        echo 'Thành công: '. $sql_Update . '</br>';
    };

// Cập nhật tên "Nguyễn Văn Hoan" cho dữ liệu Khách Hàng có mã là KH09 và năm đăng ký là 2007
$sql_Update_1 = "UPDATE KHACHHANG SET HOTEN = 'Nguyễn Văn Hoan' WHERE MAKH = 'KH09' AND YEAR(NGDK) = 2007";

$result = mysqli_query($connection,$sql_Update_1 );
    if (!$result){
        die ('Thất bại: '. mysqli_error($connection));
    } else {
        echo 'Thành công: '. $sql_Update_1 . '</br>';
    };

// Sửa kiểu dữ liệu của thuộc tính GHICHU trong quan hệ SANPHAM thành varchar(100)
$sql_Modify = "ALTER TABLE SANPHAM MODIFY COLUMN GHICHU VARCHAR(100)";

$result = mysqli_query($connection,$sql_Modify);
    if (!$result){
        die ('Thất bại: '. mysqli_error($connection));
    } else {
        echo 'Thành công: '. $sql_Modify . '</br>';
    };
    
// Xóa thuộc tính GHICHU trong quan hệ SANPHAM
$sql_Drop = "ALTER TABLE SANPHAM DROP COLUMN GHICHU";

$result = mysqli_query($connection,$sql_Drop);
    if (!$result){
        die ('Thất bại: '. mysqli_error($connection));
    } else {
        echo 'Thành công: '. $sql_Drop . '</br>';
    };

// Xóa tất cả dữ liệu khách hàng có năm sinh 1971
$sql_Delete = "DELETE FROM KHACHHANG WHERE YEAR(NGSINH) = 1971";

$result = mysqli_query($connection,$sql_Delete);
    if (!$result){
        die ('Thất bại: '. mysqli_error($connection));
    } else {
        echo 'Thành công: '. $sql_Delete . '</br>';
    };

// Xóa tất cả dữ liệu khách hàng có năm sinh 1971 và năm đăng ký 2006
$sql_Delete1971_2006 = "DELETE FROM KHACHHANG WHERE YEAR(NGSINH) = 1971 AND YEAR(NGDK) = 2006";

$result = mysqli_query($connection,$sql_Delete1971_2006);
    if (!$result){
        die ('Thất bại: '. mysqli_error($connection));
    } else {
        echo 'Thành công: '. $sql_Delete1971_2006 . '</br>';
    };

// Xóa tất hoá đơn có mã KH = KH01
$sql_Delete_HoaDon = "DELETE FROM HOADON WHERE MAKH = 'KH01'";

$result = mysqli_query($connection,$sql_Delete_HoaDon);
    if (!$result){
        die ('Thất bại: '. mysqli_error($connection));
    } else {
        echo 'Thành công: '. $sql_Delete_HoaDon . '</br>';
    };

// Đóng kết nối
mysqli_close($connection);
?>