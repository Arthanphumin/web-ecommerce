<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>21Missionboss</title>
</head>
<body>
<h1>สุทธิภูมินท์ อาจหาร(บิ๊กบอส)</h1>



<form method="post" action="" enctype="multipart/form-data">
    รหัสสินค้า <input type="text" name="psku" required> <br>
    ชื่อสินค้า <input type ="text" name ="pname" required> <br>
    ราคาสินค้า <input type ="number" name ="pprice" required> <br>
    คำอธิบายสินค้า <input type="text" name="pdesc" required> <br>
    สินค้าคงเหลือ <input type="text" name="pstoc" required> <br>
    รูปภาพสินค้า <input type="file" name="pimage" accept="image/*" required> <br>

    หมวดหมู่สินค้า 
    <select name="pcategory" required>
        <option value="1">กระเป๋าเป้</option>
        <option value="2">เครื่องแต่งกาย</option>
        <option value="3">อุปกรณ์เดินป่าและส่องสว่าง</option>
        <option value="4">อุปกรณ์เอาตัวรอด</option>
        <option value="5">อุปกรณ์ทำครัว</option>
    </select> <br>
    
    <button type ="submit" name ="submit"> บันทึก </button>
</form>



<?php
if(isset($_POST['submit'])){
    require_once '../connectdb.php';

    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pdesc = $_POST['pdesc'];
    $pstoc = $_POST['pstoc'];
    $psku = $_POST['psku']; 
    $pcategory = $_POST['pcategory'];

    $image_name = $_FILES['pimage']['name']; 
    $tmp_name = $_FILES['pimage']['tmp_name']; 
    $folder = "../images/"; 


    move_uploaded_file($tmp_name, $folder . $image_name);


    $sql = "INSERT INTO products (name, category_id, sku, price, description, stock_quantity, image_url) 
        VALUES ('{$pname}', '{$pcategory}', '{$psku}', '{$pprice}', '{$pdesc}', '{$pstoc}', '{$image_name}')";
        
    mysqli_query($conn, $sql) or die ("เพิ่มข้อมูลไม่ได้");

    echo "<script>";
    echo "alert('เพิ่มข้อมูลสำเร็จ');";
    echo "</script>";




}
?>

</body>
</html>