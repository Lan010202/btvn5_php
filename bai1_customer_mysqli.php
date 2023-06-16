<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "btvn5";
$connection = mysqli_connect($servername,$username,$password);

if(!$connection)
    die("Thất bại " . mysqli_error()); 
    // Thông báo lỗi nếu kết nối thất bại 
if (!mysqli_select_db($connection, $database))     
    die("thất bại " . mysql_error()); 
   // Thông báo lỗi nếu chọn CSDL thất bại
$createtable = "
   CREATE TABLE IF NOT EXiSTS customers (

    id  int(11) NOT NULL ,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    phone varchar(255) NOT NULL,
    PRIMARY KEY (id)
  
   )"; 
$result = mysqli_query($connection,$createtable);
if (!$result){
    die ('Thất bại: '. mysqli_error($connection));
} else {
    echo 'Thành công: '. $createtable. '</br>';
};

echo "____________________INSERT _______________________ <br/>";
    // Thêm mới

    $sql_insert = "
    INSERT INTO customers (id,name,email,phone)
    VALUES
    (1, 'Lan1', 'lan1@gmail.com', '123456777'),
    (2, 'Lan2', 'lan2@gmail.com', '123456888'),
    (3, 'Lan3', 'lan3@gmail.com', '333456789'),
    (1, 'Lan4', 'lan4@gmail.com', '444456789'),
    (1, 'Lan5', 'lan5@gmail.com', '555556789')";
    $result = mysqli_query($connection,$sql_insert);
    if (!$result){
        die ('Thêm mới không thành công: '. mysqli_error($connection));
    } else {
        echo 'Thêm mới thành công: '. $sql_insert. '</br>';
    };
    
echo "___________________UPDATE________________________ <br/>";
    // Update

    $sql_update = "UPDATE customers SET name = 'hong nhung 01' WHERE id = '1'";
    $result = mysqli_query($connection,$sql_update);
    if (!$result){
        die ('Update không thành công: '. mysqli_error($connection));
    } else {
        echo 'Update thành công: '. $sql_update. '</br>';
    };

echo "____________________DELETE_______________________ <br/>";
    // Xoá

    $sql_dlt = "DELETE FROM customers WHERE id = '4'"; 
     $result = mysqli_query($connection,$sql_dlt);
    if (!$result){
        die ('Xóa không thành công: '. mysqli_error($connection));
    } else {
        echo 'Xóa thành công: '. $sql_dlt. '</br>';
    };

echo "___________________________________________ <br/>";

$sql = "SELECT * FROM customers WHERE email = 'hn2@gmail.com';"; 
$result = mysqli_query($connection,$sql);
if (!$result){
   die ('Không thành công: '. mysqli_error($connection));
} else {
   echo 'Thành công: '. $sql. '</br>';
};
    mysqli_close($connection);
?>

   

    