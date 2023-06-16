<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "b";
$connection = mysqli_connect($servername,$username,$password);

if(!$connection)
    die("Không thành công  " . mysqli_error()); 
    // Thông báo lỗi nếu kết nối Không thành công 
if (!mysqli_select_db($connection, $database))     
    die("Không thành công  " . mysql_error()); 
   // Thông báo lỗi nếu chọn CSDL Không thành công 
$createtable = "
   CREATE TABLE IF NOT EXiSTS orders (

    id  int(11) NOT NULL ,
    customer_id  int(11) NOT NULL ,
    total_amount float NOT NULL,
    order_date date NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
   )"; 
$result = mysqli_query($connection,$createtable);
if (!$result){
    die ('Không thành công : '. mysqli_error($connection));
} else {
    echo 'Thành công: '. $createtable. '</br>';
};

echo "____________________INSERT _______________________ <br/>";
    // Thêm mới

    $sql_insert = "
    INSERT INTO orders (id, customer_id, total_amount, order_date)
    VALUES (3, 3, 100.000, '2023-06-15');
    ";
    $result = mysqli_query($connection,$sql_insert);
    if (!$result){
        die ('Không thành công : '. mysqli_error($connection));
    } else {
        echo 'Thành công: '. $sql_insert. '</br>';
    };
    
echo "___________________________________________ <br/>";

$sql = "SELECT * FROM orders WHERE customer_id = 3;"; 
$result = mysqli_query($connection,$sql);
if (!$result){
   die ('Không thành công : '. mysqli_error($connection));
} else {
   echo 'Thành công: '. $sql. '</br>';
};

echo "___________________________________________ <br/>";
$sql_1 = "SELECT customers.*, orders.*
FROM customers
JOIN orders ON customers.id = orders.id;
"; 
$result = mysqli_query($connection,$sql_1);
if (!$result){
   die ('Không thành công : '. mysqli_error($connection));
} else {
   echo 'Thành công: '. $sql_1. '</br>';
};

echo "___________________________________________ <br/>";
$sql_2 = "SELECT DISTINCT email FROM customers;
"; 
$result = mysqli_query($connection,$sql_2);
if (!$result){
   die ('Không thành công : '. mysqli_error($connection));
} else {
   echo 'Thành công: '. $sql_2. '</br>';
};

    mysqli_close($connection);
?>

   

    