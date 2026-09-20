<?php
require_once 'connectdb.php';

$sql = "SELECT * FROM products";
$rs = mysqli_query($conn, $sql);

echo "<h1>สุทธิภูมินท์ อาจหาร(บิ๊กบอส)</h1>";

while ($data = mysqli_fetch_array($rs)) {
    echo $data['name']."-----".$data['price']."<br>";
}
?>