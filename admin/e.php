<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>21Missionboss - ระบบจัดการสินค้า</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f4f5f0;
            color: #333;
            display: flex;
            justify-content: center;
            padding: 50px 20px;
            margin: 0;
        }
        .admin-card {
            background: #ffffff;
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 850px; /* ขยายความกว้างให้เต็มตาขึ้น */
            border-top: 6px solid #556B2F;
        }
        h1 {
            color: #556B2F;
            text-align: center;
            font-size: 26px;
            margin-top: 0;
            margin-bottom: 35px;
        }
        
        /* สร้าง Grid Layout 2 คอลัมน์ */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        /* คลาสสำหรับช่องที่อยากให้กว้างเต็มบรรทัด */
        .full-width {
            grid-column: 1 / -1;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #4a4a4a;
            font-size: 14px;
        }
        input[type="text"], 
        input[type="number"], 
        select, 
        input[type="file"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-family: 'Prompt', sans-serif;
            font-size: 15px;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }
        input:focus, select:focus {
            border-color: #556B2F;
            background-color: #fff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(85, 107, 47, 0.15);
        }
        input[type="file"] {
            padding: 9px;
        }
        button {
            grid-column: 1 / -1; /* ให้ปุ่มบันทึกกว้างเต็มบรรทัด */
            background-color: #556B2F;
            color: white;
            padding: 16px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-family: 'Prompt', sans-serif;
            margin-top: 15px;
        }
        button:hover {
            background-color: #3e4f22;
        }

        /* รองรับหน้าจอมือถือ (ปรับกลับเป็นคอลัมน์เดียวถ้าย่อจอ) */
        @media (max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="admin-card">
    <h1>เพิ่มรายการสินค้าใหม่</h1>
    
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-grid">
            
            <!-- แถวที่ 1: รหัส กับ หมวดหมู่ -->
            <div class="form-group">
                <label>รหัสสินค้า (SKU)</label>
                <input type="text" name="psku" placeholder="เช่น BP-001" required>
            </div>
            <div class="form-group">
                <label>หมวดหมู่สินค้า</label>
                <select name="pcategory" required>
                    <option value="" disabled selected>-- เลือกหมวดหมู่ --</option>
                    <option value="1">กระเป๋าเป้</option>
                    <option value="2">เครื่องแต่งกาย</option>
                    <option value="3">อุปกรณ์เดินป่าและส่องสว่าง</option>
                    <option value="4">อุปกรณ์เอาตัวรอดและที่พักอาศัย</option>
                    <option value="5">อุปกรณ์ทำครัว</option>
                </select>
            </div>

            <!-- แถวที่ 2: ชื่อสินค้า (เต็มบรรทัด) -->
            <div class="form-group full-width">
                <label>ชื่อสินค้า</label>
                <input type="text" name="pname" placeholder="ระบุชื่อสินค้า" required>
            </div>
            
            <!-- แถวที่ 3: ราคา กับ สต็อก -->
            <div class="form-group">
                <label>ราคาสินค้า (บาท)</label>
                <input type="number" name="pprice" placeholder="0.00" required>
            </div>
            <div class="form-group">
                <label>สินค้าคงเหลือ (ชิ้น)</label>
                <input type="number" name="pstoc" placeholder="0" required> 
            </div>

            <!-- แถวที่ 4: คำอธิบาย (เต็มบรรทัด) -->
            <div class="form-group full-width">
                <label>คำอธิบายสินค้า</label>
                <!-- เปลี่ยน input text เป็น textarea เพื่อให้กรอกรายละเอียดได้ยาวๆ ง่ายขึ้น -->
                <textarea name="pdesc" rows="3" placeholder="ระบุรายละเอียดเพิ่มเติม" style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-family: 'Prompt'; background-color: #fafafa;" required></textarea>
            </div>
            
            <!-- แถวที่ 5: รูปภาพ (เต็มบรรทัด) -->
            <div class="form-group full-width">
                <label>อัปโหลดรูปภาพสินค้า</label>
                <input type="file" name="pimage" accept="image/*" required>
            </div>
            
            <!-- ปุ่มบันทึก -->
            <button type="submit" name="submit">บันทึกข้อมูลสินค้า</button>

        </div>
    </form>
</div>

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
    echo "alert('เพิ่มข้อมูลสินค้าสำเร็จ!');";
    echo "window.location.href = '';"; 
    echo "</script>";
}
?>

</body>
</html>